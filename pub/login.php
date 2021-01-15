<?php
//includo file con dati db
include('../private/config.php');       
//connessione                                                                            
$con = new mysqli($host, $user, $password, $nomedb);                                                                
if($con == false) die("Impossibile connettersi al database: ".mysql_error());

$msg = "";

if (isset($_POST['login'])) {
    $username = $con->real_escape_string($_POST['username']);
    $passcode = $con->real_escape_string($_POST['passcode']);

    //query per selezionare l'utente dal db
    $sql = $con->query("SELECT idUtente, passcode FROM utente WHERE nomeUtente='$username'");                                  
    if ($sql->num_rows > 0) {
        //metto idUtente e passcode in un array e passcode
        $data = $sql->fetch_array();                                                                                
        //verifico la password
        if (password_verify($passcode, $data['passcode'])) {     
            //apertura sessione utente                                                   
            session_start();
            $id = $data['idUtente'];
            $_SESSION['id']=$id;                                                                                        
            $_SESSION['username']=$username;
            $_SESSION['pagePrecedente']="";
            $_SESSION['path']="../img/";
            //reinderizzo l'utente alla sua pagina profilo
            header("location: ../private/profilo.php");                                                                  
        } else
            $msg = "Password errata";
    } else
        $msg = "Username o password errati";
}
echo $msg;
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<h1 class="text-center">Benvenuto in myPhotoboard</h1>
<div class="container-md p-5 my-5 border">
    <form class="form-horizontal" method="post" action="login.php">
        <h2 class="mb-3">Login</h2>
        <div class="form-group text-center">
            <input type="text" class="form-control" id="username" placeholder="Username" name="username">
        </div>
        <div class="form-group text-center">
            <input type="password" class="form-control" id="passcode" placeholder="Password" name="passcode">
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" name="login">Accedi</button>
        </div>
        <div class="form-group text-center">
            <p>Non sei ancora registrato?</p>
            <a href="registrati.php">Registrati</a>
        </div>
    </form>
</div>
</body>
</html>