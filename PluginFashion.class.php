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
        'ActionRegistration' => '_ActionRegistration',
        'ActionPeople' => '_ActionPeople',
      ),
      'module' => array(
        'ModuleUser' => '_ModuleUser',
      ),
      'mapper' => array(
        'ModuleUser_MapperUser' => '_ModuleUser_MapperUser',
      ),
      'entity' => array(
        'ModuleUser_EntityUser' => '_ModuleUser_EntityUser',
      ),
  );

  public function Activate () {
    $return = false;
    if (!$this->isTableExists('prefix_profiles')) {
      $return = $this->ExportSQL(dirname(__FILE__).'/profiles.sql');
    }
    if (!$this->isTableExists('prefix_fields')) {
      $return = $this->ExportSQL(dirname(__FILE__).'/fields.sql');
    }
    return isset($return['result'])? $return['result']: true;
  }

  public function Deactivate () {
    // TODO: Drop prefix_profiles, prefix_fields
  }

  // ---

  public function Init () {}

}

