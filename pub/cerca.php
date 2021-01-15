<?php
session_start();

$page = "cerca.php";

$username="";
$msg="";
//includo file con dati db
include('../private/config.php');                       
//connessione                                                            
$con = new mysqli($host, $user, $password, $nomedb);                                                                
if($con == false) die("Impossibile connettersi al database: ".mysql_error());

//prendo il nome cercato
if(isset($_POST['cerca'])) {
    $username = $con->real_escape_string($_POST['username']);                             
    //query                        
    $sql = $con->query("SELECT nomeUtente FROM utente WHERE nomeUtente='$username'");                               

    //controllo se è presente
    if ($sql->num_rows > 0) {                                                                                      
        $data = $sql->fetch_array();
    } else{
        $msg = "Utente non trovato";
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerca</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/myStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-light border">
    <div class="navbar-brand">
        <h2>myPhotoboard</h2>
    </div>
    <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link" href="../private/profilo.php">Profilo</a>
        </li>
        <li class="nav-item">
        <a class="active nav-link" href="cerca.php">Cerca</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="../private/aggiungi_post.php">Aggiungi un post</a>
        </li>
    </ul>
</nav>
    <div class="container main-container">
        <div class="col border">
            <form method="post"action="cerca.php">
                <div class="form-group text-center space">
                    <input type="text" name="username" placeholder="Cerca...">
                    <button type="submit" class="btn btn-primary" name ="cerca">Cerca</button>
                </div>
                    <?php 
                        if ($msg == "" && $username != "") {
                            $_SESSION['usernameCercato']=$username;
                            $_SESSION['pagePrecedente']=$page;
                            echo "<ul class='ricerca'>
                                    <li class='ricerca'>
                                        <a class='ricerca' href='cercato.php'>" . "@" . $username . "</a>" . "<br><br>
                                    </li>
                                </ul>";
                        } else {
                            echo "<p class='ricerca'>" . $msg . "</p>";
                        } 
                    ?>
                </form>
        </div>
    </div>
    <div class="jumbotron text-center bg-white">
        Copyright &copy; 2020 Cordani Francesco.
    </div>
</body>
</html>