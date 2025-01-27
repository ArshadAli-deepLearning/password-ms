<?php
error_reporting(32767);
ini_set('display_errors', 1);

$basepath = realpath(__DIR__ . '/..');

require_once $basepath . '/lib/Database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

session_start();
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}
$password_id = isset($_POST['password_id']) ? intval($_POST['password_id']) : 0;
$input_password = isset($_POST['password']) ? trim($_POST['password']) : '';
if ($password_id <= 0 || empty($input_password)) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

try {
    $db = new Database();
    $sql = "SELECT id FROM tbl_users WHERE id = :id AND password = :password LIMIT 1";
    $stmt = $db->pdo->prepare($sql);
    $stmt->bindValue(':id', $_SESSION['id']);
    $stmt->bindValue(':password', SHA1($input_password));
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        // Fetch the stored hashed password from the secure passwords table
        $sql = "SELECT password FROM tbl_passwords WHERE id = :id LIMIT 1";
        $stmt = $db->pdo->prepare($sql);
        $stmt->bindValue(':id', $password_id);
        $stmt->execute();
        $password_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$password_data) {
            echo json_encode(['success' => false, 'message' => 'Password not found']);
            exit;
        }
        $hashed_password = $password_data['password'];
        echo json_encode(['success' => true, 'message' => 'Password verified', 'password' => $hashed_password]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Incorrect password']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error', 'error' => $e->getMessage()]);
}
