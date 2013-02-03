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

  public function GetUsersByProfileFilter($ProfileName, $aFilter,$aOrder,$iCurrPage,$iPerPage,$aAllowData=null) {
    $sKey="user_filter_".$ProfileName.serialize($aFilter).serialize($aOrder)."_{$iCurrPage}_{$iPerPage}";
    if (false === ($data = $this->Cache_Get($sKey))) {
      $data = array('collection'=>$this->oMapper->GetUsersByProfileFilter($ProfileName,$aFilter,$aOrder,$iCount,$iCurrPage,$iPerPage),'count'=>$iCount);
      $this->Cache_Set($data, $sKey, array("user_update","user_new"), 60*60*24*2);
    }
    $data['collection']=$this->GetUsersAdditionalData($data['collection'],$aAllowData);
    return $data;
  }

  public function GetStatUsersProfile() {
    if (false === ($aStat = $this->Cache_Get("user_stats"))) {

      $aStat['count_all']=$this->oMapper->GetCountUsers();
      $sDate=date("Y-m-d H:i:s",time()-Config::Get('module.user.time_active'));
      $aStat['count_active']=$this->oMapper->GetCountUsersActive($sDate);
      $aStat['count_inactive']=$aStat['count_all']-$aStat['count_active'];

      $aSex=$this->oMapper->GetCountUsersSex();
      $aStat['count_sex_man']=(isset($aSex['man']) ? $aSex['man']['count'] : 0);
      $aStat['count_sex_woman']=(isset($aSex['woman']) ? $aSex['woman']['count'] : 0);
      $aStat['count_sex_other']=(isset($aSex['other']) ? $aSex['other']['count'] : 0);

      $aProfiles=$this->oMapper->GetCountProfiles();
      foreach($aProfiles as $Profile => $Value){
        if(!$Profile)
          $aStat['other'] = $Value['count'];
        else
          $aStat[$Profile] = $Value['count'];
      }

      foreach(Config::Get('plugin.fashion.AmountProfiles') as $Profile => $Key){
        if(!isset($aStat[$Profile])) $aStat[$Profile] = 0;
      }

      $this->Cache_Set($aStat, "user_stats", array("user_update","user_new"), 60*60*24*4);
    }
    return $aStat;
  }

}
