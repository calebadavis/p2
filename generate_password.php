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
      ini_set("auto_detect_line_endings", true);
      $words = file("words.txt", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
      $chars = file("special_chars.txt", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
      $cnt = count($words); // How many words are in the dictionary?
      $specialCharsCnt = count($chars); // How many available special chars?
      $requestCnt = (int)$_POST['numWords']; // Password length (num of words)
      $insertNum = (bool)$_POST['insertNum']; // Should password include a num?
      $insertChar = (bool)$_POST['insertChar']; // Should it include a char?
      $upperCase = (bool)$_POST['upperCase']; // Should one character be caps?
      // Which word in the password should get an inserted number?
      $wordToInsertNum = ($insertNum) ? rand(1, $requestCnt) : 0;

      // Which word in the password should get an inserted special character?
      $wordToInsertChar = ($insertChar) ? rand(1, $requestCnt) : 0;

      // Which word in the password should get an upper case character?
      $wordToUpperCase = ($upperCase) ? rand(1, $requestCnt) : 0;

      $password = "";
      echo("    <p>");

      // The main loop: for each random word
      for ($idx = 0; $idx < $requestCnt; ++$idx) {
	$randIdx = rand(200, 6000);
        $newWord = $words[$randIdx];

        // If the user requested it, make one letter of one word in the 
        // password upper-case.
        if ($upperCase && ($wordToUpperCase == $idx + 1)) {
          $capsIdx = rand(0, strlen($newWord)-1);
	  $pfx = substr($newWord, 0, $capsIdx);
          $charToChange = substr($newWord, $capsIdx, 1);
          $sfx = substr($newWord, $capsIdx+1);
          $newWord = $pfx . strtoupper($charToChange) . $sfx;
	}

        // If the user requested a random number to be inserted in one word...
        if ($insertNum && ($wordToInsertNum == $idx + 1)) {
          $numVal = rand(0, 9);
          $insertPos = rand(0, strlen($newWord));
          $newWord = substr_replace($newWord, $numVal, $insertPos, 0);
	}

        // If the user requested a randomly placed special character....
        if ($insertChar && ($wordToInsertChar == $idx + 1)) {
          $charVal = $chars[rand(0, count($chars) - 1)];
          $insertPos = rand(0, strlen($newWord));
          $newWord = substr_replace($newWord, $charVal, $insertPos, 0);
	}

        $password = $password . $newWord;
        if ($idx+1 < $requestCnt) $password = $password . '-';
      }

      echo($password . "</p>\n");
      
    ?>
  </body>
</html>
