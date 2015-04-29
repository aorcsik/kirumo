;;(function($) { $(function() {

function adjustHeader() {
    if ($(window).scrollTop() > 70) {
        $("#page-wrap").addClass("fixed");
    } else {
        $("#page-wrap.fixed").removeClass("fixed");
        $(".header-wrap").height(135 - $(window).scrollTop() * 0.5);
    }
}

$(window).scroll(adjustHeader);
$(window).resize(adjustHeader);
adjustHeader();

$(".comment-list li").each(function() {
    if ($(this).is(".webmention") || $(this).is(".pingback")) {
        if ($(this).text().match(/mentioned this .*? on/) ||
            $(this).text().match(/This .*? was mentioned on/)) {
            $(this).addClass("action-mention");
        } else if ($(this).text().match(/liked this .*? on/)) {
            $(this).addClass("action-like");
        }
    }
});
$(".comment-list .comment-body").each(function() {
    var avatar_url = $(".avatar", this).attr("src");
    $(".avatar", this).replaceWith('<div class="avatar" style="background-image: url(' + "'" + avatar_url + "'" +');"></div>');
});

if ($("article.post").size() == 1 && $("article.post img.page-background").size() > 0) {
    $("article.post img.page-background").eq(0).each(function() {
        $("body").css("background-image", "url('" + $(this).attr("src") + "')");
    });
} else {
    $("body").css("background-image", 'url("http://include.aorcsik.com/wp-content/uploads/2014/11/minimalistic_digital_geometry_colors_3000x2100_55492.jpg")');
}
$("#page-wrap").addClass("show-bg");


}); })(jQuery);