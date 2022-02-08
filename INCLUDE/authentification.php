<?php
    try {
        $bdd = new pdo("mysql:host=localhost;dbname=e-shop;charset=utf8", "root", "");
        $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
?> 