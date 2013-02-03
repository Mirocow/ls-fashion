<!-- Fashion plugin -->
{if !$oUserCurrent}

  <section class="block">
    <header class="block-header">
      <h3>Регистрация</h3>
      {*<a href="{router page='login'}">{$aLang.user_login_submit}</a>*}
    </header>
    <div class="block-content">
      <div class="js-block-profile-content" data-type="all">
      <ul class="profiles">
          {foreach from=$aProfiles key=Key item=Name}
            <li><a href="{router page='fashion_register'}{$Key}" class="js-register_{$Key}-form-show {$Key}">{$Name}</a></li>
          {/foreach}
      </ul>
      </div>
    </div>
  </section>

  {* Регистрация формы регистрации в всплывающем окне *}
  {if $useAjax}
    {literal}<script type="text/javascript">{/literal}
    {foreach from=$aProfiles key=Key item=Name}
    {literal}
      $('.js-register_{/literal}{$Key}{literal}-form-show').click(function(){
        if (ls.blocks.switchTab('register_{/literal}{$Key}{literal}','popup-register')) {
          $('#window_register_form').jqmShow();
        } else {
          window.location=aRouter.fashion_register;
        }
        return false;
      });
    {/literal}
    {/foreach}
    {literal}</script>{/literal}
  {/if}


  <div class="modal modal-register" id="window_register_form">

      <header class="modal-header">
        <h3>{$aLang.user_registration}</h3>
        <a href="#" class="close jqmClose"></a>
      </header>

      <div class="modal-content">
        <ul class="nav nav-pills nav-pills-tabs">
          {foreach from=$aProfiles key=Key item=Name}
            <li class="{*if $key eq 'moel'}active{/if*} js-block-popup-register-item" data-type="register_{$Key}"><a href="#">{$Name}</a></li>
          {/foreach}
        </ul>

        {foreach from=$aProfiles key=Key item=Name}
          <div class="tab-content js-block-popup-register-content" data-type="register_{$Key}" style="display:none;">
            {hook run='fashion_register_begin' isPopup=true}
              {if $sTemplatePathPlugin = $LS->GetModuleObject('PluginFashion_ModuleProfile')->getProfileTemplate($Key, 'registrations')}

                {* Заполняем шаблоны для Ajax*}
                {if $useAjax}

                {/if}

                {include file="$sTemplatePathPlugin" ProfileName=$Key useAjax=$useAjax}
              {/if}
            {hook run='fashion_register_end' isPopup=true}
          </div>
        {/foreach}
      </div>

  </div>

{/if}
<!-- /Fashion plugin -->
