<?php 

// message pour chaque page selectionné pas l'utilisateur

function displayAcceuil(){
  if(!isset($_SESSION["customer"])){
    $result = '

    <div class="bg-white shadow-sm rounded p-6  mt-5 mx-auto" style = "width:30%" ; "background-color:#efefef">

    <form class="" action="actionInscription" method="post">
     
    <div class="mb-4 col-md4 col-md-offset-4 text-center ">
        <h2 class="h4 align-items-center">Veuillez créez un compte</h2>
        <h2 class="h4">INSCRIPTION</h2>
     </div>


           <!-- Input -->
    <div class=" mb-3">
    <div class=" mb-3">
    <div class="form-group col-md4 col-md-offset-4 text-center">
        <label for="Nom">Nom</label>
          <input type="text" id="Nom" name="firstname" class="form-control " value="" required="" placeholder="Entrer votre Nom">
        </div>
        </div>
      </div>
      <!-- End Input -->

      <!-- Input -->
      <div class=" mb-3">
      <div class="form-group col-md4 col-md-offset-4 text-center">
      <label for="Prenom">Prénom</label>
        <div class="input-group input-group form">
          <input type="text" id="Prenom" name="lastname" class="form-control " value="" required="" placeholder="Entrer votre Prénom">
        </div>
          </div>
      </div>
      <!-- End Input -->

      <!-- Input -->
      <div class=" mb-3">
      <div class="form-group col-md4 col-md-offset-4 text-center">
      <label for="Nom">Email</label>
        <div class="input-group input-group form">
          <input type="email" id="email" class="form-control " name="email" value="" required="" placeholder="Entrez votre adresse email">
        </div>
        </div>
      </div>
      <!-- End Input -->

      <!-- Input -->
      <div class=" col-md4 col-md-offset-4 text-center">
      <div class="form-group col-md4 col-md-offset-4 text-center">
        <label for="pwd">Mot de passe</label>
          <input type="password" id ="pwd"class="form-control " name="pwd" value="" required="" placeholder="Entrez votre mot de passe">
        </div>
      </div>
      <!-- End Input -->
      <div class="mt-1 col-md4 col-md-offset-4 text-center">
      <button type="submit" class="btn btn-block btn-primary">S\'inscrire</button>
      </div>
    </form>
  </div>
  
';
  }else{
    $result = '<h2 class="mt-5 mr-5"> Bienvenue sur votre site de musique préféré </h2>
    <img src="'.BASE_URL.SP."image".SP."produit".SP."cheers-g6f8d5100c_1920.jpg".'" class="card-img-top" alt="...">
    ';
  }
    return $result;
}

function displayProfil(){
    $result = '
    <ul class="list-group mt-5 mx-auto" style = "width : 30%" >
    <li class="list-group-item active" aria-current="true">Bienvenu sur votre profil '.$_SESSION['customer']["lastname"].'</li>
    <li class="list-group-item">Votre nom '.$_SESSION['customer']["firstname"].'</li>
    <li class="list-group-item">Votre prénom '.$_SESSION['customer']["lastname"].'</li>
    <li class="list-group-item">Votre email '.$_SESSION['customer']["email"].'</li>
  </ul>';
  


return($result);
}

function displayactionConnexion(){
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
    return '<p class=" btn btn-danger btn-block">non échouée ,email existant</p>'.displayProduit();
      }
   }

function displayactionInscription(){
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
function displayAjout(){

    $result = '<div class="bg-white shadow-sm rounded p-6  mt-5 mx-auto" style = "width : 30%">
    <form class="" action="actionAjout" method="post">
      <div class="mb-4">
        <h2 class="h4"> Ajouter votre musique </h2>
      </div>


      <!-- Input -->
      <div class=" mb-3">
        <div class="input-group input-group form">
          <input type="text" name="firstname" class="form-control " value="" required="" placeholder="Entrer votre Nom">
        </div>
      </div>
      <!-- End Input -->

      <!-- Input -->
      <div class=" mb-3">
        <div class="input-group input-group form">
          <input type="text" name="lastname" class="form-control " value="" required="" placeholder="Entrer votre Prénom">
        </div>
      </div>
      <!-- End Input -->

      <!-- Input -->
      <div class=" mb-3">
        <div class="input-group input-group form">
          <input type="email" class="form-control " name="email" value="" required="" placeholder="Entrez votre adresse email">
        </div>
      </div>
      <!-- End Input -->

      <!-- Input -->
      <div class=" mb-3">Inscription
        <div class="input-group input-group form">
          <input type="password" class="form-control " name="pwd" value="" required="" placeholder="Entrez votre mot de passe">
        </div>
      </div>
      <!-- End Input -->

      <button type="submit" class="btn btn-block btn-primary">S\'inscrire</button>
    </form>
  </div>
';
 
  
    return $result;
}
function displayactionAjout(){
  global $model;
 // print_r($_REQUEST); exit();
  $title = $_REQUEST["title"];
  $descriptions = $_REQUEST["description"];
  $auteur = $_REQUEST["auteur"];
  $lien= $_REQUEST["lien"];
  $data = $model->ajoutMusique($title, $descriptions,$auteur,$lien);
  //ok
      return '<p class="btn btn-success btn-block">Ajoute réussie '.$title.', Vous êtes bien connecté</p>'.displayProduit();

}

function displayConnexion(){
  $result = '<div class="bg-white mt-5 mx-auto shadow-sm rounded p-6" style = "width:30%">
  <form class="" action="actionInscription" method="post">
    <div class="mb-4">
      <h2 class="h4">Connexion</h2>
    </div>
    <!-- Input -->
    <div class=" mb-3">
      <div class="input-group input-group form">
        <input type="email" class="form-control " name="email" value="" required="" placeholder="Entrez votre adresse email" aria-label="Entrez votre adresse email">
      </div>
    </div>
    <!-- End Input -->

    <!-- Input -->
    <div class=" mb-3">
      <div class="input-group input-group form">
        <input type="password" class="form-control " name="pwd" value="" required="" placeholder="Entrez votre mot de passe" aria-label="Entrez votre mot de passe">
      </div>
    </div>
    <!-- End Input -->

    <button type="submit" class="btn btn-block btn-primary">Connexion</button>
  </form>
</div>
';
  return $result;

}

function displayContact(){

    $result = '<h1> Bienvenue sur la page de contact </h1>';
  $result .='<!--Section: Contact v.2-->
  <section class="mb-4">
  
      <!--Section heading-->
      <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
      <!--Section description-->
      <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
          a matter of hours to help you.</p>
  
      <div class="row">
  
          <!--Grid column-->
          <div class="col-md-9 mb-md-0 mb-5">
              <form id="contact-form" name="contact-form" action="mail.php" method="POST">
  
                  <!--Grid row-->
                  <div class="row">
  
                      <!--Grid column-->
                      <div class="col-md-6">
                          <div class="md-form mb-0">
                              <input type="text" id="name" name="name" class="form-control">
                              <label for="name" class="">Your name</label>
                          </div>
                      </div>
                      <!--Grid column-->
  
                      <!--Grid column-->
                      <div class="col-md-6">
                          <div class="md-form mb-0">
                              <input type="text" id="email" name="email" class="form-control">
                              <label for="email" class="">Your email</label>
                          </div>
                      </div>
                      <!--Grid column-->
  
                  </div>
                  <!--Grid row-->
  
                  <!--Grid row-->
                  <div class="row">
                      <div class="col-md-12">
                          <div class="md-form mb-0">
                              <input type="text" id="subject" name="subject" class="form-control">
                              <label for="subject" class="">Subject</label>
                          </div>
                      </div>
                  </div>
                  <!--Grid row-->
  
                  <!--Grid row-->
                  <div class="row">
  
                      <!--Grid column-->
                      <div class="col-md-12">
  
                          <div class="md-form">
                              <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                              <label for="message">Your message</label>
                          </div>
  
                      </div>
                  </div>
                  <!--Grid row-->
  
              </form>
  
              <div class="text-center text-md-left">
                  <a class="btn btn-primary" onclick="..">Send</a>
              </div>
              <div class="status"></div>
          </div>
          <!--Grid column-->
  
          <!--Grid column-->
          <div class="col-md-3 text-center">
              <ul class="list-unstyled mb-0">
                  <li><i class="fas fa-map-marker-alt fa-2x"></i>
                      <p>San Francisco, CA 94126, USA</p>
                  </li>
  
                  <li><i class="fas fa-phone mt-4 fa-2x"></i>
                      <p>+ 01 234 567 89</p>
                  </li>
  
                  <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                      <p>contact@mdbootstrap.com</p>
                  </li>
              </ul>
          </div>
          <!--Grid column-->
  
      </div>
  
  </section>
  <!--Section: Contact v.2-->';
    return $result;
}

function displayProduit(){
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

function displaySearch(){
  global $model;
  global $url;
  global $category2;
  $result =  '<h1> Musique du genre: '.$category2[$url[1]-1] ["Genre"].' </h1>';
  $category2 = $model->getSearch(null,$url[1]);
  foreach ($category2 as $key => $value) {
  
    if(!isset($_SESSION["customer"])){
  
      $result .= '<div class="card" style="width: 18rem; display:inline-block;">
      <img src="'.BASE_URL.SP."image".SP."produit".SP.$value["image"].'" class="card-img-top" alt="...">
         <div class="card-body">
         <h5 class="card-title">'.$value["title"].'</h5>
         <p class="card-text">'.$value["genre"].'</p>
         <p class="card-text">'.$value["descriptions"].'</p>
          </div>
          </div>'; 
  
    }else{
  
      $result .= '<div class="card" style="width: 18rem; display:inline-block;">
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

function displayCategory(){
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


          function DisplayUpdateProfil(){
            $result = '
            <div class="bg-white shadow-sm rounded p-6  mt-5 mx-auto" style = "width : 30%">

            <form class="" action="actionUptade" method="post">
            <div class="" style="width: 450px;">
          <p class = "h5 mx-auto"> Mise à jour de mes données </p>
          </div>
          
              <!-- Input -->
              <div class=" mb-3">
                <div class="form-group">
                <label for="Nom">Nom</label>
                  <input type="text" name="firstname"  id="Nom" class="form-control " value="'.$_SESSION['customer']["firstname"].'" required="" placeholder="Entrer votre Nom">
                </div>
              </div>
              <!-- End Input -->
        
              <!-- Input -->
              <div class=" mb-3">
                <div class="form-group">
                <label for="Prenom">Prenom</label>
                  <input type="text" id="Prenom" name="lastname" class="form-control "  value="'.$_SESSION['customer']["lastname"].'" required="" placeholder="Entrer votre Prénom">
                </div>
              </div>
              <!-- End Input -->
        
              <!-- Input -->
              <div class=" mb-3">
              <div class="form-group">
              <label for="email">Email</label>
                  <input type="email" id="email" class="form-control " name="email"  value="'.$_SESSION['customer']["email"].'" required="" placeholder="Entrez votre adresse email">
                </div>
              </div>
              <!-- End Input -->
           <div class= "container">
           <div class = "row">
           <div class="col-md4 col-md-offset-4 text-center">
              <button type="submit" class="btn btn-block btn-primary mx-center">Modifier</button>
          </div>
          </div>
          </div>
            </form>
          </div>';

            return $result;
          }

          function displayDeconnexion(){
            $result = '<h1> Vous etes deconnecte';
            unset($_SESSION["customer"]);
            return displayProduit();
          }


          

?>