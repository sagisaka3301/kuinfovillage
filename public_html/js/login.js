window.onload = function() {
    const spinner = document.getElementById('loading');
    spinner.classList.add('loaded');
}


// 最初のifはn-userの要素とnew-user-boxの要素以外の部分をクリックしたら消えるようにするという処理
// else if のifはボックスが隠れていた時、n-userのボタンをクリックしたらスライドダウンでボックスが現れるようにする処理
// else if のelseはそれ以外ならスライドアップで引き上げる処理。

$(document).on('click', function(e) {
    if(!$(e.target).closest('.n-user').length && !$(e.target).closest('.new-user-box').length) {
        $('.new-user-box').fadeOut();
    } else if ($(e.target).closest('.n-user').length) {
        if($('.new-user-box').is(':hidden')) {
            $('.new-user-box').slideDown();
        } else {
            $('.new-user-box').slideUp();
        }
    }
});

// 上の処理は、新規登録。この処理はログイン。やってることは一緒
$(document).on('click', function(e) {
    if(!$(e.target).closest('.login').length && !$(e.target).closest('.login-box').length) {
        $('.login-box').fadeOut();
    } else if ($(e.target).closest('.login').length) {
        if($('.login-box').is(':hidden')) {
            $('.login-box').slideDown();
        } else {
            $('.login-box').slideUp();
        }
    }
});

// 新規登録ボタン、またはログインボタンが押されたとき、周りを暗くする処理。
// else if はログインボックス以外かつ新規登録ボックス以外を押したら明るく戻す
$(document).on('click', function(e) {
    if($(e.target).closest('.login').length || $(e.target).closest('.n-user').length) {
        $('main').css('background-color','rgba(0,0,0,0.5)');
        $('.title, .btns').css('filter','brightness(50%)');
    } else if(!$(e.target).closest('.new-user-box').length && !$(e.target).closest('.login-box').length) {
        $('main').css('background-color','rgba(0,0,0,0.0)');
        $('.title, .btns').css('filter','brightness(100%)');
    }
});



$(function () {
    $('.batsu').on('click', () => {
        $('.new-user-box').fadeOut();
        $('main').css('background-color','rgba(0,0,0,0.0)');
        $('.title, .btns').css('filter','brightness(100%)');
    });
    $('.batsu-b').on('click', () => {
        $('.login-box').fadeOut();
        $('main').css('background-color','rgba(0,0,0,0.0)');
        $('.title, .btns').css('filter','brightness(100%)');
    });
});

console.log('appple')