<?php
    session_start();
    if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
        header ('Location: connexion');
        exit();
    }
?>