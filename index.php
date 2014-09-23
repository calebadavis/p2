<!doctype html>
<html lang='en'>

  <head>
    <meta charset='utf-8'/>
    <title>xkcd-style password generator</title>
    <link rel="stylesheet" href="css/normalize.css" type="text/css" />
    <link rel="stylesheet" href="css/password_gen.css" type="text/css" />
  </head>

  <body>

    <h1>An xkcd-style Password Generator</h1>

    <?php require("logic.php"); ?>

    <section id="generator">
      <form action="index.php" method="post">
        <fieldset id="word_count">
          <legend>Word Count</legend>
          <?php
            echo "Words: <input type='number' name='numWords' min='1' value='$requestCnt'/>\n";
          ?>
        </fieldset>
        <fieldset id="variations">
          <legend>Variations</legend>
          <?php
            echo "<input type='checkbox' name='insertNum' value='insertNum'";
            if ($insertNum) echo " checked";
            echo ">Insert a number?<br/>\n";
            echo "          <input type='checkbox' name='insertChar' value='insertChar'";
            if ($insertChar) echo " checked";
            echo ">Insert a special character?<br/>\n";
            echo "          <input type='checkbox' name='upperCase' value='upperCase'";
            if ($upperCase) echo " checked";
            echo ">Make one character upper-case?\n";
          ?>
        </fieldset>
        <input type="submit" value="Generate" />
      </form>
    </section>

    <section id="about">
      <p>An <a href="http://www.xkcd.com/936">xkcd style password</a> is a password which consists of several easy-to-remember words, rather than the traditional shorter, complex series of letters, numbers, and special characters:</p>
      <p>This page allows you to generate xkcd style passwords. You can specify how many common words to use for the password, as well as options for inserting a random special character, a randomly placed number (0-9), and to randomly capitalize one of the letters.</p>
      <p>The words are based on a list of several thousand of the most commonly used words in the english language.</p> 
    </section>

    <section id="password">
      <h2>New Password:</h2>
      <?php echo "<h3>$password</h3>\n"; ?>
    </section>

    <section id="cartoon">
      <h2>Original xkcd Cartoon</h2>
      <img src="http://imgs.xkcd.com/comics/password_strength.png" alt="xkcd password cartoon"/>
    </section>
  </body>
</html>
