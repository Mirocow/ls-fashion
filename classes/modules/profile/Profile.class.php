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
  protected $_UserId;

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

    // Сценарий в зависимости от профиля
    $_oEntityProfile->_setValidateScenario('registration_' . $type);

    $_oEntityProfile->setType( $type );

    if(!$_oEntityProfile->_Validate(null,false)){
      return $_oEntityProfile->_getValidateErrors();
    }

    if($_oEntityProfile->Save()){
      $oEntityField = LS::Ent('PluginFashion_ModuleField_EntityField');

      if(isset($aVars['Update'])){
        $oEntityField->_SetIsNew(FALSE);
        $oEntityFieldOld = $oProfileOld->getFields();
        if($oEntityFieldOld)
          $oEntityField->setId( $oEntityFieldOld->getId() );
      }

      // Сценарий в зависимости от профиля
      $oEntityField->_setValidateScenario('registration_' . $type);

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

  /*protected function GetProfileByUserId($aUserId){
    if($this->_oEntityProfile) return $this->_oEntityProfile;

    if($oEntityProfile = $this->GetProfilesByUserId(array($aUserId => $aUserId)) )
      $this->_oEntityProfile = reset($oEntityProfile);
  }

  protected function GetProfilesByUserId($aUserId, $limit = 0){
    $aProfiles=$this->getProfile()
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
  }*/

  protected function GetEntityProfileByUserId( $iUserId ){
    $aProfiles=$this->getProfile()
                ->GetItemsByFilter(
                  array('user_id IN'=>array($iUserId), '#index-from' => 'user_id'),
                        'PluginFashion_ModuleProfile_EntityProfile'
                );
    if(!$aProfiles)
      return false;

    $this->_oEntityProfile = reset($aProfiles);
  }

  public function setProfile(PluginFashion_ModuleProfile_EntityProfile $oProfile){
    $this->_oEntityProfile = $oProfile;
  }

  public function getProfile( $iUserId = 0 ){
    if(!$iUserId)
        return $this;
    $this->_UserId = $iUserId;
    return clone $this;
  }

  public function getEntityProfile(){

    if(!$this->_oEntityProfile)
      $this->GetEntityProfileByUserId( $this->_UserId );

    if(!$this->_oEntityProfile)
      return false;

    return $this->_oEntityProfile;
  }

  public function getType(){
    if($oEntityProfile = $this->getEntityProfile())
      return $oEntityProfile->getType();
  }

  public function getField(){
    if($this->_oField) return $this->_oField;

    if(!$this->_oEntityProfile)
      $this->GetEntityProfileByUserId( $this->_UserId );

    if(!$this->_oEntityProfile)
      return false;

    if($iProfileId = $this->_oEntityProfile->getId())
      $this->_oField = LS::getInstance()
        ->GetModuleObject('PluginFashion_ModuleField')
          ->getField( $iProfileId );

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
      $path = $sTemplatePathPlugin . $type . '/default.tpl';
    return $path;
  }

  public function __get($name){
    if($oField = $this->getField())
      if($oEntityField = $oField->getEntityField())
        return $oEntityField->$name();
    return false;
  }

  public function __set($name, $value){
    $i = 1;
  }

}
