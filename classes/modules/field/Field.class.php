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
  protected $_ProfileId = 0;

  public function Init () {
    parent::Init();
    $this->_fields_config = Config::Get('plugin.fashion.Fields');
  }

  public function getFields(){

    $oEntityField = $this->GetByFilter(
                        array('profile_id' => $this->_ProfileId ),
                              'PluginFashion_ModuleField_EntityField'
                      );

    if(!isset($oEntityField)) return null;

    $this->setField( $oEntityField );

    return $this->getEntityField();
  }

  public function Validate($field_name, $value = ''){
    $Fields = Config::Get('plugin.fashion.Fields');
    if(in_array($field_name, array_keys($Fields))){
      $oField = LS::Ent('PluginFashion_ModuleField_EntityField');
      if(!isset($oField))
        return false;
      $function = 'set' . func_camelize($field_name);
      call_user_func_array(array($oField,$function), array($value));
      // Получаем профиль по обратному адресу
      if (isset($_SERVER['HTTP_REFERER'])) {
        $aUrl=explode('/',parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH));
        if(count($aUrl) == 3)
          // Сценарий в зависимости от профиля
          $oField->_setValidateScenario('registration_' . $aUrl[2]);
      }
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
  public function getFieldsLabels(PluginFashion_ModuleField_EntityField $oField){
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

  public function getFieldsViewsData(PluginFashion_ModuleField_EntityField $oField){
    $aFields = $oField->_getData($oField);

    foreach($aFields as $field => &$value){
      if($field == 'id' || $field == 'profile_id')
        continue;

      $field_config = $this->GetFieldConfig($field);

      switch($field_config['widget']){
        case 'combo':
        case 'list':
          $t = $this->Lang_Get("plugin.fashion.{$field}_fields.{$value}");
          if($t == "NOT_FOUND_LANG_TEXT")
            $t = $field_config['fields'][$value];
          if(!$t)
            $t = $value;
          $value = $t;
        break;
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

  public function getField($profile_id){
    $this->_ProfileId = $profile_id;
    $this->getFields();
    return $this;
  }

  public function getEntityField(){
    return $this->_oEntityField;
  }

}
