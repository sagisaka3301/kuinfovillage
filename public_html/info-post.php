<?php
session_start();


require_once '../classes/dbc.php';
require_once '../classes/class-func.php';


$user_id = $_SESSION['user_id'];
$user = UserLogic::getUser($user_id);


$reviews = $_POST;

$review = new Info($reviews);

$review->reviewCreate($reviews);
// 投稿をしてくれたユーザーにフラグを立てる。
$review->postUserFlag($user_id);

header('Location: class-info.php');
?>

<a href="class-info.php">戻る</a>