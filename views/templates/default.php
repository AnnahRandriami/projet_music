<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/var/www/html/projet_zik/src/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title> <?php echo $title ?> </title>
</head>

<body>
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #fecba1;;">

        <div class="container-fluid">


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse position-relative top-1 start-50 translate-middle-x" style="z-index:9" id="navbarNavDropdown">
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
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                            <?php
                            foreach ($category as $key => $value) {
                                echo '<a class="dropdown-item" href="' . BASE_URL . SP . "category" . SP . $value["idGenre"] . '">' . $value["Genre"] . '</a>';
                            }
                            ?>
                        </ul>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL . SP . "contact" ?>">Contact</a>
                    </li>

                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-danger me-5" type="submit">Search</button>
                </form>
            </div>



            <div class="d-grid gap-1 d-md-flex justify-content" style="z-index:999">
                <?php if (!isset($_SESSION["customer"])) : ?>
                    <a class="btn btn-outline-danger" type="submit" href="<?php echo BASE_URL . SP . "connexion" ?>">Connexion</a>
                    <a class="btn btn-outline-danger" type="submit" href="<?php echo BASE_URL . SP . "acceuil" ?>">Inscription</a>
                <?php endif; ?>


                <?php if (isset($_SESSION["customer"])) : ?>
                    <a class="btn btn-outline-danger" type="submit" href="<?php echo BASE_URL . SP . "Deconnexion" ?>">Deconnexion</a>
                    <a class="btn btn-outline-danger" type="submit" href="<?php echo BASE_URL . SP . "profil" ?>">Profil</a>
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