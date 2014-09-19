<!doctype html>
<html>
  <head>
    <title>Random English Words</title>
    <meta charset='utf-8'/>
  </head>
  <body>
    <h1>Random English Words</h1>
    <form action="generate_password.php" method="post">
      <p>Number of words: <input type="number" name="numWords" min="1" value="4"/></p>
      <p><input type="checkbox" name="insertNum" value="insertNum">Insert a number?</p>
      <p><input type="checkbox" name="insertChar" value="insertChar">Insert a special character?</p>
      <p><input type="checkbox" name="upperCase" value="upperCase">Make one character upper-case?</p>
      <p><input type="submit" /></p>
    </form>
  </body>
</html>
