<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!--Bootstrap 4 Link - CSS -->

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

            <link rel="stylesheet" href="elyts.css">

    <title>MagicRain - Signup/login</title>
</head>
<body>

    <header>
        <div class="row">
         <ul class="main-nav">
                    <li><a href="index.html">HOME</a> </li>
                    <li><a href="games.html">GAMES</a> </li>
                    <li><a href="discord.html">DISCORD</a> </li>
                    <li><a href="contact.html">CONTACT</a> </li>
                    </ul>
            </div>
</header>

<?php

if (!isset($_POST['submit'])){
?>
<!-- The HTML login form -->
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <form action="login.php">
        <div class="col-md-4 offset-md-4 form-div">
            <h3 class="text-center">Login</h3>
            <div class="form-group">
        Username: <input type="text" name="username" class="form-control form-control-lg"/><br />
        </div>
        <div class="form-group">
        Password: <input type="password" name="password" class="form-control form-control-lg"/><br />
        </div>

        <button type="submit" name="submit" class="btn btn-primary btn-block bt-lg">Login</button>
        <p class="text-center">Don't have an account? <a href="signup.php">Login</a></p>
</div>
</div>

    </form>

<?php
} else {
    require_once("db_const.php");
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    # check connection
    if ($mysqli->connect_errno) {
        echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
        exit();
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * from users WHERE username LIKE '{$username}' AND password LIKE '{$password}' LIMIT 1";
    $result = $mysqli->query($sql);
    if (!$result->num_rows == 1) {
        header("Location:login.php");

        echo '<script language="javascript">';
        echo 'alert(Weird! Credintials do not seem to match?)';  //not showing an alert box.
        echo '</script>';
    } else {
        echo "<p><h3>You have logged in! Choose a tab to switch to ...</h3></p> ";
        // do stuffs
    }
}
?> 
<div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div">
            <h3 class="text-center"></h3>
<form action="index.html" >
</body>
</html>