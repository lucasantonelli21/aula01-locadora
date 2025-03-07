$(".page-profile-edit", function(){

    var $page = $(this);

    var $checkboxButton = $page.find('.render-password');
    var $passwordConfirmation = $page.find('.password-confirmation');
    var $passwordBox = $page.find('.password-box');
    var $newPassword = $page.find('.new-password');
    var $password = $page.find('.password');
    var $imgCheck = $page.find('.img-check');

    $checkboxButton.on('change', function (){
        $passwordBox.toggleClass('d-none');
        console.log($checkboxButton.val());
        if($checkboxButton.is(":checked")){
            $passwordConfirmation.attr('required',true);
            $newPassword.attr('required',true);
            $password.attr('required',true);

        }else{
            $passwordConfirmation.removeAttr('required');
            $newPassword.removeAttr('required');
            $password.removeAttr('required');
        }
    });

    $passwordConfirmation.keyup(function(){

        if($newPassword.val() == $(this).val()){
            $imgCheck.css('visibility', 'visible');
        }else{
            $imgCheck.css('visibility', 'hidden');
        }

    });

});



$(".page-form-rent", function(){

    var $page = $(this);
    var $emailSelect2 =  $('.select2').select2({
        width: "100%",
        placeholder : "Insira o e-mail do cliente",
        // dropdownCssClass: "drop-down-select",
        // selectionCssClass: ":all:",
        // theme: "classic",
        language: {
            "noResults": function(){
                return "Não foi encontrado nenhum e-mail com esses caracteres ! ";
            }
        },
        ajax: {
            url: "http://127.0.0.1:8000/clientes/email",
            delay: 200,
            data: function(params){
                var query = {
                    search: params.term,
                    type: 'public'
                  }
                return query;
            },
            processResults: function(data){
                return {results: data};
            }
        }


      });

});





