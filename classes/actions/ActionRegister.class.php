<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/

class PluginFashion_ActionRegister extends ActionPlugin {

  public function Init() {
  }

  protected function RegisterEvent() {
    //parent::RegisterEvent();
    foreach(Config::Get('plugin.fashion.Profiles') as $title => $item){
      $this->AddEvent($item,'EventRegister');
    }
  }

  public function EventRegister(){
    if ($this->User_GetUserCurrent()) {
      return parent::EventNotFound();
    }
    if(isPost('submit_register'))
      Router::Action('registration');
    else{
      $profile = $this->GetEventMatch(0);
      if(count($profile)) $profile = $profile[0];
      $this->Viewer_Assign('header', TRUE);
      $this->Viewer_Assign('footer', TRUE);
      $this->Viewer_Assign('ProfileName', $profile);

      $aRequest=$_REQUEST;
      func_htmlspecialchars($aRequest);
      $aLang = $this->Lang_GetLangMsg();
      $Fields = Config::Get('plugin.fashion.Fields');

      foreach($Fields as $field_name => $Field){

        $this->Viewer_Assign($field_name, $field_name);

        // Поле список
        $list = Config::Get('plugin.fashion.'.$field_name);
        if(is_array($list)){
          if($list)
            $this->Viewer_Assign($field_name.'_list', $list);
          elseif( isset($aLang['plugin']['fashion'][$field_name.'_fields']) )
            $this->Viewer_Assign($field_name.'_list', $aLang['plugin']['fashion'][$field_name.'_fields']);
          else
            $this->Viewer_Assign($field_name.'_list', array());
        }

        if(isset($aRequest[$field_name]))
          $this->Viewer_Assign($field_name.'_value', $aRequest[$field_name]);
        if(isset($aLang['plugin']['fashion'][$field_name]))
          $this->Viewer_Assign($field_name.'_label', $aLang['plugin']['fashion'][$field_name]);
        if(isset($aLang['plugin']['fashion'][$field_name.'_notice']))
          $this->Viewer_Assign($field_name.'_notice', $aLang['plugin']['fashion'][$field_name.'_notice']);

      }

      $path = LS::getInstance()->GetModuleObject('PluginFashion_ModuleProfile')->getProfileTemplate($profile);
      $this->SetTemplate($path);
    }
  }

}
