(function ($) {
  "use strict";

  // ==========================================
  //      Start Document Ready function
  // ==========================================
  $(document).ready(function () {
    // ============== Header Hide Click On Body Js Start ========
    $(".header-button").on("click", function () {
      $(".body-overlay").toggleClass("show");
    });
    $(".body-overlay").on("click", function () {
      $(".header-button").trigger("click");
      $(this).removeClass("show");
    });
    // =============== Header Hide Click On Body Js End =========

    // ========================== Header Hide Scroll Bar Js Start =====================
    $(".navbar-toggler.header-button").on("click", function () {
      $("body").toggleClass("scroll-hide-sm");
    });
    $(".body-overlay").on("click", function () {
      $("body").removeClass("scroll-hide-sm");
    });
    // ========================== Header Hide Scroll Bar Js End =====================

    // ========================== Small Device Header Menu On Click Dropdown menu collapse Stop Js Start =====================
    $(".dropdown-item").on("click", function () {
      $(this).closest(".dropdown-menu").addClass("d-block");
    });
    // ========================== Small Device Header Menu On Click Dropdown menu collapse Stop Js End =====================

    // ========================== Add Attribute For Bg Image Js Start =====================
    $(".bg-img").css("background", function () {
      var bg = "url(" + $(this).data("background-image") + ")";
      return bg;
    });

    // language
    const curElement = {
      mainCurrency: $(".language-list"),
    };

    const mainCurrency = curElement.mainCurrency;
    const currencyItem = mainCurrency.children();

    currencyItem.each(function () {
      const innerItem = $(this);
      const languageText = innerItem.find(".language_text");

      innerItem.on("click", function () {
        $(".language__text").text(languageText.text());
      });
    });

    // light case

    $("a[data-rel^=lightcase]").lightcase();

    // ========================== Add Attribute For Bg Image Js End =====================

    // copy clip board

    $("#referrals-btn").on("click", function () {
      var copyText = $("#referrals-input");
      copyText.select();
      copyText[0].setSelectionRange(0, 99999);
      document.execCommand("copy");
      alert("Copy referrals link");
    });

    // duplicate ticket

    function addFileInput() {
      var newInput = $("<input>", {
        type: "file",
        class: "form--control",
      });

      var newLabel = $("<label>", {
        class: "form--label mb-0 mt-2",
        text: "Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx",
      });

      var newFormGroup = $("<div>", {
        class: "flex-fill",
      })
        .append(newInput)
        .append(newLabel);

      var mainClass = $("<div>", {
        class: "form-group flex-between align-items-start gap-3",
      }).append(newFormGroup);

      var removeButton = $("<button>", {
        class: "remove-button",
        html: '<i class="icon--Icon-olor-2"></i>',
        click: function () {
          mainClass.remove();
        },
      });

      mainClass.append(removeButton);

      $("#formContainer").append(mainClass);
    }
    $(".duplicate-ticket").click(function () {
      addFileInput();
    });

    // ================== Password Show Hide Js Start ==========
    $(".toggle-password").on("click", function () {
      $(this).toggleClass(" fa-eye-slash");
      var input = $($(this).attr("id"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
    // =============== Password Show Hide Js End =================

    // ========================= Slick Slider Js Start ==============
    $(".banner-content-slider__inner").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 2000,
      speed: 1500,
      dots: true,
      pauseOnHover: true,
      arrows: false,
      appendDots: ".banner-slider-dots",
    });

    // choose slider

    $(".choose-us-slider").slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 2000,
      speed: 1500,
      dots: true,
      pauseOnHover: true,
      arrows: false,
      appendDots: ".card-slider-dots",
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 1,
          },
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
          },
        },
      ],
    });

    // testimonial slider
    $(".testimonials-slider").slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 2000,
      speed: 1500,
      dots: true,
      pauseOnHover: true,
      arrows: false,
      appendDots: ".testimonials-slider-dots",
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 1,
          },
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
          },
        },
      ],
    });

    // winner slider
    $(".latest-winner__list").slick({
      autoplay: true,
      dots: false,
      infinite: true,
      speed: 1000,
      slidesToShow: 5,
      arrows: false,
      slidesToScroll: 4,
      cssEase: "linear",
      vertical: true,
      autoplaySpeed: 0,
      verticalSwiping: true,
      swipeToSlide: true,
      swipe: true,
      focusOnHover: true,
      pauseOnHover: true,
    });

    // ========================= Slick Slider Js End ===================

    // ========================= Client Slider Js Start ===============
    $(".payment-slider").slick({
      slidesToShow: 6,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 1000,
      pauseOnHover: true,
      speed: 2000,
      dots: false,
      arrows: false,
      responsive: [
        {
          breakpoint: 1400,
          settings: {
            slidesToShow: 5,
          },
        },
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 4,
          },
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
          },
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3,
          },
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 2,
          },
        },
      ],
    });
    // ========================= Client Slider Js End ===================

    // ================== Sidebar Menu Js Start ===============
    // Sidebar Dropdown Menu Start
    $(".has-dropdown > a").click(function () {
      $(".sidebar-submenu").slideUp(200);
      if ($(this).parent().hasClass("active")) {
        $(".has-dropdown").removeClass("active");
        $(this).parent().removeClass("active");
      } else {
        $(".has-dropdown").removeClass("active");
        $(this).next(".sidebar-submenu").slideDown(200);
        $(this).parent().addClass("active");
      }
    });
    // Sidebar Dropdown Menu End
    // Sidebar Icon & Overlay js
    $(".dashboard-body__bar-icon").on("click", function () {
      $(".sidebar-menu").addClass("show-sidebar");
      $(".sidebar-overlay").addClass("show");
    });
    $(".sidebar-menu__close, .sidebar-overlay").on("click", function () {
      $(".sidebar-menu").removeClass("show-sidebar");
      $(".sidebar-overlay").removeClass("show");
    });
    // Sidebar Icon & Overlay js
    // ===================== Sidebar Menu Js End =================

    // ==================== Dashboard User Profile Dropdown Start ==================
    $(".user-info__button").on("click", function (event) {
      event.stopPropagation(); // Prevent the click event from propagating to the body
      $(".user-info-dropdown").toggleClass("show");
    });

    $(".user-info-dropdown__link").on("click", function (event) {
      event.stopPropagation(); // Prevent the click event from propagating to the body
      $(".user-info-dropdown").addClass("show");
    });

    $("body").on("click", function () {
      $(".user-info-dropdown").removeClass("show");
    });
    // ==================== Dashboard User Profile Dropdown End ==================

    // ==================== Custom Sidebar Dropdown Menu Js Start ==================
    $(".has-submenu").on("click", function (event) {
      event.preventDefault(); // Prevent the default anchor link behavior

      // Check if this submenu is currently visible
      var isOpen = $(this).find(".sidebar-submenu").is(":visible");

      // Hide all submenus initially
      $(".sidebar-submenu").slideUp();

      // Remove the "active" class from all li elements
      $(".sidebar-menu__item").removeClass("active");

      // If this submenu was not open, toggle its visibility and add the "active" class to the clicked li
      if (!isOpen) {
        $(this).find(".sidebar-submenu").slideToggle(500);
        $(this).addClass("active");
      }
    });
    // ==================== Custom Sidebar Dropdown Menu Js End ==================

    // ========================= Odometer Counter Up Js End ==========
    $(".counterup-item").each(function () {
      $(this).isInViewport(function (status) {
        if (status === "entered") {
          for (
            var i = 0;
            i < document.querySelectorAll(".odometer").length;
            i++
          ) {
            var el = document.querySelectorAll(".odometer")[i];
            el.innerHTML = el.getAttribute("data-odometer-final");
          }
        }
      });
    });
    // ========================= Odometer Up Counter Js End =====================
  });
  // ==========================================
  //      End Document Ready function
  // ==========================================

  // ========================= Preloader Js Start =====================
  $(window).on("load", function () {
    $(".preloader").fadeOut();
  });
  // ========================= Preloader Js End=====================

  // ========================= Header Sticky Js Start ==============
  $(window).on("scroll", function () {
    if ($(window).scrollTop() >= 300) {
      $(".header").addClass("fixed-header");
    } else {
      $(".header").removeClass("fixed-header");
    }
  });
  // ========================= Header Sticky Js End===================

  //============================ Scroll To Top Icon Js Start =========
  var btn = $(".scroll-top");

  $(window).scroll(function () {
    if ($(window).scrollTop() > 300) {
      btn.addClass("show");
    } else {
      btn.removeClass("show");
    }
  });

  btn.on("click", function (e) {
    e.preventDefault();
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      "300"
    );
  });
  // select box
  $(".game-select-box").click(function () {
    $(".game-select-box").removeClass("active");
    $(this).addClass("active");
  });

  //========================= Scroll To Top Icon Js End ======================

  $(".showFilterBtn").on("click", function () {
    $(".responsive-filter-card").slideToggle();
  });

  const mine_box = document.getElementsByClassName("mine-box");

  [...mine_box].forEach((item) => {
    item.addEventListener("click", () => {
      item.classList.add("active-hidden");
    });
  });
})(jQuery);
