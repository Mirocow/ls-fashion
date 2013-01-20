<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/

class PluginFashion_ModuleProfile extends ModuleORM {

  protected $_oMapper;
  //protected $_oUserCurrent;
  protected $_oEntityProfile;
  protected $_oField;

  public function Init () {
    parent::Init();
  }

  public function Save($aVars = array(), $fields = array(), $type = '') {
    $_oEntityProfile=LS::Ent('PluginFashion_ModuleProfile_EntityProfile');

    if(isset($aVars['Update'])){
      $_oEntityProfile->_SetIsNew(FALSE);
      $oProfileOld = $aVars['oUser']->getProfile();
      $_oEntityProfile->setId( $oProfileOld->getEntityProfile()->getId() );
    }

    $_oEntityProfile->setUserId( $aVars['oUser']->getUserId() ); // $this->_oUserCurrent
    $_oEntityProfile->_setValidateScenario('registration');
    $_oEntityProfile->setType( $type );

    if(!$_oEntityProfile->_Validate(null,false)){
      return $_oEntityProfile->_getValidateErrors();
    }

    if($_oEntityProfile->Save()){
      $oEntityField = LS::Ent('PluginFashion_ModuleField_EntityField');

      if(isset($aVars['Update'])){
        $oEntityField->_SetIsNew(FALSE);
        $oEntityFieldOld = $oProfileOld->getFields();
        $oEntityField->setId( $oEntityFieldOld->getId() );
      }

      $oEntityField->_setValidateScenario('registration');
      $oEntityField->setProfileId( $_oEntityProfile->getId() );
      foreach($fields as $field => $value){
        $function = 'set' . func_camelize($field);
        call_user_func_array(array($oEntityField,$function), array($value));
      }

      if(!$oEntityField->_Validate(null,false)){
        return $oEntityField->_getValidateErrors();
      }

      if(!$oEntityField->save()) {
        return $oEntityField->_getValidateErrors();
      }

      return $_oEntityProfile->getId();

    } else {
      return $_oEntityProfile->_getValidateErrors();
    }
  }

  public function GetProfileByUserId($aUserId){
    if($this->$_oEntityProfile) return $this->$_oEntityProfile;
    $this->$_oEntityProfile = $this->GetProfilesByUserId(array($aUserId));
  }

  public function GetProfilesByUserId($aUserId, $limit = 0){
    $aProfiles=LS::getInstance()->GetModuleObject('PluginFashion_ModuleProfile')
                ->GetItemsByFilter(
                  array('user_id IN'=>array_keys($aUserId), '#index-from' => 'user_id'),
                        'PluginFashion_ModuleProfile_EntityProfile'
                );

    $modules = array();
    foreach ($aProfiles as $oProfile) {
      $module = LS::getInstance()->GetModuleObject('PluginFashion_ModuleProfile');
      $module->setProfile( $oProfile );
      $modules[$oProfile->getUserID()] = $module;
    }

    return $modules;
  }

  public function setProfile(PluginFashion_ModuleProfile_EntityProfile $oProfile){
    $this->_oEntityProfile = $oProfile;
  }

  public function getProfile(){
    return $this;
  }

  public function getEntityProfile(){
    return $this->_oEntityProfile;
  }

  public function isProfile(){
    return isset($this->_oEntityProfile);
  }

  public function getField(){
    if($this->_oField) return $this->_oField;
    $this->_oField = LS::getInstance()
      ->GetModuleObject('PluginFashion_ModuleField')
        ->getField( $this->_oEntityProfile->getId() );
    return $this->_oField;
  }

  public function getFields(){
    return $this->getField()->getFields();
  }

  public function getFieldsLabels(){
    $fields = $this->getFields();
    if($fields)
      return $this->getField()->getFieldsLabels($fields);
  }

  public function getFieldsViewsData(){
    $oFields = $this->getFields();
    if($oFields)
      return $this->getField()->getFieldsViewsData($oFields);
  }

  public function getFieldsArray(){
    $oFields = $this->getFields();
    if($oFields)
      return $oFields->_getDataArray();
  }

  public function getProfileTemplate($profile, $type = 'registrations'){
    $sTemplatePathPlugin = Plugin::GetTemplatePath('fashion');
    $path = $sTemplatePathPlugin . $type . '/'.$profile.'.tpl';
    if(!file_exists($path))
      $path = $sTemplatePathPlugin . $type . '/'.Config::Get('plugin.fashion.DefaultProfile').'.tpl';
    return $path;
  }

  public function __get($name){
    if($oEntityField = $this->getField()->getEntityField())
      return $oEntityField->$name();
  }

  public function __set($name, $value){
    $i = 1;
  }

}
