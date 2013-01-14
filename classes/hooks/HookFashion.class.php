<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/

class PluginFashion_HookFashion extends Hook {


  public function RegisterHook () {
    $this->AddHook ('init_action', 'AddStylesAndJS', __CLASS__);

    $this->AddHook ('registration_validate_before', '_registration_validate_before', __CLASS__);
    $this->AddHook ('registration_validate_after', '_registration_validate_after', __CLASS__);
    $this->AddHook ('registration_after', '_registration_after', __CLASS__);
    $this->AddHook ('registration_validate_field', '_registration_validate_field', __CLASS__);

    $this->AddHook('template_form_settings_profile_end', 'settings',__CLASS__,-100);
    $this->AddHook('template_profile_whois_privat_item', 'profile',__CLASS__,-100);
  }

  // ---


  public function AddStylesAndJS () {
    $sTemplateWebPath = Plugin::GetTemplateWebPath (__CLASS__);
    //$this->Viewer_AppendStyle ($sTemplateWebPath . 'css/style.css');
    $this->Viewer_AppendScript ($sTemplateWebPath . 'js/script.js');
  }

  public function _registration_validate_before(&$aVars = array()){
    if( Config::Get('plugin.fashion.LoginEqMail') ){
      Config::Set('module.user.login.charset', Config::Get('module.user.login.charset') . '@\.');
      $aVars['oUser']->setUserLogin( $aVars['oUser']->getUserMail() );
    }
  }

  public function _registration_validate_after($aVars = array()){
    $i = 1;
  }

  public function _registration_after($aVars = array()){
    $Fields = Config::Get('plugin.fashion.Fields');
    foreach($Fields as $name => $params){
      $_fields[$name] = getRequestStr( $name );
    }
    if(($aErrors = LS::getInstance()
      ->GetModuleObject('PluginFashion_ModuleProfile')
      ->Save( $aVars, $_fields, getRequestStr( 'profile_type' ) ))){
        if(is_array($aErrors)){
          $this->Viewer_AssignAjax('aErrors', $aErrors);
          return false;
        }
    }
    return true;
  }

  /**
   * Валидация полей профиля
   * Сценарий: registration
   *
   * @param mixed $aVars
   */
  public function _registration_validate_field($aVars = array()){
    $aPlugins=$this->Plugin_GetList();
    if (!(isset($aPlugins['fashion']))) {
      return true;
    }
    // $this->PluginFashion_ModuleField_Validate($aVars['aField']['field'])
    if(($aErrors = LS::getInstance()
      ->GetModuleObject('PluginFashion_ModuleField')
      ->Validate($aVars['aField']['field'], $aVars['aField']['value']))){
        $this->Viewer_AssignAjax('aErrors', $aErrors);
        return false;
    }
    return true;
  }

  public function settings() {
      $oProfile = LS::getInstance()->GetModuleObject('PluginFashion_ModuleProfile')->getProfile();

      $type = $oProfile->getEntityProfile()->getType();

      foreach($oProfile->getFields()->_getDataArray() as $field_name => $value){
        $this->Viewer_Assign("{$field_name}_value",$value);
      }
      unset($oProfile);
      return $this->Viewer_Fetch(Plugin::GetTemplatePath('fashion')."profile/{$type}_settings_profile.tpl");
  }

  public function profile() {
      $oProfile = LS::getInstance()->GetModuleObject('PluginFashion_ModuleProfile')->getProfile();
      $type = $oProfile->getEntityProfile()->getType();
      unset($oProfile);
      return $this->Viewer_Fetch(Plugin::GetTemplatePath('fashion')."profile/{$type}_profile.tpl");
  }

}

?>