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
</head>
<body>
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
    <div class="row rows">
            <form class="form1" method="post"action="cerca.php">
                <input type="text" name="username" placeholder="Cerca...">
                <button type="submit" name ="cerca">Cerca</button>
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
    <div class="footer">
        Copyright &copy; 2020 Cordani Francesco.
    </div>
</body>
</html>