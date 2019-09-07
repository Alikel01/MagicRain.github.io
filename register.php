<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!--Bootstrap 4 Link - CSS -->

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>MagicRain - Login/Signup</title>
    <link rel="stylesheet" href="elyts.css" class="css">
</head>
<body>  
<?php
require_once("db_const.php");
if (!isset($_POST['submit'])) {
?>  <!-- The HTML registration form -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div">
            <h3 class="text-center">Sign up</h3>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <form action="login.php">
        <div class="form-group">
        Username: <input type="text" name="username" class="form-control form-control-lg"/><br />
            </div>
            <div class="form-group">
            Password: <input type="password" name="password" class="form-control form-control-lg"/><br />
            </div>
            <div class="form-group">
            Email: <input type="type" name="email" class="form-control form-control-lg" /><br />
            </div>
    
                     <button type="submit" name="submit" class="btn btn-primary btn-block bt-lg">Sign Up</button>
                     <p class="text-center">Already have an account? <a href="login.php">Login</a></p>
                    </div>
                 </div>
            </div> 
                </div>
    </form>
<?php
} else {
## connect mysql server
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    # check connection
    if ($mysqli->connect_errno) {
        echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
        exit();
    }
## query database
    # prepare data for insertion
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $email      = $_POST['email'];

    # check if username and email exist else insert
    $exists = 0;
    $result = $mysqli->query("SELECT username from users WHERE username = '{$username}' LIMIT 1");
    if ($result->num_rows == 1) {
        $exists = 1;
        $result = $mysqli->query("SELECT email from users WHERE email = '{$email}' LIMIT 1");
        if ($result->num_rows == 1) $exists = 2;    
    } else {
        $result = $mysqli->query("SELECT email from users WHERE email = '{$email}' LIMIT 1");
        if ($result->num_rows == 1) $exists = 3;
    }

    if ($exists == 1) echo "<p>Username already exists!</p>";
    else if ($exists == 2) echo "<p>Username and Email already exists!</p>";
    else if ($exists == 3) echo "<p>Email already exists!</p>";
    else {
        # insert data into mysql database
        $sql = "INSERT  INTO `users` (`id`, `username`, `password`, `email`) 
                VALUES (NULL, '{$username}', '{$password}', '{$email}')";

        if ($mysqli->query($sql)) {
            //echo "New Record has id ".$mysqli->insert_id;
            echo "<p>Registred successfully!</p>";
        } else {
            echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
            exit();
        }
    }
}
?>      
</body>
</html>