<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/

class PluginFashion_ModuleUser_EntityUser extends PluginFashion_Inherit_ModuleUser_EntityUser {

  public function Init () {
    parent::Init();
  }

  public function getProfileName(){

    $oProfile = $this->_getDataOne('profile');

    if(!$oProfile || get_class($oProfile) != 'PluginFashion_ModuleProfile' ) parent::getProfileName();

    if($oProfile->profile_firstname && $oProfile->profile_secondname){
      $data = array();
      $aLang = $this->Lang_GetLangMsg();
      $field_name = $oProfile->getType();
      if($aLang['plugin']['fashion']['profile_names'][$field_name])
        $data[] = $aLang['plugin']['fashion']['profile_names'][$field_name];
      $data[] = $oProfile->profile_firstname;
      $data[] = $oProfile->profile_secondname;
      $profile_name =  implode(' ' ,$data);
    } else
      $profile_name = parent::getProfileName();

    return $profile_name;
  }

}
