<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
*/

class PluginFashion_ActionFashion extends ActionPlugin {

  public function Init() {
  }

  protected function UpdateEvent() {
    $this->AddEvent($item,'Update');
  }

  /**
   * Служит для обновления таблиц согласно настройка config.php
   */
  public function Update(){
    // TODO 5 -o Mirocow -c БД: Сделать функцию альтера всех связанных таблиц
  }

}
