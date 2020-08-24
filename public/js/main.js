const url = "http://proyecto-laravel.com.devel";

$(".btn-like").css("cursor", "pointer");
$(".btn-dislike").css("cursor", "pointer");

like();
dislike();

function like() {
    $(".btn-like").unbind("click").click(function(e) {
        e.preventDefault();

        $(this).addClass("btn-dislike").removeClass("btn-like");
        $(this).attr("src", url+"/img/heart-red.png");

        $.ajax({
            url: url + "/like/" + $(this).data("id"),
            type: "GET",
        });

        dislike();
    });
}

function dislike() {
    $(".btn-dislike").unbind("click").click(function(e) {
        e.preventDefault();

        $(this).addClass("btn-like").removeClass("btn-dislike");
        $(this).attr("src", url+"/img/heart-black.png");

        $.ajax({
            url: url + "/dislike/" + $(this).data("id"),
            type: "GET",
        });

        like();
    });
}

