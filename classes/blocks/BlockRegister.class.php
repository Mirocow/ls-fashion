<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/

class PluginFashion_BlockRegister extends Block {

  public function Exec () {

    $aProfiles = array();
    $aLang = $this->Lang_GetLangMsg();

    foreach(Config::Get('plugin.fashion') as $Key => $Value)
      $this->Viewer_Assign($Key, $Value);

    foreach(Config::Get('plugin.fashion.Profiles') as $field_name)
      $aProfiles[$field_name] = $aLang['plugin']['fashion']['profile_names'][$field_name];

    $this->Viewer_Assign('aProfiles', $aProfiles);

  }

}

?>