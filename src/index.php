<?php 
 //session_start();
require "include.php";
 // tranforme le PATH_INFO en tableau avec le nom de chaque page
$url = trim($_SERVER['PATH_INFO'], '/');
//print_r($url);exit();
    $url = explode('/', $url);
   
    $route = array("acceuil", "contact" , "produit" , "panier",
     "category" ,"actionInscription","actionConnexion" ,"updateProfil","profil" , 
     "Deconnexion" , "connexion", "actionUptade", "search" , "ajout" , "actionAjout" , "choixGenre", "ajoutOK", "test");
    $action = $url [0];

    // recupere la  première page du site 
    if(!in_array($action,$route)){
        $title = "<h1>Page error</h1>";
        $content = "<h1>URL introuvable </h1>!";
    }else{
       // affichage de la page selectionner
       $function = "display".ucwords($action);
       $title = "Page".$action;
       $content = $function();
    }
    //génere la view
    require VIEWS.SP."templates".SP."default.php";
?>