<?php 
 session_start();
require "include.php";
 // tranforme le PATH_INFO en tableau avec le nom de chaque page
$url = trim($_SERVER['PATH_INFO'], '/');
    $url = explode('/', $url);
    $route = array("acceuil", "contact" , "produit" , "panier",
     "category" ,"actionInscription","actionConnexion" ,"updateProfil","profil" , 
     "Deconnexion" , "connexion", "actionUptade", "search" , "ajout" , "actionajout");
    $action = $url [0];

    // recupere la  première page du site 
    if(!in_array($action,$route)){
        $title = "Page error";
        $content = "URL introuvable !";
    }else{
       // affichage de la page selectionner
       $function = "display".ucwords($action);
       $title = "Page".$action;
       $content = $function();
    }
    //génere la view
    require VIEWS.SP."templates".SP."default.php";
?>