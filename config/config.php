<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/

$config['useAjax'] = FAlSE;
$config['LoginEqMail'] = TRUE;

// Список профелей
$config['Profiles'] = array(
    'Модели' => 'model',
    'Фотографы' => 'photo',
    'Стилисты/Визажисты' => 'stylist',
    'Музыканты' => 'musician',
    'Певцы' => 'singer',
    'Актеры' => 'actor',
    'Кастинг директоры' => 'casting',
    'Скауты/Агенты' => 'agent',
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
        'registration_model',
        'registration_photo',
        'registration_stylist',
        'registration_musician',
        'registration_singer',
        'registration_actor',
        'registration_casting',
        'registration_agent',
      )),
      array('string', 'on'=>array(
        '',
        'registration_model',
        'registration_photo',
        'registration_stylist',
        'registration_musician',
        'registration_singer',
        'registration_actor',
        'registration_casting',
        'registration_agent',
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
        'registration_model',
        'registration_photo',
        'registration_stylist',
        'registration_musician',
        'registration_singer',
        'registration_actor',
        'registration_casting',
        'registration_agent',
      )),
      array('string', 'on'=>array(
        '',
        'registration_model',
        'registration_photo',
        'registration_stylist',
        'registration_musician',
        'registration_singer',
        'registration_actor',
        'registration_casting',
        'registration_agent',
      )),
    ),
  ),

  'profile_experience' => array(
    'Actions' => array(),
    'fields' => array(
      'NoExperience',
      'Small',
      'High',
    ),
    'widget' => 'combo', // Применяется с модулем http://livestreet.ru/blog/13956.html
    'type' => array( ), // Настройки для поля в БД
    // Правила проверки поля
    'aValidateRules' => array(
      array('required', 'isEmpty' => false, 'on'=>array(
        '',
        'registration_model',
        'registration_photo',
        'registration_stylist',
        'registration_musician',
        'registration_singer',
        'registration_actor',
        'registration_casting',
        'registration_agent',
      )),
      array('string', 'on'=>array(
        '',
        'registration_model',
        'registration_photo',
        'registration_stylist',
        'registration_musician',
        'registration_singer',
        'registration_actor',
        'registration_casting',
        'registration_agent',
      )),
      array('is_selected', 'on'=>array(
        '',
        'registration_model',
        'registration_photo',
        'registration_stylist',
        'registration_musician',
        'registration_singer',
        'registration_actor',
        'registration_casting',
        'registration_agent',
      ))
    ),
  ),

  'profile_gender' => array(
    'Actions' => array(),
    'fields' => array(
      'Male',
      'Female',
    ),
    'widget' => 'combo', // Применяется с модулем http://livestreet.ru/blog/13956.html
    'type' => array( ), // Настройки для поля в БД
    // Правила проверки поля
    'aValidateRules' => array(
      array('required', 'isEmpty' => false, 'on'=>array(
        'registration_model',
        'registration_photo',
        'registration_stylist',
        'registration_musician',
        'registration_singer',
        'registration_actor',
        'registration_casting',
        'registration_agent',
      )),
      array('string', 'on'=>array(
        'registration_model',
        'registration_photo',
        'registration_stylist',
        'registration_musician',
        'registration_singer',
        'registration_actor',
        'registration_casting',
        'registration_agent',
      )),
      array('is_selected', 'on'=>array(
        'registration_model',
        'registration_photo',
        'registration_stylist',
        'registration_musician',
        'registration_singer',
        'registration_actor',
        'registration_casting',
        'registration_agent',
      ))
    ),
  ),

  //
  // Жен
  //
  'profile_chest' => array(
    'Actions' => array(),
    'fields' => array(
      0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5, 5.5, 6
    ),
    'widget' => 'combo', // Применяется с модулем http://livestreet.ru/blog/13956.html
    'type' => array( ), // Настройки для поля в БД
    // Правила проверки поля
    'aValidateRules' => array(
      array('required', 'isEmpty' => false, 'on'=>array(
        'registration_model',
      )),
      array('string', 'on'=>array(
        'registration_model',
      )),
      array('is_selected', 'on'=>array(
        'registration_model',
      ))
    ),
  ),

  'profile_waist' => array(
    'Actions' => array(),
    'widget' => 'text', // Применяется с модулем http://livestreet.ru/blog/13956.html
    'type' => array( ), // Настройки для поля в БД
    // Правила проверки поля
    'aValidateRules' => array(
      array('required', 'isEmpty' => false, 'on'=>array(
        '',
        'registration_model',
      )),
      array('string', 'on'=>array(
        '',
        'registration_model',
      )),
    ),
  ),

  'profile_hips' => array(
    'Actions' => array(),
    'widget' => 'text', // Применяется с модулем http://livestreet.ru/blog/13956.html
    'type' => array( ), // Настройки для поля в БД
    // Правила проверки поля
    'aValidateRules' => array(
      array('required', 'isEmpty' => false, 'on'=>array(
        '',
        'registration_model',
      )),
      array('string', 'on'=>array(
        '',
        'registration_model',
      )),
    ),
  ),

  //
  //
  //

  'profile_growth' => array(
    'Actions' => array(),
    'widget' => 'text', // Применяется с модулем http://livestreet.ru/blog/13956.html
    'type' => array( ), // Настройки для поля в БД
    // Правила проверки поля
    'aValidateRules' => array(
      array('required', 'isEmpty' => false, 'on'=>array(
        'registration_model',
        'registration_actor',
      )),
      array('string', 'on'=>array(
        'registration_model',
        'registration_actor',
      )),
    ),
  ),

  'profile_weight' => array(
    'Actions' => array(),
    'widget' => 'text', // Применяется с модулем http://livestreet.ru/blog/13956.html
    'type' => array( ), // Настройки для поля в БД
    // Правила проверки поля
    'aValidateRules' => array(
      array('required', 'isEmpty' => false, 'on'=>array(
        'registration_model',
        'registration_actor',
      )),
      array('string', 'on'=>array(
        'registration_model',
        'registration_actor',
      )),
    ),
  ),

  'profile_haircolor' => array(
    'Actions' => array(),
    'fields' => array(
      'блонд',
      'светло-русый',
      'русый',
      'темно-русый',
      'рыжий',
      'седой',
      'светло-каштановый',
      'каштановый',
      'темно-каштановый',
      'черный',
      'другой'
    ),
    'widget' => 'combo', // Применяется с модулем http://livestreet.ru/blog/13956.html
    'type' => array( ), // Настройки для поля в БД
    // Правила проверки поля
    'aValidateRules' => array(
      array('required', 'isEmpty' => false, 'on'=>array(
        'registration_model',
        'registration_actor',
      )),
      array('string', 'on'=>array(
        'registration_model',
        'registration_actor',
      )),
      array('is_selected', 'on'=>array(
        'registration_model',
        'registration_actor',
      ))
    ),
  ),

  'profile_eyes' => array(
    'Actions' => array(),
    'fields' => array(
      'голубой',
      'зеленый',
      'карий',
      'серый',
      'черный',
      'другой'
    ),
    'widget' => 'combo', // Применяется с модулем http://livestreet.ru/blog/13956.html
    'type' => array( ), // Настройки для поля в БД
    // Правила проверки поля
    'aValidateRules' => array(
      array('required', 'isEmpty' => false, 'on'=>array(
        'registration_model',
        'registration_actor',
      )),
      array('string', 'on'=>array(
        'registration_model',
        'registration_actor',
      )),
      array('is_selected', 'on'=>array(
        'registration_model',
        'registration_actor',
      ))
    ),
  ),

);

//
// Применяется для формирования полей для шаблонов
//
foreach($config['Fields'] as $name => $params)
  $config[$name] = isset($params['fields'])? $params['fields']: $name;

// После правок полей, необходимо запустить http://site.com/fashion/update
// Для создания полей в БД

Config::Set('db.table.profile', '___db.table.prefix___profiles');
Config::Set('db.table.field', '___db.table.prefix___fields');

//
// Регистрация блоков
//

// Регистрация блока регистрации
Config::Set ('block.rule_register', array (
  'action' => array ('index'),
  //'path' => '',
  'blocks' => array (
    'right' => array (
      'fashion' => array (
        'params' => array (
          'plugin' => 'fashion',
          'useAjax' => (bool)$config['useAjax'],
        ),
        'priority' => 1000,
      ),
    )
  ),
));

//
// Регистрация экшенов
//

// Экшен регистрации
Config::Set('router.page.fashion_register', 'PluginFashion_ActionRegister');
// Экшен обновления полей в БД
Config::Set('router.page.fashion', 'PluginFashion_ActionFashion');

return $config;


/*
Заметки:

//
// Получить объекты
//
LS::getInstance()->GetModuleObject('PluginFashion_ModuleProfile') - модуль
LS::Ent('PluginFashion_ModuleProfile_EntityProfile') - Сущность

//
// Текущий пользователь
//
$oUserCurrent = $this->User_GetUserCurrent();
$oUserCurrent = LS::getInstance()->GetModuleObject('ModuleUser')->GetUserCurrent();
$oUserCurrent = LS::E()->GetModuleObject('ModuleUser')->GetUserCurrent();
$oUserCurrent = LS::CurUsr();

// Профиль пользователя
$this->oUserProfile->getId();

//
// Конфигурация
//
Config::Get('plugin.fashion.Profiles')

//
// Акшены/Эветы/Параметры:
//
Router::GetAction()
Router::GetActionEvent()
Router::GetPathWebCurrent()
Router::GetParam(array())

Хуки:
$this->Hook_Run('registration_validate_after', array('oUser'=>$oUser));

*/
?>