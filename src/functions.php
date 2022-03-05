<?php 
//session_start();
// ACCEUIL 

use LDAP\Result;

function displayAcceuil(){
  session_start();
  if(!isset($_SESSION["customer"])){
    $result = '
    <div class="bg-white shadow-sm rounded p-6  mt-5 mx-auto" style = "width:30%" ; "background-color:#efefef">
           <form class="" action="actionInscription" method="post">
            <div class="mb-4 col-md4 col-md-offset-4 text-center ">
                 <h2 class="h4 align-items-center">Veuillez créez un compte</h2>
             </div>
           <!-- Input -->
  
       <div class="form-group col-md4 col-md-offset-4">
             <input type="text" id="Nom" name="firstname" class="form-control " value="" required="" placeholder="Nom">
        </div>
    
        <div class="input-group input-group form mt-2">
          <input type="text" id="Prenom" name="lastname" class="form-control " value="" required="" placeholder="Prénom">
        </div>
    
        <input type="radio" id="case1" name="groupe1" value="case 1" checked>
    
        <input type="radio" value=""></label>
           
            </div>
            
            <div>
  
        <div class="input-group input-group  mt-2 form">
          <input type="email" id="email" class="form-control " name="email" value="" required="" placeholder="Adresse email">
        </div>
   
     
      <div class="form-group col-md4 col-md-offset-4  mt-2">
          <input type="password" id ="pwd"class="form-control " name="pwd" value="" required="" placeholder="Mot de passe">
        </div>
  
      <div class="mt-1 col-md4 col-md-offset-4  mt-2 text-center">
          <button type="submit" class="btn btn-block btn-primary">S\'inscrire</button>
       </div>
    </form>
  </div>
';
  }else{
    $result = '<h1 class="mt-5 mr-5"> Bienvenue sur votre site de musique préféré </h1>
    <img src="'.BASE_URL.SP."image".SP."produit".SP."cheers-g6f8d5100c_1920.jpg".'" class="card-img-top" alt="...">
    ';
  }
    return $result;
}

//CONNEXION
function displayConnexion(){
  session_start();
  $result = '<div class=" opacity-75 bg-white mt-5 mx-auto shadow-sm rounded p-6" style = "width:30%">
  <form class="" action="actionConnexion" method="post">
    <div class="mb-4">
      <h2 class="h4">Connexion</h2>
    </div>
    <!-- Input -->
    <div class=" mb-3">
      <div class="input-group input-group form">
        <input type="email" class="form-control " name="email" value="" required="" placeholder="Adresse email" aria-label="Entrez votre adresse email">
      </div>
    </div>
    <!-- End Input -->
    <!-- Input -->
    <div class=" mb-3">
      <div class="input-group input-group form">
        <input type="password" class="form-control " name="pwd" value="" required="" placeholder="Mot de passe" aria-label="Entrez votre mot de passe">
      </div>
    </div>
    <!-- End Input -->
    <button type="submit" class="btn btn-block btn-primary">Connexion</button>
  </form>
</div>
';
  return $result;
}
//ACTION CONNEXION
function displayactionConnexion(){
  session_start();
  global $model;
  // print_r($_REQUEST); exit();
   $email = $_REQUEST["email"];
   $pwd = $_REQUEST["pwd"];
   $data_customer = $model->login($email,$pwd);
   //ok
     if($data_customer){
       $_SESSION["customer"] = $data_customer;
       return '<p class="btn btn-success btn-block">Connexion reussi, vous êtes bien connecté</p>'.displayAcceuil();
     
   }else{ // connexion echoué
    return '<p class=" btn btn-danger btn-block">Erreur, identifiant non valide</p>'.displayProduit();
      }
   }

//ACTION DECONNEXION
function displayDeconnexion(){
  session_start();
  $result = '<p class="btn btn-success btn-block">Vous etes déconnecté</p>';
  unset($_SESSION["customer"]);
  return $result.displayProduit();
}

//PROFIL
function displayProfil(){
  session_start();
    $result = '
    <ul class="list-group mt-5 mx-auto" style = "width : 30%" >
    <li class="list-group-item active" aria-current="true">Bienvenu sur votre profil '.$_SESSION['customer']["lastname"].'</li>
    <li class="list-group-item">Votre nom '.$_SESSION['customer']["firstname"].'</li>
    <li class="list-group-item">Votre prénom '.$_SESSION['customer']["lastname"].'</li>
    <li class="list-group-item">Votre email '.$_SESSION['customer']["email"].'</li>
  </ul>';
return($result);
}

//CONTACTER
function displayContact(){
  session_start();
  $result = '<h1> Bienvenue sur la page de contact </h1>';
  $result .='<!--Section: Contact v.2-->
  <div class="bg-white shadow-sm rounded p-6  mt-5 mx-auto" style = "width : 70%">
         <div class="row">
            <div class="form-group col-sm-6">
                <label for="name" class="h4">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" required>
            </div>
            <div class="form-group col-sm-6">
                <label for="email" class="h4">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" required>
            </div>
        </div>
        <div class="form-group">
            <label for="message" class="h4 ">Message</label>
            <textarea id="message" class="form-control" rows="5" placeholder="Enter your message" required></textarea>
        </div>
        <button type="submit" id="form-submit" class="btn btn-success btn-lg pull-right ">Submit</button>
<div id="msgSubmit" class="h3 text-center hidden">Message Submitted!</div>
  </div>';
    return $result;
}

//INSCRIPTION
function displayactionInscription(){
  session_start();
  global $model;
 // print_r($_REQUEST); exit();
  $firstname = $_REQUEST["firstname"];
  $lastname = $_REQUEST["lastname"];
  $email = $_REQUEST["email"];
  $pwd = $_REQUEST["pwd"];
  $data = $model->createCustomers($firstname,$lastname,$email,$pwd);
  //ok
  if($data){//inscription réussie
    $data_customer = $model->login($email,$pwd);
    if($data_customer){
      $_SESSION["customer"] = $data_customer;
      return '<p class="btn btn-success btn-block">Inscription réussie '.$lastname.', Vous êtes bien connecté</p>'.displayProduit();
    
  }else{ // inscription échouée
    return '<p class=" btn btn-danger btn-block">connexion échouée ,vérifier vos identifiants</p>'.displayProduit();
     }
  }
}

//AFFICHER PRODUIT
function displayProduit(){
  session_start();
  global $model; 
  $dataProduct = $model->getProduct();
  //Affichage product avec photo
  $result = '<h1> Liste des musiques</h1>';
foreach ($dataProduct as $key => $value) {
  if(!isset($_SESSION["customer"])){
    $result .= '<div class="card" style="width: 18rem; display:inline-block;">
    <img src="'.BASE_URL.SP."image".SP."produit".SP.$value["image"].'" class="card-img-top" alt="...">
       <div class="card-body">
       <h5 class="card-title">'.$value["title"].'</h5>
       <p class="card-text">'.$value["genre"].'</p>
       <p class="card-text">'.$value["description"].'</p>
        </div>
        </div>'; 
  }else{
    $result .= '<div class="card" style="width: 18rem; display:inline-block;">
    <img src="'.BASE_URL.SP."image".SP."produit".SP.$value["image"].'" class="card-img-top" alt="...">
       <div class="card-body">
       <h5 class="card-title">'.$value["title"].'</h5>
       <p class="card-text">'.$value["genre"].'</p>
       <p class="card-text">'.$value["description"].'</p>
       <a href="#" class="btn btn-primary">Téléchager</a>
       <a href="'.$value["lien"].'" target="_blank" class="btn btn-success">Lire</a>
        </div>
        </div>'; 
  }
   } 
   return $result;
        }
        //RECHERCHE PAR GENRE
        function displayCategory(){
          session_start();
          global $model;
          global $url;
          global $category;
          $result =  '<h1> Musique du genre: '.$category[$url[1]-1] ["Genre"].' </h1>';
          $dataProduct = $model->getProduct(null,$url[1]);
          foreach ($dataProduct as $key => $value) {
          
            if(!isset($_SESSION["customer"])){
          
              $result .= '<div class="card" style="width: 18rem; display:inline-block;">
              <img src="'.BASE_URL.SP."image".SP."produit".SP.$value["image"].'" class="card-img-top" alt="...">
                 <div class="card-body">
                 <h5 class="card-title">'.$value["title"].'</h5>
                 <p class="card-text">'.$value["genre"].'</p>
                 <p class="card-text">'.$value["description"].'</p>
                  </div>
                  </div>'; 
          
            }else{
          
              $result .= '<div class="card" style="width: 18rem; display:inline-block;">
              <img src="'.BASE_URL.SP."image".SP."produit".SP.$value["image"].'" class="card-img-top" alt="...">
                 <div class="actionConnexioncard-body">
                 <h5 class="card-title">'.$value["title"].'</h5>
                 <p class="card-text">'.$value["genre"].'</p>
                 <p class="card-text">'.$value["description"].'</p>
                 <a href="#" class="btn btn-primary">Téléchager</a>
                 <a href="'.$value["lien"].'" target="_blank" class="btn btn-success">Lire</a>
                  </div>
                  </div>'; 
            }
            
             } 
             return $result;
                  }
        
 //AJOUT MUSIC
function displayAjout(){
  session_start();

  //print_r($_SERVER); exit();
    $result = '
    <div class="bg-white shadow-sm rounded p-6  mt-5 mx-auto" style = "width:50%" ; "background-color:#efefef">
    
    <form class="" action="actionAjout" method="post">
    <div class="mb-4 col-md4 col-md-offset-4 text-center ">
      <h2 class="h4 align-items-center">Rajouter votre musique</h2>
    </div>
    <div class="form-group col-md4 col-md-offset-4">
      <input type="text" id="title" name="title" class="form-control " value="" required="" placeholder="Titre">
      </div> <div class="form-group col-md4 col-md-offset-4  mt-2">
    <input type="text" id="lien" class="form-control " name="lien" value="" required="" placeholder="Lien">
    </div>
     <div class="form-group col-md4 col-md-offset-4  mt-2">
      <input type="text" id="pwd" class="form-control " name="auteur" value="" required="" placeholder="Auteur">
    </div>
  <div class="form-group">
        <label for="description" class="h4 ">Descriptions</label>
         <textarea id="description" name="descriptions" class="form-control" rows="5" placeholder="Enter la description"></textarea>
   </div>
<div class="mt-1 col-md4 col-md-offset-4  mt-2 text-center">
   <button type="submit" class="btn btn-block btn-primary">Suite</button>
</div>
</form>
</div>';


    return $result;
    
}

 //ACTION AJOUT
function displayactionAjout(){
  session_start();
  global $model;
 
  $title = $_REQUEST["title"];
  $descriptions = $_REQUEST["description"];
  $auteur = $_REQUEST["auteur"];
  $lien= $_REQUEST["lien"];
  $genre= $_REQUEST["genre"];
  $data = $model->ajoutMusique($title, $descriptions,$auteur,$lien, $genre);
  //ok
      return '<p class="btn btn-success btn-block">Ajoute réussie '.$title.'</p>'.displayChoixGenre();
}

 //RECHERCHE
function displaySearch(){
  $result = 
  session_start();
  global $model;
  global $url;
  global $category2;
  $result =  '<h1> Musique du genre: '.$category2[$url[1]-1] ["Genre"].' </h1>';
  $category2 = $model->getSearch(null,$url[1]);
  foreach ($category2 as $key => $value) {
  
    if(!isset($_SESSION["customer"])){
      $result .= '
      <div class="card" style="width: 18rem; display:inline-block;">
      <img src="'.BASE_URL.SP."image".SP."produit".SP.$value["image"].'" class="card-img-top" alt="...">
         <div class="card-body">
         <h5 class="card-title">'.$value["title"].'</h5>
         <p class="card-text">'.$value["genre"].'</p>
         <p class="card-text">'.$value["descriptions"].'</p>
          </div>
          </div>'; 
    }else{
      $result .= '<div class="card"actionConnexion style="width: 18rem; display:inline-block;">
      <img src="'.BASE_URL.SP."image".SP."produit".SP.$value["image"].'" class="card-img-top" alt="...">
         <div class="card-body">
         <h5 class="card-title">'.$value["title"].'</h5>
         <p class="card-text">'.$value["genre"].'</p>
         <p class="card-text">'.$value["descriptions"].'</p>
         <a href="#" class="btn btn-primary">Téléchager</a>
         <a href="'.$value["lien"].'" target="_blank" class="btn btn-success">Lire</a>
          </div>
          </div>'; 
    }
     } 
     return $result;
}

function displayactionUptade(){
 // print_r($_POST); exit();
}
  //CHOIX GENRE
function displayChoixGenre(){
  session_start();
  global $model;
  global $url;
  global $category;
  $result =  '<h1> Choississer le genre: '.$category["Genre"].' </h1>';
  $dataProduct = $model->choixGenre();
 // $data = $model->delete();
  //$dataProduct = $model->delete();
  foreach ($dataProduct as $key => $value) {
      $result .= '
      
      <form action="test" method="GET" style ="height:5px"  >
      <div class="reponses">
          <button type="submit" class="facile">'.$value["Genre"].'
              <label for="facile" class="niveau" style ="width:150px">
                  <input type="checkbox" name="'.$value["Genre"].'" value ='.$value["Genre"].' >
              </label>
          </button>
        </div>
  </form>

';
     } 

     return $result; 
    
          }

function displaytest(){
  session_start();
  global $model;
  $genre = $_SERVER['QUERY_STRING'];
  $toto = explode("=", $genre);
  $vgenre = $toto[0];
  $dataProduct = $model->ajoutOKK($vgenre);
 // print_r($vgenre);exit();
  $result ='<p class="btn btn-success btn-block">Ajout réussi</p>';
      return $result ;
}

?>