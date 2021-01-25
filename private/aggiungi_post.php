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
    $percorso = "../img/" . basename($_FILES['image']['name']);                                                          
    $img = $con->real_escape_string($_FILES['image']['name']);
    $text = $con->real_escape_string($_POST['text']);
    $tag = $con->real_escape_string($_POST['tag']);
    $idUtente = $con->real_escape_string($_SESSION['id']);

    //query inserimento post
    $sql = "INSERT INTO post(text,tag,img,fk_utente) VALUES ('$text', '$tag', '$img', '$idUtente')";                                    
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
        <a class="nav-link" href="profilo.php">Profilo</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="../pub/cerca.php">Cerca</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="aggiungi_post.php">Aggiungi un post</a>
        </li>
    </ul>
</nav>
<div class="container main-container">
    <div class="row">
        <div class="col border">
            <form method="post" action="aggiungi_post.php" enctype="multipart/form-data">
                <div class="form-group text center space">
                    <input type="file" name="image">
                </div>
                <div class="form-group text center">
                    <textarea name="text" cols="30" rows="10" placeholder="Descrizione..."></textarea>
                    </br>
                    <input type="text" name="tag" placeholder="tag...">
                </div>
                <div class="mb-3">
                    <input class="btn btn-primary pubblica" type="submit" name="pubblica" value="pubblica">
                </div>
        <?php echo $msg; ?>
        </form>
        </div>
    </div>
</div>
</form> 
<div class="jumbotron text-center bg-white">
    Copyright &copy; 2020 Cordani Francesco.
</div>
</body>
</html>