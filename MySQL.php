<?php

echo("Creating tables in database...\n");

echo(shell_exec("mysql -u root -p < Sozdanie_BD.sql"));

echo(shell_exec("pip install pyodbc"));

echo(shell_exec("pip install pyTelegramBotAPI"));

echo(shell_exec("exit;"));


?>