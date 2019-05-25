(function (e) {
    "use strict";
    var n = window.MINIMAL_JS || {};
    var iScrollPos = 0;
    var ebody = e('body');

    /*Used for ajax loading posts*/
    var loadType, loadButton, loader, pageNo, loading, morePost, scrollHandling;
    /**/
    n.mobileMenu = {
        init: function () {
            this.toggleMenu(), this.menuArrow()
        },

        toggleMenu: function () {
            e('.nav-toogle').on('click', function (event) {
                e('body').toggleClass('extended-menu');
            });

            e('.main-navigation').on('click', 'ul.menu a i', function (event) {
                event.preventDefault();
                var ethis = e(this),
                    eparent = ethis.closest('li'),
                    esub_menu = eparent.find('> .sub-menu');
                if (esub_menu.css('display') == 'none') {
                    esub_menu.slideDown('300');
                    ethis.addClass('active');
                } else {
                    esub_menu.slideUp('300');
                    ethis.removeClass('active');
                }
                return false;
            });
        },

        menuArrow: function () {
            if (e('.main-navigation ul.menu').length) {
                e('.main-navigation ul.menu .sub-menu').parent('li').find('> a').append('<i class="icon-nav-down">');
            }
        }
    },

        n.ThemematticPreloader = function () {
            e(window).load(function () {
                e("body").addClass("page-loaded");
            });
        },

        n.ThemematticSlider = function () {
            e('.main-slider').slick({
                slidesToShow: 1,
                fade: true,
                dots: true,
                prevArrow: e('.slide-prev-1'),
                nextArrow: e('.slide-next-1'),
                infinite: true,
                arrows: true,
                customPaging: function (slider, i) {
                    if (i < 9) {
                        var thumb = $(slider.$slides[i]).data();
                        return '<span>' + '0' + (i + 1) + '</span>';
                    } else {
                        var thumb = $(slider.$slides[i]).data();
                        return '<span>' + (i + 1) + '</span>';
                    }
                }
            });

            e('.main-carousel').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: false,
                arrows: true,
                infinite: true,
                prevArrow: e('.slide-prev-2'),
                nextArrow: e('.slide-next-2'),
                focusOnSelect: true,
                responsive: [
                    {
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 580,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });

            e('.recommended-slider').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: false,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 8000,
                nextArrow: '<i class="navcontrol-icon slide-next ion-ios-arrow-right"></i>',
                prevArrow: '<i class="navcontrol-icon slide-prev ion-ios-arrow-left"></i>',
                focusOnSelect: true,
                responsive: [
                    {
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 2,
                            arrows: true
                        }
                    },
                    {
                        breakpoint: 580,
                        settings: {
                            slidesToShow: 1,
                            arrows: true
                        }
                    }
                ]
            });

            /*Single Column Gallery*/
            n.SingleColGallery('gallery-columns-1');
            n.SingleGutenGallery('columns-1');
            /**/

        },

        n.SingleColGallery = function (gal_selector) {
            if (e.isArray(gal_selector)) {
                e.each(gal_selector, function (index, value) {
                    e("#" + value).find('.gallery-columns-1').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false,
                        infinite: false,
                        nextArrow: '<i class="navcontrol-icon slide-next ion-ios-arrow-right"></i>',
                        prevArrow: '<i class="navcontrol-icon slide-prev ion-ios-arrow-left"></i>'
                    });
                });
            } else {
                e("." + gal_selector).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                    infinite: false,
                    nextArrow: '<i class="navcontrol-icon slide-next ion-ios-arrow-right"></i>',
                    prevArrow: '<i class="navcontrol-icon slide-prev ion-ios-arrow-left"></i>'
                });
            }
        },

        n.SingleGutenGallery = function (gal_selector) {
            if (e.isArray(gal_selector)) {
                e.each(gal_selector, function (index, value) {
                    e("#" + value).find('.columns-1').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false,
                        infinite: false,
                        nextArrow: '<i class="navcontrol-icon slide-next ion-ios-arrow-right"></i>',
                        prevArrow: '<i class="navcontrol-icon slide-prev ion-ios-arrow-left"></i>'
                    });
                });
            } else {
                e("." + gal_selector).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                    infinite: false,
                    nextArrow: '<i class="navcontrol-icon slide-next ion-ios-arrow-right"></i>',
                    prevArrow: '<i class="navcontrol-icon slide-prev ion-ios-arrow-left"></i>'
                });
            }
        },

        n.MagnificPopup = function () {
            e('.zoom-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                closeOnContentClick: false,
                closeBtnInside: false,
                mainClass: 'mfp-with-zoom mfp-img-mobile',
                image: {
                    verticalFit: true,
                    titleSrc: function (item) {
                        return item.el.attr('title');
                    }
                },
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300,
                    opener: function (element) {
                        return element.find('img');
                    }
                }
            });

            e('.widget .gallery').each(function () {
                e(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function (element) {
                            return element.find('img');
                        }
                    }
                });
            });

            n.GalleryPopup();

        },


        n.GalleryPopup = function () {
            e('.entry-content .gallery, .entry-content .wp-block-gallery').each(function () {
                e(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function (element) {
                            return element.find('img');
                        }
                    }
                });
            });
        },
        n.NiceScroll = function () {
            const container = document.querySelector('#site-navigation');
            const ps = new PerfectScrollbar('#site-navigation', {
                wheelSpeed: 2,
                wheelPropagation: true,
                minScrollbarLength: 50,
                maxScrollbarLength: 150
            });
        },

        n.DataBackground = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {

                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });

            e('.bg-image').each(function () {
                var src = e(this).children('img').attr('src');
                e(this).css('background-image', 'url(' + src + ')').children('img').hide();
            });
        },

        n.show_hide_scroll_top = function () {
            if (e(window).scrollTop() > e(window).height() / 2) {
                e("#scroll-up").fadeIn(300);
            } else {
                e("#scroll-up").fadeOut(300);
            }
        },

        n.scroll_up = function () {
            e("#scroll-up").on("click", function () {
                e("html, body").animate({
                    scrollTop: 0
                }, 800);
                return false;
            });

        },

        n.toogle_minicart = function () {
            if (e("body").hasClass("rtl")) {
                e('.minicart-title-handle').sidr({
                    side: 'right',
                    displace: false,
                });
            } else {
                e('.minicart-title-handle').sidr({
                    side: 'left',
                    displace: false,
                });
            }

            e('.sidr-class-sidr-button-close').click(function () {
                e.sidr('close', 'sidr');
            });
        },

        n.ms_masonry = function () {
            if (e('.masonry-blocks').length > 0) {

                /*Default masonry animation*/
                var hidden = 'scale(0.5)';
                var visible = 'scale(1)';
                /**/

                /*Get masonry animation*/
                if (minimalBlocksVal.masonry_animation === 'none') {
                    hidden = 'translateY(0)';
                    visible = 'translateY(0)';
                }

                if (minimalBlocksVal.masonry_animation === 'slide-up') {
                    hidden = 'translateY(50px)';
                    visible = 'translateY(0)';
                }

                if (minimalBlocksVal.masonry_animation === 'slide-down') {
                    hidden = 'translateY(-50px)';
                    visible = 'translateY(0)';
                }

                if (minimalBlocksVal.masonry_animation === 'zoom-out') {
                    hidden = 'translateY(-20px) scale(1.25)';
                    visible = 'translateY(0) scale(1)';
                }
                /**/

                var $blocks = e('.masonry-blocks').imagesLoaded(function () {
                    //e('.masonry-blocks article').fadeIn();
                    $blocks.masonry({
                        itemSelector: 'article',
                        hiddenStyle: {
                            transform: hidden,
                            opacity: 0
                        },
                        visibleStyle: {
                            transform: visible,
                            opacity: 1
                        }
                    });
                });
            }
        },

        n.thememattic_matchheight = function () {
            jQuery('.widget-area').theiaStickySidebar({
                additionalMarginTop: 30
            });

            e(function() {
                e('.woocommerce ul.products li .wrapper').matchHeight({ property: 'min-height' });
            });
        },

        n.tmsticky_sidebar = function () {
            jQuery('.widget-area').theiaStickySidebar({
                additionalMarginTop: 30
            });
        },

        n.setLoadPostDefaults = function () {
            if (e('.load-more-posts').length > 0) {
                loadButton = e('.load-more-posts');
                loader = e('.load-more-posts .ajax-loader');
                loadType = loadButton.attr('data-load-type');
                pageNo = 2;
                loading = false;
                morePost = true;
                scrollHandling = {
                    allow: true,
                    reallow: function () {
                        scrollHandling.allow = true;
                    },
                    delay: 400
                };
            }
        },

        n.fetchPostsOnScroll = function () {
            if (e('.load-more-posts').length > 0 && 'scroll' === loadType) {
                var iCurScrollPos = e(window).scrollTop();
                if (iCurScrollPos > iScrollPos) {
                    if (!loading && scrollHandling.allow && morePost) {
                        scrollHandling.allow = false;
                        setTimeout(scrollHandling.reallow, scrollHandling.delay);
                        var offset = e(loadButton).offset().top - e(window).scrollTop();
                        if (2000 > offset) {
                            loading = true;
                            n.ShowPostsAjax();
                        }
                    }
                }
                iScrollPos = iCurScrollPos;
            }
        },

        n.fetchPostsOnClick = function () {
            if (e('.load-more-posts').length > 0 && 'click' === loadType) {
                e('.load-more-posts a').on('click', function (event) {
                    event.preventDefault();
                    n.ShowPostsAjax();
                });
            }
        },
        n.masonryOnClickUpdate = function () {
            setTimeout(function () {
                $('.masonry-blocks').masonry();
            }, 150);
        }

    n.onClickSlideUpdate = function () {
        setTimeout(function () {
            $('.widget-area').theiaStickySidebar('resize');
            $('.main-slider').slick('refresh');
            $('.main-carousel').slick('refresh');
            $('.insta-slider').slick('refresh');
            $('.recommended-slider').slick('refresh');
            $('.gallery-columns-1').slick('refresh');
            $('.columns-1').slick('refresh');
        }, 120);
    }

    n.fetchPostsOnMenuClick = function () {
        e('.trigger-icon-wraper').on('click', function (event) {
            event.preventDefault();
            var $blocks = e('.masonry-blocks');
            n.masonryOnClickUpdate();
            n.onClickSlideUpdate();
        });
    },

        n.ShowPostsAjax = function () {
            e.ajax({
                type: 'GET',
                url: minimalBlocksVal.ajaxurl,
                data: {
                    action: 'minimal_blocks_load_more',
                    nonce: minimalBlocksVal.nonce,
                    page: pageNo,
                    post_type: minimalBlocksVal.post_type,
                    search: minimalBlocksVal.search,
                    cat: minimalBlocksVal.cat,
                    taxonomy: minimalBlocksVal.taxonomy,
                    author: minimalBlocksVal.author,
                    year: minimalBlocksVal.year,
                    month: minimalBlocksVal.month,
                    day: minimalBlocksVal.day
                },
                dataType: 'json',
                beforeSend: function () {
                    loader.addClass('ajax-loader-enabled');
                },
                success: function (response) {
                    if (response.success) {

                        var gallery = false;
                        var gal_selectors_1 = [];
                        var gal_selectors_2 = [];
                        var $content_join = response.data.content.join('');

                        if ($content_join.indexOf("gallery-columns-1") >= 0) {
                            gallery = true;
                            /*Push the post ids having galleries so that new gallery instance can be created*/
                            e($content_join).find('.entry-gallery').each(function () {
                                gal_selectors_1.push(e(this).closest('article').attr('id'));
                            });
                        }

                        if ($content_join.indexOf("columns-1") >= 0) {
                            gallery = true;
                            /*Push the post ids having galleries so that new gallery instance can be created*/
                            e($content_join).find('.entry-gallery').each(function () {
                                gal_selectors_2.push(e(this).closest('article').attr('id'));
                            });
                        }

                        if (e('.masonry-blocks').length > 0) {
                            var $content = e($content_join);
                            $content.hide();
                            var $blocks = e('.masonry-blocks');
                            $blocks.append($content);
                            $blocks.imagesLoaded(function () {

                                $content.show();

                                /*Init new Gallery*/
                                if (true === gallery) {
                                    n.SingleColGallery(gal_selectors_1);
                                    n.SingleGutenGallery(gal_selectors_2);
                                }
                                /**/

                                if (minimalBlocksVal.relayout_masonry) {
                                    $blocks.masonry('appended', $content).masonry();
                                } else {
                                    $blocks.masonry('appended', $content);
                                }

                                loader.removeClass('ajax-loader-enabled');
                            });
                        }

                        pageNo++;
                        loading = false;
                        if (!response.data.more_post) {
                            morePost = false;
                            loadButton.fadeOut();
                        }

                        /*For audio and video to work properly after ajax load*/
                        e('video, audio').mediaelementplayer({alwaysShowControls: true});
                        /**/

                        /*For Gallery to work*/
                        n.GalleryPopup();
                        /**/

                        loader.removeClass('ajax-loader-enabled');


                    } else {
                        loadButton.fadeOut();
                    }
                }
            });
        },

        e(document).ready(function () {
            n.mobileMenu.init(), n.ThemematticPreloader(), n.ThemematticSlider(), n.MagnificPopup(), n.NiceScroll(), n.DataBackground(), n.scroll_up(), n.thememattic_matchheight(), n.tmsticky_sidebar(), n.toogle_minicart(), n.ms_masonry(), n.setLoadPostDefaults(), n.fetchPostsOnClick(), n.fetchPostsOnMenuClick();
        }),
        e(window).scroll(function () {
            n.show_hide_scroll_top(), n.fetchPostsOnScroll();
        })
})(jQuery);