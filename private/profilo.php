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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/myStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/myScript.js"></script>
</head>
<!-- richiamo funzione js per canvas foto profilo -->
<body onload="myCanvas()">           
<nav class="navbar navbar-expand-sm bg-light border">
    <div class="navbar-brand">
        <h2>myPhotoboard</h2>
    </div>
    <ul class="navbar-nav">
        <li class="nav-item">
        <a class="active nav-link" href="profilo.php">Profilo</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="../pub/cerca.php">Cerca</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="../private/aggiungi_post.php">Aggiungi un post</a>
        </li>
    </ul>
</nav>
<div class="container main-container">
    <div class="row">
        <div class="col border">
            <form action="profilo.php" method="post">
                <button class="btn btn-primary my-5 float-right" type="submit" name="logout">Logout</button>
                <br>
                <br>
                <?php echo "<p class='float-right mx-3'>@" . $username . "</p>"; ?>                
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
</div>                                                                                        
<div class="jumbotron text-center bg-white">
    Copyright &copy; 2020 Cordani Francesco.
</div>
</body>
</html>

