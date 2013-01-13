<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/

class PluginFashion_ModuleField extends ModuleORM {

  private $return = array();

  protected $oMapper;

  public function Init () {
    parent::Init();
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

}
