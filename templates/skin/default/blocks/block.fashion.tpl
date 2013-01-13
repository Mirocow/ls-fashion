<!-- Fashion plugin -->
{if !$oUserCurrent}

  <section class="block">
    <header class="block-header">
      <h3>Регистрация</h3>
    </header>
    <div class="block-content">
      <div class="js-block-profile-content" data-type="all">
      <ul class="profiles">
          {foreach from=$oConfig->get('plugin.fashion.Profiles') item=Key key=Name}
            <li><a href="{router page='fashion_register'}{$Key}" class="js-register_{$Key}-form-show {$Key}">{$Name}</a></li>
          {/foreach}
      </ul>
      </div>
    </div>
  </section>

  {* Регистрация формы регистрации в всплывающем окне *}
  {if $useAjax}
  {literal}<script type="text/javascript">{/literal}
  {foreach from=$oConfig->get('plugin.fashion.Profiles') item=Key key=Name}
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
          {foreach from=$oConfig->get('plugin.fashion.Profiles') item=Key key=Name}
            <li class="{*if $key eq 'moel'}active{/if*} js-block-popup-register-item" data-type="register_{$Key}"><a href="#">{$Name}</a></li>
          {/foreach}
        </ul>

        {foreach from=$oConfig->get('plugin.fashion.Profiles') item=Key key=Name}
          <div class="tab-content js-block-popup-register-content" data-type="register_{$Key}" style="display:none;">
            {hook run='fashion_register_begin' isPopup=true}
              {assign var="sTemplatePathPlugin" value=$aTemplatePathPlugin.fashion}
              {include file="$sTemplatePathPlugin/registrations/`$Key`_form.tpl" Key=$Key useAjax=$useAjax}
            {hook run='fashion_register_end' isPopup=true}
          </div>
        {/foreach}
      </div>

  </div>

{/if}
<!-- /Fashion plugin -->
