<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/

if (!class_exists ('Plugin')) {
  die ('Fashion!');
}

class PluginFashion extends Plugin {

  // Переопределение
  public $aDelegates = array(
      'action' => array(
      ),
      'module' => array(
      ),
      'entity' => array(
      ),
      'template' => array(
      ),
  );

  // Наследование
  public $aInherits = array(
      'action' => array(
      ),
      'module' => array(
      ),
      'mapper' => array(
      ),
      'entity' => array(
      ),
  );

  public function Activate () {
    if (!$this->isTableExists('prefix_profiles')) {
      $this->ExportSQL(dirname(__FILE__).'/profiles.sql');
    }
    if (!$this->isTableExists('prefix_fields')) {
      $this->ExportSQL(dirname(__FILE__).'/fields.sql');
    }
    return true;
  }

  // ---

  public function Init () {}

}

?>