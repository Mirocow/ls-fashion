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

    if($oProfile->getProfileFirstname && $oProfile->getProfileSecondname)
      $profile_name = $oProfile->getProfileFirstname . ' ' . $oProfile->getProfileSecondname;
    else
      $profile_name = parent::getProfileName();

    return $profile_name;
  }

}
