<!doctype html>
<html lang='en'>
  <head>
    <title>Generated xkcd-style Password</title>
    <meta charset='utf-8'/>

    <!-- BEGIN 3rd Party Bootstrap inclusions -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <!--[if lt IE 9]>
      <script -->
        <!--src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js">
      </script>
      <script -->
        <!--src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js">
      </script>
    <![endif]-->
    <!-- END 3rd Party Bootstrap inclusions -->

  </head>
  <body>

    <!-- BEGIN more Bootstrap inclusions -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- END more Boostratp inclusions -->

    <h1>Generated xkcd-style Password</h1>
    <?php 

      require("logic.php");

      echo("<p>$password</p>\n");
      
    ?>
  </body>
</html>
