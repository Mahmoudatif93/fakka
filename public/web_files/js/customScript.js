$(document).ready(function() {
    // Wizard Steps
    const steps = $('.wizard-steps .step');
    const progress = $('.wizard-steps .progress');
    const bodySections = $('.wizard-body .tab');

    function next(n) {
        if (n > steps.length - 1) {
            return
        }
        $(steps).removeClass('active');
        $(steps[n]).addClass('active');
        $(steps[n]).prevAll().addClass('active');
        $(bodySections).slideUp();
        $(bodySections[n]).slideDown();
        $(progress).css({
            width: (100 / 3) * (n + 1) + '%',
        });
    }
    next(0);

    $('.wizard-next-btn').each(function(i) {
        $(this).click(function() {
            next(2);
        });
    });

    // Accordion
    $('.accordion .title').click(function() {
        const el = $(this);
        const elParent = el.closest('.accordion-section');
        const targetContent = elParent.find('.content');
        $('.accordion .title').removeClass('active');
        $('.accordion .accordion-section .content').slideUp();
        targetContent.slideDown();
        el.addClass('active');
    });

    $('.payment-place .heading').click(function() {
        const el = $(this);
        const elParent = el.closest('.payment-section');
        const targetContent = elParent.find('.payment-content');
        $('.payment-place .title').removeClass('active');
        $('.payment-place .payment-section .payment-content').slideUp();
        targetContent.slideDown();
        el.addClass('active');
    });

});



(function() {
    "use strict";
    var jQueryPlugin = (window.jQueryPlugin = function(ident, func) {
        return function(arg) {
            if (this.length > 1) {
                this.each(function() {
                    var $this = $(this);

                    if (!$this.data(ident)) {
                        $this.data(ident, func($this, arg));
                    }
                });

                return this;
            } else if (this.length === 1) {
                if (!this.data(ident)) {
                    this.data(ident, func(this, arg));
                }

                return this.data(ident);
            }
        };
    });
})();

(function() {
    "use strict";

    function Guantity($root) {
        const element = $root;
        const quantity = $root.first("data-quantity");
        const quantity_target = $root.find("[data-quantity-target]");
        const quantity_minus = $root.find("[data-quantity-minus]");
        const quantity_plus = $root.find("[data-quantity-plus]");
        var quantity_ = quantity_target.val();
        $(quantity_minus).click(function() {
            quantity_target.val(--quantity_);
        });
        $(quantity_plus).click(function() {
            quantity_target.val(++quantity_);
        });
    }
    $.fn.Guantity = jQueryPlugin("Guantity", Guantity);
    $("[data-quantity]").Guantity();
})();







$(document).ready(function() {
    var cartCountValue = 0;
    var cartCount = $('.cart .count');
    $(cartCount).text(cartCountValue);

    $('.random-btn').on('click', function() {
        $('.cart').offset({
            top: getRndInteger(0, window.innerHeight - 100),
            left: getRndInteger(0, window.innerWidth - 100)
        });
    });

    $('.cart-btn').on('click', function() {
        var cartBtn = this;
        var cartCountPosition = $(cartCount).offset();
        var btnPosition = $(this).offset();
        var leftPos =
            cartCountPosition.left < btnPosition.left ?
            btnPosition.left - (btnPosition.left - cartCountPosition.left) :
            cartCountPosition.left;
        var topPos =
            cartCountPosition.top < btnPosition.top ?
            cartCountPosition.top :
            cartCountPosition.top;
        $(cartBtn)
            .append("<span class='count'>1</span>");

        $(cartBtn).find(".count").each(function(i, count) {
            $(count).offset({
                    left: leftPos,
                    top: topPos
                })
                .animate({
                        opacity: 0
                    },
                    function() {
                        $(this).remove();
                        cartCountValue++;
                        $(cartCount).text(cartCountValue);
                    }
                );
        });
    });

    function getRndInteger(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
});
//const dropdown_menu = document.getElementById('dropdown-menu');

function showDropdownMenu() {
    //var ss = document.getElementById('dropdown-menu');
   // dropdown_menu.style.display = "block";
   var dropdown_menu = document.getElementById('dropdown-menu');
   jQuery('#dropdown_menu').toggle('show');
   $("#dropdown-menu").toggle();
    dropdown_menu.classList.toggle('show-dropdown-menu');
}








// Payment Method Radios
$('[name="delivery_type"]').on('change', function() {
    const targetVal = $(this).val();

    if (targetVal === 'ship') {
        $('#deliver_by_shipping').slideDown(300)
    } else {
        $('#deliver_by_shipping').slideUp(300)
    }
});

//////////////////////////vertical tabs///
var tab=document.getElementById("defaultOpen");
if(tab){


document.getElementById("defaultOpen").click();
$(document).ready(function() {
    //----------Select the first tab and div by default

    $('#vertical_tab_nav > .vertical-links > .link > a').eq(0).addClass("selected");
    $('#vertical_tab_nav > div > .content').eq(0).css('display', 'block');


    //---------- This assigns an onclick event to each tab link("a" tag) and passes a parameter to the showHideTab() function

    $('#vertical_tab_nav > .vertical-links').click(function(e) {

        if ($(e.target).is("a")) {

            /*Handle Tab Nav*/
            $('#vertical_tab_nav > .vertical-links > .link > a').removeClass("selected");
            $(e.target).addClass("selected");

            /*Handles Tab Content*/
            var clicked_index = $("a", this).index(e.target);
            $('#vertical_tab_nav > div > .content').css('display', 'none');
            $('#vertical_tab_nav > div > .content').eq(clicked_index).fadeIn();

        }

        $(this).blur();
        return false;

    });


}); //end ready
$(document).ready(function() {
    $(".button").click(function() {
        $(".modal").fadeIn();
        $("body").css("overflow", "hidden");
    });
    $(".cross").click(function() {
        $(".modal").fadeOut();
        $("body").css("overflow", "auto");
    });
});

}


 // popup
 $('[data-toggle="modal"]').each(function() {
    $(this).on('click', function() {
        const target = `#${$(this).data('target')}`;
        showModal(target);
    });
});

$('[data-modal-dismiss]').each(function() {
    $(this).on('click', function() {
        const target = $(this).closest('.popup');
        closeModal(target);
    });
});

function showModal(target) {
    $("body").css("overflow", "hidden");
    $('.popup').hide();
    $(target).fadeIn(300);
}

function closeModal() {
    $('.popup').hide();
    $("body").css("overflow", "auto");
}


////////end of vertical tabs

