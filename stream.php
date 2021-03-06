<?php ob_start();
require("verify.php");

#Set these and make sure the webserver user can read files in them
$mp3lopath = "/data/music/lo";
$mp3hipath = "/data/music/hi";

# Needs the following in httpd.conf for this virtual host
# RewriteEngine  on
# RewriteRule    ^/database/play/(.*)$   /database/stream.php?xname=$1

header ('Content-Type: text/html');

if (preg_match ("/^([0-9][0-9][0-9][0-9][0-9][0-9][0-9])-([0-9][0-9])-([lohi][lohi])\.mp3$/", $xname, $r)) {
	$format = $r[3];
	$cdnumber = $r[1];
	$file = "$r[1]-$r[2].mp3";
}
else { die ("wrong format"); }

#settype ($file, "integer");
	
#echo "<p>format=$format";
#echo "<p>cdnumber=$cdnumber";
#echo "<p>filename=$file";


if ($format != "lo" && $format != "hi")  { die ("format wrong"); }

if ($format == "lo") $filename = $mp3lopath;
if ($format == "hi") $filename = $mp3hipath;

$filename .= "/$cdnumber/$file";

if (!is_readable($filename)) { die ("cannot read file"); }

header ('Content-Type: audio/mpeg');

$fd = fopen ($filename, "rb");
$length = filesize ($filename);
header ("Content-Length: $length");
readfile($filename);
fclose ($fd);
?>
