<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
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
                <!-- <form action="<php $_SERVER['PHP_SELF'] ?>" method="GET"> -->
                <form id="search" method="get">
                    <input type="text" id="query" name="query" />
                    <input type="submit" value="search" />
                    <div id="query-warning"></div>
                </form>
                <div id="form-message"></div>
                <div id="results"></div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

  <script type="text/javascript">


$(document).ready(function() {

    $('#search').submit(function(e){

        e.preventDefault();

        var query = $('#query').val();

        // alert(search);

            $.ajax({
                type: "GET",
                url: 'search.php',
                dataType: 'json',
                data: {query: query},
                }).done(function(data){

                    if (!data.success) {
                        if (data.response) {
                            $('#query-warning').html('<div class="help-block input-alert-error">' + data.errors.query + '</div>');
                        } else {
                            $('#query-warning').html('');
                        }
                        $('#form-message').html('<div class="help-block input-alert-error">' + data.message + '</div>');
                        $('#results').html('');
                    }  else {
                        
                        $('#query-warning').html('');

                        $('#form-message').html('<div class="alert alert-success">' + data.message + '</div>');

                        $('#results').html('<div class="alert alert-success">' + data.results + '</div>');

                    }

                    // alert(data);
            });
    });

});

  </script>
</body>
</html>