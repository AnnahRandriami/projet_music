<?php 
//session_start();
class DataLayer{
    private $connexion; 
    //test si la connexion avec la database de mysql est fait
 function __construct() {
      try {
          $this->connexion = new PDO("mysql:host=".HOST.";dbname=".DB_NAME,DB_USER,DB_PASSWORD);
         // echo "connexion à la base de donnée reussi";
  //définit l'erreur si pas de connexion
      } catch (PDOException $th ) {
         echo $th->getMessage();
      }
    }

function createCustomers ($firstname, $lastname, $email,$pwd){
    //requete insertion dans table customers de la base de donnée
   $sql = "INSERT INTO `users`(firstname, lastname, email, pwd) VALUES 
    ( :firstname, :lastname, :email, :pwd)";
    try {
        //test si requete fait
        $result = $this->connexion->prepare($sql);
      $var = $result -> execute(array(
          ':firstname' => $firstname,
          ':lastname' => $lastname,
            ':email' => $email,
            ':pwd' => sha1($pwd)
        ));
        if($var){
            return TRUE;
        }else{
            return FALSE;
        }
    } catch (PDOException $th) {
       return NULL; 
    }

}

function ajoutMusique($title, $descriptions,$auteur, $lien, $genre){
    //requete insertion dans table customers de la base de donnée
   $sql = "INSERT INTO `music`(title, descriptions, auteur, lien ,genre) VALUES 
    ( :title, :descriptions, :auteur, :lien, :genre)";
    try {
        //test si requete fait
        $result = $this->connexion->prepare($sql);
      $var = $result -> execute(array(
          ':title' => $title,
          ':descriptions' => $descriptions,
            ':auteur' => $auteur,
            ':lien' => $lien,
            ':genre' => $genre,
        ));
        if($var){
            return TRUE;
        }else{
            return FALSE;
        }
    } catch (PDOException $th) {
       return NULL; 
    }

}

function login($email,$pwd){
     $sql = "SELECT * FROM users WHERE email = :email";  
     try {
         //code...
         $result = $this->connexion->prepare($sql);
         $result->execute(array(':email' => $email));
         $data = $result->fetch(PDO::FETCH_ASSOC);
         if($data && ($data['pwd'] == sha1($pwd))){
            //enleve le mot de passe dans print_r
            unset($data['pwd']);
            return $data;
         }else{
              return FALSE;
         }
     } catch (PDOException $th) {
        return NULL;
     }
     
}


function choixGenre(){
 $sql =  "SELECT Genre FROM music WHERE genre is NOT NULL GROUP BY genre ";  
 try {
     $result = $this->connexion->prepare($sql);
     $var = $result->execute();
     $data = $result->fetchAll(PDO::FETCH_ASSOC);
     if($data){
        return $data;
    }else{
        return FALSE;
    }
} catch (PDOException $th) {
   return NULL; 
}
}

function delete(){
    $sql =  "DELETE FROM `music` WHERE genre IS NULL";  
    try {
        $result = $this->connexion->prepare($sql);
        $var = $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        if($data){
           return $data;
       }else{
           return FALSE;
       }
   } catch (PDOException $th) {
      return NULL; 
   }
   }

   function ajoutOKK($genre){
    $sql =  "UPDATE music SET genre = :genre WHERE genre IS NULL";  
    try {
        $result = $this->connexion->prepare($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        $result->execute(array(':genre' => $genre));
        $var = $result->execute();
        if($var){
           return $var;
       }else{
           return FALSE;
       }
   } catch (PDOException $th) {
      return NULL; 
   }
   }

  



/*function createOrders($idcustomers, $idproduct, $quantity, $price){
    $sql = "INSERT INTO `orders`(idcustomers, idproduct, quantity, price) VALUES 
    (:idcustomers , :idproduct, :quantity, :price)";

    try {
        //code...
        $result  = $this->connexion->prepare($sql);
        $var = $result->execute (array(
        ':idcustomers' =>$idcustomers,
        ':idproduct' => $idproduct,
        ':quantity' => $quantity,
        ':price' => $price
    ));
    if($var){
        return TRUE;
    }else{
        return FALSE;
    }
    } catch (PDOException $th) {
        //throw $th;
    }

}*/

//uptdate
function uptadeInfoCustomers($newInfo){
    $sql = "UPDATE `users` SET "; 
    try {
       foreach($newInfo as $key => $value){
          $sql .= " $key = '$value' ,";
       }
       $sql = substr($sql,0,-1);
       $sql .= " WHERE idUser = :idUser";
       $result = $this->connexion->prepare($sql);
      $var = $result->execute(array('idUser'=>$newInfo['idUser']));
      if($var){
        return TRUE;
    }else{
        return FALSE;
    }
   } catch (\Throwable $th) {
       //throw $th;
   } //requette uptabe table cust
}
function getCategory(){
    $sql = "SELECT * FROM genre";

    try {
        $result = $this->connexion->prepare($sql);
        $var = $result->execute();
        //recup tout les elements
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        if($data){
            return $data;
        }else{
            return FALSE;
        }
    } catch (PDOException $th) {
        //throw $th;
    }

}




function getProduct($limit=NULL , $category=NULL){
    $sql = "SELECT * FROM music ";
    try {
        if(!is_null($category)){
            $sql .= 'WHERE idGenre = ' .$category;
       }
        if(!is_null($limit)){
             $sql .= ' LIMIT ' .$limit;
        }
      // print_r($sql); exit();
        $result = $this->connexion->prepare($sql);
        $var = $result->execute();
        //recup tout les elements
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        if($data){
            return $data;
        }else{
            return FALSE;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
}
 
function getSearch($category=NULL){
    $sql = "SELECT * FROM music ";
    try {
        if(!is_null($category)){
            $sql .= ' WHERE title LIKE = ' .$category . '%';
       }
      //print_r($sql); exit();
        $result = $this->connexion->prepare($sql);
        $var = $result->execute();
        //recup tout les elements
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        if($data){
            return $data;
        }else{
            return FALSE;
        }
    } catch (PDOException $th) {
        //throw $th;
    }
}



}

  
?>