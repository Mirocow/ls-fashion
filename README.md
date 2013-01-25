Fashion from [LiveStreet CMS](http://livestreetcms.com/ "LiveStreet CMS")
=======================================================================

Описание
--------

Плагин позволяет создавать неограниченное кол-во профилей и полей к ним.

Возможности
-----------

Возможности:
* Сущность профилей
* Сущность полей
* Вывод полей в профиле пользователя
* Редактирование полей
* Модуль будет поддерживать выбор профиля при регистрации
* Модуль будет совместим с темой Social и будет поддерживать Ajax
* Настройки выполняются из файла конфигурации

Сущности:
* Field — Поле профиля (текстовое поле, список итд)
  * Валидация Entity
  * Правила валидации
  * Сохранение сущности
  * Сдержит ссылку на профиль
* Profile — Профиль пользователя (покупатель, продавец итд)
  * Валидация Entity
  * Правила валидации
  * Сохранение сущности
* Role — роль пользователя (менеджер, админ итд) // В разработке
  * Валидация Entity
  * Правила валидации
  * Сохранение сущности
  * Содержит список Permissions
* Permissions — разрешения пользователя // В разработке
  * Валидация Entity
  * Правила валидации
  * Сохранение сущности

Field (Поля):
* Поле: Любой тип данных
* Поддержка поля: Конфигурование поля через файл конфигурации
* Валидация: Выполняется по правилам фреймворка и сожержится в config.php

Видимость: Настраивается из файла конфигурации (при регистрации, в профиле итд)
Обработчики: Реализованы хуки почти на все необходимые операции

Пример конфигурации:

	$config['useAjax'] = FAlSE;
	$config['LoginEqMail'] = TRUE;
	
	// Список профелей
	$config['Profiles'] = array(
	    'programmer',
	    'makeup_man',
			'user',		
	);
	
	// Список полей с привязкой к профилю
	$config['Fields'] = array(
	
	  'profile_firstname' => array(
	    'Actions' => array(),
	    'widget' => 'text', // Применяется с модулем http://livestreet.ru/blog/13956.html
	    'type' => array( ), // Настройки для поля в БД
	    // Правила проверки поля
	    'aValidateRules' => array(
	      array('required', 'isEmpty' => false, 'on'=>array(
	        '',
	        'registration_programmer',
	        'registration_makeup_man',
	        'registration_user',				
	      )),
	      array('string', 'on'=>array(
	        '',
	        'registration_programmer',
	        'registration_makeup_man',
	        'registration_user',
	      )),
	    ),
	  ),
	
	  'profile_secondname' => array(
	    'Actions' => array(),
	    'widget' => 'text', // Применяется с модулем http://livestreet.ru/blog/13956.html
	    'type' => array( ), // Настройки для поля в БД
	    // Правила проверки поля
	    'aValidateRules' => array(
	      array('required', 'isEmpty' => false, 'on'=>array(
	        '',
	        'registration_programmer',
	        'registration_makeup_man',
	        'registration_user',
	      )),
	      array('string', 'on'=>array(
	        '',
	        'registration_programmer',
	        'registration_makeup_man',
	        'registration_user',
	      )),
	    ),
	  ),
	
	  'profile_experience' => array(
	    'Actions' => array(),
	    'fields' => array(
	      'Без опыта',		
	      'Начинающий',
	      'Опытный',
	      'Ведущий разработчик',
	    ),
	    'widget' => 'combo', // Применяется с модулем http://livestreet.ru/blog/13956.html
	    'type' => array( ), // Настройки для поля в БД
	    // Правила проверки поля
	    'aValidateRules' => array(
	      array('required', 'isEmpty' => false, 'on'=>array(
	        '',
	        'registration_programmer',
	        'registration_makeup_man',
	      )),
	      array('string', 'on'=>array(
	        '',
	        'registration_programmer',
	        'registration_makeup_man',
	      )),
	      array('is_selected', 'on'=>array(
	        '',
	        'registration_programmer',
	        'registration_makeup_man',
	      ))
	    ),
	  ),
	
	);

Установка
---------

* Переписать в папку plugins/fashion
* Активировать плагин
* Настроить plugins/fashion/config/config.php


В дальнейшем все настройки можно будет выполнять из адмики, используя плагин ls-config: http://ls.mirocow.com/blog/ls-config/

В шаблонах сделан задел на будущий модуль ls-widget (Возможность создавать виджеты простой функцией, аналог виджетов Yii Framework)
http://ls.mirocow.com/blog/ls-widget/

Пример:

	  {* Имя (текст) *}
	  {assign var="profile_firstname" value='profile_firstname'}
	  {assign var="profile_firstname_value" value=$_aRequest.profile_firstname}
	  {assign var="profile_firstname_label" value=$aLang.plugin.fashion.profile_firstname}
	  {assign var="profile_firstname_notice" value=$aLang.plugin.fashion.profile_firstname_notice}
	  <p><label for="registration-label-{$profile_firstname}">{$profile_firstname_label}</label>
	  <input type="text" name="{$profile_firstname}" id="registration-{$profile_firstname}" value="{$profile_firstname_value}" class="input-text input-width-300 js-ajax-validate" />
	  <i class="icon-ok-green validate-ok-field-{$profile_firstname}" style="display: none"></i>
	  <i class="icon-question-sign js-tip-help" title="{$profile_firstname_notice}"></i>
	  <small class="validate-error-hide validate-error-field-{$profile_firstname}"></small></p>
	
	  {* Фамилия (текст) *}
	  {assign var="profile_secondname" value='profile_secondname'}
	  {assign var="profile_secondname_value" value=$_aRequest.profile_secondname}
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
	  {assign var="profile_experience_value" value=$_aRequest.profile_experience}
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

License
-------
[ ![CC BY-NC](http://i.creativecommons.org/l/by-nc/3.0/88x31.png "CC BY-NC") ](http://creativecommons.org/licenses/by-nc/3.0/ "CC BY-NC")
