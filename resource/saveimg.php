<?php
error_reporting(0);
$url = 'http://localhost/cam01';
/**
 * Get the width and height of the destination image
 * from the POST variables and convert them into
 * integer values
 */
$w = (int)$_POST['width'];
$h = (int)$_POST['height'];

// create the image with desired width and height

$img = imagecreatetruecolor($w, $h);

// now fill the image with blank color
// do you remember i wont pass the 0xFFFFFF pixels 
// from flash?
imagefill($img, 0, 0, 0xFFFFFF);

$rows = 0;
$cols = 0;

// now process every POST variable which
// contains a pixel color
for($rows = 0; $rows < $h; $rows++){
 // convert the string into an array of n elements
 $c_row = explode(",", $_POST['px' . $rows]);
 for($cols = 0; $cols < $w; $cols++){
  // get the single pixel color value
  $value = $c_row[$cols];
  // if value is not empty (empty values are the blank pixels)
  if($value != ""){
   // get the hexadecimal string (must be 6 chars length)
   // so add the missing chars if needed
   $hex = $value;
   while(strlen($hex) < 6){
    $hex = "0" . $hex;
   }
   // convert value from HEX to RGB
   $r = hexdec(substr($hex, 0, 2));
   $g = hexdec(substr($hex, 2, 2));
   $b = hexdec(substr($hex, 4, 2));
   // allocate the new color
   // N.B. teorically if a color was already allocated 
   // we dont need to allocate another time
   // but this is only an example
   $test = imagecolorallocate($img, $r, $g, $b);
   // and paste that color into the image
   // at the correct position
   imagesetpixel($img, $cols, $rows, $test);
  }
 }
}

$waktu = date("H-i-s");
$nama = 'gambar-'.$waktu;
// print out the correct header to the browser
header("Content-type:image/jpeg");
imagejpeg($img,$nama.".png", 90);

include "koneksi.php";
$gambar = $nama;
// Simpan Data ke Database
$sql = "INSERT INTO hasil (nama,gambar) VALUES ('".$nama."','".$gambar."')";
$simpan = mysql_query($sql);

//header("location:".$url);

?>

