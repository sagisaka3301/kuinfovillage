// ヘッダームーブ
(function($) {
    var $nav = $('#navArea');
    var $btn = $('.toggle_btn');
    var $mask = $('#mask');
    var open = 'open'; // class
    // menu open close
    $btn.on( 'click', function() {
        if ( ! $nav.hasClass( open ) ) {
            $nav.addClass( open );
        } else {
            $nav.removeClass( open );
        }
    });
    // mask close
    $mask.on('click', function() {
       $nav.removeClass( open );
    });
} )(jQuery);



// ローディング
window.onload = function() {
    const spinner = document.getElementById('loading');
    spinner.classList.add('loaded');
}

/*
$(function() {
	var headerHeight = $('header').outerHeight(),
		startPos = 0;
        headerWidth = $('header').outerWidth();
    
	$(window).on('load scroll', function() {
		var scrollPos = $(this).scrollTop();
		if ( scrollPos > startPos && scrollPos > headerHeight ) {
			$('header, .toggle_btn').css('top', '-' + headerHeight + 'px');
		} else {
			$('header').css('top', '0');
			$('.toggle_btn').css('top', '33px');
		}
		startPos = scrollPos;

        if(headerWidth < 504) {
			$('.toggle_btn').css('top', '20px');
			$('header').css('top', '0px');
        }
	});
});*/


$(document).on('click', function(e) {
    if(!$(e.target).closest('.edit-btn').length && !$(e.target).closest('.edit-form').length) {
        $('.edit-form').fadeOut();
    } else if ($(e.target).closest('.edit-btn').length) {
        if($('.edit-form').is(':hidden')) {
            $('.edit-form').slideDown();
        } else {
            $('.edit-form').slideUp();
        }
    }
});


// 新規登録ボタン、またはログインボタンが押されたとき、周りを暗くする処理。
// else if はログインボックス以外かつ新規登録ボックス以外を押したら明るく戻す
$(document).on('click', function(e) {
    if($(e.target).closest('.edit-btn').length) {
        $('.filter').css('background-color','rgba(0,0,0,0.5)');
        $('header, .edit-btn, .edit-logout input, .user-area, .pro-img-front img').css('filter','brightness(10%)');
    } else if(!$(e.target).closest('.edit-form').length) {
        $('.filter').css('background-color','rgba(0,0,0,0.0)');
        $('header, .edit-btn, .edit-logout input, .user-area, .pro-img-front img').css('filter','brightness(100%)');
    }
})

console.log("apple")




$(function () {
    $('.back').on('click', () => {
        $('.edit-form').fadeOut();
        $('.filter').css('background-color','rgba(0,0,0,0.0)');
        $('header, .edit-btn, .edit-logout input, .user-area, .pro-img-front img').css('filter','brightness(100%)');
    });
});