<?php
session_start();
if(isset($_SESSION['username']) == "") {
    header("location: ../index.php");
}

//includo file con dati db
include('config.php');                                                                                   
//connessione
$con = new mysqli($host, $user, $password, $nomedb);                                                                
if($con == false) die("Impossibile connettersi al database: ".mysql_error());

$sql = $con->query("SELECT * FROM utente WHERE nomeUtente='" . $_SESSION['username'] . "'");
$data = $sql->fetch_array();
$username = $data['nomeUtente'];

//logout
if(isset($_POST['logout'])) {                                                                                       
    header("location: ../pub/logout.php");
}
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
            <a class="active" href="profilo.php">Profilo</a>
            <a href="../pub/cerca.php">Cerca</a>
            <a href="aggiungi_post.php">Aggiungi un post</a>
        </div>
    </div>
    <div class="row">
        <div class="container full-height">
            <form action="profilo.php" method="post">
                <?php echo "<p>@" . $username . "</p>"; ?>
                <br>
                <br>                
                <button class="logout" type="submit" name="logout">Logout</button>
            </form>
            <canvas id="profileCanvas" class="profileCanvas">Your browser does not support the HTML canvas tag.</canvas>
            <img id="avatar" src="../img/avatar/avatar-predefinito.png" alt="avatar" class="img-avatar">
            <?php
                $id = $_SESSION['id']; 
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

