<?php 

//1- je créé ma fonction debug()
function debug($mavar){
    echo "<br><pre class=\"alert alert-warning\">";
    var_dump($mavar);
    echo "</pre>";
}

// 2- Je crée ma fonction pour vérifier que l'utilisateur est connecté
function estConnecte() {
    if (isset($_SESSION['membres'])) { /* SI dans la superglobale $_SESSION je récupère un indice membre, cela signifie que la personne est connectée */
        return true;/* il est connecté */
    }else{
        return false;/* il n'est pas connecté */
    }
}

// 3- Je vérifie que le membre qui est connecté est admin
function estAdmin() {
    if (estConnecte() && $_SESSION['membres']['statut'] == 1) {/* si l'utilisateur est connecté et que son statut est 1 alors il est admin */
        /* Je vérifie que l'on remplie les conditions de la fonction estConnecte() et que dans ma table membre, dans la colonne statut je récupère bien l'integer 1 qui correspond à ADMIN */
        return true; //connecté et admin
    }else {
        return false; // connecté mais pas admin
    }
}

?>