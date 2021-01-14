<?php
//controllo parte privata
session_start();
if(isset($_SESSION['username']) == "") {
    header("location: ../index.php");
}
//includo file con dati db
include('config.php');                                                                                  
//connessione
$con = new mysqli($host, $user, $password, $nomedb);                                                                
if($con == false) die("Impossibile connettersi al database: ".mysql_error());

$msg = "";

if(isset($_POST['pubblica'])) {
    //percorso memorizzazione immagini
    $percorso = "../../img/" . basename($_FILES['image']['name']);                                                          
    $img = $con->real_escape_string($_FILES['image']['name']);
    $text = $con->real_escape_string($_POST['text']);
    $tag = $con->real_escape_string($_POST['tag']);
    $idUtente = $con->real_escape_string($_SESSION['id']);

    //query inserimento post
    $sql = "INSERT INTO post (text, tag, img, fk_utente) VALUES ('$text', '$tag', '$img', '$idUtente')";                                    
    $con->query($sql);
    
    if(move_uploaded_file($_FILES['image']['tmp_name'], $percorso)) {                                            
        $msg = "Immagine pubblicata con successo.";
    } else {
        $msg = "C'è stato un problema.";
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi un post</title>
</head>
<body>
    <div class="topnav">
        <div class="topnav-logo">
            <h2>myPhotoboard</h2>
        </div>
        <div class="topnav-link">
            <a href="profilo.php">Profilo</a>
            <a href="../pub/cerca.php">Cerca</a>
            <a class="active" href="aggiungi_post.php">Aggiungi un post</a>
        </div>
    </div>
    <form class="form1 "method="post" action="aggiungi_post.php" enctype="multipart/form-data">
        <div>
            <input type="file" name="image">
        </div>
        <div>
            <textarea name="text" cols="30" rows="10" placeholder="Descrizione..."></textarea>
            <input type="text" name="tag" placeholder="tag...">
        </div>
        <div>
            <input  class="pubblica" type="submit" name="pubblica" value="pubblica">
        </div>
        <?php echo $msg; ?>
    </form>
    <div class="footer">
        Copyright &copy; 2020 Cordani Francesco.
    </div>
</body>
</html>