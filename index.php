<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <div class="titolo">
        <h1 class="titolo">Benvenuto in myPhotoboard</h1>
    </div>
    <form class="form1" method="post" action="/pub/login.php">
        <h1>Login</h1>
        <input type="text" id="username" placeholder="Username" name="username">
        <input type="password" id="passcode" placeholder="Password" name="passcode">
        <button type="submit" name="login">Accedi</button>
        <div>
            <p>Non sei ancora registrato?</p>
            <a href="/pub/registrati.php">Registrati</a>
        </div>
    </form>
</body>
</html>