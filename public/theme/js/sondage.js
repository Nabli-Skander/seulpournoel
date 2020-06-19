//
$(function () {
    $('#forSondage').on('submit', function (e) {
        e.preventDefault();
        let requiredCheckboxes = $('.checkboxForm'),
            i, cpt =0,element=$(this);


        for (i = 0; i < requiredCheckboxes.length; i++) {
            if (requiredCheckboxes[i].checked) {
                cpt++
            }

        }

        if (cpt > 0) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                data: $('#forSondage').serialize(),
                success: function () {
                    $(".error_message").removeClass("active");
                    element.children('#formActive').hide(300);
                    element.children('h2').hide(300);
                    element.children('h3').hide(300);
                    $(".ok_message").addClass("active");
                },
                error: function () {
                    $(".error_message")[0].children[0].innerHTML = 'Une erreur technique est survenue veuillez réessayer dans quelques instants';
                    $(".error_message").addClass("active");
                }
            });

        } else {
            $(".error_message")[0].children[0].innerHTML = 'Merci de remplire correctement le formulaire.';
            $(".error_message").addClass("active");
        }

    });

    $(".skill-figure").each(function(){
        let time= 45;
        let $this = this;
        let i = 0;
        let id = $(this).attr('id');
        let tx = $(this).attr('data-taux');
        let teinte = $(this).attr('data-color');
        let color1 = "hsl(" + teinte + ", 0%, 50%)";
        let color2 = "hsl(" + teinte + ", 60%, 0%)";
        let mylet = setInterval(function(){ setColor() }, time);

        function setColor() {
            if (i <= Math.round(tx)) {
                let bg = "conic-gradient(from 0deg," + color1 +""+ i +"%," + color2 +""+ i +"%)"
                $($this).css("background", bg);
                $('.skill-output', $this).html(i+"%");
                i++
            }
            else {function stopColor() {clearInterval(mylet);}}
        }
    });
});