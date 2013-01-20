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
    foreach(Config::Get('plugin.fashion.Profiles') as $title => $item){
      $this->AddEvent($item,'Register');
    }
  }

  public function Register(){
    if(isPost('submit_register'))
      Router::Action('registration');
    else{
      $profile = $this->GetEventMatch(0);
      $this->Viewer_Assign('header', TRUE);
      $this->Viewer_Assign('footer', TRUE);
      $this->Viewer_Assign('Key', $profile);
      $path = LS::getInstance()->GetModuleObject('PluginFashion_ModuleProfile')->getProfileTemplate($profile);
      $this->SetTemplate($path);
    }
  }

}
