<?php
//includo file con dati db
include('../private/config.php');                                                                                   
//connessione
$con = new mysqli($host, $user, $password, $nomedb);                                                                
if($con == false) die("Impossibile connettersi al database: ".mysql_error());

$msg = "";

if (isset($_POST['submit'])) {
    $name = $con->real_escape_string($_POST['username']);
    $email = $con->real_escape_string($_POST['email']); 
    $password = $con->real_escape_string($_POST['password']);
    $cPassword = $con->real_escape_string($_POST['cPassword']);

    //controllo password
    if ($password != $cPassword)                                                                                        
        $msg = "Le password devono corrispondere!";
    else{
        //cripto la password
        $hash = password_hash($password, PASSWORD_BCRYPT);                       
        //query inserimento utente db                                       
        $con->query("INSERT INTO utente (nomeUtente,email,passcode) VALUES ('$name', '$email', '$hash')");    
        //apertura sessione utente             
        session_start();                                                                 
        $id = $data['idUtente'];
        $_SESSION['id']=$id;                                                                                        
        $_SESSION['username']=$name;
        //memorizzo in session la pagina
        $_SESSION['pagePrecedente']="";
        //memorizzo in session il percorso per le immagini
        $_SESSION['path']="../img/";
        //reindirizzo alla propria pagina profilo
        header("location: ../private/profilo.php");                                                                         
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
<h1 class="text-center">Inizia a riempire la tua Photoboard</h1>
<div class="container-md p-5 my-5 border">
    <form class="form-horizontal" method="post" action="registrati.php">                                                                           <!-- form registrazione -->
        <h2 class="mb-3">Registrati</h2>
        <div class="form-group text-center">
            <input type="text" class="form-control" placeholder="Username" name="username"></p>
        </div>
        <div class="form-group text-center">
            <input type="email" class="form-control" placeholder="Email" name="email"></p>
        </div>
        <div class="form-group text-center">
            <input type="password" class="form-control" placeholder="Password" name="password"></p>
        </div>
        <div class="form-group text-center">
            <input type="password" class="form-control" placeholder=" Conferma password" name="cPassword"></p>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary" type="submit" name="submit">Registrati</button>
        </div>
    </form>
</div>
</body>

</html>
