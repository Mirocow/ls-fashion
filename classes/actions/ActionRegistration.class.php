<?php
/*-------------------------------------------------------
*
*   Template Social Plugin
*   Copyright 2012 Denis Shakhov
*
*--------------------------------------------------------
*
*   Contact e-mail: work@deniart.ru
*
---------------------------------------------------------
*/

/**
 * Обрабатывает профайл юзера, т.е. УРЛ вида /profile/login/
 *
 */
class PluginFashion_ActionRegistration extends PluginFashion_Inherit_ActionRegistration {

  protected $sMenuHeadItemSelect='index';

  protected function RegisterEvent() {
    parent::RegisterEvent();
  }

  public function EventIndex(){
    return parent::EventNotFound();
  }

}
?>