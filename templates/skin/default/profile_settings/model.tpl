<h3 class="header-sep">{$aLang.plugin.fashion.title}</h3>

  {if $oProfile}
    XXX
  {/if}

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
  {assign var="profile_gender_notice" value=$aLang.plugin.fashion.profile_gender_notice}
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

  {* Грудь (выпадающий список) *}
  {assign var="profile_chest" value='profile_chest'}
  {assign var="profile_chest_list" value=$oConfig->get('plugin.fashion.profile_chest')}
  {assign var="profile_chest_label" value=$aLang.plugin.fashion.profile_chest}
  {assign var="profile_chest_notice" value=$aLang.plugin.fashion.profile_chest_notice}
  <p><label for="registration-label-{$profile_chest}">{$profile_chest_label}</label>
  <select name="{$profile_chest}" id="{$profile_chest}" class="input-width-full js-ajax-validate">
    <option value="0">{$profile_chest_label}</option>
    {foreach from=$profile_chest_list item=Key}
      <option {if $profile_chest_value==$Key}selected{/if}>{$Key|escape:'html'}</option>
    {/foreach}
  </select>
  <i class="icon-ok-green validate-ok-field-{$profile_chest}" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$profile_chest_notice}"></i>
  <small class="validate-error-hide validate-error-field-{$profile_chest}"></small></p>

  {* Талия (текст) *}
  {assign var="profile_waist" value='profile_waist'}
  {assign var="profile_waist_label" value=$aLang.plugin.fashion.profile_waist}
  {assign var="profile_waist_notice" value=$aLang.plugin.fashion.profile_waist_notice}
  <p><label for="registration-label-{$profile_waist}">{$profile_waist_label}</label>
  <input type="text" name="{$profile_waist}" id="registration-{$profile_waist}" value="{$profile_waist_value}" class="input-text input-width-300 js-ajax-validate" />
  <i class="icon-ok-green validate-ok-field-{$profile_waist}" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$profile_waist_notice}"></i>
  <small class="validate-error-hide validate-error-field-{$profile_waist}"></small></p>

  {* Бедра (текст) *}
  {assign var="profile_hips" value='profile_hips'}
  {assign var="profile_hips_label" value=$aLang.plugin.fashion.profile_hips}
  {assign var="profile_hips_notice" value=$aLang.plugin.fashion.profile_hips_notice}
  <p><label for="registration-label-{$profile_hips}">{$profile_hips_label}</label>
  <input type="text" name="{$profile_hips}" id="registration-{$profile_hips}" value="{$profile_hips_value}" class="input-text input-width-300 js-ajax-validate" />
  <i class="icon-ok-green validate-ok-field-{$profile_hips}" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$profile_hips_notice}"></i>
  <small class="validate-error-hide validate-error-field-{$profile_hips}"></small></p>

  {* Рост (текст) *}
  {assign var="profile_growth" value='profile_growth'}
  {assign var="profile_growth_label" value=$aLang.plugin.fashion.profile_growth}
  {assign var="profile_growth_notice" value=$aLang.plugin.fashion.profile_growth_notice}
  <p><label for="registration-label-{$profile_growth}">{$profile_growth_label}</label>
  <input type="text" name="{$profile_growth}" id="registration-{$profile_growth}" value="{$profile_growth_value}" class="input-text input-width-300 js-ajax-validate" />
  <i class="icon-ok-green validate-ok-field-{$profile_growth}" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$profile_growth_notice}"></i>
  <small class="validate-error-hide validate-error-field-{$profile_growth}"></small></p>

  {* Вес (текст) *}
  {assign var="profile_weight" value='profile_weight'}
  {assign var="profile_weight_label" value=$aLang.plugin.fashion.profile_weight}
  {assign var="profile_weight_notice" value=$aLang.plugin.fashion.profile_weight_notice}
  <p><label for="registration-label-{$profile_weight}">{$profile_weight_label}</label>
  <input type="text" name="{$profile_weight}" id="registration-{$profile_weight}" value="{$profile_weight_value}" class="input-text input-width-300 js-ajax-validate" />
  <i class="icon-ok-green validate-ok-field-{$profile_weight}" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$profile_weight_notice}"></i>
  <small class="validate-error-hide validate-error-field-{$profile_weight}"></small></p>

  {* Цвет волос (выпадающий список) *}
  {assign var="profile_haircolor" value='profile_haircolor'}
  {assign var="profile_haircolor_list" value=$oConfig->get('plugin.fashion.profile_haircolor')}
  {assign var="profile_haircolor_label" value=$aLang.plugin.fashion.profile_haircolor}
  {assign var="profile_haircolor_notice" value=$aLang.plugin.fashion.profile_haircolor_notice}
  <p><label for="registration-label-{$profile_haircolor}">{$profile_haircolor_label}</label>
  <select name="{$profile_haircolor}" id="{$profile_haircolor}" class="input-width-full js-ajax-validate">
    <option value="0">{$profile_haircolor_label}</option>
    {foreach from=$profile_haircolor_list item=Key}
      <option {if $profile_haircolor_value==$Key}selected{/if}>{$Key|escape:'html'}</option>
    {/foreach}
  </select>
  <i class="icon-ok-green validate-ok-field-{$profile_haircolor}" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$profile_haircolor_notice}"></i>
  <small class="validate-error-hide validate-error-field-{$profile_haircolor}"></small></p>

  {* Цвет глаз (выпадающий список) *}
  {assign var="profile_eyes" value='profile_eyes'}
  {assign var="profile_eyes_list" value=$oConfig->get('plugin.fashion.profile_eyes')}
  {assign var="profile_eyes_label" value=$aLang.plugin.fashion.profile_eyes}
  {assign var="profile_eyes_notice" value=$aLang.plugin.fashion.profile_eyes_notice}
  <p><label for="registration-label-{$profile_eyes}">{$profile_eyes_label}</label>
  <select name="{$profile_eyes}" id="{$profile_eyes}" class="input-width-full js-ajax-validate">
    <option value="0">{$profile_eyes_label}</option>
    {foreach from=$profile_eyes_list item=Key}
      <option {if $profile_eyes_value==$Key}selected{/if}>{$Key|escape:'html'}</option>
    {/foreach}
  </select>
  <i class="icon-ok-green validate-ok-field-{$profile_eyes}" style="display: none"></i>
  <i class="icon-question-sign js-tip-help" title="{$profile_eyes_notice}"></i>
  <small class="validate-error-hide validate-error-field-{$profile_eyes}"></small></p>