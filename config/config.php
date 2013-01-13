<?php
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

// После правок полей, необходимо запустить http://site.com/fashion/update
// Для создания полей в БД

Config::Set('db.table.profile', '___db.table.prefix___profiles');
Config::Set('db.table.field', '___db.table.prefix___fields');

// Вспомогательный массив
foreach($config['Fields'] as $name => $params)
  $config[$name] = $params['fields'];

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

{$Key|lower}
Config::Get('plugin.fashion.Profiles')
$oUser=$this->User_GetUserById($oUser->getId());
$this->Hook_Run('registration_validate_after', array('oUser'=>$oUser));

*/
?>