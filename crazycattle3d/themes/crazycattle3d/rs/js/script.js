
// ============================ search ================================= 
$('.search-form__btn').on('click', function () {
    gameSearch()
})

$('.search-form__input').on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        gameSearch()
    }
})
// let oldValue = null;
function gameSearch() {
    // console.log("OLD "+oldValue);
    let keywords = $(".search-form__input").val();
    var rex_rule = /[ \-\.?:\\\/\_\'\*]+/g;
    var value1 = keywords.replace(rex_rule, " ").trim().toLowerCase();
    value1 = value1.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
    // console.log("value1 "+value1);
    var url = '/search/' + value1;
    console.log(value1);
    if (value1 && oldValue != value1) {
        oldValue = value1;
        window.location.href = url;
    }
}

// ============================ paging vs click pagination.php + show gif loading ================================= 
function paging(p) {
    $(".loading_mask").removeClass("hidden-load");
    if (!p) {
        p = 1;
    }
    let url = "/paging.ajax";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            p: p,
            keywords: keywords,
            field_order: field_order,
            order_type: order_type,
            category_id: category_id,
            is_hot: is_hot,
            is_new: is_new,
            tag_id: tag_id,
            limit: limit,
        },
        success: function (response) {
            $(".loading_mask").addClass("hidden-load");
            // $('html, body').animate({
            //     scrollTop: $(".scroll-top").offset().top
            // }, 1000);
            if (response) {
                $("#ajax-append").html(response);

                let t = [].slice.call(document.querySelectorAll("img.lazy-image"));
                if ("IntersectionObserver" in window) {
                    let e = new IntersectionObserver(function (t, n) {
                        t.forEach(function (t) {
                            if (t.isIntersecting) {
                                let n = t.target;
                                n.dataset.src && ((n.src = n.dataset.src), n.classList.remove("lazy-image"), e.unobserve(n));
                            }
                        });
                    });
                    t.forEach(function (t) {
                        e.observe(t);
                    });
                }
            }
        }
    })
}

$(document).ready(function () {
    addPlugin(); // ajax full_rate + comment
})

// ajax full_rate + comment
const regex = /\?clear=1/;
function addPlugin() {
    if (!id_game && !url_game) {
        return
    }
    let url = "/add-plugin.ajax";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            id_game: id_game,
            url_game: url_game,
        },
        success: function (response) {
            if (response) {
                let data = JSON.parse(response);
                $("#append-rate").html(data.rate);
                $("#append-comment").html(data.comment);
            }
        }
    })
}

// ===========================  Show more / Show less =======================================
$('.btn-showmore').click(function () {
    if ($('.desc-text').hasClass('desc-text-full')) {
        $('.desc-text').removeClass('desc-text-full');
        $('.btn-showmore').html("Show more »");
        $('html, body').animate({
            scrollTop: $('.area__column--content').offset().top
        }, 500);
    } else {
        $('.desc-text').addClass('desc-text-full');
        $('.btn-showmore').html("Show less «");
    }
})
