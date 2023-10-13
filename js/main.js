// Nav menu for mobile
$('#menu-btn').click(function() {
    $('nav .navigation ul').addClass('active')
});
$('#menu-close').click(function() {
    $('nav .navigation ul').removeClass('active')
});

// Counter Animation
let nCount = function(selector) {
    $(selector).each(function() {
        $(this).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: "swing",
            step: function(value){
                $(this).text(Math.ceil(value));
            }
        })
    }); 
}

let a = 0;
let b = 0;
$(window).scroll(function() {
    let oTop = $(".numbers").offset().top - window.innerHeight;

    if (a==0 && $(window).scrollTop() >= oTop){
        a++;
        nCount(".rect > h1");
    }
})

$(window).scroll(function() {
    let oTop = $(".time").offset().top - window.innerHeight;

    if (b==0 && $(window).scrollTop() >= oTop){
        b++;
        nCount(".date > .p");
    }
})

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        console.log(entry)
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        } else {
            entry.target.classList.remove('show');
        }
    });
});

const hidden = document.querySelectorAll('.hide');
hidden.forEach((el) => observer.observe(el));