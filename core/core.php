<?php
require("config.php");
require("facebook.php");
session_start();
$conn = new Mongo();
$db = $conn->soneta;
$personas = $db->personas;

$access_token = '129045643787467|b4d7087a02e8d99fda980f42-670893967|xpFUcWAPyHH15fSOcEdd_6eFzuw';

$facebook = new Facebook($client_id, $client_secret);

$facebook->setAccessToken($access_token);

$friends =  $facebook->call_api("/me/friends","get",$data);
$tag = $facebook->call_api("/me/tagged","get",$data);
$posts = $facebook->call_api("/me/posts","get",$data);
$likes = $facebook->call_api("/me/likes","get",$data);
$photos = $facebook->call_api("/me/photos","get",$data);
$groups = $facebook->call_api("/me/groups","get",$data);
$events = $facebook->call_api("/me/events","get",$data);
$checkins = $facebook->call_api("/me/checkins","get",$data);
$statuses = $facebook->call_api("/me/statuses","get",$data);
$user = $facebook->call_api("/me","get",$data);

echo date('l jS \of F Y h:i:s A');
echo "I attended ".count($user["education"])." educational institutes<br/>";
echo "I worked ".count($user["work"])." places<br/>";
echo "I have ".count($friends['data']). " Friends<br/>";
echo "I was tagged ".count($tag['data']). " times<br/>";
echo "I posted ".count($posts['data']). " posts<br/>";
echo "I have ".count($likes['data']). " Likes<br/>";
echo "I was tagged in photos ".count($photos['data']). "<br/>";
echo "I am a member of ".count($groups['data']). " groups<br/>";
echo "I am attending ".count($events['data']). " events<br/>";
echo "I checked in ".count($checkins['data']). " places<br/>";
echo "I have ".count($statuses['data']). " Statuses<br/>";
?>
