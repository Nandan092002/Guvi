<?php
$dbHost = 'localhost';
$dbName = 'guvi';
$dbUser = 'root';
$dbPass = '';

$email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

try {
  $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $db->prepare("SELECT email,password FROM guvi WHERE email=:email AND password=:password");
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':password', $password);
  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if($user) {
    echo json_encode(array('success' => true));
  } else {
    echo json_encode(array('success' => false, 'error' => 'Invalid email or password'));
  }
} catch(PDOException $e) {
  echo json_encode(array('success' => false, 'error' => $e->getMessage()));
}
?>