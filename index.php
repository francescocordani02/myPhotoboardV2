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
    <form class="form-horizontal" method="post" action="pub/login.php">
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
            <a href="pub/registrati.php">Registrati</a>
        </div>
    </form>
</div>
</body>
</html>