<?php

require 'core.inc.php';
require 'connect.inc.php';


$file_name = $_FILES['file']['name'];

// random 4 digit to add to our file name
// some people use date and time in stead of random digit
$random_digit=date_format(new DateTime(null, new DateTimeZone('Europe/Belfast')),'d-m-Y-G-i-s').'-'.rand(0000,9999).'--';

//combine random digit to you file name to create new file name
//use dot (.) to combile these two variables

$new_file_name=$random_digit.$file_name;

//set where you want to store files
//in this example we keep file in folder upload
//$new_file_name = new upload file name
//for example upload file name cartoon.gif . $path will be upload/cartoon.gif
$path= "img/uploads/".$new_file_name;
if($_FILES['file'] != null)
{
	if(copy($_FILES['file']['tmp_name'], $path))
	{
	}else{}
}

$title = $_POST['title'];
$intro = $_POST['introduction'];
$contentmore = $_POST['content'];

if(!empty($path) && !empty($title) && !empty($intro) && !empty($contentmore)){
	
$title = addslashes($title);
$intro = addslashes($intro);

$price = $_POST['price'];
if($price >= 0){}else{$price = ''; }

$console = '';
$genre = '';
$star = '';
$staff = '';
$year ='';

if(isset($_POST['pc'])){$console = $console.';pc;';}
if(isset($_POST['mac'])){$console = $console.';mac;';}
if(isset($_POST['linux'])){$console = $console.';linux;';}
if(isset($_POST['ps4'])){$console = $console.';ps4;';}
if(isset($_POST['ps3'])){$console = $console.';ps3;';}
if(isset($_POST['xboxone'])){$console = $console.';xboxone;';}
if(isset($_POST['xbox360'])){$console = $console.';xbox360;';}
if(isset($_POST['wiiu'])){$console = $console.';wiiu;';}
if(isset($_POST['wii'])){$console = $console.';wii;';}
if(isset($_POST['ios'])){$console = $console.';ios;';}
if(isset($_POST['android'])){$console = $console.';android;';}

if(isset($_POST['action'])){$genre = $genre.';action;';}
if(isset($_POST['adventure'])){$genre = $genre.';adventure;';}
if(isset($_POST['music'])){$genre = $genre.';music;';}
if(isset($_POST['mmo'])){$genre = $genre.';mmo;';}
if(isset($_POST['puzzle'])){$genre = $genre.';puzzle;';}
if(isset($_POST['rpg'])){$genre = $genre.';rpg;';}
if(isset($_POST['shooter'])){$genre = $genre.';shooter;';}
if(isset($_POST['action'])){$genre = $genre.';sport;';}
if(isset($_POST['strategy'])){$genre = $genre.';strategy;';}

if(isset($_POST['1'])){$star = '1';}
if(isset($_POST['2'])){$star = '2';}
if(isset($_POST['3'])){$star = '3';}
if(isset($_POST['4'])){$star = '4';}
if(isset($_POST['5'])){$star = '5';}

if(isset($_POST['staff'])){$staff = 'staff';}

if(isset($_POST['pre2010'])){$year = 'pre2010';}
if(isset($_POST['2011'])){$year = '2011';}
if(isset($_POST['2012'])){$year = '2012';}
if(isset($_POST['2013'])){$year = '2013';}
if(isset($_POST['2014'])){$year = '2014';}
if(isset($_POST['beta'])){$year = 'beta';}

$content = '<div class="contentBoxContainer"><div class="contentBoxPicture"><img src="'.$path.'"/></div><div class="contentBoxText"><h2>'.$title.'</h2><p>'.$intro.'</p></div><div class="contentMore">';
$content = $content.$contentmore;
$content = $content.'</div><p class="readMore">Read More</p></div>';

$query = "INSERT INTO contentgames_table (title, content, consoles, genres, year, stars, price, staff)
VALUES ('$title','$content', '$console','$genre','$year','$star','$price','$staff')";
if	($query_run = mysql_query($query)){
									header('Location: games.php');
								}else{
									echo 'Sorry, we could not process your request. Try again later.<br>';
									echo $query."\r\n";
									echo $query_run."\r\n";
									echo mysql_error();
								}


}else{echo'Error - Required Fields Left Blank';}
?>