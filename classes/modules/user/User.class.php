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

    // Приклеиваем профиль к объекту User
    foreach ($aUsers as $id => $oUser){
      $profile = LS::getInstance()
                  ->GetModuleObject('PluginFashion_ModuleProfile')
                  ->getProfile( $oUser->getId() );
      $oUser->setProfile( $profile );
    }

		return $aUsers;
	}

  public function Update(ModuleUser_EntityUser $oUser) {
    parent::Update($oUser);

    $Fields = Config::Get('plugin.fashion.Fields');
    foreach($Fields as $name => $params){
      if($request = getRequestStr( $name ))
        $_fields[$name] = $request;
    }

    if(!isset($_fields)) return true;

    return $oUser
      ->getProfile()
        ->Save(
          array('oUser' => $oUser, 'Update' => TRUE),
          $_fields,
          $oUser->getProfile()->getType()
        );

  }

}
