// Function to add a class to the navbar when scrolled
function handleScroll() {
    const navbar = document.getElementById("navbar");
    if (window.scrollY > 40) {
        navbar.classList.add("navbar-scrolled");
    } else {
        navbar.classList.remove("navbar-scrolled");
    }
}

// Add a scroll event listener
window.addEventListener("scroll", handleScroll);

AOS.init();

$('.the-slider .owl-carousel').owlCarousel({
    loop: true,
    responsiveClass: true,
    margin: 10,
    center: true,
    nav: false,
    autoplay:true,
    autoplayTimeout:10000,
    autoplayHoverPause:true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 3
        }
    }
})

$('.information .owl-carousel').owlCarousel({
    loop: true,
    responsiveClass: true,
    margin: 10,
    center: true,
    nav: true,
    autoplay:true,
    autoplayTimeout:15000,
    autoplayHoverPause:true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})

$(document).ready(function () {
    let filterCategories = $('.category-link');
    let filterImages = $('.gallery-img');

    filterCategories.on('click', function () {
        if ($(this).hasClass('category-active')) {
            return; // Exit early if the clicked category is already active
        }

        $('.category-active').removeClass('category-active');
        $(this).addClass('category-active');

        let selectedCategoryName = $(this).data('name');

        filterImages.each(function (index, image) {
            let imageCategory = $(image).data('name');
            if (selectedCategoryName === 'All' || imageCategory === selectedCategoryName) {
                $(image).show();
            } else {
                $(image).hide();
            }
        });
    });
});


const btnToTop = $('#btnToTop');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btnToTop.addClass('showBtnToTop');
  } else {
    btnToTop.removeClass('showBtnToTop');
  }
});

btnToTop.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});
