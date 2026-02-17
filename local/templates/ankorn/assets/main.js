$(function () {
    $(document).ready(function () {
      $('body').addClass('site-is-ready');     

      /* Поле "Диапазон измерения, мм" активно при выборе уровнемеров, поля "тип оборудования", если в поле тип оборудование выбран сигнализатор уровня, поле "Диапазон измерения, мм" не активно */ 

      if ( $('.PARAM_TYPE1').length > 0 ) {
        var elements = $('.PARAM_TYPE1 .smart-filter-input-group-checkbox-list .form-check.mb-1');
        //alert('Найдено элементов:', elements.length);
        $('.PARAM_TYPE1.smart-filter-parameters-box .smart-filter-input-group-checkbox-list .form-check.mb-1').each(function(index, element) {
          var labelText = $(this).find('label.smart-filter-checkbox-text').text().trim().toLowerCase();
          //alert(labelText);
          if ( $(this).find('label').text().trim().toLowerCase() == "сигнализатор уровня" ) {
            if ( $(this).find('input').prop('checked') == true ) {

              var elements1 = $('.PARAM_RANGE.smart-filter-parameters-box .smart-filter-input-group-checkbox-list .form-check.mb-1 input');
              console.log('Найдено элементов:', elements1.length);
              $('.PARAM_RANGE.smart-filter-parameters-box .smart-filter-input-group-checkbox-list .form-check.mb-1 input').each(function(index, element) {
                $(this).prop("disabled", true);  
                $(this).prop("checked", false); 
              });

            }
          }
        });
      }

      $('.PARAM_TYPE1 input#arrFilter_52_973284970').on('click', function() {
        if ( $(this).prop("checked") == true ) { /* Выбран сигнализатор уровня */
          $('.PARAM_RANGE.smart-filter-parameters-box .smart-filter-input-group-checkbox-list .form-check.mb-1 input').each(function(index, element) {
            $(this).prop("disabled", true); 
            $(this).prop("checked", false);  
            $('.PARAM_RANGE').addClass('hidden');
          });
        }
        else { /* галочка сигнализатор уровня снята */
          $('.PARAM_RANGE.smart-filter-parameters-box .smart-filter-input-group-checkbox-list .form-check.mb-1 input').each(function(index, element) {
            $(this).prop("disabled", false); 
            $('.PARAM_RANGE').removeClass('hidden');
          });    
        }
      })

      /* --- */

      $(document).on('click', 'a[target="_blank"]', function(e) {
        const url = $(this).attr('href');
        alert('Открыто новое окно с URL:', url);
        // Здесь можно отправить данные на сервер или сохранить в переменную

      });

    });




    var timerId;
    var initialClick = false;
    var initialChat = false;
    var initialWhatsApp = false;
    var initialTelegram = false;
    //hide amo chat on mobile
    timerId = setInterval(() => hideAmoMobile(), 100);

    function hideAmoMobile() {
      if ( ( $('#amo-livechat').length == 1 ) ) {
        $('#amo-livechat').addClass('noMobileDialog');

          $('.amo-button').on('click', function() { // открытие чата
            if (window.innerWidth <= 640) {
              $('#amo-livechat').removeClass('noMobileDialog');          
            }
            if (!initialClick) {
              ym(45467883,'reachGoal','CHAT_SHOW_AMO');
              //console.log('click');
              initialClick = true;              
            }

            const timerIdOne = setTimeout(() => {

              $('.styles_button__1mvfr').on('click', function() {
                if (!initialChat) {
                  alert('chat');
                  initialChat = true;              
                }
              });

              $('.amo-button--whatsapp, .amo-button--whatsapp a').on('click', function() {
                if (!initialWhatsApp) {
                  alert('initialWhatsApp');
                  initialWhatsApp = true;              
                }
              });

              $('.amo-button--telegram, .amo-button--telegram a').on('click', function() {
                if (!initialTelegram) {
                  alert('initialTelegram');
                  initialTelegram = true;              
                }
              });

              $("#social_iframe").contents().find(".amo-button--whatsapp a").on("click", function() {
                // Обработчик события клика по кнопке внутри iframe
                alert("Кнопка внутри iframe была нажата!");
              });

              //alert($('#social_iframe').length);
              //var iframeDoc = $('#social_iframe').contents();
              //alert(iframeDoc.html());
              //var elementWhatsApp = iframeDoc.find('.amo-button--whatsapp');
              //alert(elementWhatsApp.length);


            }, 500);

          });



        clearInterval(timerId);
      }
    }



    // $('.clients-slider').flickity({
    //     // options
    //     cellAlign: 'left',
    //     contain: true,
    //     autoPlay: true,
    //     pageDots: false
    // });
    const DRAG_THRESHOLD = window.innerWidth > 1024 ? 20 : 0;
    var $slider = $('.clients-slider');
    if ($slider.length) {
        $slider.flickity({
            dragThreshold: DRAG_THRESHOLD,
            cellAlign: 'left',
            wrapAround: true,
            imagesLoaded: true,
            pageDots: false,
            autoPlay: 2000,
        });
        $slider.on('dragStart.flickity', function (event, pointer) {
            $(this).addClass('is-dragging');
        });
        $slider.on('dragEnd.flickity', function (event, pointer) {
            $(this).removeClass('is-dragging');
        });
    }

    var $CatalogSlider = $('.catalog-slider');
    if ($CatalogSlider.length) {
        $CatalogSlider.flickity({
            dragThreshold: DRAG_THRESHOLD,
            cellAlign: 'left',
            wrapAround: true,
            imagesLoaded: true,
            pageDots: false,
            autoPlay: 2000,
        });
        $CatalogSlider.on('dragStart.flickity', function (event, pointer) {
            $(this).addClass('is-dragging');
        });
        $CatalogSlider.on('dragEnd.flickity', function (event, pointer) {
            $(this).removeClass('is-dragging');
        });
    }

    $('.video').on('click', function () {
        $('.video-frame').remove();
        let id = $(this).data('id');
        $(this).prepend('\
        <iframe class="video-frame" src="https://www.youtube.com/embed/' + id + '?autoplay=1" allow="autoplay" allowfullscreen></iframe>\
      ');
    });

    $(".cboxElement").colorbox({
        rel:'cboxElement',
        maxWidth: '860px',
        maxHeight: '860px',
        fixed: true,
        current: `{current} из {total}`
    });

    $('.catalog-preview-button').on('click', function () {
        let $catalog = $(this).parents('.catalog-preview');
        let hide = $catalog.hasClass('catalog-preview--show-more');
        collapseCatalogClose(hide, $catalog);
        if (hide) {
            return;
        }
        let label = 'Свернуть';
        $catalog.addClass('catalog-preview--show-more');
        $catalog.find('.catalog-preview-more').stop(true, false, true).slideDown(400);
        $catalog.find('.catalog-preview-button').html(label);
        $catalog.addClass('catalog-preview--index');
    });

    function collapseCatalogClose(hide, $catalog) {
        var $allCatalog = $('.catalog-preview');
        $allCatalog.removeClass('catalog-preview--show-more');
        let label = 'Развернуть';
        $allCatalog.find('.catalog-preview-more').stop(true, false, true).slideUp(400);
        $allCatalog.find('.catalog-preview-button').html(label);
        setTimeout(() => {
            $allCatalog.removeClass('catalog-preview--index');
            if (!hide) {
                $catalog.addClass('catalog-preview--index');
            }
        }, 400);
    }

    // $('.slider-for').slick({
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     arrows: false,
    //     fade: false,
    //     infinite: false,
    //     speed: 400,
    // });
    //
    // $('.slider-nav')
    //     .on('init', function(event, slick) {
    //         $('.slider-nav .slick-slide.slick-current').addClass('is-active');
    //     })
    //     .slick({
    //         slidesToShow: 3,
    //         slidesToScroll: 1,
    //         dots: false,
    //         arrows: false,
    //         focusOnSelect: false,
    //         vertical: true,
    //         infinite: false,
    //         responsive: [{
    //             breakpoint: 1025,
    //             settings: {
    //                 slidesToShow: 3,
    //                 slidesToScroll: 1,
    //             }
    //         }, {
    //             breakpoint: 835,
    //             settings: {
    //                 slidesToShow: 3,
    //                 slidesToScroll: 1,
    //             }
    //         }, {
    //             breakpoint: 481,
    //             settings: {
    //                 slidesToShow: 3,
    //                 slidesToScroll: 1,
    //                 vertical: true
    //             }
    //         }]
    //     });
    //
    // $('.slider-for').on('afterChange', function(event, slick, currentSlide) {
    //     $('.slider-nav').slick('slickGoTo', currentSlide);
    //     var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
    //     $('.slider-nav .slick-slide.is-active').removeClass('is-active');
    //     $(currrentNavSlideElem).addClass('is-active');
    // });
    //
    // $('.slider-nav').on('click', '.slick-slide', function(event) {
    //     event.preventDefault();
    //     var goToSingleSlide = $(this).data('slick-index');
    //
    //     $('.slider-for').slick('slickGoTo', goToSingleSlide);
    // });

    $('.product-gallery-thumb').click(function() {
        // Удаляем класс active со всех миниатюр и добавляем его только к текущей
        $('.product-gallery-thumb').removeClass('product-gallery-thumb--active');
        $(this).addClass('product-gallery-thumb--active');

        // Получаем URL изображения из атрибута data-url
        var newImageUrl = $(this).data('url');

        // Обновляем основное изображение
        $('.product-gallery-image img').attr('src', newImageUrl);
    });

    // Обработчик клика на ссылки табов
    $('.nav-link').click(function(event) {
        event.preventDefault(); // Предотвращаем переход по ссылке

        // Удаляем класс 'active' у всех ссылок и контента табов
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');

        // Добавляем класс 'active' для выбранной ссылки
        $(this).addClass('active');

        // Получаем id контента, связанного с выбранной вкладкой
        var tabContentId = $(this).attr('href');

        // Показываем соответствующий контент таба
        $(tabContentId).addClass('show active');
    });

    var $backToTop = $("#backtotop");
    $backToTop.hide();


    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 100) {
            $backToTop.fadeIn();
        } else {
            $backToTop.fadeOut();
        }
    });

    $backToTop.on('click', function(e) {
        $("html, body").animate({scrollTop: 0}, 500);
    });

    $(document).click(function (e) {
        if ($(e.target).is('.modal')) {
            $('.modal').fadeOut()
            $('html, body').removeClass('no-scroll')
            $('.text-success').fadeOut();
            $('.modal__window-desc, .modal__window-form').fadeIn();
        }
    });

    $(".input-phone").mask("+7 (999) 999-9999");

    $('.call').click(function () {
        $('#modalCal').fadeIn();
    })

    $('.modal-selection').click(function () {
        $('#modalSelection').fadeIn();
    })

    $('.modal-engineer').click(function () {
        $('#modalEngineer').fadeIn();
        ym(45467883,'reachGoal','vh-engineer-callback');
        console.log('45467883')
    })

    $('.modal-price').click(function () {
        $('#modalPrice').fadeIn();
       let productName = $('.product-content h1').text().trim()
        $('.input-product-name').val(productName);
        ym(45467883,'reachGoal','vh-price-request-open-form')
    })

    $('.modal-close').click(function () {
        $('.modal').fadeOut();
        $('.text-success').fadeOut();
        $('.modal__window-desc, .modal__window-form').fadeIn();
    })

    $('.agree input').prop('checked', true)

    if (  $(window).width() > 1120 ) {
        $('.menu-item--catalog, .catalog-nav').mouseenter(function () {
            $('.catalog-nav').addClass('catalog-nav--visible');
            $('.menu-item--catalog').addClass('menu-item--hover');
        });

        $('.menu-item--catalog, .catalog-nav').mouseleave(function () {
            $('.catalog-nav').removeClass('catalog-nav--visible');
            $('.menu-item--catalog').removeClass('menu-item--hover');
        });
    }

    $('.header-toggler').click(function () {
        $('body').toggleClass('show-mobile-nav')
    })

    $(".section-list-wrap").find(".show-more").click(function (){
        var height = $(this).parent().find('.catalog-section-list-tile-list').height() +30;
        $(".section-list-wrap").toggleClass('active');

        if($(".section-list-wrap").hasClass( "active" )){
            $(".section-list-wrap").css('height', '110').animate({height: height}, 250);
        }else{
            $(".section-list-wrap").css('height', height).animate({height: 110}, 250);
        }

    })


})