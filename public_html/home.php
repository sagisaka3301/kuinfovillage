<!-- トップページ -->
<?php
session_start();
// セッションの確認
if (!isset($_SESSION['login_user'])) {
    header('Location: index.php');
}
// headの読み込み
$title = 'KU Info Village';
$discription = '神奈川大学学生専用の授業情報掲示板です。履修の際に参考にしてください。';
include 'head.php';

?>
<link rel="stylesheet" href="./css/home.css">
<link rel="stylesheet" href="./css/home-res.css">
<div class="filter">
<body>
    <?php include 'header.php'; ?>
    <main>
        <!-- ローディング -->
        <div id="loading">
            <div class="spinner"></div>
        </div>
        <!-- レスポンシブ(スマホ版)のファーストビュー -->
        <div class="res-first"></div>
        <!-- PC版ファーストビュー(スライドショー) -->
        <div class="main-slider">
            <div class="worksslider inside">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="3000">
                    <!-- Indicators 真ん中下の丸い点-->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                    </ol>
                    <!-- 画像のエリア -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active item1">
                            <div class="carousel-caption">
                            </div>
                        </div>
                        <div class="item item2">
                            <div class="carousel-caption">
                            <!-- キャプション -->
                            </div>
                        </div>
                        <div class="item item3">
                            <div class="carousel-caption">
                            <!-- キャプション -->
                            </div>
                        </div>
                        <div class="item item4">
                            <div class="carousel-caption">
                            <!-- キャプション -->
                            </div>
                        </div>
                    </div>
                    <!-- Controls 左右のアイコン矢印-->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- ロゴと簡単な説明コンテナ -->
        <div class="about-box">
            <div class="about-inner">
                <div class="about-logo">
                    <div class="logo-mix-area">
                        <span class="k">K</p>
                        <span class="u">U</p>
                    </div>
                </div>
                <div class="about-text">
                    <div class="about-text-area">
                        <h3>KU INFO VILLAGE</h3>
                        <p>神奈川大学の学生専用の授業情報掲示板になります。履修の参考に利用していただければと思います。不具合、デザインのアドバイス等があれば、SNSのDMやお問い合わせページよりご意見をいただければ嬉しいです。</p>
                    </div>    
                </div>
            </div>
        </div>
        <!-- サービス紹介コンテナ -->
        <div class="ser-top">
            <p class="ser-title">Service</p>
            <div class="ser-about">
                <div class="abo-inner">
                    <h2>―</h2>
                    <h3>About</h3>
                    <p class="abo-a">CLASSESページで授業情報の投稿・閲覧、MYPAGEでプロフィールの編集が可能です。適当にご利用ください。質問や投稿削除依頼は、お問い合わせページをご利用ください。</p>
                    <p class="abo-b">PHPというプログラミング言語を利用して制作しました。質問や投稿削除依頼は、お問い合わせページをご利用ください。</p>
                </div> 
            </div>
        </div>
        <div class="ser-dis" style="background-image: url('./img/fancy.jpg');">
            <div class="dis-area">
                <h2>―</h2>
                <h3>About Coding</h3>
                <p class="dis-p">このサイトは、主にPHPというプログラミング言語を使用して制作しました。当掲示板のようなWebアプリケーションだけではなく、ホームページの制作も可能なので、興味がある方は、お問い合わせよりご依頼ください。また、Pythonによる定型業務の自動化もある程度可能ですので、そのようなご依頼も相談を受け付けてます。</p>
                <p class="dis-p-b">このサイトは、主にPHPというプログラミング言語を使用して制作しました。当掲示板のようなWebアプリケーションだけではなく、ホームページの制作も可能なので、興味がある方は、お問い合わせよりご依頼ください。また、Pythonによる定型業務の自動化もある程度可能ですので、そのようなご依頼も相談を受け付けてます。</p>
            </div>
        </div>
        <!-- 注意事項等エリア -->
        <div class="information">
            <div class="info-title">
                <p>注意事項</p>
                <h2>Precautions</h2>
            </div>
            <div class="info-inner">
                <div class="i-block info-a">
                    <h3>表　現</h3>
                    <div class="i-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <p>授業評価(特に低めの)を投稿される際、ある程度は自由ですが、度が過ぎたな暴言は禁止とさせていただきます。大学の授業は質の良いものばかりだと思うので、大丈夫だとは思いますが、万が一低い評価の授業がある場合は注意の方よろしくお願いします。</p>
                </div>
                <div class="i-block info-b">
                    <h3>機　密</h3>
                    <div class="i-icon">
                        <i class="fas fa-user-secret"></i>
                    </div>
                    <p>神大専用のサイトになるので、管理人の許可なく外部SNS等に評価内容のスクショを載せることはお控えください。教員さんとのトラブル等は、一切責任を負いません。低い評価でも、正当な評価なら苦情はないはずなので、嘘だけはつかないよう気をつけてください。</p>
                </div>
                <div class="i-block info-c">
                    <h3>情　報</h3>
                    <div class="i-icon">
                        <i class="fas fa-user-lock"></i>
                    </div>
                    <p>個人情報の公開は十分に注意してください。一度JINDAIメールで登録すれば、後から普段あまり使わないようなメールアドレスに変更可能なので、必要に応じて変更してください。変更後はそちらのアドレスでログインが可能です。</p>
                </div>
            </div>
        </div>
        <!-- 問い合わせへのリンクエリア -->
        <div class="con-area">
            <div class="con-title">
                <p class="con-t-text">お問い合わせ</p>
                <h2>Contact</h2>
                <p>ご利用いただきありがとうございます。質問等がありましたら、こちらのリンクからお問い合わせページに飛んでいただくか、さらに下の開発者のSNSのURLより、ご連絡いただければと思います。</p>
            </div>
            <div class="con-link">
                <a href="./contact.php">お問い合わせ</a>
            </div>
            <div class="con-twi-link">
                <div class="twi-title">
                    <p >以下、開発者のTwitterアカウントになります。こちらからでも連絡可能です。</p>
                    <a class="account" href="" target="blank">Twitterアカウント</a>
                </div>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script src="./js/home.js"></script>