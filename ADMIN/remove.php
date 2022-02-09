<?php 
session_start();
if (!isset($_SESSION['admin'])) {
    header ('Location: ../');
    exit();
}
include('../INCLUDE/authentification.php');
?>
<!-- Suppression id -->
<?php 
if (isset($_GET['id'])) {
    $sup = $bdd->query('DELETE FROM articles WHERE id='.$_GET['id'].'');
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
        <script src="https://kit.fontawesome.com/6ca76ec2b7.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
        <title>Supprimer article</title>
    </head>

    <body>
        <!-- Barre à gauche -->
        <section id="menu">
            <div class="logo">
                <img src="/IMG/admin.png" alt="">
                <h2><a href="../index" class="grosTitre">Dashboard</a></h2>
            </div>
            <div class="items">
                <li><i class="fas fa-users"></i><a href="./"> View Users</a></li>
                <li><i class="far fa-plus-square"></i><a href="add"> Add Articles</a></li>
                <li><i class="far fa-trash-alt"></i><a href="remove"> Remove Articles</a></li>
                <li><i class="fas fa-layer-group"></i><a href=""> Category</a></li>
            </div>
        </section> 
        <!-- Barre de recherche -->
        <section id="interface">
            <div class="navigation">
                <div class="n1">
                    <div class="search">
                        <i class="fas fa-search"></i>
                        <form method="GET">
                            <input type="search" name="s" placeholder="Rechercher un article" autocomplete="on">
                        </form>
                    </div>
                </div>
                <div class="profile">
                    <i class="fas fa-user"></i>
                </div>
            </div>

            <!-- Affichage articles -->
            <h3 class="i-name">Vous pouvez supprimer des articles !</h3>
            <?php
            $allArticles = $bdd->query('SELECT * FROM articles ORDER BY id DESC');
            if(isset($_GET['s']) AND !empty($_GET['s'])) {
                $recherche = htmlspecialchars($_GET['s']);
                $allArticles = $bdd->query('SELECT * FROM articles WHERE nom LIKE "'.$recherche.'%" ORDER BY id DESC');
            }
            ?>
            <div class="board">
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Nom</td>
                            <td>Quantité</td>
                            <td>Description</td>
                            <td>Catégorie</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($allArticles->rowCount() > 0) {
                        ?>
                            <?php foreach($allArticles->fetchAll(PDO::FETCH_OBJ) as $article): ?>
                                <tr>
                                    <td class="people">
                                        <img src="<?= $article->image ?>" alt="">
                                        <div class="profil">
                                            <h5><?= $article->nom ?></h5>
                                            <p><?= $article->prix ?>€</p>
                                        </div>
                                    </td>
                                    <td class="stock">
                                        <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<strong><?= $article->stock ?></strong></p>
                                    </td>
                                    <td class="description">
                                        <p><?= $article->description ?></p>
                                    </td>
                                    <td class="inscription">
                                        <p>&nbsp&nbsp&nbsp&nbsp<?= $article->categorie ?>&nbsp&nbsp&nbsp</p>
                                    </td>
                                    <td>
                                        <form method="get">
                                            <a href="?id=<?= $article->id; ?>" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php 
                        } else {
                            ?>
                            <p>Aucun article trouvé</p>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>