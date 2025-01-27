<?php
error_reporting(32767);
ini_set('display_errors', 1);

$basepath = realpath(__DIR__ . '/..');

include_once $basepath . '/lib/Database.php';
include_once $basepath . '/lib/Session.php';

class Passwords
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

// Add New Password
public function addNewPassword($data)
{
    Session::init();
    $data['user_id'] = Session::get('id');
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['expires_at'] = date('Y-m-d H:i:s', strtotime('+30 day'));

    if (
        empty($data['user_id']) || empty($data['strength']) || empty($data['password_for']) ||
        empty($data['username']) || empty($data['password']) || empty($data['login_url'])
    ) {
        return '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Input fields must not be empty!</div>';
    }

    // Insert query for tbl_passwords
    $sql = "INSERT INTO `tbl_passwords` (`id`, `user_id`, `strength`, `password_for`, `username`, `password`, `login_url`, `created_at`, `expires_at`) 
            VALUES (NULL, :user_id, :strength, :password_for, :username, :password, :login_url, :created_at, :expires_at)";
    
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':user_id', $data['user_id']);
    $stmt->bindValue(':strength', $data['strength']);
    $stmt->bindValue(':password_for', $data['password_for']);
    $stmt->bindValue(':username', $data['username']);
    $stmt->bindValue(':password', $data['password']);
    $stmt->bindValue(':login_url', $data['login_url']);
    $stmt->bindValue(':created_at', $data['created_at']);
    $stmt->bindValue(':expires_at', $data['expires_at']);

    $result = $stmt->execute();

    if ($result) {
        return '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success !</strong> Password added successfully!</div>';
    } else {
        return '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Something went wrong!</div>';
    }
}



  // Select All Tutorials Method
  public function selectAllPasswords()
  {
    Session::init();
    $user_id = Session::get('id');
    $sql = "SELECT * FROM tbl_passwords WHERE user_id = '$user_id' ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // Delete Tutorial by Id Method
  public function deletePasswordById($remove)
  {
    Session::init();
    $user_id = Session::get('id');
    $sql = "DELETE FROM tbl_passwords WHERE id = :id AND user_id = :user_id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $stmt->bindValue(':user_id', $user_id);
    $result = $stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> Password Deleted Successfully !</div>';
      return $msg;
    } else {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Unable to Delete Password!</div>';
      return $msg;
    }
  }
}
