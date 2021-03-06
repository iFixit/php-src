--TEST--
Test file_put_contents() function : usage variation - obscure filenames
--CREDITS--
Dave Kelsey <d_kelsey@uk.ibm.com>
--SKIPIF--
<?php
if(substr(PHP_OS, 0, 3) == "WIN")
  die("skip Not for Windows");
?>
--CONFLICTS--
obscure_filename
--FILE--
<?php
/* Prototype  : int file_put_contents(string file, mixed data [, int flags [, resource context]])
 * Description: Write/Create a file with contents data and return the number of bytes written
 * Source code: ext/standard/file.c
 * Alias to functions:
 */

echo "*** Testing file_put_contents() : usage variation ***\n";

$dir = __DIR__ . '/file_put_contents_variation8';
mkdir($dir);
chdir($dir);

/* An array of filenames */
$names_arr = array(
  -1,
  TRUE,
  FALSE,
  NULL,
  "",
  " ",
  //this one also generates a java message rather than our own so we don't replicate php message
  "\0",
  array(),

  //the next 2 generate java messages so we don't replicate the php messages
  "/no/such/file/dir",
  "php/php"

);

for( $i=0; $i<count($names_arr); $i++ ) {
  echo "-- Iteration $i --\n";
  $res = file_put_contents($names_arr[$i], "Some data");
  if ($res !== false && $res != null) {
     echo "$res bytes written to: $names_arr[$i]\n";
     unlink($names_arr[$i]);
  }
  else {
     echo "Failed to write data to: $names_arr[$i]\n";
  }
}
rmdir($dir);

echo "\n*** Done ***\n";
?>
--EXPECTF--
*** Testing file_put_contents() : usage variation ***
-- Iteration 0 --
9 bytes written to: -1
-- Iteration 1 --
9 bytes written to: 1
-- Iteration 2 --

Warning: file_put_contents(): Filename cannot be empty in %s on line %d
Failed to write data to: 
-- Iteration 3 --

Warning: file_put_contents(): Filename cannot be empty in %s on line %d
Failed to write data to: 
-- Iteration 4 --

Warning: file_put_contents(): Filename cannot be empty in %s on line %d
Failed to write data to: 
-- Iteration 5 --
9 bytes written to:  
-- Iteration 6 --

Warning: file_put_contents() expects parameter 1 to be a valid path, string given in %s on line %d
Failed to write data to:  
-- Iteration 7 --

Warning: file_put_contents() expects parameter 1 to be a valid path, array given in %s on line %d

Notice: Array to string conversion in %s on line %d
Failed to write data to: Array
-- Iteration 8 --

Warning: file_put_contents(%sdir): failed to open stream: %s in %s on line %d
Failed to write data to: %sdir
-- Iteration 9 --

Warning: file_put_contents(%sphp): failed to open stream: %s in %s on line %d
Failed to write data to: %sphp

*** Done ***
