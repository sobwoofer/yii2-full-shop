$(document).ready(function () {
    //====================================
    //--------- Functions ----------------
    //====================================
    //  //= source/debounce.js
    //====================================
    //--------- Custom Scripts -----------
    //====================================
    //  // = source/map.js
    // Button Top
    // How use
    // Add <div id="toTop"></div>
    $(function () {
        var btnTop = $('#toTop'); // Button id
    
        $(window).scroll(function () {
            if ($(this).scrollTop() > 0 && !btnTop.hasClass('scrolling')) {
                btnTop.fadeIn();
            } else {
                btnTop.fadeOut();
            }
        });
    
        btnTop.click(function () {
            btnTop.fadeOut().addClass('scrolling');
            $('body,html').animate({
                scrollTop: 0
            }, 800, function () {
    
                btnTop.removeClass('scrolling');
            });
        });
    
        $('.smoothScroll').click(function (event) {
            var href = $(this).attr('href');
            var target = $(href);
            var top = target.offset().top;
    
            if (target.length) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: top - 190
                }, 500);
            }
        });
    });
    // End Button Top script
    //  //= source/modal.js
    //  //= source/responsive-iframe.js
    //  //= source/miss-click.js

    $('.product-line__item input[type="number"]').styler();
    $('.product_list_item input[type="number"]').styler();

    // var main_block_swiper = new Swiper('.main-block .swiper-container', {
    //     pagination: ' .main-block  .swiper-pagination',
    //     nextButton: '.main-block  .swiper-button-next',
    //     prevButton: '.main-block  .swiper-button-prev',
    //     paginationClickable: true
    // });
    // var product_line_swiper = new Swiper('.product-line-1 .swiper-container', {
    //     slidesPerView: 6,
    //     loop: true,
    //     nextButton: '.product-line-1 .swiper-button-next',
    //     prevButton: '.product-line-1 .swiper-button-prev',
    //     autoplay: 4000,
    //     // onlyExternal: true,
    //     paginationClickable: true,
    //     breakpoints: {
    //         480: {
    //             slidesPerView: 1,
    //             spaceBetween: 20
    //         },
    //         900: {
    //             slidesPerView: 2
    //         },
    //         1100: {
    //             slidesPerView: 3
    //         },
    //         1200: {
    //             slidesPerView: 4
    //         },
    //         1390: {
    //             slidesPerView: 5
    //         },
    //         1400: {
    //             slidersPreView: 6
    //         }
    //
    //         // 1920: {
    //         //     slidesPerView: 5
    //         // }
    //     },
    //     spaceBetween: 30
    // });
    
    // var product_line_swiper_1 = new Swiper('#tab-1 .swiper-container', {
    //     slidesPerView: 6,
    //     loop: true,
    //     autoplay: 4000,
    //     nextButton: '#tab-1 .swiper-button-next',
    //     prevButton: '#tab-1 .swiper-button-prev',
    //
    //     // onlyExternal: true,
    //     lazyLoading: true,
    //     paginationClickable: true,
    //     spaceBetween: 30,
    //     breakpoints: {
    //         480: {
    //             slidesPerView: 1,
    //             spaceBetween: 20
    //         },
    //         900: {
    //             slidesPerView: 2
    //         },
    //         1100: {
    //             slidesPerView: 3
    //         },
    //         1200: {
    //             slidesPerView: 4
    //         },
    //         1390: {
    //             slidesPerView: 5
    //         },
    //         1400: {
    //             slidersPreView: 6
    //         }
    //
    //         // 1920: {
    //         //     slidesPerView: 5
    //         // }
    //
    //     }
    // });
    
    // var product_line_swiper_2 = new Swiper('#tab-2 .swiper-container', {
    //     slidesPerView: 6,
    //     loop: true,
    //     autoplay: 4000,
    //     nextButton: '#tab-2 .swiper-button-next',
    //     prevButton: '#tab-2 .swiper-button-prev',
    //
    //     // onlyExternal: true,
    //     paginationClickable: true,
    //     lazyLoading: true,
    //     spaceBetween: 30,
    //     breakpoints: {
    //         480: {
    //             slidesPerView: 1,
    //             spaceBetween: 20
    //         },
    //         900: {
    //             slidesPerView: 2
    //         },
    //         1100: {
    //             slidesPerView: 3
    //         },
    //         1200: {
    //             slidesPerView: 4
    //         },
    //         1390: {
    //             slidesPerView: 5
    //         },
    //         1400: {
    //             slidersPreView: 6
    //         }
    //
    //         // 1920: {
    //         //     slidesPerView: 5
    //         // }
    //     }
    // });
    
    // var product_line_swiper_3 = new Swiper('#tab-3 .swiper-container', {
    //     slidesPerView: 6,
    //     loop: true,
    //     autoplay: 4000,
    //     lazyLoading: true,
    //     nextButton: '#tab-3 .swiper-button-next',
    //     prevButton: '#tab-3 .swiper-button-prev',
    //     // onlyExternal: true,
    //     paginationClickable: true,
    //     spaceBetween: 30,
    //     breakpoints: {
    //         480: {
    //             slidesPerView: 1,
    //             spaceBetween: 20
    //         },
    //         900: {
    //             slidesPerView: 2
    //         },
    //         1100: {
    //             slidesPerView: 3
    //         },
    //         1200: {
    //             slidesPerView: 4
    //         },
    //         1390: {
    //             slidesPerView: 5
    //         },
    //         1400: {
    //             slidersPreView: 6
    //         }
    //
    //         // 1920: {
    //         //     slidesPerView: 5
    //         // }
    //     }
    // });
    
    // var popular_line_swiper = new Swiper('.popular .swiper-container', {
    //     slidesPerView: 6,
    //     loop: true,
    //     autoplay: 4000,
    //     lazyLoading: true,
    //     nextButton: '.popular .swiper-button-next',
    //     prevButton: '.popular .swiper-button-prev',
    //     // onlyExternal: true,
    //     paginationClickable: true,
    //     spaceBetween: 30,
    //     breakpoints: {
    //         480: {
    //             slidesPerView: 1,
    //             spaceBetween: 20
    //         },
    //         900: {
    //             slidesPerView: 2
    //         },
    //         1100: {
    //             slidesPerView: 3
    //         },
    //         1200: {
    //             slidesPerView: 4
    //         },
    //         1390: {
    //             slidesPerView: 5
    //         },
    //         1400: {
    //             slidersPreView: 6
    //         }
    //
    //         // 1920: {
    //         //     slidesPerView: 5
    //         // }
    //     }
    // });
    // var news_line_swiper = new Swiper('.news .swiper-container', {
    //     slidesPerView: 6,
    //     loop: true,
    //     autoplay: 4000,
    //     lazyLoading: true,
    //     nextButton: '.news .swiper-button-next',
    //     prevButton: '.news .swiper-button-prev',
    //     // onlyExternal: true,
    //     paginationClickable: true,
    //     spaceBetween: 30,
    //     breakpoints: {
    //         480: {
    //             slidesPerView: 1,
    //             spaceBetween: 20
    //         },
    //         900: {
    //             slidesPerView: 2
    //         },
    //         1100: {
    //             slidesPerView: 3
    //         },
    //         1200: {
    //             slidesPerView: 4
    //         },
    //         1390: {
    //             slidesPerView: 5
    //         },
    //         1400: {
    //             slidersPreView: 6
    //         }
    //
    //         // 1920: {
    //         //     slidesPerView: 5
    //         // }
    //     }
    // });
    
    // var sale_line_swiper = new Swiper('.sale .swiper-container', {
    //     slidesPerView: 6,
    //     loop: true,
    //     autoplay: 4000,
    //     lazyLoading: true,
    //     nextButton: '.sale .swiper-button-next',
    //     prevButton: '.sale .swiper-button-prev',
    //     // onlyExternal: true,
    //     paginationClickable: true,
    //     spaceBetween: 30,
    //     breakpoints: {
    //         480: {
    //             slidesPerView: 1,
    //             spaceBetween: 20
    //         },
    //         900: {
    //             slidesPerView: 2
    //         },
    //         1100: {
    //             slidesPerView: 3
    //         },
    //         1200: {
    //             slidesPerView: 4
    //         },
    //         1390: {
    //             slidesPerView: 5
    //         },
    //         1400: {
    //             slidersPreView: 6
    //         }
    //
    //         // 1920: {
    //         //     slidesPerView: 5
    //         // }
    //     }
    // });
    
    var our_clients_swiper = new Swiper('.our_clients .swiper-container', {
        slidesPerView: 6,
        loop: true,
        autoplay: 4000,
        nextButton: '.our_clients .swiper-button-next',
        prevButton: '.our_clients .swiper-button-prev',
        // onlyExternal: true,
        paginationClickable: true,
        spaceBetween: 30,
        spaceBetween: 30,
        breakpoints: {
            480: {
                slidesPerView: 1,
                spaceBetween: 20
            },
            900: {
                slidesPerView: 2
            },
            1100: {
                slidesPerView: 3
            },
            1200: {
                slidesPerView: 4
            },
            1390: {
                slidesPerView: 5
            },
            1400: {
                slidersPreView: 6
            }
    
            // 1920: {
            //     slidesPerView: 5
            // }
        }
    });
    var our_brends_swiper = new Swiper('.our_brends .swiper-container', {
        slidesPerView: 5,
        loop: true,
        autoplay: 4000,
        nextButton: '.our_brends .swiper-button-next',
        prevButton: '.our_brends .swiper-button-prev',
        // onlyExternal: true,
        paginationClickable: true,
        spaceBetween: 30,
        spaceBetween: 30,
        breakpoints: {
            480: {
                slidesPerView: 1,
                spaceBetween: 20
            },
            900: {
                slidesPerView: 2
            },
            1100: {
                slidesPerView: 3
            },
            1200: {
                slidesPerView: 4
            },
            1390: {
                slidesPerView: 5
            },
            1600: {
                slidesPerView: 4
            }
    
            // 1920: {
            //     slidesPerView: 5
            // }
        }
    });
    
    <!-- Initialize Swiper -->
    var galleryTop = new Swiper('.slider_wrapper .gallery-top', {
        spaceBetween: 10,
    });
    var galleryThumbs = new Swiper('.slider_wrapper .gallery-thumbs', {
        spaceBetween: 10,
        centeredSlides: true,
        slidesPerView: 3,
        touchRatio: 0.2,
        nextButton: '.slider_wrapper .sp .swiper-button-next',
        prevButton: '.slider_wrapper .sp .swiper-button-prev',
        direction: 'vertical',
        slideToClickedSlide: true
    });
    galleryTop.params.control = galleryThumbs;
    galleryThumbs.params.control = galleryTop;
    // $(function() {
    
    $('header select').selectric();
    $('.select select').selectric();
    // });
    
    $(".lang label ").click(function(event) {
        
        if (!$(".lang input").is( ":checked" )) {
            console.log('ru')
            $('.lang .ua').removeClass('act')
            $('.lang .ru').addClass('act')
        } else {
            console.log('ua')
    		$('.lang .ru').removeClass('act')
    		$('.lang .ua').addClass('act')
        }
    
    });
    //====================================
    //--------- Setting libs -------------
    //====================================
    $('.catalog-btn').click(function (e) {
        $('.top-info .catalog').toggleClass('active')
    })
    //====================================
    //-------- Only this site ------------
    //====================================
});
$('.menu button').click(function (event) {
    $('.menu-inner').toggleClass('active');
});
$('.catalog button').click(function (event) {
    $('.catalog-inner').toggleClass('active');
});
// $('.star').raty({
//     start: 4
// });
$('[data-toggle="tooltip"]').tooltip();
// $("#slider-range").slider({
//     min: 0,
//     max: 1000,
//     values: [0, 1000],
//     range: true,
//     stop: function (event, ui) {
//         $("input#minCost").val($("#slider-range").slider("values", 0));
//         $("input#maxCost").val($("#slider-range").slider("values", 1));
//     },
//     slide: function (event, ui) {
//         $("input#minCost").val($("#slider-range").slider("values", 0));
//         $("input#maxCost").val($("#slider-range").slider("values", 1));
//     }
// });
$('.like').click(function (e) {
    e.preventDefault();
    $(this).toggleClass('active')
})
if ($('#clock').length) {
    $(window).on('load', function () {
        var labels = ['дни', 'часы', 'мин', 'сек'],
            nextYear = (new Date().getFullYear() + 1) + '/01/01',
            template = _.template($('#clock-template').html()),
            currDate = '00:00:00:00',
            nextDate = ':00:00:00:00',
            parser = /([0-9]{2})/gi,
            $example = $('#clock');

        // Parse countdown string to an object
        function strfobj(str) {
            var parsed = str.match(parser),
                obj = {};
            labels.forEach(function (label, i) {
                obj[label] = parsed[i]
            });
            return obj;
        }

        // Return the time components that diffs
        function diff(obj1, obj2) {
            var diff = [];
            labels.forEach(function (key) {
                if (obj1[key] !== obj2[key]) {
                    diff.push(key);
                }
            });
            return diff;
        }

        // Build the layout
        var initData = strfobj(currDate);
        labels.forEach(function (label, i) {
            $example.append(template({
                curr: initData[label],
                next: initData[label],
                label: label
            }));
        });
        // Starts the countdown
        $example.countdown(nextYear, function (event) {
            var newDate = event.strftime('%w:%d:%H:%S'),
                data;
            if (newDate !== nextDate) {
                currDate = nextDate;
                nextDate = newDate;
                // Setup the data
                data = {
                    'curr': strfobj(currDate),
                    'next': strfobj(nextDate)
                };
                // Apply the new values to each node that changed
                diff(data.curr, data.next).forEach(function (label) {
                    var selector = '.%s'.replace(/%s/, label),
                        $node = $example.find(selector);
                    // Update the node
                    $node.removeClass('flip');
                    $node.find('.curr').text(data.curr[label]);
                    $node.find('.next').text(data.next[label]);
                    // Wait for a repaint to then flip
                    _.delay(function ($node) {
                        $node.addClass('flip');
                    }, 50, $node);
                });
            }
        });
    });
}
//slick slider
// $('.slider-for').slick({
//     slidesToShow: 1,
//     slidesToScroll: 1,
//     arrows: true,
//     prevArrow: '<button type="button" class="custom-next"></button>',
//     nextArrow: '<button type="button" class="custom-prev"></button>',
//     fade: true,
//     asNavFor: '.slider-nav'
// });
// $('.slider-nav').slick({
//     slidesToShow: 3,
//     slidesToScroll: 1,
//     asNavFor: '.slider-for',
//     dots: true,
//     centerMode: true,
//     focusOnSelect: true
// });

// help page
$(document).ready(function () {
    $(".panel_custom").click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }
    });
});
// light box
// $('.slider-for').slickLightbox({
//     itemSelector: '.light',
//     navigateByKeyboard: true
// });

$('.product-line__item').hover(
    function () {
        let h = $(this).find('.hover-block').height() + 40;
        $('<div class="after-style"><style>.product-line__item:after{height: calc(100% + ' + h + 'px )!important;}</style></div>').appendTo('body');
    },
    function () {
        $(".after-style").remove()
    }
);
$('.btn.btn-to-cart').click(function () {
    let div = document.createElement('div')
    div.classList.add('add-to-cart-info')
    div.innerHTML = "<p>товар добавлен <br> в корзину</p>";
    $(this).append(div)
    setTimeout(function () {
        $('.add-to-cart-info').remove()
    }, 2000)
})

$('.product-line__item__action-block .like').click(function () {
    let div = document.createElement('div')
    div.classList.add('add-to-cart-info')
    div.innerHTML = "<p>товар добавлен <br> в избранное</p>";
    $(this).append(div)
    setTimeout(function () {
        $('.add-to-cart-info').remove()
    }, 2000)
})


$(".seo-text-block").click(function () {
    $(" .seo-text-block .max-seo-text").slideToggle("show");
});
// $("#feedback").validate({
//     rules: {
//         firstname: {
//             required: true,
//             minlength: 2
//         },
//         msg: {
//             required: true,
//             minlength: 2
//         },
//         phone: {
//             required: true,
//             number: true,
//             minlength: 10,
//             maxlength: 10
//         },
//         email: {
//             required: true,
//             email: true
//         }
//     },
//     messages: {
//         firstname: "Введите имя",
//         msg: "Введите текст",
//         email: "Введите корректный email",
//         phone: "Введите корректный номер телефона",
//     }
// });
!function (e) {
    var t = function (t, n) {
        this.$element = e(t), this.type = this.$element.data("uploadtype") || (this.$element.find(".thumbnail").length > 0 ? "image" : "file"), this.$input = this.$element.find(":file");
        if (this.$input.length === 0) return;
        this.name = this.$input.attr("name") || n.name, this.$hidden = this.$element.find('input[type=hidden][name="' + this.name + '"]'), this.$hidden.length === 0 && (this.$hidden = e('<input type="hidden" />'), this.$element.prepend(this.$hidden)), this.$preview = this.$element.find(".fileupload-preview");
        var r = this.$preview.css("height");
        this.$preview.css("display") != "inline" && r != "0px" && r != "none" && this.$preview.css("line-height", r), this.original = {
            exists: this.$element.hasClass("fileupload-exists"),
            preview: this.$preview.html(),
            hiddenVal: this.$hidden.val()
        }, this.$remove = this.$element.find('[data-dismiss="fileupload"]'), this.$element.find('[data-trigger="fileupload"]').on("click.fileupload", e.proxy(this.trigger, this)), this.listen()
    };
    t.prototype = {
        listen: function () {
            this.$input.on("change.fileupload", e.proxy(this.change, this)), e(this.$input[0].form).on("reset.fileupload", e.proxy(this.reset, this)), this.$remove && this.$remove.on("click.fileupload", e.proxy(this.clear, this))
        }, change: function (e, t) {
            if (t === "clear") return;
            var n = e.target.files !== undefined ? e.target.files[0] : e.target.value ? {name: e.target.value.replace(/^.+\\/, "")} : null;
            if (!n) {
                this.clear();
                return
            }
            this.$hidden.val(""), this.$hidden.attr("name", ""), this.$input.attr("name", this.name);
            if (this.type === "image" && this.$preview.length > 0 && (typeof n.type != "undefined" ? n.type.match("image.*") : n.name.match(/\.(gif|png|jpe?g)$/i)) && typeof FileReader != "undefined") {
                var r = new FileReader, i = this.$preview, s = this.$element;
                r.onload = function (e) {
                    i.html('<img src="' + e.target.result + '" ' + (i.css("max-height") != "none" ? 'style="max-height: ' + i.css("max-height") + ';"' : "") + " />"), s.addClass("fileupload-exists").removeClass("fileupload-new")
                }, r.readAsDataURL(n)
            } else this.$preview.text(n.name), this.$element.addClass("fileupload-exists").removeClass("fileupload-new")
        }, clear: function (e) {
            this.$hidden.val(""), this.$hidden.attr("name", this.name), this.$input.attr("name", "");
            if (navigator.userAgent.match(/msie/i)) {
                var t = this.$input.clone(!0);
                this.$input.after(t), this.$input.remove(), this.$input = t
            } else this.$input.val("");
            this.$preview.html(""), this.$element.addClass("fileupload-new").removeClass("fileupload-exists"), e && (this.$input.trigger("change", ["clear"]), e.preventDefault())
        }, reset: function (e) {
            this.clear(), this.$hidden.val(this.original.hiddenVal), this.$preview.html(this.original.preview), this.original.exists ? this.$element.addClass("fileupload-exists").removeClass("fileupload-new") : this.$element.addClass("fileupload-new").removeClass("fileupload-exists")
        }, trigger: function (e) {
            this.$input.trigger("click"), e.preventDefault()
        }
    }, e.fn.fileupload = function (n) {
        return this.each(function () {
            var r = e(this), i = r.data("fileupload");
            i || r.data("fileupload", i = new t(this, n)), typeof n == "string" && i[n]()
        })
    }, e.fn.fileupload.Constructor = t, e(document).on("click.fileupload.data-api", '[data-provides="fileupload"]', function (t) {
        var n = e(this);
        if (n.data("fileupload")) return;
        n.fileupload(n.data());
        var r = e(t.target).closest('[data-dismiss="fileupload"],[data-trigger="fileupload"]');
        r.length > 0 && (r.trigger("click.fileupload"), t.preventDefault())
    })
}(window.jQuery)

// help page
$(document).ready(function () {
    $(".panel_custom__title").click(function () {
        if ($(this).parent().parent().hasClass('active')) {
            $(this).parent().parent().removeClass('active');
        } else {
            $(this).parent().parent().addClass('active');
        }
    });

    $('.plus').click(function () {
        let p = $(this).closest('.product-line__item').find('.prace_new');
        let price = $(p[0]).attr('data-price');

        let now = p[0].innerText.replace(' ','');
        now = now.replace('грн','')
        p[0].innerHTML = (+now + +price).toFixed(2) +"грн"

    })
    $('.minus').click(function () {
        let p = $(this).closest('.product-line__item').find('.prace_new');
        let price = $(p[0]).attr('data-price');
        let now = p[0].innerText.replace(' ','');
        now = now.replace('грн','')

        if(+now > +price){

        p[0].innerHTML = (+now - +price).toFixed(2) +"грн"
}

    })
});


$('#accordion .panel-heading').click(function (e) {
    console.log(e)
    // $('#accordion .panel-heading').removeClass('active');
    $(this).toggleClass('active');
});

$('.filter_cat_wrp .toggle-btn').click(function (e) {
    $($(this).parent().parent('.filter_cat_wrp')).toggleClass('active')
});

$('.header_cart_wrp').click(function (e) {
    $(this).toggleClass('active')
    $('.cart__inside').toggleClass('active')
});


// live comment
$(document).ready(function () {
    $("#btn__review_block").click(function () {
        $('.review_wrapper').fadeOut()
        $(this).fadeOut()
        $('.live_review').fadeIn()
    });
    $(".close-live_review").click(function () {
        $('.live_review').fadeOut()
        $('#btn__review_block').fadeIn()
        $('.review_wrapper').fadeIn()
    });
});