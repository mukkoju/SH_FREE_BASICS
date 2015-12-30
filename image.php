<?php
$data = $_POST;
$id = $data['id'];

//DB functionality
$db =  new PDO('mysql:host=localhost;dbname=saddahaq_facebook_apps', 'root', 'dambo');
$tmp = $db->query("SELECT _ID_ FROM table_free_basics_saddahaq WHERE _ID_ = ".$db->quote($id));
$res = $tmp->fetch(PDO::FETCH_ASSOC); 
$time = time();

if($res){
  return $data['id'];
}
else {
 $tmp = $db->query("INSERT INTO table_free_basics_saddahaq VALUES (".$db->quote($id).", ".$db->quote($data['email']).", ".$db->quote($data['name']).", 'F_B', $time)");
}
        
$pfImg = file_get_contents('https://graph.facebook.com/'.$id.'/picture?width=480&height=480&redirect=false');
$pfImg = json_decode($pfImg, true);
$prfUrl = $pfImg["data"]["url"];
$prfWidth = $pfImg["data"]["width"];
$prfHeight = $pfImg["data"]["height"];

//genrating image
$IntialImg = imagecreatefrompng("screen.png");
//$logoTxt = imagecreatefrompng("logo.png");
$profileImage = imagecreatefromjpeg($prfUrl);
$white = imagecolorallocate($IntialImg, 255, 255, 255);
$font = '/var/www/FREE_BASICS/maiandra.ttf';

//imagettftext($IntialImg, 30, 0, 140, 400, $white, $font, $data['name']);
//var_dump($pfImg);
//place profile image
imagecopymerge($IntialImg, $profileImage, 0, 0, 0, 0, $prfWidth, $prfHeight, 40);
//imagecopymerge($IntialImg, $logoTxt, 0, 0, 0, 0, 217, 115, 90);


$imageName = 'images/'.$id.'_Pic.png';

//save image
header('Content-type: image/png');
$save = imagepng($IntialImg, $imageName, 9);

return array('img'=>$imageName);