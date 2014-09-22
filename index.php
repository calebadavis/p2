<!doctype html>
<html lang='en'>
  <head>

    <meta charset='utf-8'/>
    <title>xkcd-style password generator</title>

    <!-- BEGIN 3rd Party Bootstrap inclusions -->
<!--    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> -->
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

    <link rel="stylesheet" href="css/password_gen.css" type="text/css" />

  </head>
  <body>

    <!-- BEGIN more Bootstrap inclusions -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- END more Boostratp inclusions -->

    <h1>An xkcd-style Password Generator</h1>

    <?php require("logic.php"); ?>

    <section id="generator">
      <form action="index.php" method="post">
        <fieldset id="word_count">
          <legend>Word Count</legend>
          <?php
            if ($requestCnt < 1) $requestCnt = 4;
            echo "          <p>Words: <input type='number' name='numWords' min='1' value='$requestCnt'/></p>\n";
          ?>
        </fieldset>
        <fieldset id="variations">
          <legend>Variations</legend>
          <?php
            echo "          <p><input type='checkbox' name='insertNum' value='insertNum'";
            if ($insertNum) echo " checked";
            echo ">Insert a number?</p>\n";
            echo "          <p><input type='checkbox' name='insertChar' value='insertChar'";
            if ($insertChar) echo " checked";
            echo ">Insert a special character?</p>\n";
            echo "          <p><input type='checkbox' name='upperCase' value='upperCase'";
            if ($upperCase) echo " checked";
            echo ">Make one character upper-case?</p>\n";
          ?>
        </fieldset>
        <p><input type="submit" /></p>
      </form>
    </section>
    <section id="about">
      <p>An <a href="http://www.xkcd.com/936">xkcd style password</a> is a password which consists of several easy-to-remember words, rather than the traditional shorter, complex series of letters, numbers, and special characters:</p>
      <p>This page allows you to generate xkcd style passwords. You can specify how many common words to use for the password, as well as options for inserting a random special character, a randomly placed number (0-9), and to randomly capitalize one of the letters.</p>
      <p>The words are based on a list of several thousand of the most commonly used words in the english language.</p> 
    </section>

    <section id="password">
      <h2>New Password:</h2>
      <?php echo "      <h3>$password</h3>\n"; ?>
    </section>

    <section id="cartoon">
      <h2>Original xkcd Cartoon</h2>
      <img src="http://imgs.xkcd.com/comics/password_strength.png" alt="xkcd password cartoon"/>
    </section>
  </body>
</html>
