<?php

session_start();

//入力画面からのアクセスでなければ戻す
if (!isset($_SESSION['form'])) {
    header('Location: contact.php');
} else {
    $post = $_SESSION['form'];
}

//送信ボタンが押されたとき、...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // メールを送信する。
    $to = 'kuinfo12345@gmail.com';
    $from = $post['email'];
    $subject = 'お問い合わせが届いています。';
    $body = <<<EOT
名前： {$post['name']}
メールアドレス：　{$post['email']}
内容：
{$post['content']}
EOT;
    mb_send_mail($to, $subject, $body, "From: {$from}");

    //セッションを消してお礼画面へ
    unset($_SESSION['form']);
    header('Location: complete.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>確認画面</h2>
    <form action="" method="post">
        <input type="hidden" name="name" value="<?php echo htmlspecialchars($post['name']); ?>">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($post['email']); ?>">
        <input type="hidden" name="content" value="<?php echo htmlspecialchars($post['content']); ?>">

        <dl>
        <dt>お名前</dt>
        <dd><?php echo htmlspecialchars($post['name']); ?> </dd>
        <dt>メールアドレス</dt>
        <dd><?php echo htmlspecialchars($post['email']); ?> </dd>
        <dt>お問い合わせ内容</dt>
        <dd><?php echo nl2br(htmlspecialchars($post['content'])); ?></dd>
        </dl>

        <input type="button" value="戻る" onClick="history.back()">
        <input type="submit" value="送信">
    </form>
</body>
</html>