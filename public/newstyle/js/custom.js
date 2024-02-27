$(document).ready(function () {



    //Sidebar End
    const closeIcon = $("#nav .content .top .button-menu");
    const sideBar = $("#sidebar");
    const lanBtn = $('#nav .content .top .button-language');
    closeIcon.click(function () {
        if (sideBar.scrollTop() != 0) {
            sideBar.scrollTop(0);
        }
        if ($(this).hasClass('button-close')) {
            sideBar.addClass('translate-100');
            if ($(window).innerWidth() < 576) {
                lanBtn.addClass('d-none');
            }
            $(this).removeClass('button-close');
        } else {
            sideBar.removeClass('translate-100');
            if ($(window).innerWidth() < 576) {
                lanBtn.removeClass('d-none');
            }
            $(this).addClass('button-close');
        }
    });
    var i = 1;

    function lanMenuHideUnhide() {
        if ($(window).innerWidth() >= 576) {
            lanBtn.removeClass('d-none');
        } else {
            lanBtn.addClass('d-none');
        }
    }
    lanMenuHideUnhide();


    //Image change on scrooll
    const bioImage = $("#biography .main .image img");
    $(window).scroll(function () {
        const navLink = $("#biography .main .menu nav ul .nav-item .nav-link.active");
        let link = navLink.attr('href');
        link = link.replace('#', '');
        let path = 'img/biography/';
        let imageName = link + '.png';
        let fullPath = path + imageName;
        bioImage.attr('src', fullPath);
        $('.scrollspy-example').scrollspy('refresh');
    });
    //end image change on scroll
    $(window).resize(function () {
        lanMenuHideUnhide();
    });
    //Sidebar End

    new VenoBox({
        selector: ".bannerVideo",
        autoplay: true,
        ratio: 'full',
        spinColor: "#7b61ff",
        bgcolor: "rgba(123, 97, 255, .2)"
    });

    $('.owl-carousel').owlCarousel({
        margin: 20,
        loop: false,
        autoWidth: true,
        mouseDrag: false,
        nav: true,
        dots: false,
        navText: ['<span class="prev-icon"><span class="material-symbols-outlined">chevron_left</span></span>', '<span class="next-icon"><span class="material-symbols-outlined">chevron_right</span></span>']
    });


    function isDisabledIcon() {
        if ($('button.owl-prev').hasClass('disabled')) {
            $('#category-slider .owl-carousel').removeClass('owl-carousel-custom-prev');
        } else {
            $('#category-slider .owl-carousel').addClass('owl-carousel-custom-prev');
        }
        if ($('button.owl-next').hasClass('disabled')) {
            $('#category-slider .owl-carousel').removeClass('owl-carousel-custom-next');
        } else {
            $('#category-slider .owl-carousel').addClass('owl-carousel-custom-next');
        }
    }
    isDisabledIcon();

    $('.owl-carousel').on('changed.owl.carousel', function (e) {
        isDisabledIcon();
    });

    $("#category-slider .category-input").change(function () {

        if ($(this).is(':checked')) {
            $(this).parent().children('label').addClass('active');
        } else {
            $(this).parent().children('label').removeClass('active');

        }

    });


    // init Isotope

    var $grid = $('#achievement-post .posts').isotope({
        itemSelector: '#achievement-post .post',
        percentPosition: true,
        masonry: {
            columnWidth: '#achievement-post .grid-sizer'

        }
    });
    // layout Isotope after each image loads
    $grid.imagesLoaded().progress(function () {
        $grid.isotope('layout');
    });
















});