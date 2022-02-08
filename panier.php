<?php
include('INCLUDE/sessionStart.php');
include('INCLUDE/authentification.php');
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="stylePanier.css">
        <script src="https://kit.fontawesome.com/6ca76ec2b7.js" crossorigin="anonymous"></script>
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
                                <p><?= $article->quantity ?></p>
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