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

  /**
   * Определяем правила валидации
   * Стандартные правила валидации: http://docs.mirocow.com/doku.php?id=livestreet:description:entity
   *
   * @var array
   */
  protected $aValidateRules=array( );

  public function Init() {
    //
    // Правила обработки полей назначаются в config.php
    //
    $Profiles = Config::Get('plugin.fashion.Profiles');
    $Fields = Config::Get('plugin.fashion.Fields');
    foreach($Profiles as $Profile)
      foreach($Fields as $field_name => $Field)
        if(isset($Field['aValidateRules']))
          foreach($Field['aValidateRules'] as $validateRule){
            array_unshift($validateRule, $field_name);
            $this->aValidateRules[] = $validateRule;
          }
     //
     // Если необходимо ввести дополнительные проверки, то они должны быть по правилу
     // on => [имя_правила]_[имя_профиля]
     //
     $this->aValidateRules[] = array('id', 'required', 'isEmpty' => false, 'on'=>array('', 'registration'));
  }

  public function ValidateIsSelected($sValue,$aParams) {
    if(!$sValue)
      return 'Не выбран ни один пункт';
    return true;
  }

  public function ShowColumns(){
    return array_keys( Config::Get('plugin.fashion.Fields') );
  }

  public function getFieldsData(){
    return $this->_getData($this);
  }
}