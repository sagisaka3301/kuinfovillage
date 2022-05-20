<?php
session_start();
require_once '../classes/UserLogic.php';

$err = [];

$token = filter_input(INPUT_POST, 'csrf_token');
//トークンがない場合、もしくは一致しない場合、処理を中止
if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
    exit('不正なリクエスト');
}

unset($_SESSION['csrf_token']);

// バリデーション
if(!$username = filter_input(INPUT_POST, 'username')) {
    $err[] = 'ユーザー名を記入してください。';
}
if(!$email = filter_input(INPUT_POST, 'email')) {
    $err[] = 'メールアドレスを記入してください。';
}

if(!strpos($email, KEY_WORD)) {
    $err[] = '神奈川大学の学生以外は登録しないでください。';
}

if(!preg_match(KEY_NUM, $email)) {
    $err[] = '神奈川大学の学生以外は登録しないでください。';
}


$password = filter_input(INPUT_POST, 'password');

// 正規表現
if(!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)) {
    $err[] = 'パスワードは英数字8文字以上100文字以下にしてください。'."\n".'また、パスワードに「.」や「‐」は使わないでください。';
}
$password_conf = filter_input(INPUT_POST, 'password_conf');
if($password !== $password_conf) {
    $err[] = '確認用パスワードと異なっています。';
}

if (count($err) === 0) {
    // ユーザーを登録する処理
    $hasCreated = UserLogic::createUser($_POST);

    if(!$hasCreated) {
        $err[] = '登録に失敗しました。';
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了画面</title>
</head>
<body>
<?php if (count($err) > 0) : ?>
    <?php foreach($err as $e) : ?>
        <p><?php echo $e ?></p>
    <?php endforeach ?>
<?php else : ?>
    <p>登録が完了しました。</p>
<?php endif ?>
<a href="index.php">戻る</a>
</body>
</html>