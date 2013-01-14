<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/

class PluginFashion_ModuleField extends ModuleORM {

  private $return = array();

  protected $_oMapper;
  protected $_fields_config = null;
  protected $_oEntityField;

  public function Init () {
    parent::Init();
    $this->_fields_config = Config::Get('plugin.fashion.Fields');
  }

  public function Validate($field_name, $value = ''){
    $Fields = Config::Get('plugin.fashion.Fields');
    if(in_array($field_name, array_keys($Fields))){
      $oField = LS::Ent('PluginFashion_ModuleField_EntityField');
      if(!isset($oField))
        return false;
      $function = 'set' . func_camelize($field_name);
      call_user_func_array(array($oField,$function), array($value));
      if(!$oField->_Validate(array($field_name),false)){
        return $oField->_getValidateErrors();
      }
    }
    return false;
  }

  public function Save(PluginFashion_ModuleProfile_EntityProfile $oProfile) {
    $i = 1;
  }

  /**
   * Вывод неподготовленных данных
   *
   * @param PluginFashion_ModuleField_EntityField $oField
   */
  public function getFieldsData(PluginFashion_ModuleField_EntityField $oField){
    return $oField->_getData($oField);
  }

  /**
   * Вывод обработанных данных
   *
   * @param PluginFashion_ModuleField_EntityField $oField
   */
  public function getFieldsViewsData(PluginFashion_ModuleField_EntityField $oField){
    $aFields = $oField->_getData($oField);

    foreach($aFields as $field => &$value){
      if($field == 'id' || $field == 'profile_id')
        continue;

      $field_config = $this->GetFieldConfig($field);

      switch($field_config['widget']){
        case 'combo':
        case 'list':
          $value = $this->Lang_Get("plugin.fashion.{$field}_fields.{$value}");
        break;
        default:
          $value = $this->Lang_Get("plugin.fashion.{$field}");
      }

    }

    return $aFields;
  }

  public function GetFieldConfig($field_name){
    return $this->_fields_config[$field_name];
  }

  public function setField(PluginFashion_ModuleField_EntityField $oField){
    $this->_oEntityField = $oField;
  }

  public function getField(){
    return $this;
  }

  public function getEntityField(){
    return $this->_oEntityField;
  }

}
