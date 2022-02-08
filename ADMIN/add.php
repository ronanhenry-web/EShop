<?php 
session_start();
if (!isset($_SESSION['admin'])) {
    header ('Location: ../');
    exit();
}
include('../INCLUDE/authentification.php');
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
        <script src="https://kit.fontawesome.com/6ca76ec2b7.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
        <title>Ajouter article</title>
    </head>

    <body>
        <!-- Barre à gauche -->
        <section id="menu">
            <div class="logo">
                <img src="/IMG/admin.png" alt="">
                <h2>Dashboard</h2>
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
            <div class="n1"></div>
        </div>

        <!-- Formulaire pour ajouter article -->
        <form method="post">
        <h3 class="i-name">Avec ce formulaire vous pouvez ajouter autant d'article que vous souhaitez !</h3>
        <br>
        <div class ="container">
            <div class="mb-3">  
                <label for="exampleInputEmail1" class="form-label">Nom de l'article :</label>
                <input type="text" class="form-control" name="nom" required>
            </div>
            <div class="mb-3">  
                <label for="exampleInputEmail1" class="form-label">Quantité d'article :</label>
                <input type="number" class="form-control" name="stock" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Prix de l'article :</label>
                <input type="number" class="form-control" name="prix" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Image de l'article :</label>
                <input type="name" class="form-control" name="image" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Description de l'article :</label>
                <textarea class="form-control" name="desc" required></textarea>
            </div>
            <br>
            <br>
            <br>
            <div class="box">
                <form action="addArticle.php" method="post" required>
                    <select name="categorie">
                        <?php 
                        $bdd = new pdo("mysql:host=localhost;dbname=e-shop;charset=utf8", "root", "");
                        $requete = $bdd->prepare('SELECT * FROM categorie'); 
                        $requete->execute(); 
                        foreach($requete->fetchAll(PDO::FETCH_OBJ) as $categories): 
                        ?>
                        <option value="<?= $categories->type ?>"><?= $categories->type ?></option>
                        <?php endforeach;?>
                    </select>
                </form>
            </div>
            <br>
            <br>
            <button type="submit" name="valider" class="btn btn-success">Ajouter article</button>
        </div>
        </form>
    </body>
</html>

<?php
    if(isset($_POST['valider'])) {
        if(isset($_POST['nom']) AND isset($_POST['prix']) AND isset($_POST['image'])
        AND isset($_POST['desc']) AND isset($_POST['categorie'])) {
            $requete = $bdd->prepare("INSERT INTO articles (nom, prix, image, description, categorie) VALUES ('".$_POST["nom"]."','".$_POST["prix"]."', '".$_POST["image"]."', '".$_POST["desc"]."', '".$_POST["categorie"]."')");
            $requete->execute();
        }
    }
?>