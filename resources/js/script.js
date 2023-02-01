var browser_witdh = window.innerWidth;

jQuery(function () {

  if(!Modernizr.svg) {
    $('img[src*="svg"]').attr('src', function() {
      return $(this).attr('src').replace('.svg', '.png');
    });
    $('*[style*="svg"]').attr('style', function() {
      return $(this).attr('style').replace('.svg', '.png');
    });
  }

  setTimeout(function() { 
    $('div.js-dgwt-wcas-enable-mobile-form.dgwt-wcas-enable-mobile-form').remove();
  }, 500);

  $(window).on('resize', function () {
      var newWidth = $(window).width();
      if (newWidth != browser_witdh) {
        setTimeout(function() { 
          $('div.js-dgwt-wcas-enable-mobile-form.dgwt-wcas-enable-mobile-form').remove();
        }, 500);
      }
  });

  $(document).on("mouseup", function(e) {
    var container = $('div.dgwt-wcas-search-wrapp');

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
      $(document.body).removeClass('dgwt-wcas-open');
    }
  })

  var browser_witdh = window.innerWidth;

  if (browser_witdh < 769 ) {
    var submenu = $('.nav-container .menu-item').find('.sub-menu');
    submenu.each(function() {
      $(this).parent().prepend('<span></span>');
    });

    $('.menu-item span').on("click", function() {
      $(this).parent('li').toggleClass('open')
    });
  }


  if (!isCheckout() || browser_witdh < 1101) {
    $('.footer-upper-row.checkout').remove();
  } else {
    $('.footer-upper-row.default').remove();
  }
  
  if (browser_witdh < 1101) {
    var sidebar_shop = $('#primary-sidebar');
    sidebar_shop.prepend('<span class="close-btn">&#10005;</span>')

    $('.product-filter-btn').on("click", function() {
      sidebar_shop.toggleClass('open');
    });

    sidebar_shop.find('span.close-btn').on("click", function() {
      sidebar_shop.removeClass('open');
    });

    //Close when clicking outside of filter container
    $(document).on("mouseup", function(e) {
      if (!sidebar_shop.is(e.target) && sidebar_shop.has(e.target).length === 0 && !$('.product-filter-btn').is(e.target) && $('.product-filter-btn').has(e.target).length === 0) 
      {
        sidebar_shop.removeClass('open');
      }
    })
  }

  //hamburger menu icon animation
  $('#icon').on("click", function() {
    $('#a').toggleClass('a');
    $('#b').toggleClass('c');
    $('#c').toggleClass('b');

    $('.container.nav-container').toggleClass('nav-open');
    if($('.nav-open').length) {
      $(document.body).addClass('no-scroll');
    } else {
      $(document.body).removeClass('no-scroll');
    }  
  });

  // Lightslider plugin - slider activation on homepage
  var options_quote_desktop = {
    autoWidth: true,
    slideMargin: 52,
    centerSlide:true,    
    loop: true,    
    gallery: false,
    enableTouch: false,
    enableDrag: false,
    freeMove: false,
    swipeThreshold: 40,
    responsive : [],
  }
  var options_quote_mobile = {
    item: 2,
    autoWidth: true,
    slideMargin: 24,
    loop: true,
    controls: false,
    gallery: false,
    enableTouch: true,
    enableDrag: true,
    freeMove: false,
    swipeThreshold: 40,
    responsive : [],
  }
  var options_gallery_desktop = {
    autoWidth: true,
    slideMargin: 52,
    centerSlide:true,
    mode: "fade",
    loop: true,
    controls: false,
    gallery: false,
    enableTouch:true,
    enableDrag:true,
    swipeThreshold: 40,
    responsive : [],

    onSliderLoad: function (el) {
      var items = $('.gallery-item');
      var active = $('.gallery-item.active');
      items.last().addClass("prev");
      active.next().addClass("next");
    },
  }
  var options_gallery_mobile = {
    item: 2,
    autoWidth: true,
    slideMargin: 24,
    mode: "slide",
    loop: true,
    controls: false,
    gallery: false,
    enableTouch:true,
    enableDrag:true,
    swipeThreshold: 40,
    responsive : [],
  }


  var sliderArray = $(".slider");

  if (sliderArray.length) {
    var quoteSlider = $("#lightSlider");
    var gallerySlider = $("#lightSlider-gallery");
    if(quoteSlider.length) {
      if(browser_witdh > 768) {
        quoteSlider.lightSlider(options_quote_desktop);
        $( window ).resize();
      } else {
        quoteSlider.lightSlider(options_quote_mobile);
        $( window ).resize();
      }
    }
    if(gallerySlider.length) {
      if(browser_witdh > 480) {
        var slider = gallerySlider.lightSlider(options_gallery_desktop);

        $(document).on("click", ".prev", function() {
          slider.goToPrevSlide(); 
        });
        $(document).on("click", ".next", function() {
          slider.goToNextSlide(); 
        });
      } else {
        gallerySlider.lightSlider(options_gallery_mobile);
      }
    }
  }

  if($(document.body).hasClass('post-type-archive-feedback')) {
    //Show more class toggle on feedback archive page
    var selector = ".quote-item.hidden";
    var button_show = $('#show-more');
    checkHiddenElements(button_show, selector);
    button_show.on("click", function() {
      var hidden_items = $(selector);
      hidden_items.each(function(i) {
        if(i < 8) {
          $(this).removeClass('hidden');
        }
      });
      checkHiddenElements(button_show, selector);
    })
  } 
  
  if ($(document.body).hasClass('category-gallery') || $(document.body).hasClass('category-galerija')) {
    //Show more class toggle on gallery archive page
    var selector = ".gallery-item.hidden";
    var button_show = $('#show-more');
    checkHiddenElements(button_show, selector);
    button_show.on("click", function() {
      var hidden_items = $(selector);
      hidden_items.each(function(i) {
        if(i < 9) {
          $(this).removeClass('hidden');
        }
      });
      checkHiddenElements(button_show, selector);
    })
  }

  if (browser_witdh > 680) {
    //Lightbox activation in gallery archive page
    $(".fancybox-gallery-item").fancybox({});
  }


  // Gallery archive page - mobile action
  if (browser_witdh < 681) {
    $.fancybox.destroy();
    var thumbnailLinks = $('a.thumbnailLink');
    $('.fancy-big-img').fancybox({});

    thumbnailLinks.click(function(e) {
      e.preventDefault();

      $('.big-image a').attr('href', $(this).attr('href'));
      $('.big-image a img').attr('src', $(this).attr('href')); 

      $('.gallery-archive')[0].scrollIntoView({ 
        behavior: 'smooth' 
      });
    });
  }

  //Smooth scroll from button click to element
  $('.btn-goto').on("click", function() {
    var href = $(this).data("url");
    if (href.charAt(0) == "#") {
      $(href)[0].scrollIntoView({ 
        behavior: 'smooth' 
      });
    } else {
      window.open(href)
    }
  });




  //Add custom increment buttons to "Add to cart" value
  var $input_field = $("form.cart .quantity");
  $input_field.prepend('<div class="dec js-qty-btn">-</div>');
  $input_field.append('<div class="inc js-qty-btn">+</div>');

  $(".js-qty-btn").on("click", function() {
    var $button = $(this);
    var oldValue = $button.parent().find("input").val();
    if ($button.text() == "+") {
      var newVal = parseFloat(oldValue) + 1;
    } else {
    // Don't allow decrementing below zero
      if (oldValue > 0) {
        var newVal = parseFloat(oldValue) - 1;
      } else {
        newVal = 0;
      }
    }
    $button.parent().find("input").val(newVal);
  });


  //Refresh cart auto
  var timeout;
	$('.woocommerce').on('change', 'input.qty', function(){
		if ( timeout !== undefined ) {
			clearTimeout( timeout );
		}
		timeout = setTimeout(function() {
			$("[name='update_cart']").trigger("click");
		}, 500 ); // half a second delay
	});


  //Checkout tab action

  $('#fiz-persona').prop( "checked", true );
  $('#fiz-persona').parent('.field-radio').addClass('checked');
  var additional_fields = $('.woocommerce-billing-fields p').not('.main');

  $('input[type=radio][name=fields]').on("change", function() {
    if (this.value == 'fiz-persona') {
      additional_fields.addClass('hidden');
      $(this).parent('.field-radio').addClass('checked');
      $('#jur-persona').parent('.field-radio').removeClass('checked');
    }
    else if (this.value == 'jur-persona') {
      additional_fields.removeClass('hidden');
      $(this).parent('.field-radio').addClass('checked');
      $('#fiz-persona').parent('.field-radio').removeClass('checked');
    }
  });

  $('.tablink').on("click", function() {
    var block_id = "#" + $(this).data('id');
    var active_block_id = "#" + $('.tabcontent.active').attr('id');
    var current_at = $(active_block_id).index('.tabcontent');
    var selected_at = $(block_id).index('.tabcontent');
    if(current_at > selected_at) {
      changeTabs($(this), block_id);
    } else if (current_at == selected_at || selected_at - current_at > 1){
      return;
    } else {
      if(validateCheckout(active_block_id)) {
        changeTabs($(this), block_id)
      }
    }
  });

  function changeTabs(button, block_id) {
    $('.tabcontent.active').removeClass('active');
    $('.tablink.pressed').removeClass('pressed');
    button.addClass('pressed');
    $(block_id).addClass('active');

    if(block_id == '#payment') {
      $('.next-tab-btn').addClass('hidden');
    } else {
      if ($('.next-tab-btn').hasClass('hidden')){
        $('.next-tab-btn').removeClass('hidden');
      }
    }
  }

  $('.next-tab-btn').on("click", function(e) {
    e.preventDefault();
    var active_block = $('.tabcontent.active');
    var active_tab = $('.tablink.pressed');
    var active_block_id = "#" + active_block.attr('id');
    if(validateCheckout(active_block_id)) {
      active_block.removeClass('active');
      active_block.next('.tabcontent').addClass('active');
      active_tab.removeClass('pressed');
      active_tab.next('.tablink').addClass('pressed');

      if(active_block_id == '#shipping') {
        $('.next-tab-btn').addClass('hidden');
      }

    }
  });

  validateText('#billing_company');
  validateText('#billing_address_1');
  validateText('#billing_first_name');
  validateText('#billing_vat');
  validateEmail('#billing_email');
  validatePhoneNumber('#billing_phone');
  validateText('#billing_registration_num');

  validateText('#shipping_address_1');
  validateText('#shipping_city');
  validateText('#shipping_postcode');

  //Remove element to fix search bug on fibosearch plugin
  var $flags = $('[name="dgwt_wcas"]');
  if($flags.length){
      $flags.remove();
  }


  //Contact form validation
  validateEmail('#info-email');
  validatePhoneNumber('#info-number');
  validateText('#info-name');
  validateText('#info-message');

  if ($('.woocommerce-checkout').length) {
    $('#shipping_country').select2();
  }

});

$(document).on('facetwp-loaded', function() {
  $('.facetwp-facet-color').children().each(function() {
    var color_element = $(this);
    var color = color_element.text().split(" ")[0];
    if(color.length) {
      color_element.attr('data-color', color);
    }
    var color_value = color_element.attr('data-color');
    color_element.empty();
    color_element.css("background-color", color_value);
  });
  $('.facetwp-facet-color_en').children().each(function() {
    var color_element = $(this);
    var color = color_element.text().split(" ")[0];
    if(color.length) {
      color_element.attr('data-color', color);
    }
    var color_value = color_element.attr('data-color');
    color_element.empty();
    color_element.css("background-color", color_value);
  });
});


//Show more class toggle on gallery archive page
function checkHiddenElements (btn, selector) {
  if($(selector).length) {
    btn.removeClass("js-hidden");
  } else {
    btn.addClass("js-hidden");
  }
}


/***********
 * 
 * Form validations
 * 
 ***********/

function validateEmail(id) {
  // Email must be an email
  $(id).on("keyup", function() {
    var input=$(this);
    var re = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
    var is_email=re.test(input.val());
    if (is_email) {
      input.parents("p").removeClass("invalid").addClass("valid");
    }	else {
      input.parents("p").removeClass("valid").addClass("invalid");
    }
  });
}

function validatePhoneNumber(id) {
  // Number should be 8 numbers long and not empty
  $(id).on("keyup", function() {
    var input = $(this);
    var re = /^\b[1-9]{8}\b$/g;
    var is_number = re.test(input.val());
    if(is_number) {
      input.parents("p").removeClass("invalid").addClass("valid");
    }	else {
      input.parents("p").removeClass("valid").addClass("invalid");
    }
  });
}

function validateNumber(id) {
  // Number should be a number and not empty
  $(id).on("keyup", function() {
    var input = $(this);
    var re = /^\b[1-9]{+}\b$/g;
    var is_number = re.test(input.val());
    if(is_number) {
      input.parents("p").removeClass("invalid").addClass("valid");
    }	else {
      input.parents("p").removeClass("valid").addClass("invalid");
    }
  });
}

function validateText(id) {
  // Name can't be blank
  $(id).on("keyup", function() {
    var input=$(this);
    var is_name=input.val();
    if (is_name) {
      input.parents("p").removeClass("invalid").addClass("valid");
    } else {
      input.parents("p").removeClass("valid").addClass("invalid");
    }
  });
}


function validateCheckout(id) {
  var fields = $(id + ' p').not('.hidden');
  var fields_input = fields.find('input');
  var is_Valid = true;
  if($(id + ' p.invalid').not('.hidden').length) {
    is_Valid = false;
  } 
  fields_input.each(function() {
    var value = $(this).val();
    if(!value) {
      console.log('empty value found');
      is_Valid = false;
      $(this).parents('p').addClass('invalid');
    }
  });
  if(is_Valid) {
    return true;
  } else {
    return false;
  }
}

function isCheckout() {
  var class_checkout = 'woocommerce-checkout';
  if ($(document.body).hasClass(class_checkout) && !$(document.body).hasClass('woocommerce-order-received')) {
    return true;
  } else {
    return false;
  }
}