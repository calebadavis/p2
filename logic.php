<?php
/**
 * Main logic for xkcd-style password generation
 *
 * Generates an xkcd-style password, placing the new value in '$password'
 *
 * Assumes co-located files 'words.txt' and 'special_chars.txt'. These files 
 * should be text, consisting of one word or character per line.
 *
 * Inspects the builtin $_POST array for the following keys:
 * -'numWords': How many common words to use in the password (default 4)
 * -'insertChar': Insert a special character into the password?
 * -'insertNum': Insert a number into the password?
 * -'upperCase': Randomly upper-case one character of the password?
 */

ini_set("auto_detect_line_endings", true);
$words = file("words.txt", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
$chars = file("special_chars.txt", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
$cnt = count($words); // How many words are in the dictionary?
$specialCharsCnt = count($chars); // How many available special chars?

// Password length (num of words) - default to 4
$requestCnt = 
  (array_key_exists('numWords', $_POST)) ? 
    (int)$_POST['numWords']:
    4;

// Should password include a num?
$insertNum = 
  (array_key_exists('insertNum', $_POST)) ? 
    (bool)$_POST['insertNum']:
    false;

// Should it include a char?
$insertChar = 
  (array_key_exists('insertChar', $_POST)) ? 
    (bool)$_POST['insertChar']: 
    false;

// Should one character be caps?
$upperCase = 
  (array_key_exists('upperCase', $_POST)) ? 
    (bool)$_POST['upperCase']:
    false;

// Which word in the password should get an inserted number?
$wordToInsertNum = ($insertNum) ? rand(1, $requestCnt) : 0;

// Which word in the password should get an inserted special character?
$wordToInsertChar = ($insertChar) ? rand(1, $requestCnt) : 0;

// Which word in the password should get an upper case character?
$wordToUpperCase = ($upperCase) ? rand(1, $requestCnt) : 0;

$password = "";

// The main loop: for each word
for ($idx = 0; $idx < $requestCnt; ++$idx) {

  // First select a random word:
  $newWord = $words[rand(0, $cnt - 1)];

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

  // Use '-' character to join words
  $password = $password . $newWord;
  if ($idx+1 < $requestCnt) $password = $password . '-';
}
?>