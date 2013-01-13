<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/

class PluginFashion_ModuleProfile_EntityProfile extends EntityORM {

  protected $sPrimaryKey = 'id';

  protected $aRelations=array(

  );

  /**
   * Определяем правила валидации
   * Стандартные правила валидации: http://docs.mirocow.com/doku.php?id=livestreet:description:entity
   *
   * @var array
   */
  protected $aValidateRules=array(

  );

  public function Init() {
    $i = 1;
  }

  public function ShowColumns(){
    return array_keys( Config::Get('plugin.fashion.Profiles') );
  }

}