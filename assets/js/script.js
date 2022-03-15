$(document).ready(function () {
    //Limites
    min = 1;
    max = 50; //Habria que discutir un máximo
    var timeout;
    $("#number-pattern").change(function () { //Cuando detecta un cambio mira si ha superado el maximo o el minimo y lo cambia
        try {
            var valor = parseInt($("#number-pattern").val());
            if (valor < min) {
                $("#number-pattern").val(min);
            } else if (valor > max) {
                $("#number-pattern").val(max);
            }
        } catch (Exception) {
            $("#number-pattern").val(min);
        }
    });

    $("#restar").mousedown(function () { //Resta valores del cotador
        var valor = Number($("#number-pattern").val());
        if (valor > min) { //Si es mayor que el limite
            $("#number-pattern").val(valor - 1); //Restamos uno valor
        }
        timeout = setInterval(function () {
            var valor = Number($("#number-pattern").val());
            if (valor > min) { //Si es mayor que el limite
                $("#number-pattern").val(valor - 1); //Restamos uno valor
            }
        }, 100);
        return false;
    });

    $("#sumar").mousedown(function () { //Suma valores del contador
        var valor = Number($("#number-pattern").val());
        if (valor >= 0 && valor < max) { //Si esta entre los limites
            $("#number-pattern").val(valor + 1); //Sumamos uno al valor
        }
        timeout = setInterval(function () {
            var valor = Number($("#number-pattern").val());
            if (valor >= 0 && valor < max) { //Si esta entre los limites
                $("#number-pattern").val(valor + 1); //Sumamos uno al valor
            }
        }, 100);
        return false;
    });

    $(document).mouseup(function () {
        clearInterval(timeout);
        return false;
    });
});
//Subir y Bajar la fecha del Saber Más-----------------------------------------------------------------------------------------------------------------------
function bajar() {
    var obj = document.getElementById("imag");
    obj.style.marginTop = "10px";
    obj.style.transition = "all 0.2s ease-in-out";
}

function subir() {
    var obj = document.getElementById("imag");
    obj.style.marginTop = "0px";
    obj.style.transition = "all 0.2s ease-in-out";
}
(function ($) {
    $.fn.nodoubletapzoom = function () {
        $(this).bind('touchstart', function preventZoom(e) {
            var t2 = e.timeStamp
                , t1 = $(this).data('lastTouch') || t2
                , dt = t2 - t1
                , fingers = e.originalEvent.touches.length;
            $(this).data('lastTouch', t2);
            if (!dt || dt > 500 || fingers > 1) return; // not double-tap

            e.preventDefault(); // double tap - prevent the zoom
            // also synthesize click events we just swallowed up
            $(this).trigger('click').trigger('click');
        });
    };
})(jQuery);
(function ($) {
    var IS_IOS = /iphone|ipad/i.test(navigator.userAgent);
    $.fn.nodoubletapzoom = function () {
        if (IS_IOS)
            $(this).bind('touchstart', function preventZoom(e) {
                var t2 = e.timeStamp
                    , t1 = $(this).data('lastTouch') || t2
                    , dt = t2 - t1
                    , fingers = e.originalEvent.touches.length;
                $(this).data('lastTouch', t2);
                if (!dt || dt > 500 || fingers > 1) return; // not double-tap

                e.preventDefault(); // double tap - prevent the zoom
                // also synthesize click events we just swallowed up
                $(this).trigger('click').trigger('click');
            });
    };
})(jQuery)
$(document).ready(function(){

    // Slide in elements on scroll
    $(window).scroll(function() {
        $(".slideanim").each(function(){
            var pos = $(this).offset().top;

            var winTop = $(window).scrollTop();
            if (pos < winTop + 600) {
                $(this).addClass("slide");
            }
        });
    });
})
//-----------------Slide In desde la Arriba Bajo----------------
$(document).ready(function() {
    $(window).scroll(function() {
        $(".RevealLeft").each(function() {
            var pos = $(this).offset().top;
            var winTop = $(window).scrollTop();
            if (pos < winTop + 700) {
                $(this).addClass("revealLeft");
            }
        });
    });
});