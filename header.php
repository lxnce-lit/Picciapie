<?php
include("./connection/config.php");


$status = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $status = 'invalid';
    } else {
        $db = connection();   
        if (!$db) {           
            $status = 'error';
        } else {
            $stmt = $db->prepare('INSERT INTO `contact us` (name, email, message) VALUES (?, ?, ?)');
            $stmt->bind_param('sss', $name, $email, $message);
            $status = $stmt->execute() ? 'sent' : 'error';
            $stmt->close();
            $db->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Piccapie | Pies and Cafe</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <link rel="icon" href="logo.png">
</head>
<body>
<!-- 2. HOME -->
<header id="home" class="hero">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-md-7">
        <h1 class="display-4 fw-bold">Fresh pies, hot coffee, one cozy table.</h1>
        <p class="lead my-4">Piccapie bakes small-batch sweet and savory pies every morning and pairs them with freshly brewed coffee. Come in for a slice or take a whole pie home.</p>
        <a href="#products" class="btn btn-light btn-lg me-2">See our pies</a>
        <a href="#contact" class="btn btn-outline-light btn-lg">Order inquiry</a>
      </div>
      <div class="col-md-5 text-center">
           <img src="./logo/mimi.png" alt="..." class="img-fluid" style="max-height:250px;">
    </div>
    </div>
  </div>
</header>