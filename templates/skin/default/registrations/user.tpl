{if $header}{include file='header.tpl' noShowSystemMessage=false}{/if}

{assign var="sTemplatePathPlugin" value=$aTemplatePathPlugin.fashion}
{include file="$sTemplatePathPlugin/registrations/forms_js.tpl" ProfileName=$ProfileName}

<form action="{router page="fashion_register/$ProfileName"}" method="post" id="register-{$ProfileName}-form">
  {hook run='form_registration_begin' isPopup=true}

  {* Имя (текст) *}
  <p><label for="registration-label-{$profile_firstname}">{$profile_firstname_label}</label>
  <input type="text" name="{$profile_firstname}" id="registration-{$profile_firstname}" value="{$profile_firstname_value}" class="input-text input-width-300 js-ajax-validate" />
  <i class="icon-ok-green validate-ok-field-{$profile_firstname}" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$profile_firstname_notice}"></i>
  <small class="validate-error-hide validate-error-field-{$profile_firstname}"></small></p>

  {* Фамилия (текст) *}
  <p><label for="registration-label-{$profile_secondname}">{$profile_secondname_label}</label>
  <input type="text" name="{$profile_secondname}" id="registration-{$profile_secondname}" value="{$profile_secondname_value}" class="input-text input-width-300 js-ajax-validate" />
  <i class="icon-ok-green validate-ok-field-{$profile_secondname}" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$profile_secondname_notice}"></i>
  <small class="validate-error-hide validate-error-field-{$profile_secondname}"></small></p>

  <p><label for="popup-registration-mail">{$aLang.registration_mail}</label>
  <input type="text" name="mail" id="popup-registration-mail" value="{$_aRequest.mail}" class="input-text input-width-300 js-ajax-validate" />
  <i class="icon-ok-green validate-ok-field-mail" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$aLang.registration_mail_notice}"></i>
  <small class="validate-error-hide validate-error-field-mail"></small></p>

  <p><label for="popup-registration-user-password">{$aLang.registration_password}</label>
  <input type="password" name="password" id="user-password" value="" class="input-text input-width-300 js-ajax-validate" />
  <i class="icon-ok-green validate-ok-field-password" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$aLang.registration_password_notice}"></i>
  <small class="validate-error-hide validate-error-field-password"></small></p>

  <p><label for="popup-registration-user-password-confirm">{$aLang.registration_password_retry}</label>
  <input type="password" value="" id="user-password-confirm" name="password_confirm" class="input-text input-width-300 js-ajax-validate" />
  <i class="icon-ok-green validate-ok-field-password_confirm" style="display: none"></i>
  <small class="validate-error-hide validate-error-field-password_confirm"></small></p>

  {hookb run="popup_registration_captcha"}
  <p><label for="popup-registration-captcha">{$aLang.registration_captcha}</label>
  <img src="{cfg name='path.root.engine_lib'}/external/kcaptcha/index.php?{$_sPhpSessionName}={$_sPhpSessionId}"
     onclick="this.src='{cfg name='path.root.engine_lib'}/external/kcaptcha/index.php?{$_sPhpSessionName}={$_sPhpSessionId}&n='+Math.random();"
     class="captcha-image" />
  <input type="text" name="captcha" id="popup-registration-captcha" value="" maxlength="3" class="input-text input-width-100 js-ajax-validate" />
  <small class="validate-error-hide validate-error-field-captcha"></small></p>
  {/hookb}

  {hook run='form_registration_end' isPopup=true}

  <input type="hidden" name="profile_type" value="{$ProfileName}">
  <input type="hidden" name="return-path" value="{$PATH_WEB_CURRENT|escape:'html'}">
  <button type="submit" name="submit_register" class="button button-primary" id="register-{$ProfileName}-form-submit">{$aLang.registration_submit}</button>
</form>


{if $footer}{include file='footer.tpl'}{/if}