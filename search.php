<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);


    $connection = mysqli_connect("localhost", "root", "root", "search");

    function confirm_connection() {
        if (mysqli_connect_errno()) {
            $message = "Connection Failed!";
            exit($message);
        }
    }

    confirm_connection();

    $connection or die("Error connecting to database: ".mysqli_error($connection));
    
    mysqli_select_db($connection, "search") or die(mysqli_error($connection));


    $query = $_GET['query'];
    // gets value sent over search form

    // $query = $_POST['query'];

    $data = array();
    $errors = array();
    
    // $min_length = 3;

    if (empty($query)) {
        $errors['query'] = "Please Enter a Search Term.";
    } else if (strlen($query) < 3) {
        $errors['query'] = "Please Enter a length of more than 3 characters.";
    } 

        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
            $data['message'] = 'There was an error with your search.';
            $data['response'] = true;
        } else {
        
        $query = htmlspecialchars($query); 

        $query = mysqli_real_escape_string($connection, $query);
        
        $raw_results = mysqli_query($connection, "SELECT * FROM people
            WHERE (`firstname` LIKE '%".$query."%') OR (`lastname` LIKE '%".$query."%')") or die(mysqli_error($connection));
        
        if(mysqli_num_rows($raw_results) > 0){ 
            
            while($results = mysqli_fetch_array($raw_results)){

                $data['results'] = $results['firstname'] . $results['lastname'];
                // echo $data;
            
                // echo "<p><h3>".$results['title']."</h3>".$results['text']."</p>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }

            $data['success'] = true;
            $data['message'] = 'Success!';
            $data['response'] = true;
            
        } else { // if there is no matching rows do following
            $data['success'] = false;
            $data['errors'] = $errors;
            $data['response'] = false;
            $data['message'] = 'There were no results for your query';
        }
    }

    echo json_encode($data);

?>