console.log("OK");

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
});

//スライドショー
$('.carousel').carousel({
    interval: 5000, //秒数
    //pause: "hover", //hoverでスライダーが止まる
    wrap: true,     //カルーセルを循環させる(false : させない)
    keybord: true   //キーボードイベントに反応する(false : させない)
});

