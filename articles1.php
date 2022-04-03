<?php
// 1- Je require ma connexion à la base de données
require('../modelisationBDD/connect.php');

// 2- Ma requête pour le tableau
$requete = $pdoBlog->query(" SELECT * FROM articles ");

// 3- Traitement de l'ajout d'article
if (!empty($_POST)) { // Je vérifie que le formulaire n'est pas vide puis j'exécute le code
    /* Vérification insertion SQL et failles */
    $POST['image'] = htmlspecialchars($_POST['image']);
    $POST['titre'] = htmlspecialchars($_POST['titre']);
    $POST['contenu'] = htmlspecialchars($_POST['contenu']);
    $POST['auteur'] = htmlspecialchars($_POST['auteur']);
    $POST['date_parution'] = htmlspecialchars($_POST['date_parution']);

    /* Je prépare ma requête avec des marqueurs vides, pour l'instant */
    $insertion = $pdoBlog->prepare(" INSERT INTO articles (titre, contenu, image, auteur, date_parution) VALUES (:titre, :contenu, :image, :auteur, :date_parution) ");

    /* Je fais correspondre mes marqueurs vides aux éléments de mon form */
    $insertion->execute(array(
        ':titre' => $_POST['titre'],
        ':contenu' => $_POST['contenu'],
        ':image' => $_POST['image'],
        ':auteur' => $_POST['auteur'],
        ':date_parution' => $_POST['date_parution'],
    ));
}

// 4- J'initialise la vaiable contenu qui va servir pour les messages de réussite ou d'erreur pour la suppression
$contenu = "";/* JE FAIS BIEN ATTENTION !!! il ne faut pas qu'il y est d'espace pour l'initialisation */

// 5- Suppression d'un article
if (isset($_GET['action']) && $_GET['action'] == 'suppression' && isset($_GET['id'])) {/* je fais toutes mes vérifications pour la suppression dans l'URL du bouton supprimer */
    // Je prépare ma requête avec un marqueur vide
    $delete = $pdoBlog->prepare(" DELETE FROM articles WHERE id = :id ");
    // Je fais correspondre le marqueur à l'élément recherché
    $delete->execute(array(
        ':id' => $_GET['id']
    ));

    if ($delete->rowCount() == 0) {/* si ça n'a pas fonctionné */
        $contenu .= '<div class="alert alert-danger">Erreur de suppression de l\'article n° ' . $_GET['id'] . '</div>';
    } else {/* sinon, c'est que ça a fonctionné */
        $contenu .= '<div class="alert alert-success">L\'article n° ' . $_GET['id'] . ' a bien été supprimé</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MON BLOG - Page des articles</title>
    <!-- BOOTSWATCH CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.3/lux/bootstrap.min.css" integrity="sha512-B5sIrmt97CGoPUHgazLWO0fKVVbtXgGIOayWsbp9Z5aq4DJVATpOftE/sTTL27cu+QOqpI/jpt6tldZ4SwFDZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body>
<?php require 'inc/nav.inc.php'; ?>

    <div class="p-5 bg-primary">
        <div class="container">
            <h1 class="display-3 text-white">MON BLOG</h1>
            <p class="lead text-white">Page des articles</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php echo $contenu; ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Titre</th>
                            <th>Contenu</th>
                            <th>Image</th>
                            <th>Auteur</th>
                            <th>Date de parution</th>
                            <th>Actions</th>
                        </tr>
                    </thead><!-- fin de l'en-tête -->
                    <tbody>
                        <?php while ($article = $requete->fetch(PDO::FETCH_ASSOC)) { ?>
                            <!-- OUVERTURE DE LA BOUCLE WHILE // Ce n'est pas parce que je ne suis plus dans un passage PHP que ma boucle ne continue pas // Tant que je n'ai pas mis d'accolade fermante, la boucle continue -->
                            <tr>
                                <td><?php echo $article['id']; ?></td>
                                <td><?php echo $article['titre']; ?></td>
                                <td><?php echo substr($article['contenu'], 0,70); ?><a href="article1.php?id=<?php echo $article['id']; ?>" class="btn btn-outline-primary btn-sm"> [VOIR LA SUITE]</a></td>
                                <td><img src="<?php echo $article['image']; ?>" alt="Illustation article" class="img-fluid"></td>
                                <td><?php echo $article['auteur']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($article['date_parution'])); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="article1.php?id=<?php echo $article['id']; ?>" class="btn btn-primary">Modifier</a>
                                        <a href="articles1.php?action=suppression&id=<?php echo $article['id']; ?>" class="btn btn-danger" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer cet article ?'))">Supprimer</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        <!-- Fermeture de ma boucle while -->
                    </tbody><!-- Fermeture de tbody -->

                </table>


            </div>
            <div class="col-8 mx-auto">
                <h2 class="text-center">Ajout d'un article</h2>
                <form action="#" method="POST" class="border bg-light p-2 rounded mx-auto">
                    <div class="mb-3">
                        <label for="titre">Titre de l'article</label>
                        <input type="text" name="titre" id="titre" class="form-control" required> <!-- l'attribut NAME nous sert à récupérer ce qui se trouve dans l'input pour l'envoyer dans la bdd // c'est la raison pour laquelle il faut absolument que le name corresponde à la colonne de notre bdd -->
                        <!-- Pour que quand je clique sur le label j'arrive directement dans l'input , je dois mettre la même chose dans le label FOR et dans l'input ID -->
                    </div><!-- TITRE -->

                    <div class="mb-3">
                        <label for="contenu">Contenu de l'article</label>
                        <input type="text" name="contenu" id="contenu" class="form-control" required><!-- grâce à ctrl + d je sélectionne tous les éléments "pareils" -->
                    </div><!-- CONTENU -->

                    <div class="mb-3">
                        <label for="image">Image</label>
                        <input type="text" name="image" id="image" class="form-control" required placeholder="URL de l'image">
                    </div><!-- IMAGE -->

                    <div class="mb-3">
                        <label for="auteur">Auteur de l'article</label>
                        <input type="text" name="auteur" id="auteur" class="form-control" required>
                    </div><!-- AUTEUR -->

                    <div class="mb-3">
                        <label for="date_parution">Date de parution</label>
                        <input type="date" name="date_parution" id="date_parution" class="form-control" required>
                    </div><!-- DTAE DE PARUTION -->

                    <button type="submit" class="btn btn-primary" name="submit">Ajouter l'article</button> <!-- BOUTON SUBMIT -->

                </form>
            </div>
        </div>
    </div>


    <!-- BOOTSWATCH JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>