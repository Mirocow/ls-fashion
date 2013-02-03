<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/

class PluginFashion_ModuleUser_MapperUser extends PluginFashion_Inherit_ModuleUser_MapperUser {

  public function Init () {
    parent::Init();
  }

  public function GetUsersByProfileFilter($ProfileName, $aFilter,$aOrder,&$iCount,$iCurrPage,$iPerPage) {
    $aOrderAllow=array('user_id','user_login','user_date_register','user_rating','user_skill','user_profile_name');
    $sOrder='';
    foreach ($aOrder as $key=>$value) {
      if (!in_array($key,$aOrderAllow)) {
        unset($aOrder[$key]);
      } elseif (in_array($value,array('asc','desc'))) {
        $sOrder.=" u.{$key} {$value},";
      }
    }
    $sOrder=trim($sOrder,',');
    if ($sOrder=='') {
      $sOrder=' u.user_id desc ';
    }

    $sql = "SELECT
          u.user_id
        FROM
          ".Config::Get('db.table.user')." u
          { INNER JOIN ".Config::Get('db.table.profile')." p ON p.user_id = u.user_id AND p.type =? }
        WHERE
          1 = 1
          { AND u.user_id = ?d }
          { AND u.user_mail = ? }
          { AND u.user_password = ? }
          { AND u.user_ip_register = ? }
          { AND u.user_activate = ?d }
          { AND u.user_activate_key = ? }
          { AND u.user_profile_sex = ? }
          { AND u.user_login LIKE ? }
          { AND u.user_profile_name LIKE ? }
        ORDER by {$sOrder}
        LIMIT ?d, ?d ;
          ";
    $aResult=array();
    if ($aRows=$this->oDb->selectPage($iCount,$sql,
                      $ProfileName ? $ProfileName : DBSIMPLE_SKIP,
                      isset($aFilter['id']) ? $aFilter['id'] : DBSIMPLE_SKIP,
                      isset($aFilter['mail']) ? $aFilter['mail'] : DBSIMPLE_SKIP,
                      isset($aFilter['password']) ? $aFilter['password'] : DBSIMPLE_SKIP,
                      isset($aFilter['ip_register']) ? $aFilter['ip_register'] : DBSIMPLE_SKIP,
                      isset($aFilter['activate']) ? $aFilter['activate'] : DBSIMPLE_SKIP,
                      isset($aFilter['activate_key']) ? $aFilter['activate_key'] : DBSIMPLE_SKIP,
                      isset($aFilter['profile_sex']) ? $aFilter['profile_sex'] : DBSIMPLE_SKIP,
                      isset($aFilter['login']) ? $aFilter['login'] : DBSIMPLE_SKIP,
                      isset($aFilter['profile_name']) ? $aFilter['profile_name'] : DBSIMPLE_SKIP,
                      ($iCurrPage-1)*$iPerPage, $iPerPage
    )) {
      foreach ($aRows as $aRow) {
        $aResult[]=$aRow['user_id'];
      }
    }
    return $aResult;
  }

  public function GetCountProfiles() {
    $sql = "SELECT p.type AS ARRAY_KEY, count(*) as count FROM ".Config::Get('db.table.profile')." p
    INNER JOIN ".Config::Get('db.table.user')." u ON u.user_id = p.user_id
    WHERE u.user_activate = 1
    GROUP BY p.type ";
    $result=$this->oDb->select($sql);
    return $result;
  }

}
