<?php
error_reporting(32767);
ini_set('display_errors', 1);

$basepath = realpath(__DIR__ . '/..');

include_once $basepath . '/lib/Database.php';
include_once $basepath . '/lib/Session.php';

class Quiz
{
  // Database property
  private $db;

  // Constructor
  public function __construct()
  {
    $this->db = new Database();
  }

  // Format Date Method
  public function formatDate($date)
  {
    $strtime = strtotime($date);
    return date('Y-m-d H:i:s', $strtime);
  }
// Quiz.php
// Add New Quiz Method
public function addNewQuiz($data)
{
    $exname = $data['exname'];
    $desp = $data['desp'];
    $nq = $data['nq'];
    $extime = $data['extime'];
    $subt = $data['subt'];
    $subject = $data['subject'];

    if ($exname == "" || $desp == "" || $nq == "" || $extime == "" || $subt == "" || $subject == "") {
        return '<div class="alert alert-danger alert-dismissible mt-3">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong> Input fields must not be empty!</div>';
    }

    $sql = "INSERT INTO quiz_list (exname, desp, nq, extime, subt, subject)
            VALUES (:exname, :desp, :nq, :extime, :subt, :subject)";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':exname', $exname);
    $stmt->bindValue(':desp', $desp);
    $stmt->bindValue(':nq', $nq);
    $stmt->bindValue(':extime', $extime);
    $stmt->bindValue(':subt', $subt);
    $stmt->bindValue(':subject', $subject);
    $result = $stmt->execute();

    if ($result) {
        return '<div class="alert alert-success alert-dismissible mt-3">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Quiz added successfully!</div>';
    } else {
        return '<div class="alert alert-danger alert-dismissible mt-3">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong> Something went wrong!</div>';
    }
}


public function updateQuiz($quizId, $data)
{
    $title = $data['exname'];
    $description = $data['desp'];
    $questions = $data['nq'];
    $examTime = $data['extime'];
    $submissionTime = $data['subt'];
    $subject = $data['subject'];

    if ($title == "" || $description == "" || $questions == "" || $examTime == "" || $submissionTime == "" || $subject == "") {
        return '<div class="alert alert-danger">All fields are required!</div>';
    }

    // Update query
    $sql = "UPDATE quiz_list SET 
            exname = :title, 
            desp = :description, 
            nq = :questions, 
            extime = :examTime, 
            subt = :submissionTime, 
            subject = :subject 
            WHERE exid = :id";  // Change 'id' to 'exid' or the correct column name
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':questions', $questions);
    $stmt->bindValue(':examTime', $examTime);
    $stmt->bindValue(':submissionTime', $submissionTime);
    $stmt->bindValue(':subject', $subject);
    $stmt->bindValue(':id', $quizId); // Bind the correct column name

    $result = $stmt->execute();

    if ($result) {
        return '<div class="alert alert-success">Quiz updated successfully!</div>';
    } else {
        return '<div class="alert alert-danger">Quiz update failed!</div>';
    }
}
// Delete Quiz Method
public function deleteQuizById($quizId)
{
    $sql = "DELETE FROM quiz_list WHERE exid = :exid"; // Use the correct column name
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':exid', $quizId);
    $result = $stmt->execute();

    if ($result) {
        return '<div class="alert alert-success alert-dismissible mt-3">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Quiz deleted successfully!
                </div>';
    } else {
        return '<div class="alert alert-danger alert-dismissible mt-3">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong> Quiz not deleted.
                </div>';
    }
}
  // Get All Quizzes
  public function selectAllQuizzes()
  {
      // Use the correct column name for sorting
      $sql = "SELECT * FROM quiz_list ORDER BY exid DESC"; // Replace 'exid' with the correct primary key column name
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  

  // Get Quiz by ID
  public function getQuizById($quizId)
  {
    $sql = "SELECT * FROM quiz_list WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $quizId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
  public function getQuestionsByExamId($exid)
{
    $sql = "SELECT * FROM qstn_list WHERE exid = :exid ORDER BY sno ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':exid', $exid, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ); // Return as an array of objects
}
}
