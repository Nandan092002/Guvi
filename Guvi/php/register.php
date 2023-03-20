<?php
$dbHost = 'localhost';
$dbName = 'guvi';
$dbUser = 'root';
$dbPass = '';

$name     = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$newpassword = filter_input(INPUT_POST, 'newpassword', FILTER_SANITIZE_STRING);
$mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);


try {
  $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $db->prepare("INSERT INTO guvi (name, email, password, newpassword, mobile) VALUES (:name, :email, :password, :newpassword, :mobile)");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':password', $password);
  $stmt->bindParam(':newpassword', $newpassword);
  $stmt->bindParam(':mobile', $mobile);

  $stmt->execute();

  echo json_encode(array('success' => true));
} catch(PDOException $e) {
  echo json_encode(array('success' => false, 'error' => $e->getMessage()));
}
?>
