<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/

$config['useAjax'] = false;
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