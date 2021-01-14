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
        $_SESSION['path']="../../img/";
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
</head>

<body>
    <div class="titolo">
        <h1 class="titolo">Inizia a riempire la tua Photoboard</h1>
    </div>
    <form class="form1" method="post" action="registrati.php">                                                                            <!-- form registrazione -->
        <h1>Registrati</h1>
        <p>Username:<br/><input type="text" placeholder="Username" name="username"></p>
        <p>Email:<br/><input type="email" placeholder="Email" name="email"></p>
        <p>Password:<br/><input type="password" placeholder="Password" name="password"></p>
        <p>Reinserisci password:<br/><input type="password" placeholder="Password" name="cPassword"></p>
        <button type="submit" name="submit">Registrati</button>
    </form>
</body>

</html>
