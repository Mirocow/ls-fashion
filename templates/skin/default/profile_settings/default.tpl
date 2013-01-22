<h3 class="header-sep">{$aLang.plugin.fashion.title}</h3>

  {* Имя (текст) *}
  {assign var="profile_firstname" value='profile_firstname'}
  {assign var="profile_firstname_label" value=$aLang.plugin.fashion.profile_firstname}
  {assign var="profile_firstname_notice" value=$aLang.plugin.fashion.profile_firstname_notice}
  <p><label for="registration-label-{$profile_firstname}">{$profile_firstname_label}</label>
  <input type="text" name="{$profile_firstname}" id="registration-{$profile_firstname}" value="{$profile_firstname_value}" class="input-text input-width-300 js-ajax-validate" />
  <i class="icon-ok-green validate-ok-field-{$profile_firstname}" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$profile_firstname_notice}"></i>
  <small class="validate-error-hide validate-error-field-{$profile_firstname}"></small></p>

  {* Фамилия (текст) *}
  {assign var="profile_secondname" value='profile_secondname'}
  {assign var="profile_secondname_label" value=$aLang.plugin.fashion.profile_secondname}
  {assign var="profile_secondname_notice" value=$aLang.plugin.fashion.profile_secondname_notice}
  <p><label for="registration-label-{$profile_secondname}">{$profile_secondname_label}</label>
  <input type="text" name="{$profile_secondname}" id="registration-{$profile_secondname}" value="{$profile_secondname_value}" class="input-text input-width-300 js-ajax-validate" />
  <i class="icon-ok-green validate-ok-field-{$profile_secondname}" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$profile_secondname_notice}"></i>
  <small class="validate-error-hide validate-error-field-{$profile_secondname}"></small></p>

  {* Опыт работы (выпадающий список) *}
  {*
    Нет опыта
    Небольшой
    Большой
  *}
  {assign var="profile_experience" value='profile_experience'}
  {assign var="profile_experience_list" value=$oConfig->get('plugin.fashion.profile_experience')}
  {assign var="profile_experience_label" value=$aLang.plugin.fashion.profile_experience}
  {assign var="profile_experience_notice" value=$aLang.plugin.fashion.profile_experience_notice}
  <p><label for="registration-label-{$profile_experience}">{$profile_experience_label}</label>
  <select name="{$profile_experience}" id="{$profile_experience}" class="input-width-full js-ajax-validate">
    <option value="0">{$profile_experience_label}</option>
    {foreach from=$profile_experience_list item=Key}
      {assign var="sProfileFieldName" value=$aLang.plugin.fashion.profile_experience_fields.$Key}
      <option value="{$Key}" {if $profile_experience_value==$Key}selected{/if}>{$sProfileFieldName|escape:'html'}</option>
    {/foreach}
  </select>
  <i class="icon-ok-green validate-ok-field-{$profile_experience}" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$profile_experience_notice}"></i>
  <small class="validate-error-hide validate-error-field-{$profile_experience}"></small></p>

  {* Пол (выпадающий список) *}
  {assign var="profile_gender" value='profile_gender'}
  {assign var="profile_gender_list" value=$oConfig->get('plugin.fashion.profile_gender')}
  {assign var="profile_gender_label" value=$aLang.plugin.fashion.profile_gender}
  {assign var="profile_gender_notice" value=$aLang.plugin.fashion.profile_gender}
  <p><label for="registration-label-{$profile_gender}">{$profile_gender_label}</label>
  <select name="{$profile_gender}" id="{$profile_gender}" class="input-width-full js-ajax-validate">
    <option value="0">{$profile_gender_label}</option>
    {foreach from=$profile_gender_list item=Key}
      {assign var="sProfileFieldName" value=$aLang.plugin.fashion.profile_gender_fields.$Key}
      <option value="{$Key}" {if $profile_gender_value==$Key}selected{/if}>{$sProfileFieldName|escape:'html'}</option>
    {/foreach}
  </select>
  <i class="icon-ok-green validate-ok-field-{$profile_gender}" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$profile_gender_notice}"></i>
  <small class="validate-error-hide validate-error-field-{$profile_gender}"></small></p>