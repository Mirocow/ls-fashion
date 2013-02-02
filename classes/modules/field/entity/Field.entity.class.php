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
    $aLang = $this->Lang_GetLangMsg();

    // TODO 5: Добавить кеширование правил

    foreach($Profiles as $Profile)
      foreach($Fields as $field_name => $Field)
        if(isset($Field['aValidateRules']))
          foreach($Field['aValidateRules'] as $validateRule){
            array_unshift($validateRule, $field_name);
            if(!isset($validateRule['msg']) && isset($aLang['plugin']['fashion'][$field_name.'_error_used']))
              $validateRule['msg'] = $aLang['plugin']['fashion'][$field_name.'_error_used'];
            $this->aValidateRules[] = $validateRule;
          }
     $this->aValidateRules[] = array('id', 'required', 'isEmpty' => false, 'on'=>array('', 'registration'));
  }

  public function ValidateIsSelected($sValue,$aParams) {
    if(!isset($this->_aData) || !$this->_aData || !is_array($this->_aData)) return true;

    $fields = array_keys($this->_aData);
    $field_name = $fields[0];

    $aLang = $this->Lang_GetLangMsg();

    // TODO 5: Добавить кеширование правил

    if(!$sValue)
      if(isset($aLang['plugin']['fashion'][$field_name.'_error_used']) && $aLang['plugin']['fashion'][$field_name.'_error_used'])
        return $aLang['plugin']['fashion'][$field_name.'_error_used'];
      else
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