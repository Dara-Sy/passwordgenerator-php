<?php

// this is a character set in php; character set for lowercase letters

// rand($low, $high); uses a libc random number generator
// the library bundled with the C programming language
// strlen is the string length - 1

function random_char($string) {
  $i = random_int(1,strlen($string)-1);
  return $string[$i];
}

// echo random_char($chars);

function random_string($length, $char_set) {
  $output = '';
  for($i=0; $i < $length; $i++) {
    $output .= random_char($char_set);
  }
  return $output;
}

function generate_password($options) {
  // define character sets
  $lower = 'abcdefghijklmnopqrstuvwxyz';
  $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $numbers = '0123456789';
  $symbols = '$*?!-';

  // extract configuration flags into variables
  // ternary, if lower is set, use the value of lower, if not use 0
  $use_lower = isset($options['lower']) ? $options['lower'] : '0';
  $use_upper = isset($options['upper']) ? $options['upper'] : '0';
  $use_numbers = isset($options['numbers']) ? $options['numbers'] : '0';
  $use_symbols = isset($options['symbols']) ? $options['symbols'] : '0';

  // building up master sets depending on relationships
  $chars = '';
  if($use_lower === '1') { $chars .= $lower; }
  if($use_upper === '1') { $chars .= $upper; }
  if($use_numbers === '1') { $chars .= $numbers; }
  if($use_symbols === '1') { $chars .= $symbols; }

  // . is a symbol that concatenates chars
  // $chars = $lower . $upper . $numbers . $symbols;
  return random_string($length, $chars);
}

// set options into an array
$options = array(
  'length' => $_GET['length'],
  'lower' => $_GET['lower'],
  'upper' => $_GET['upper'],
  'numbers' => $_GET['numbers'],
  'symbols' => $_GET['symbols']
);

$password = generate_password($options);


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Password Generator</title>
</head>
<body>

  <p>Generated Password: <?php echo $password; ?></p>
  <p> Generate a new password using the form options.</p>
  <form action="" method="GET">
    <!-- use php to save data, checked boxes, and save pw in url -->
    Length: <input type="text" name="length" value="<?php if(isset($_GET['length'])) { echo $_GET['length'];} ?>" /> <br />
      <input type = "checkbox" name="lower" value="1" <?php if($_GET['lower'] == 1) { echo 'checked'; } ?> /> Lower <br />
      <input type = "checkbox" name="upper" value="1" <?php if($_GET['upper'] == 1) { echo 'checked'; } ?> /> Upper <br />
      <input type = "checkbox" name="numbers" value="1" <?php if($_GET['numbers'] == 1) { echo 'checked'; } ?> /> Numbers <br />
      <input type="checkbox" name="symbols" value="1" <?php if($_GET['symbols'] == 1) { echo 'checked'; } ?> /> Symbols<br />
      <input type="submit" value="Submit" />
  </form>

  </body>
</html>

<!--
// echo rand(1,6);
// echo $chars[0];
// mt_rand is "mersenne twister" random number generator
// drop-in replacement for random
// up to 4x faster than rand and more random than rand

// random_int uses different rand sources
// cryptographically secure, dice aren't heavier on one side
// issue: new function of PHP 7

// other secure rand options or libraries
// Mcrypt library
// /dev/urandom (unix only)
// OpenSSL -->

