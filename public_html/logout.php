<?php
session_start();
require_once '../classes/UserLogic.php';

if (!$logout = filter_input(INPUT_POST, 'logout')) {
    exit('不正なリクエストです。');
}

//ログインしているか判定し、セッションが切れていたらログインしてくださいというメッセージを書く
$result = UserLogic::checkLogin();

/*if(!$result) {
    exit('セッションが切れましたので、ログインしなおしてください。');
}*/

UserLogic::logout();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="allround.css">
    <title>KU Info Village | ログアウト</title>
</head>
<body>
    <div class="logout">
        <h2>ログアウト完了</h2>
        
    </div>
    <div class="to-top">
        <a href="./index.php">トップ画面へ</a>
    </div>
    
</body>
</html>