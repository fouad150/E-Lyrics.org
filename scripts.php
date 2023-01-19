<?php
include "classes/databaseClass.php";
$dbConnection = new databaseConnection();
$pdo = $dbConnection->connection();

include "classes/loginClass.php";
$login_object = new login();
if (isset($_POST['login'])) {
    $password = $_POST['password'];
    $email = $_POST['email'];
    if ($login_object->checkEmpty($email, $password)) {
        $_SESSION['err-empty'] = "please fill all the fields";
        header("location:login.php");
    } else if ($login_object->checkExist($email, $password)) {
        // echo $_SESSION['profil'];
        header("location:dashboard.php");
    } else {
        $_SESSION['err-login'] = "Email or password incorrect try again";
        header("location:login.php");
    }
}


include "classes/songClass.php";
$song_object = new song();
if (isset($_POST["save"])) $song_object->insert();
if (isset($_POST["update"])) $song_object->update();
if (isset($_POST["delete"])) $song_object->delete();
