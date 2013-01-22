<h3 class="header-sep">{$aLang.plugin.fashion.title}</h3>

 {* Имя (текст) *}
  {assign var="profile_firstname" value='profile_firstname'}
  {*assign var="profile_firstname_value" value="XXX"*}
  {assign var="profile_firstname_label" value=$aLang.plugin.fashion.profile_firstname}
  {assign var="profile_firstname_notice" value=$aLang.plugin.fashion.profile_firstname_notice}
  <p><label for="label-{$profile_firstname}">{$profile_firstname_label}</label>
  <input type="text" name="{$profile_firstname}" id="{$profile_firstname}" value="{$profile_firstname_value}" class="input-text input-width-300 js-ajax-validate" />
  <i class="icon-ok-green validate-ok-field-{$profile_firstname}" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$profile_firstname_notice}"></i>
  <small class="validate-error-hide validate-error-field-{$profile_firstname}"></small></p>

  {* Фамилия (текст) *}
  {assign var="profile_secondname" value='profile_secondname'}
  {*assign var="profile_secondname_value" value="YYY"*}
  {assign var="profile_secondname_label" value=$aLang.plugin.fashion.profile_secondname}
  {assign var="profile_secondname_notice" value=$aLang.plugin.fashion.profile_secondname_notice}
  <p><label for="label-{$profile_secondname}">{$profile_secondname_label}</label>
  <input type="text" name="{$profile_secondname}" id="{$profile_secondname}" value="{$profile_secondname_value}" class="input-text input-width-300 js-ajax-validate" />
  <i class="icon-ok-green validate-ok-field-{$profile_secondname}" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$profile_secondname_notice}"></i>
  <small class="validate-error-hide validate-error-field-{$profile_secondname}"></small></p>