<?php
/*
  Informer plugin
  (P) PSNet, 2008 - 2012
  http://psnet.lookformp3.net/
  http://livestreet.ru/profile/PSNet/
  http://livestreetcms.com/profile/PSNet/
*/

class PluginFashion_HookFashion extends Hook {

  public function RegisterHook () {
    $this->AddHook ('init_action', 'AddStylesAndJS', __CLASS__);
    $this->AddHook ('registration_validate_before', '_registration_validate_before', __CLASS__);
    $this->AddHook ('registration_validate_after', '_registration_validate_after', __CLASS__);
    $this->AddHook ('registration_after', '_registration_after', __CLASS__);
    $this->AddHook ('registration_validate_field', '_registration_validate_field', __CLASS__);

    //$this->AddDelegateHook('module_user_update_after','update',__CLASS__,-3);
    //$this->AddHook('template_form_settings_profile_begin', 'settings',__CLASS__,-3);
    //$this->AddHook('template_prof_register', 'register',__CLASS__,-3);
    //$this->AddHook('template_profile_whois_privat_item', 'profile',__CLASS__,-3);
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
      ->Save( $aVars, $_fields ))){
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

}

?>