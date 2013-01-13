<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/

class PluginFashion_ModuleProfile extends ModuleORM {

  protected $oMapper;
  protected $oUserCurrent;

  public function Init () {
    parent::Init();
    /**
     * Получаем объект текущего юзера
     */
    $this->oUserCurrent=$this->User_GetUserCurrent();
  }

  public function Save($aVars = array(), $fields = array()) {
    $oProfile=LS::Ent('PluginFashion_ModuleProfile_EntityProfile');
    $oProfile->setUserId( $this->oUserCurrent );
    $oProfile->_setValidateScenario('registration');
    $oProfile->setUserId( $aVars['oUser']->getUserId() );

    if(!$oProfile->_Validate(null,false)){
      return $oProfile->_getValidateErrors();
    }
    if($oProfile->Save()){
      $oField = LS::Ent('PluginFashion_ModuleField_EntityField');
      $oField->_setValidateScenario('registration');
      $oField->setProfileId( $oProfile->getId() );
      foreach($fields as $field => $value){
        $function = 'set' . func_camelize($field);
        call_user_func_array(array($oField,$function), array($value));
      }
      if(!$oField->_Validate(null,false)){
        return $oField->_getValidateErrors();
      }
      if(!$oField->save()) {
        return $oField->_getValidateErrors();
      }

      return $oField->getId();

    } else {
      return $oProfile->_getValidateErrors();
    }
  }

}
