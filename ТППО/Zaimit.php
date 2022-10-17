<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="main_style.css">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/form.css">
    <title> Zaimit </title>
</head>
<body>
    <div class="topheader">
        <div class="container">
            <header class="header">
                <div class="logo">
                    <a href="#0">
                        <img src="Images/logo.jpeg" alt="logo">
                        <p>Ведём учет клиентов за вас</p>
                    </a>
                </div>
            </header>
        </div>
    </div>
    <?php
        session_start();
        if (isset($_POST['username']) and isset($_POST['password']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($username == "username" and $password == "qwerty")
            {
                $_SESSION['username'] = $username;
                header('Location: scripts/check.php');
            } 
            else {
                header('Location: scripts/workpage.php');
            }
        }
    ?>
    <main class="main-content">
        <div class="block">
            <form action="#" class="form" method = "POST">
                <p>
                    <input type="text" class="form_input" placeholder="Логин" name = "username">
                </p>
                <p>
                    <input type="text" class="form_input" placeholder="Пароль" name = "password">
                </p>
                <p>
                    <button class="form_btn" type = "submit">Войти</button>
                </p>
                <p>
                    <a href="scripts/forgotten.php" class="form_forgot">Востановить пароль</a>
                </p>
            </form>
        </div>
    <main>
</body>
</html>