<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title> <?php echo $title ?> </title>
</head>
<style>

    body {
      background-image: url('https://www.musikinflu.com/wp-content/uploads/2020/05/band-stage-aqua-Vedran-DOlezal-de-Pixabay.jpg');
      text-align :center;
    }
    h1, h3{
        color: whitesmoke;
    }
.container form{
padding: 30px;
width: 90%; 
margin-left: 15px;
height: 500px;
flex-direction: column;
display: flex;
justify-content: center;
align-items: center;
border-radius: 50px;
}

.navbar{
  
  border-color:transparent !important;
}

.nav-link{
    border-color: white;
    color: white;
    background-color: black;
}
.navbar a{
    color: white;
}

.navbar a .btn{
    color: black;
}
.navbar a:hover{
    color: white;
    font-size: 1.5rem;
}

navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover {
    color: #555555;
    background-color: #e7e7e7;
}


  </style>
<body>
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-bg-light " >

        <div class="container-fluid">


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" style="z-index:9" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL . SP . "acceuil" ?>">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL . SP . "produit" ?>">Music</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Genre
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color:black">

                            <?php
                            session_start();
                            foreach ($category as $key => $value) {
                                echo '<a class="dropdown-item" href="' . BASE_URL . SP . "category" . SP . $value["idGenre"] . '">' . $value["Genre"] . '</a>';
                            }
                            ?>
                        </ul>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL . SP . "contact" ?>">Contact</a>
                    </li>

                </ul>
                <form class="d-flex" action ="actionsearch">
                <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL . SP . "search" ?>">Search</a>
                </form>
            </div>



            <div class="d-grid gap-1 d-md-flex justify-content" style="z-index:999">
                <?php session_start(); if (!isset($_SESSION["customer"])) : ?>
                    <a class="btn btn-outline" type="submit" href="<?php echo BASE_URL . SP . "connexion" ?>">Connexion</a>
                    <a class="btn btn-outline" type="submit" href="<?php echo BASE_URL . SP . "acceuil" ?>">Inscription</a>
                <?php endif; ?>


                <?php session_start(); if (isset($_SESSION["customer"])) : ?>
                    <a class="btn btn-outline" type="submit" href="<?php echo BASE_URL . SP . "Deconnexion" ?>">Deconnexion</a>
                    <a class="btn btn-outline" type="submit" href="<?php echo BASE_URL . SP . "profil" ?>">Profil</a>
                    <a class="btn btn-outline" type="submit" href="<?php echo BASE_URL . SP . "ajout" ?>">Ajouter</a>
                <?php endif; ?>
                
            </div>
        </div>
    </nav>

    <!--content-->
    <div class="container">
        <?php echo $content ?>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>