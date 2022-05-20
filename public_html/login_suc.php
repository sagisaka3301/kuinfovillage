<!-- ログイン判断：成功→ログイン処理実行　失敗→ログイン画面に返す -->
<?php

session_start();
require_once '../classes/UserLogic.php';

$err = [];

// バリデーション
// requiredを指定してあるが、破られたときの対処。
// emailまたはpasswordの入力がなかったらログイン画面に戻す。
if(!$email= filter_input(INPUT_POST, 'email')) {
    $err['email'] = '';
}

if(!$password= filter_input(INPUT_POST, 'password')) {
    $err['password'] = '';
}

if (count($err) > 0) {
    // エラーがあった場合画面を戻す
    $_SESSION = $err;
    header('Location: index.php');
    return;
}

//ログイン処理
$result = UserLogic::login($email, $password);

// ログイン失敗時の処理
if (!$result) {
    header('Location: err.php');
    session_destroy();
    return;
}

?>