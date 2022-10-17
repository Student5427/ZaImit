<?php
session_start();

if ($_SESSION['username'] = "username" and $_SESSION['password'] = "qwerty")
{
    session_destroy();
    header('Location: admin.php');
} else {
    session_destroy();
    header('Location: workpage.php');
}
?>