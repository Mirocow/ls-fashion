<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
  http://livestreet.ru/blog/13927.html
*/

class PluginFashion_BlockFashion extends Block {

  public function Exec () {

    foreach($this->aParams as $name => $param)
      $this->Viewer_Assign($name, $param);
  }

}

?>