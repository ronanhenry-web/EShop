<?php
include('INCLUDE/sessionStart.php');
include('INCLUDE/authentification.php');
?>
<?php
if (isset($_GET['add'])) {
    $number = $_GET['add'];
    if (isset($_SESSION['admin'])) {
        $user = $bdd->query('SELECT id FROM utilisateur WHERE mail="'.$_SESSION["admin"].'"');
        $test = $user->fetch(PDO::FETCH_OBJ);
    }
    else {
        $user = $bdd->query('SELECT id FROM utilisateur WHERE mail="'.$_SESSION["user"].'"');
        $test = $user->fetch(PDO::FETCH_OBJ);
    }
    if (isset($test->id)) {
        $add = $bdd->query('UPDATE panier SET quantity=quantity + 1 WHERE idUser='.$test->id.' AND idArticles='.$number.'');
    }
}

if (isset($_GET['minus'])) {
    $number = $_GET['minus'];
    if (isset($_SESSION['admin'])) {
        $user = $bdd->query('SELECT id FROM utilisateur WHERE mail="'.$_SESSION["admin"].'"');
        $test = $user->fetch(PDO::FETCH_OBJ);
    }
    else {
        $user = $bdd->query('SELECT id FROM utilisateur WHERE mail="'.$_SESSION["user"].'"');
        $test = $user->fetch(PDO::FETCH_OBJ);
    }
    if (isset($test->id)) {
        $quantity = $bdd->query('SELECT * FROM panier WHERE idUser='.$test->id.' AND idArticles='.$number.'');
        $check_quantity = $quantity->fetch(PDO::FETCH_OBJ);
        if($check_quantity->quantity == '1' || $check_quantity->quantity < '1') {
            $remove = $bdd->query('DELETE FROM panier WHERE idUser='.$test->id.' AND idArticles='.$number.'');
        }
        else {
            $remove = $bdd->query('UPDATE panier SET quantity=quantity - 1 WHERE idUser='.$test->id.' AND idArticles='.$number.'');
        }
    }
}

if (isset($_GET['delete'])) {
    $number = $_GET['delete'];
    if (isset($_SESSION['admin'])) {
        $user = $bdd->query('SELECT id FROM utilisateur WHERE mail="'.$_SESSION["admin"].'"');
        $test = $user->fetch(PDO::FETCH_OBJ);
    }
    else {
        $user = $bdd->query('SELECT id FROM utilisateur WHERE mail="'.$_SESSION["user"].'"');
        $test = $user->fetch(PDO::FETCH_OBJ);
    }
    if (isset($test->id)) {
        $delete = $bdd->query('DELETE FROM panier WHERE idUser='.$test->id.' AND idArticles='.$number.'');
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="stylePanier.css">
        <link rel="stylesheet" href="ADMIN/bootstrap-5.1.3-dist/css/bootstrap.min.css">
        <script src="https://kit.fontawesome.com/207352b49e.js" crossorigin="anonymous"></script>
        <title>E-SHOP</title>
    </head>

    <body>
        <!-- Header -->
        <div class="font_navbar">  
            <div class="font_logo">
            </div>
            <div class="font_navbar--menu">
                <a href="index" class="font_navbar--menu-link"><i class="fas fa-home"></i></i> Accueil</a>
                <a href="panier" class="font_navbar--menu-link"><i class="fas fa-cart-plus"></i> Panier</a>
                <a href="deconnexion" class="font_navbar--menu-link"><i class="fas fa-door-open"></i></i></a>
            </div>
        </div>
        <!-- Recherche articles panier -->
        <?php
        $user = $bdd->query('SELECT id FROM utilisateur WHERE mail="'.$_SESSION["admin"].'"');
        $test = $user->fetch(PDO::FETCH_OBJ);
        $allArticles = $bdd->query('SELECT * FROM panier INNER JOIN articles ON panier.idArticles = articles.id WHERE idUser='.$test->id.'');
        $totalArticles = 0;
        ?>

        <!-- Panier -->
        <h3 class="titrePanier">Votre panier</h3>
        <div>
            <table class="board">
                <?php
                if($allArticles->rowCount() > 0) {
                ?>
                <thead>
                    <tr>
                        <td><strong>Produit</strong></td>
                        <td><strong>Prix</strong></td>
                        <td><strong>Quantité</strong></td>
                        <td><strong>Total</strong></td>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach($allArticles->fetchAll(PDO::FETCH_OBJ) as $article): ?>
                        <tr>
                            <td>
                                <br>
                                <img src="<?= $article->image ?>" class="img">
                                <p><?= $article->description ?></p>
                                <br>
                            </td>
                            <td>
                                <p><?= $article->prix ?> €</p>
                            </td>
                            <td>
                                <form action="panier" method="get">
                                    <a href="?add=<?= $article->idArticles; ?>" class="btn btn-success qty"><i class="fa-solid fa-plus"></i></a>
                                    <p class="btn btn-warning"><?= $article->quantity ?></p>
                                    <a href="?minus=<?= $article->idArticles; ?>" class="btn btn-info qty"><i class="fa-solid fa-minus"></i></a>
                                    <a href="?delete=<?= $article->idArticles; ?>" class="btn btn-danger qty"><i class="fas fa-trash"></i></a>
                                </form>
                            </td>
                            <td>
                                <p><?= $article->prix * $article->quantity?> €</p>
                            </td>
                        </tr>
                        <?php $totalArticles += $article->prix * $article->quantity ?>
                        <?php endforeach; ?>
                        <p class="totalArticles">Total des articles : <?= $totalArticles ?> €</p>
                    <?php
                    } else {
                    ?>
                        <br>
                        <br>
                        <p class="vide">Votre panier est vide</p>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>