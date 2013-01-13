<?php
/*
  Fashion plugin
  (P) Mirocow, 2013
  http://mirocow.com/
*/

class PluginFashion_BlockFashion extends Block {

  public function Exec () {

    //$useAjax = $this->GetParam('useAjax');
    //$this->Viewer_Assign('useAjax', $useAjax);

    foreach($this->aParams as $name => $param)
      $this->Viewer_Assign($name, $param);
  }

}

?>