<?php
session_start();
require_once 'connect.php';

$login = $_POST['login'];
$password = $_POST['password'];


if ($login === 'Adminka' && $password === 'admin') {
    $_SESSION['user'] = [
        "role" => "admin"
    ];
    header('Location: ../admin.php');
    exit();
}


$password = md5($password);


$query = "SELECT * FROM users WHERE login = \$1 AND password = \$2";
$result = pg_query_params($connect, $query, array($login, $password));

if ($result && pg_num_rows($result) > 0) {
    $user = pg_fetch_assoc($result);
    $_SESSION['user'] = $user; 
    header("Location: ../horder.php");
    exit();
} else {
    header("Location: ../log.php");
    exit();
}
?>
