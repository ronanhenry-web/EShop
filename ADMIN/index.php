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
    $sup = $bdd->query('DELETE FROM utilisateur WHERE id='.$_GET['id'].'');
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <script src="https://kit.fontawesome.com/6ca76ec2b7.js" crossorigin="anonymous"></script>
        <title>Panel Admin</title>
    </head>
    <body>
        <!-- Barre à gauche -->
        <section id="menu">
            <div class="logo">
                <img src="/IMG/admin.png" alt="">
                <h2><a href="../index" class="grosTitre">Dashboard</a></h2>
            </div>
            <div class="items">
                <li><i class="fas fa-users"></i><a href="#"> View Users</a></li>
                <li><i class="far fa-plus-square"></i><a href="add"> Add Articles</a></li>
                <li><i class="far fa-trash-alt"></i><a href="remove"> Remove Articles</a></li>
                <li><i class="fas fa-layer-group"></i><a href=""> Category</a></li>
            </div>
        </section>
        <!-- Recherche users -->
        <?php
        $allUsers = $bdd->query('SELECT * FROM utilisateur ORDER BY id DESC');
        if(isset($_GET['s']) AND !empty($_GET['s'])) {
            $recherche = htmlspecialchars($_GET['s']);
            $allUsers = $bdd->query('SELECT * FROM utilisateur WHERE prenom LIKE "'.$recherche.'%" ORDER BY id DESC');
        }
        ?>

        <!-- Barre de recherche -->
        <section id="interface">
            <div class="navigation">
                <div class="n1">
                    <div class="search">
                        <i class="fas fa-search"></i>
                        <form method="GET">
                            <input type="search" name="s" placeholder="Rechercher un user" autocomplete="off">
                        </form>
                    </div>
                </div>
            </div>

        <!-- Stats -->
            <h3 class="i-name">
                Dashboard
            </h3>
            <div class="values">
                <?php ?>
                <div class="val-box">
                    <i class="fas fa-users"></i>
                    <div>
                        <?php 
                        $req = $bdd->query('SELECT COUNT(*) as Number FROM utilisateur');
                        $number = $req->fetch();
                        ?>
                        <h3><?=$number['Number']?></h3>
                        <span>Nombre users</span>
                    </div>
                </div>
                <div class="val-box">
                    <i class="fas fa-dollar-sign"></i>
                    <div>
                        <h3>260,000</h3>
                        <span>Chiffre d'affaire</span>
                    </div>
                </div>
                <div class="val-box">
                    <i class="fas fa-funnel-dollar"></i>
                    <div>
                        <?php 
                            $req = $bdd->query('SELECT COUNT(role) as admin FROM utilisateur WHERE role="Admin"');
                            $admin = $req->fetch();
                            ?>
                        <h3><?=$admin['admin']?></h3>
                        <span>Nombre d'admin</span>
                    </div>
                </div>
                <div class="val-box">
                    <i class="far fa-newspaper"></i>
                    <div>
                        <?php 
                            $req = $bdd->query('SELECT COUNT(*) as article FROM articles');
                            $article = $req->fetch();
                        ?>
                        <h3><?=$article['article']?></h3>
                        <span>Nombre d'article</span>
                    </div>
                </div>
            </div>
        <!-- View Users -->
            <div class="board">
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Nom</td>
                            <td>Téléphone</td>
                            <td>Inscription</td>
                            <td>Role</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($allUsers->rowCount() > 0) { ?>
                            <?php foreach($allUsers->fetchAll(PDO::FETCH_OBJ) as $user): ?>
                                <tr>
                                    <td class="people">
                                        <img src="../IMG/1.png" alt="">
                                        <div class="people-de">
                                            <h5><?= $user->prenom ?> <?= $user->nom ?></h5>
                                            <p><?= $user->mail ?></p>
                                        </div>
                                    </td>
                                    <td class="tel">
                                        <p>&nbsp&nbsp&nbsp&nbsp<?= $user->tel ?></p>
                                    </td>
                                    <td class="inscription">
                                        <p><?= $user->inscription ?></p>
                                    </td>
                                    <td class="role">
                                        <p>&nbsp&nbsp&nbsp&nbsp<?= $user->role ?></p>
                                    </td>
                                    <td class="supprimer">
                                        <form method="get">
                                            <a href="?id=<?= $user->id; ?>" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        <?php  } else { ?>
                            <p>Aucun utilisateur trouvé</p>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </body>
</html>