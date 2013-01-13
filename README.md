Fashion from [LiveStreet CMS](http://livestreetcms.com/ "LiveStreet CMS")
=======================================================================

Описание
--------

Плагин позволяет создвать неограниченное кол-во профилей и полей к ним.

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
* Profile — Профиль пользователя (покупатель, продавец итд)
  * Валидация Entity
  * Правила валидации
  * Сохранение сущности
* Role — роль пользователя (менеджер, админ итд) // В разработке
  * Валидация Entity
  * Правила валидации
  * Сохранение сущности
* Permissions — разрешения пользователя // В разработке
  * Валидация Entity
  * Правила валидации
  * Сохранение сущности

Field (Поля):
* Поле: Любой тип данных
* Поддержка поля: Конфигурование поля через файл конфигурации
* Валидация: Выполняется по правилам фреймворка

Пример валидации:

    protected $aValidateRules=array(
      array('profile_firstname','required', 'isEmpty' => false, 'on'=>array('', 'registration')),
      array('profile_firstname','string', 'on'=>array('', 'registration')), // '' - означает дефолтный сценарий

      array('profile_secondname','required', 'isEmpty' => false, 'on'=>array('', 'registration')),
      array('profile_secondname','string', 'on'=>array('', 'registration')),

      array('profile_experience','required', 'isEmpty' => false, 'on'=>array('', 'registration')),
      array('profile_experience','string', 'on'=>array('', 'registration')),
      array('profile_experience','is_selleted', 'on'=>array('', 'registration')),

      array('profile_gender','required', 'isEmpty' => false, 'on'=>array('', 'registration')),
      array('profile_gender','string', 'on'=>array('', 'registration')),
      array('profile_gender','is_selleted', 'on'=>array('', 'registration')),
    );

    public function ValidateIsSelleted($sValue,$aParams) {
      return 'Не выбран ни один пункт';
    }


Видимость: Настраивается из файла конфигурации (при регистрации, в профиле итд)
Обработчики: Реализованы хуки почти на все необходимые операции

Пример конфигурации:

      $config['useAjax'] = FAlSE;
      $config['LoginEqMail'] = TRUE;

      // Список профелй
      $config['Profiles'] = array(
          'Модель' => 'model',
          'Фотограф' => 'photo',
      );

      // Список полей с привязкой к профилю
      $config['Fields'] = array(
        'profile_firstname' => array(
          'Actions' => array(),
          'Profiles' => array('model', 'photo'),
          'fields' => array('Имя' => 'firstname'),
          'widget' => 'text', // Применяется с модулем http://livestreet.ru/blog/13956.html
          'type' => array( ), // Настройки для поля в БД
        ),
        'profile_secondname' => array(
          'Actions' => array(),
          'Profiles' => array('model', 'photo'),
          'fields' => array('Фамилия' => 'secondname'),
          'widget' => 'text', // Применяется с модулем http://livestreet.ru/blog/13956.html
          'type' => array( ), // Настройки для поля в БД
        ),
        'profile_experience' => array(
          'Actions' => array(),
          'Profiles' => array('model', 'photo'),
          'fields' => array(
            'Нет опыта' => 'NoExperience',
            'Небольшой' => 'Small',
            'Большой' => 'High',
          ),
          'widget' => 'combo', // Применяется с модулем http://livestreet.ru/blog/13956.html
          'type' => array( ), // Настройки для поля в БД
        ),
        'profile_gender' => array(
          'Actions' => array(),
          'Profiles' => array('model', 'photo'),
          'fields' => array(
            'Муж' => 'Male',
            'Жен' => 'Female ',
          ),
          'widget' => 'combo', // Применяется с модулем http://livestreet.ru/blog/13956.html
          'type' => array( ), // Настройки для поля в БД
        ),
      );

Установка
---------

* Переписать в папку plugins/fashion
* Активировать плагин
* Настроить plugins/fashion/config/config.php


В дальнейшем все настройки можно будет выполнять из адмики, используя плагин Config: livestreet.ru/blog/13945.html

В шаблонах сделан задел на будущий модуль Widget (Возможность создавать виджеты простой функцией, аналог виджетов Yii Framework)
Пример:

    {* Имя (текст) *}
    {assign var="profile_firstname" value='profile_firstname'}
    {assign var="profile_firstname_request" value=$_aRequest.plugin.fashion.profile_firstname}
    {assign var="profile_firstname_label" value=$aLang.plugin.fashion.profile_firstname}
    {assign var="profile_firstname_notice" value=$aLang.plugin.fashion.profile_firstname_notice}
    <p><label for="registration-{$profile_firstname}">{$profile_firstname_label}</label>
    <input type="text" name="{$profile_firstname}" id="registration_{$profile_firstname}" value="{$profile_firstname_request}" class="input-text input-width-300 js-ajax-validate" />
    <i class="icon-ok-green validate-ok-field-{$profile_firstname}" style="display: none"></i>
    <i class="icon-question-sign js-tip-help" title="{$profile_firstname_notice}"></i>
    <small class="validate-error-hide validate-error-field-{$profile_firstname}"></small></p>

License
-------
[ ![CC BY-NC](http://i.creativecommons.org/l/by-nc/3.0/88x31.png "CC BY-NC") ](http://creativecommons.org/licenses/by-nc/3.0/ "CC BY-NC")
