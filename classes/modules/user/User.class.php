<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/


class PluginFashion_ModuleUser extends PluginFashion_Inherit_ModuleUser {

  /**
  * Заполняем объекты UserEntity до полями
  *
  */

	public function GetUsersAdditionalData($aUserId,$aAllowData=null) {
    if(!$aUserId)
      return null;

    $aUsers = parent::GetUsersAdditionalData($aUserId,$aAllowData);

    $aProfiles=LS::getInstance()
              ->GetModuleObject('PluginFashion_ModuleProfile')
              ->GetProfilesByUserId($aUsers);

    if(!$aProfiles)
      return $aUsers;

    foreach ($aUsers as $id => $oUser)
      if(isset($aProfiles[$id]))
        $oUser->setProfile( $aProfiles[$id] );

		return $aUsers;
	}

  public function Update(ModuleUser_EntityUser $oUser) {
    parent::Update($oUser);

    if(!LS::getInstance()->GetModuleObject('PluginFashion_ModuleProfile')->getProfile()->isProfile()) return true;

    $Fields = Config::Get('plugin.fashion.Fields');
    foreach($Fields as $name => $params){
      $_fields[$name] = getRequestStr( $name );
    }

    if(!isset($_fields)) return false;

    return $oUser
      ->getProfile()
        ->Save(
          array('oUser' => $oUser, 'Update' => TRUE),
          $_fields,
          $oUser->getProfile()->getEntityProfile()->getType()
        );

  }


}
