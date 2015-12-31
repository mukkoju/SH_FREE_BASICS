<?php
$data = $_POST;
$id = $data['id'];
if(!isset($_POST) || empty($id)){
  return;
  exit();
}
//DB functionality
$db =  new PDO('mysql:host=localhost;dbname=saddahaq_facebook_apps', 'root', 'vivenfarms');
$tmp = $db->query("SELECT _ID_ FROM table_free_basics_saddahaq WHERE _ID_ = ".$db->quote($id));
$res = $tmp->fetch(PDO::FETCH_ASSOC); 
$time = time();
        
if(!$res){
 $tmp = $db->query("INSERT INTO table_free_basics_saddahaq VALUES (".$db->quote($id).", ".$db->quote($data['email']).", ".$db->quote($data['name']).", 'F_B', $time)");
}
        
$pfImg = file_get_contents('https://graph.facebook.com/'.$id.'/picture?width=480&height=480&redirect=false');
$pfImg = json_decode($pfImg, true);
$prfUrl = $pfImg["data"]["url"];

if($pfImg["data"]["width"] < 480){
  $prfWidth = 480;
  $prfHeight = 480;
}
else{
  $prfWidth = $pfImg["data"]["width"];
  $prfHeight = $pfImg["data"]["height"];
}

//genrating image
$IntialImg = imagecreatefrompng("screen1.png");
//$logoTxt = imagecreatefrompng("logo.png");
$profileImage = imagecreatefromjpeg($prfUrl);
$white = imagecolorallocate($IntialImg, 255, 255, 255);
$font = '/var/www/FREE_BASICS/maiandra.ttf';

//imagettftext($IntialImg, 30, 0, 140, 400, $white, $font, $data['name']);
//var_dump($pfImg);
//place profile image
//imagecopy($IntialImg, $profileImage, 0, 0, 0, 0, $prfWidth, $prfHeight);
//imagecopy($profileImage, $IntialImg, 0, 0, 0, 0, $prfWidth, $prfHeight);
imagecopyresized($profileImage, $IntialImg, 0, 0, 0, 0, $pfImg["data"]["width"], $pfImg["data"]["height"], $prfWidth, $prfHeight);
//imagecopymerge($IntialImg, $logoTxt, 0, 0, 0, 0, 217, 115, 90);


$imageName = 'images/'.$id.'_Pic.png';

//save image
header('Content-type: image/png');
$save = imagepng($profileImage, $imageName, 9);

return array('img'=>$imageName);