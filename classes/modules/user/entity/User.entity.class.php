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
    //$oUserCurrent = $this->User_GetUserCurrent();
    //$oUserCurrent = LS::getInstance()->GetModuleObject('ModuleUser')->GetUserCurrent();
    //$oUserCurrent = LS::E()->GetModuleObject('ModuleUser')->GetUserCurrent();
    //$oUserCurrent = LS::CurUsr();

    $oProfile = LS::CurUsr()->getProfile();

    if(get_class($oProfile) != 'PluginFashion_ModuleProfile' || !$oProfile->isProfile()) parent::getProfileName();

    $profile_firstname = $oProfile->getProfileFirstname;
    $profile_secondname = $oProfile->getProfileSecondname;

    return "$profile_firstname $profile_secondname";
  }

}
