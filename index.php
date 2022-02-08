<?php
include('INCLUDE/sessionStart.php');
include('INCLUDE/authentification.php');
?>
<?php
if (isset($_GET['id'])) {
    $idArticles = $_GET['id'];
    if (isset($_SESSION['admin'])) {
        $user = $bdd->query('SELECT id FROM utilisateur WHERE mail="'.$_SESSION["admin"].'"');
        $test = $user->fetch(PDO::FETCH_OBJ);
    }
    else {
        $user = $bdd->query('SELECT id FROM utilisateur WHERE mail="'.$_SESSION["user"].'"');
    }
    // // On récupère la liste du panier et on check si l'utilisateur ne possède pas déjà l'article
    $produit = $bdd->query('SELECT * FROM panier WHERE idUser='.$test->id.' AND idArticles='.$idArticles.'');
    $check_produit = $produit->fetch(PDO::FETCH_ASSOC);
    // Si l'article existe déjà on lui ajoute 1
    if($check_produit == '1' || $check_produit > '1') {
        $check_quantity = $produit->fetch(PDO::FETCH_OBJ);
        $quantity = $check_quantity->quantity + 1;
        $add = $bdd->query('UPDATE panier SET quantity=quantity + 1 WHERE idUser='.$test->id.' AND idArticles='.$idArticles.'');
    }
    else {
        $article = $bdd->query('INSERT INTO `panier`(`idUser`, `idArticles`, `quantity`) VALUES ('.$test->id.','.$idArticles.',1)');
    }
} 
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>E-Boutique</title>
        <link rel="stylesheet" href="style.css">
        <script src="https://kit.fontawesome.com/207352b49e.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="font_navbar">
            <div class="font_logo">
            </div>
            <div class="font_navbar--menu">
                <?php
                    if (isset($_SESSION['admin'])) {
                        echo  '<a href="ADMIN/" class="font_navbar--menu-link"><i class="fa-solid fa-bars"></i> Dashboard</a>';
                    }
                ?>
                <a href="index" class="font_navbar--menu-link"><i class="fas fa-home"></i></i> Accueil</a>
                <a href="panier" class="font_navbar--menu-link"><i class="fas fa-cart-plus"></i> Panier</a>
                <a href="deconnexion" class="font_navbar--menu-link"><i class="fas fa-door-open"></i></i></a>
            </div>
        </div>
        <div class="contenu">
            <form action="" method="post" class="custom-select">
                <select name="categorie" onChange="form.submit()"  class="categorie">
                    <option value="">Categorie</option>
                    <?php 
                        $requete = $bdd->prepare('SELECT * FROM categorie'); 
                        $requete->execute(); 
                        foreach($requete->fetchAll(PDO::FETCH_OBJ) as $categories): 
                    ?>
                        <option value="<?= $categories->type ?>"><?= $categories->type ?></option>
                    <?php endforeach;?>
                </select>
            </form>
            <div class="article">
                <?php
                    if(isset($_POST['categorie'])) {
                        $categorie = $_POST['categorie']; 
                        $requete = $bdd->prepare('SELECT * FROM articles WHERE categorie="'.$categorie.'"'); 
                    } else {
                        $requete = $bdd->prepare('SELECT * FROM articles'); 
                    }
                    
                    $requete->execute(); 
                    foreach($requete->fetchAll(PDO::FETCH_OBJ) as $article): 
                ?>
                <div class="card">
                    <div class="stock">
                        <?php
                            if ($article->stock > 5) {
                                echo "<h1>STOCK</h1>";
                            } else {
                                echo "<h1>OUT STOCK</h1>";
                            }
                        ?>
                    </div>
                    <div class="image" style="background:url('<?= $article->image ?>');height: 350px;backround-size: cover; background-position: center;"></div>
                    <p style="font-weight: bold; font-size: 17px;"><?= $article->nom ?></p>
                    <p><?= $article->description ?></p>
                    <p><?= $article->prix ?> €</p>
                    <form action="" method="GET">
                        <a href="?id=<?= $article->id; ?>" class="ajouter">
                            <i class=""> Ajouter </i>
                        </a>
                    </form>
                </div>
                <?php endforeach;?>
            </div>
    </body>
</html>
