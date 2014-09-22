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

      if ($requestCnt < 1) $requestCnt = 4;

      // Which word in the password should get an inserted number?
      $wordToInsertNum = ($insertNum) ? rand(1, $requestCnt) : 0;

      // Which word in the password should get an inserted special character?
      $wordToInsertChar = ($insertChar) ? rand(1, $requestCnt) : 0;

      // Which word in the password should get an upper case character?
      $wordToUpperCase = ($upperCase) ? rand(1, $requestCnt) : 0;

      $password = "";

      // The main loop: for each random word
      for ($idx = 0; $idx < $requestCnt; ++$idx) {

        // First select a random word:
	$randIdx = rand(200, 6000); // The interesting words start at 200
                                    // and after 6000 become very esoteric
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
?>