<?php
session_start();

$page = "cercato.php";

//includo file con dati db
include('../private/config.php');                                                                                   
//connessione
$con = new mysqli($host, $user, $password, $nomedb);                                                                
if($con == false) die("Impossibile connettersi al database: ".mysql_error());

$sql = $con->query("SELECT * FROM utente WHERE nomeUtente='" . $_SESSION['usernameCercato'] . "'");
$data = $sql->fetch_array();
$username = $data['nomeUtente'];
$_SESSION['idUtenteCercato']=$data['idUtente'];
$_SESSION['pagePrecedente']=$page;
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo</title>
    <script src="../js/myScript.js"></script>
</head>
<!-- richiamo funzione js per canvas foto profilo -->
<body onload="myCanvas()">                                                                                                          
    <div class="topnav">
        <div class="topnav-logo">
            <h2>myPhotoboard</h2>
        </div>
        <div class="topnav-link">
            <a href="../private/profilo.php">Profilo</a>
            <a class="active" href="cerca.php">Cerca</a>
            <a href="../private/aggiungi_post.php">Aggiungi un post</a>
        </div>
    </div>
    <div class="row">
        <div class="container full-height">
            <?php echo "<p>@" . $username . "</p>"; ?>
            <canvas id="profileCanvas" class="profileCanvas">Your browser does not support the HTML canvas tag.</canvas>
            <img id="avatar" src="../img/avatar/avatar-predefinito.png" alt="avatar" class="img-avatar">
            <?php
                $id = $_SESSION['idUtenteCercato']; 
                $sql = $con->query("SELECT * FROM post WHERE fk_utente='$id'");
                while($data = $sql->fetch_array()) {                  
                    echo "<div class='gallery'>
                            <a target='blank'" . "href=" . $_SESSION['path'] . $data['img'] . ">
                                <img src=" . $_SESSION['path'] . $data['img'] . ">
                            </a>
                            <div class='text'>" . $data['text'] . "</div>
                         </div>";
                }
            ?>
        </div>
    </div>
    <div class="footer">
        Copyright &copy; 2020 Cordani Francesco.
    </div>
</body>
</html>