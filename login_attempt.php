<?php
session_start();

if ($_GET['username'] == "admin" && $_GET['password'] == "s3cr3t")
{
    header("Location: index.php");
    $_SESSION['admin'] = "true";
}
else
{
    header("Location: login.php");
    $_SESSION['admin'] = "false";
}
?>