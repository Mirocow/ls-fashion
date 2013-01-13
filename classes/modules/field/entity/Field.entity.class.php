<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/

/**
 * Сущность пользовательского поля в профиле
 *
 * @package plugins.fashion.modules.field
 * @since 1.0
 */
class PluginFashion_ModuleField_EntityField extends EntityORM {

  protected $sPrimaryKey = 'id';

  protected $aRelations=array(

  );

  public function Init() {
    $i = 1;
  }

  /**
   * Определяем правила валидации
   * Стандартные правила валидации: http://docs.mirocow.com/doku.php?id=livestreet:description:entity
   *
   * @var array
   */
  protected $aValidateRules=array(
    array('profile_firstname','required', 'isEmpty' => false, 'on'=>array('', 'registration')),
    array('profile_firstname','string', 'on'=>array('', 'registration')), // '' - означает дефолтный сценарий

    array('profile_secondname','required', 'isEmpty' => false, 'on'=>array('', 'registration')),
    array('profile_secondname','string', 'on'=>array('', 'registration')),

    array('profile_experience','required', 'isEmpty' => false, 'on'=>array('', 'registration')),
    array('profile_experience','string', 'on'=>array('', 'registration')),
    array('profile_experience','is_selected', 'on'=>array('', 'registration')),

    array('profile_gender','required', 'isEmpty' => false, 'on'=>array('', 'registration')),
    array('profile_gender','string', 'on'=>array('', 'registration')),
    array('profile_gender','is_selected', 'on'=>array('', 'registration')),
  );

  public function ValidateIsSelected($sValue,$aParams) {
    if(!$sValue)
      return 'Не выбран ни один пункт';
    return true;
  }

  public function ShowColumns(){
    return array_keys( Config::Get('plugin.fashion.Fields') );
  }
}