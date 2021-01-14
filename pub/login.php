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
</head>
<body>
    <div class="titolo">
        <h1 class="titolo">Benvenuto in myPhotoboard</h1>
    </div>
    <form class="form1" method="post" action="login.php">                                                                     
        <h1>Login</h1>
        <input type="text" id="username" placeholder="Username" name="username">
        <input type="password" id="passcode" placeholder="Password" name="passcode">
        <button type="submit" name="login">Accedi</button>
        <div>
            <p>Non sei ancora registrato?</p>
            <a href="registrati.php">Registrati</a>
        </div>
    </form>
</body>
</html>