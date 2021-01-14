<?php
session_start();
session_destroy();
//reindirizzo l'utente alla pagina di login
header('location: ../index.php');                                                                    
?>