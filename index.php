<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include 'db_credentials.php';

    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    function confirm_connection() {
        if (mysqli_connect_errno()) {
            $message = "Connection Failed!";
            exit($message);
        }
    }

    confirm_connection();

    $connection or die("Error connecting to database: ".mysqli_error($connection));
    
    mysqli_select_db($connection, DB_NAME) or die(mysqli_error($connection));


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>PHP Search</title>
  <meta name="description" content="search">
  <meta name="author" content="mike_b">

  <link rel="stylesheet" href="css/styles.css?v=1.0">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="search.php" method="GET">
                    <input type="text" id="query" name="query" />
                    <input type="submit" value="search" />
                </form>
                <div id="form-message"></div>
                <div id="results"></div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
</body>
</html>