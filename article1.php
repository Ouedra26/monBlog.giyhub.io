<?php
// 1- Je require ma connexion à la base de données
require('../modelisationBDD/connect.php');

// 2- Réception des infos de l'article sélectionné grâce aux infos récupérées dans l'URL avec $_GET
if(isset($_GET['id'])){
    $article = $pdoBlog->prepare(" SELECT * FROM articles WHERE id = :id ");
    $article->execute(array(
        ':id' => $_GET['id'],/* J'associe le marqueur vide à l'id de l'article */
    ));

    if($article->rowCount() == 0){/* si le code renvoie un id inconnu */
        header('location:articles1.php');
        exit();
    }
    $resultat = $article->fetch(PDO::FETCH_ASSOC);
}else {
    header('location:articles1.php');
    exit();
}

// 4- MàJ d'un article
if (!empty($_POST)){
    $_POST['titre'] = htmlspecialchars($_POST['titre']);
    $_POST['contenu'] = htmlspecialchars($_POST['contenu']);
    $_POST['image'] = htmlspecialchars($_POST['image']);
    $_POST['auteur'] = htmlspecialchars($_POST['auteur']);
    $_POST['date_parution'] = htmlspecialchars($_POST['date_parution']);

    $resultat = $pdoBlog->prepare(" UPDATE articles SET titre = :titre, contenu=:contenu, image = :image, auteur = :auteur, date_parution = :date_parution WHERE id = :id ");

    $resultat->execute(array(
        ':titre' => $_POST['titre'],
        ':contenu' => $_POST['contenu'],
        ':image' => $_POST['image'],
        ':auteur' => $_POST['auteur'],
        ':date_parution' => $_POST['date_parution'],
        ':id' => $_GET['id'],
    ));

    header('location:articles1.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MON BLOG - Page des articles</title>
    <!-- BOOTSWATCH CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.3/lux/bootstrap.min.css" integrity="sha512-B5sIrmt97CGoPUHgazLWO0fKVVbtXgGIOayWsbp9Z5aq4DJVATpOftE/sTTL27cu+QOqpI/jpt6tldZ4SwFDZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body>

<?php require 'inc/nav.inc.php'; ?>

    <div class="p-5 bg-primary">
        <div class="container">
            <h1 class="display-3 text-white"><?php echo $resultat['titre']; ?></h1>
            <p class="lead text-white"><?php echo $resultat['auteur']; ?></p>
            <p><small class="text-white"><?php echo $resultat['date_parution']; ?></small></p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto m-5">
                <img src="<?php echo $resultat['image'] ?>" alt="Illustration article" class="img-fluid">
                <?php echo $resultat['contenu'] ?>
            </div>

           <?php if(!estAdmin()) { ?>
            <div class="col-8 mx-auto my-5">
                <h2 class="text-center">Mise à jour de l'article</h2>
                <form action="#" method="POST">
                    <!-- lorsque l'on fait une formulaire de mise à jour, il faut penser à passer en value les données déjà présentes dans la BDD pour voir ce que l'on veut modifier -->

                    <div class="mb-3">
                        <label for="titre">Titre de l'article</label>
                        <input type="text" name="titre" id="titre" class="form-control" value="<?php echo $resultat['titre'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="contenu">Contenu de l'article</label>
                        <textarea type="text" name="contenu" id="contenu" class="form-control" ><?php echo $resultat['contenu'] ?></textarea><!-- l'attribut value ne fonctionne pas sur le textarea => on met donc le contenu entre les balises ouvrantes et fermantes -->
                    </div>

                    <div class="mb-3">
                        <label for="image">URL de l'image</label>
                        <input type="text" name="image" id="image" class="form-control" value="<?php echo $resultat['image'] ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="auteur">Auteur de l'article</label>
                        <input type="text" name="auteur" id="auteur" class="form-control" value="<?php echo $resultat['auteur']; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="date_parution">Date de parution de l'article</label>
                        <input type="date" name="date_parution" id="date_parution" class="form-control" value="<?php echo $resultat['date_parution'] ?>">
                    </div>

                    <button type="submit" class="btn btn-warning">Mettre à jour</button>

                </form>
            </div>
            <?php } ?>
        </div>
    </div>


    <!-- BOOTSWATCH JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>