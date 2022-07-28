// Responsive Content Render Function
var renderMenu;
var menuContentMain;
function bigbulletin_responsive_content(renderMenu) {
  jQuery(document).ready(function ($) {
    "use strict";
    if (!menuContentMain) {
      menuContentMain = $("#theme-extrabar").html();
    }
    if ($(window).width() <= 991) {
      var dateContent = $(".theme-navextras-item").html();
      $(".responsive-content-date").html(dateContent);
      $("#theme-extrabar").empty();
    } else {
      $(".responsive-content-date").empty();
      $(".responsive-content-menu").empty();
      if (renderMenu) {
        $("#theme-extrabar").html(menuContentMain);
      }
    }
  });
}
jQuery(document).ready(function ($) {
  "use strict";
  // Responsive Content
  setInterval(myTimer, 1000);
  function myTimer() {
    const date = new Date();
    document.getElementById("twp-time-clock").innerHTML =
      date.toLocaleTimeString();
  }
  bigbulletin_responsive_content((renderMenu = false));
  $(window).resize(function () {
    bigbulletin_responsive_content((renderMenu = true));
  });
  // Hide Comments
  $(
    ".bigbulletin-no-comment .booster-block.booster-ratings-block, .bigbulletin-no-comment .comment-form-ratings, .bigbulletin-no-comment .twp-star-rating"
  ).hide();
  $(".tooltips").append("<span></span>");
  $(".tooltips").mouseenter(function () {
    $(this).find("span").empty().append($(this).attr("data-tooltip"));
  });
  // Scroll To
  $(".scroll-content").click(function () {
    $("html, body").animate(
      {
        scrollTop: $(".site-content").offset().top,
      },
      500
    );
  });
  // Rating disable
  if (
    bigbulletin_custom.single_post == 1 &&
    bigbulletin_custom.bigbulletin_ed_post_reaction
  ) {
    $(".tpk-single-rating").remove();
    $(".tpk-comment-rating-label").remove();
    $(".comments-rating").remove();
    $(".tpk-star-rating").remove();
  }
  // Add Class on article
  $(".theme-article-area").each(function () {
    $(this).addClass("theme-article-loaded");
  });
  // Aub Menu Toggle
  $(".submenu-toggle").click(function () {
    $(this).toggleClass("button-toggle-active");
    var currentClass = $(this).attr("data-toggle-target");
    $(currentClass).toggleClass("submenu-toggle-active");
  });
  // Header Search show
  $(".header-searchbar").click(function () {
    $(".header-searchbar").removeClass("header-searchbar-active");
  });
  $(".header-searchbar-inner").click(function (e) {
    e.stopPropagation(); //stops click event from reaching document
  });
  // Header Search hide
  $("#search-closer").click(function () {
    $(".header-searchbar").removeClass("header-searchbar-active");
    setTimeout(function () {
      $(".navbar-control-search").focus();
    }, 300);
    $("body").removeClass("body-scroll-locked");
  });
  // Focus on search input on search icon expand
  $(".navbar-control-search").click(function () {
    $(".header-searchbar").toggleClass("header-searchbar-active");
    setTimeout(function () {
      $(".header-searchbar .search-field").focus();
    }, 300);
    $("body").addClass("body-scroll-locked");
  });
  $("input, a, button").on("focus", function () {
    if ($(".header-searchbar").hasClass("header-searchbar-active")) {
      if ($(this).hasClass("skip-link-search-top")) {
        $(".header-searchbar #search-closer").focus();
      }
      if (!$(this).parents(".header-searchbar").length) {
        $(".header-searchbar .search-field").focus();
      }
    }
  });
  $(document).keyup(function (j) {
    if (j.key === "Escape") {
      // escape key maps to keycode `27`
      if ($(".header-searchbar").hasClass("header-searchbar-active")) {
        $(".header-searchbar").removeClass("header-searchbar-active");
        $("body").removeClass("body-scroll-locked");
        setTimeout(function () {
          $(".navbar-control-search").focus();
        }, 300);
      }
      if ($("body").hasClass("bigbulletin-trending-news-active")) {
        $(".trending-news-main-wrap").slideToggle();
        $("body").toggleClass("bigbulletin-trending-news-active");
        $(".navbar-control-trending-news").focus();
      }
    }
  });
  // Action On Esc Button
  $(document).keyup(function (j) {
    if (j.key === "Escape") {
      // escape key maps to keycode `27`
      if ($("#offcanvas-menu").hasClass("offcanvas-menu-active")) {
        $(".header-searchbar").removeClass("header-searchbar-active");
        $("#offcanvas-menu").removeClass("offcanvas-menu-active");
        $(".navbar-control-offcanvas").removeClass("active");
        $("body").removeClass("body-scroll-locked");
        setTimeout(function () {
          $(".navbar-control-offcanvas").focus();
        }, 300);
      }
    }
  });
  // Toggle Menu
  $(".navbar-control-offcanvas").click(function () {
    $(this).addClass("active");
    $("body").addClass("body-scroll-locked");
    $("#offcanvas-menu").toggleClass("offcanvas-menu-active");
    $(".button-offcanvas-close").focus();
  });
  // Offcanvas Close
  $(".offcanvas-close .button-offcanvas-close").click(function () {
    $("#offcanvas-menu").removeClass("offcanvas-menu-active");
    $(".navbar-control-offcanvas").removeClass("active");
    $("body").removeClass("body-scroll-locked");
    setTimeout(function () {
      $(".navbar-control-offcanvas").focus();
    }, 300);
  });
  // Offcanvas Close
  $("#offcanvas-menu").click(function () {
    $("#offcanvas-menu").removeClass("offcanvas-menu-active");
    $(".navbar-control-offcanvas").removeClass("active");
    $("body").removeClass("body-scroll-locked");
  });
  $(".offcanvas-wraper").click(function (e) {
    e.stopPropagation(); //stops click event from reaching document
  });
  // Offcanvas re focus on close button
  $("input, a, button").on("focus", function () {
    if ($("#offcanvas-menu").hasClass("offcanvas-menu-active")) {
      if ($(this).hasClass("skip-link-off-canvas")) {
        if (!$("#offcanvas-menu #social-nav-offcanvas").length == 0) {
          $("#offcanvas-menu #social-nav-offcanvas ul li:last-child a").focus();
        } else if (!$("#offcanvas-menu #primary-nav-offcanvas").length == 0) {
          $(
            "#offcanvas-menu #primary-nav-offcanvas ul li:last-child a"
          ).focus();
        }
      }
    }
  });
  $(".skip-link-offcanvas").focus(function () {
    $(".button-offcanvas-close").focus();
  });

  // Sidr WidgetArea
  if ($("body").hasClass("rtl")) {
    $("#widgets-nav").sidr({
      name: "sidr-nav",
      side: "right",
    });
  } else {
    $("#widgets-nav").sidr({
      name: "sidr-nav",
      side: "left",
    });
  }
  $("#widgets-nav > .navbar-control").click(function () {
    $(this).toggleClass("active");

    if ($(this).hasClass("active")) {
      $("body").addClass("body-scroll-locked");
    } else {
      $("body").removeClass("body-scroll-locked");
    }

    setTimeout(function () {
      $(".sidr-offcanvas-close").focus();
    }, 300);
  });
  $(".sidr-offcanvas-close").click(function () {
    $.sidr("close", "sidr-nav");

    $("#widgets-nav > .navbar-control").removeClass("active");

    $("body").removeClass("body-scroll-locked");

    setTimeout(function () {
      $("#widgets-nav > .navbar-control").focus();
    }, 300);
  });
  $("input, a, button").on("focus", function () {
    if ($("body").hasClass("sidr-nav-open")) {
      if ($(this).hasClass("skip-link-offcanvas-first")) {
        $(".skip-link-offcanvas-last").focus();
      }

      if (!$(this).parents("#sidr-nav").length) {
        $(".sidr-offcanvas-close").focus();
      }
    }
  });

  $(document).keyup(function (j) {
    if ($("body").hasClass("sidr-nav-open")) {
      if (j.key === "Escape") {
        // escape key maps to keycode `27`

        $.sidr("close", "sidr-nav");
        $("#widgets-nav > .navbar-control").removeClass("active");
        $("body").removeClass("body-scroll-locked");
        setTimeout(function () {
          $("#widgets-nav > .navbar-control").focus();
        }, 300);
      }
    }
  });

  // Trending News Start
  $(".navbar-control-trending-news").click(function () {
    $(".trending-news-main-wrap").slideToggle();
    $("body").toggleClass("bigbulletin-trending-news-active");
    $("#trending-collapse").focus();
  });
  $(".bigbulletin-skip-link-end").focus(function () {
    $("#trending-collapse").focus();
  });
  $(".bigbulletin-skip-link-start").focus(function () {
    $(".trending-news-main-wrap .column:last-child .entry-meta a").focus();
  });
  $("#trending-collapse").click(function () {
    $(".trending-news-main-wrap").slideToggle();
    $("body").toggleClass("bigbulletin-trending-news-active");
    $(".navbar-control-trending-news").focus();
  });
  // Trending News End
  // Single Post content gallery slide
  $(
    "ul.wp-block-gallery.columns-1, .wp-block-gallery.columns-1 .blocks-gallery-grid, .gallery-columns-1"
  ).each(function () {
    $(this).slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      fade: true,
      autoplay: false,
      autoplaySpeed: 8000,
      infinite: true,
      nextArrow:
        '<button type="button" class="slide-btn slide-btn-bg slide-next-icon">' +
        bigbulletin_custom.next_svg +
        "</button>",
      prevArrow:
        '<button type="button" class="slide-btn slide-btn-bg slide-prev-icon">' +
        bigbulletin_custom.prev_svg +
        "</button>",
      dots: false,
    });
  });

  $(function () {
    $("#theme-banner-navs a").click(function () {
      // Check for active
      $("#theme-banner-navs li").removeClass("active");
      $(this).parent().addClass("active");
      // Display active tab
      let currentTab = $(this).attr("href");
      $(".aside-panel-tabs .twp-banner-tab").hide();
      $(currentTab).show();
      return false;
    });
  });
  // Content Gallery popup End

  $(".theme-slider-block").each(function () {
    $(this).slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      fade: true,
      autoplay: false,
      autoplaySpeed: 8000,
      infinite: true,
      prevArrow: $(this)
        .closest(".theme-block-navtabs")
        .find(".slide-prev-lead"),
      nextArrow: $(this)
        .closest(".theme-block-navtabs")
        .find(".slide-next-lead"),
      dots: false,
    });
  });

  $(".theme-widget-slider").each(function () {
    $(this).slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 4000,
      speed: 900,
      infinite: true,
      nextArrow:
        '<button type="button" class="slide-btn slide-btn-bg slide-next-icon">' +
        bigbulletin_custom.next_svg +
        "</button>",
      prevArrow:
        '<button type="button" class="slide-btn slide-btn-bg slide-prev-icon">' +
        bigbulletin_custom.prev_svg +
        "</button>",
      dots: false,
    });
  });

  $(".theme-widget-carousel").each(function () {
    $(this).slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      dots: true,
      infinite: true,
      prevArrow: $(".slide-widget-prev"),
      nextArrow: $(".slide-widget-next"),
      responsive: [
        {
          breakpoint: 1400,
          settings: {
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
          },
        },
      ],
    });
  });

  // Banner Block 1
  $(".theme-main-slider-block").each(function () {
    $(this).slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      fade: true,
      autoplay: false,
      autoplaySpeed: 8000,
      infinite: true,
      prevArrow: $(this)
        .closest(".theme-main-banner")
        .find(".slide-prev-banner"),
      nextArrow: $(this)
        .closest(".theme-main-banner")
        .find(".slide-next-banner"),
      dots: false,
    });
  });

  // block slide container

  $(".block-slide-container").each(function () {
    $(this).slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 4000,
      infinite: true,
      speed: 900,
      prevArrow: $(".block-slide-button .slide-prev-icon"),
      nextArrow: $(".block-slide-button .slide-next-icon"),
    });
  });

  $(".ticker-slides").each(function () {
    $(this).slick({
      infinite: true,
      speed: 1000,
      autoplay: true,
      autoplaySpeed: 1200,
      slidesToShow: 1,
      adaptiveHeight: true,
      nextArrow: ".slide-next-ticker",
      prevArrow: ".slide-prev-ticker",
    });
    // Pause Autoplay on click
    $(".ticker-control-pause").click(function () {
      $(".ticker-slides").slick("slickPause");
      $(this).removeClass("pp-button-active");
      $(".ticker-control-play").addClass("pp-button-active");
    });
    // Autoplay active on click
    $(".ticker-control-play").click(function () {
      $(".ticker-slides").slick("slickPlay");
      $(this).removeClass("pp-button-active");
      $(".ticker-control-pause").addClass("pp-button-active");
    });
  });
  var pageSection = $(".data-bg");
  pageSection.each(function (indx) {
    if ($(this).attr("data-background")) {
      $(this).css(
        "background-image",
        "url(" + $(this).data("background") + ")"
      );
    }
  });
  $(window).scroll(function () {
    if ($(window).scrollTop() > $(window).height() / 2) {
      $(".scroll-up").fadeIn(300);
    } else {
      $(".scroll-up").fadeOut(300);
    }
  });
  // Scroll to Top on Click
  $(".scroll-up").click(function () {
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      700
    );
    return false;
  });
});
