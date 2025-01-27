<?php
error_reporting(32767);
ini_set('display_errors', 1);

$basepath = realpath(__DIR__ . '/..');

include_once $basepath . '/lib/Database.php';
include_once $basepath . '/lib/Session.php';

class Tutorials
{
  // Db Property
  private $db;
  // Db __construct Method
  public function __construct()
  {
    $this->db = new Database();
  }

  // Date formate Method
  public function formatDate($date)
  {
    // date_default_timezone_set('Asia/Dhaka');
    $strtime = strtotime($date);
    return date('Y-m-d H:i:s', $strtime);
  }

  // Add New Tutorial By Admin
  public function addNewTutorialByAdmin($data)
  {
    Session::init();
    $title = $data['title'];
    $detail = $data['detail'];
    $link = $data['link'];
    $created_by = Session::get('id');

    if ($title == "" || $detail == "" || $link == "" || $created_by == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Input fields must not be Empty !</div>';
      return $msg;
    } else {

      $sql = "INSERT INTO tbl_tutorials(title, detail, link, created_by) VALUES(:title, :detail, :link, :created_by)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':title', $title);
      $stmt->bindValue(':detail', $detail);
      $stmt->bindValue(':link', $link);
      $stmt->bindValue(':created_by', $created_by);
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success !</strong> Wow, you have Added Tutorial Successfully !</div>';
        return $msg;
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Something went Wrong !</div>';
        return $msg;
      }
    }
  }

  // Select All Tutorials Method
  public function selectAllTutorialsData()
  {
    $sql = "SELECT * FROM tbl_tutorials ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function _selectAllTutorialsData() {
    $sql = "SELECT 
                t.id, 
                t.title, 
                t.detail, 
                t.link, 
                t.created_at, 
                u.name AS author_name
            FROM 
                tbl_tutorials t
            LEFT JOIN 
                tbl_users u 
            ON 
                t.created_by = u.id
            ORDER BY 
                t.created_at DESC";

    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
public function _getTutorialById($id) {
  $sql = "SELECT 
              t.id, 
              t.title, 
              t.detail, 
              t.link, 
              t.created_at, 
              u.name AS author_name 
          FROM 
              tbl_tutorials t 
          LEFT JOIN 
              tbl_users u 
          ON 
              t.created_by = u.id 
          WHERE 
              t.id = :id 
          LIMIT 1";

  // Debugging: Output the query
  // echo $sql;

  $stmt = $this->db->pdo->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_OBJ);
}
public function getLatestPosts($limit = 4) {
  $sql = "SELECT 
              id, 
              title, 
              link
          FROM 
              tbl_tutorials 
          ORDER BY 
              created_at DESC 
          LIMIT :limit";

  $stmt = $this->db->pdo->prepare($sql);
  $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_OBJ);
}

  // Get Single Tutorial By Id Method
  public function getTutorialById($id)
  {
    $sql = "SELECT * FROM tbl_tutorials WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }

  //
  //   Get Single Tutorial Information By Id Method
  public function updateTutorialByAdmin($id, $data)
  {
    $title = trim($data['title']);
    $detail = trim($data['detail']);
    $link = trim($data['link']);

    if ($title === "" || $detail === "" || $link === "") {
      return '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Error!</strong> Input fields must not be empty!
                </div>';
    }

    $sql = "UPDATE tbl_tutorials 
            SET title = :title, 
                detail = :detail, 
                link = :link 
            WHERE id = :id";

    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':detail', $detail, PDO::PARAM_STR);
    $stmt->bindValue(':link', $link, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> Tutorial updated successfully!
                             </div>');
      header("Location: index.php");
      exit();
    } else {
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Error!</strong> Unable to update tutorial!
                             </div>');
      header("Location: index.php");
      exit();
    }
  }

  // Delete Tutorial by Id Method
  public function deleteTutorialById($remove)
  {
    $sql = "DELETE FROM tbl_tutorials WHERE id = :id ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> Tutorial Deleted Successfully !</div>';
      return $msg;
    } else {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not Deleted !</div>';
      return $msg;
    }
  }
}
