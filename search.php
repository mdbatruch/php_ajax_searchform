<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    define("DB_HOST", 'localhost');
    define("DB_USER", 'root');
    define("DB_PASS", 'root');
    define("DB_NAME", 'search');


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
                    <?php

                        $query = $_GET['query'];
                        
                        $min_length = 3;

                        $query = htmlspecialchars($query); 

                        $query = mysqli_real_escape_string($connection, $query);

                        if (strlen($query) >= $min_length) {
                            
                        $raw_results = mysqli_query($connection, "SELECT * FROM people
                            WHERE (`firstname` LIKE '%".$query."%') OR (`lastname` LIKE '%".$query."%')") or die(mysqli_error($connection));
                            
                        if(mysqli_num_rows($raw_results) > 0){ 
                            
                            while($results = mysqli_fetch_array($raw_results)){

                                echo "<p><h3>".$results['firstname']."</h3>".$results['lastname']."</p>";

                            }

                        } else {
                                echo 'No results';
                            }
                        } else {
                            echo 'Needs to Be longer!';
                        }

                    ?>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </body>
</html>