{*if $useAjax*}
  <script type="text/javascript">
    jQuery(document).ready(function($){

      // Вешаем обработчик на input.js-ajax-validate
      $('#register-form').find('input.js-ajax-validate').blur(function(e){
        var aParams={ };
        if ($(e.target).attr('name')=='password_confirm') {
          aParams['password']=$('#user-password').val();
        }
        if ($(e.target).attr('name')=='password') {
          aParams['password']=$('#user-password').val();
          if ($('#user-password-confirm').val()) {
            ls.user.validateRegistrationField(
              'password_confirm',
              $('#user-password-confirm').val(),
              $('#register-form'),
              { 'password': $(e.target).val() }
            );
          }
        }
        // Валидация полей
        ls.user.validateRegistrationField(
          $(e.target).attr('name'),
          $(e.target).val(),
          $('#register-form'),
          aParams
        );
      });

      // Вешаем обработчик на select.js-ajax-validate
      $('#register-form').find('select.js-ajax-validate').change(function(e){
        var aParams={ };
        // Валидация полей
        ls.user.validateRegistrationField(
          $(e.target).attr('name'),
          $(e.target).val(),
          $('#register-form'),
          aParams
        );
      });

      // Вешаем обработчик на select.js-ajax-validate
      $('#register-form').find('select.js-ajax-validate').mouseover(function(e){
        var aParams={ };
        // Валидация полей
        ls.user.validateRegistrationField(
          $(e.target).attr('name'),
          $(e.target).val(),
          $('#register-form'),
          aParams
        );
      });

      // Вешаем обработчик на select.js-ajax-validate
      {*$('#register-form').find('select.js-ajax-validate').mouseout(function(e){
        var aParams={ };
        // Валидация полей
        ls.user.validateRegistrationField(
          $(e.target).attr('name'),
          $(e.target).val(),
          $('#register-form'),
          aParams
        );
      });*}

      // Сабмит
      $('#register-form').bind('submit',function(){
        // Отключаем кнопки
        $('#register-form-submit').attr('disabled',true);
        ls.user.registration('register-form');
        return false;
      });

      $('#register-form-submit').attr('disabled',false);
    });
  </script>
{*/if*}