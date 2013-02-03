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
class PluginFashion_ActionPeople extends PluginFashion_Inherit_ActionPeople {

  protected $sMenuHeadItemSelect='index';

  protected function RegisterEvent() {
    parent::RegisterEvent();
    foreach(Config::Get('plugin.fashion.Profiles') as $title => $item){
      $this->AddEvent($item,'EventProfile');
    }
  }

  protected function EventProfile() {
    $ProfileName = $this->GetEventMatch(0);
    if(count($ProfileName)) $ProfileName = $ProfileName[0];

    /**
     * Получаем статистику
     */
    $this->GetStatsProfile($ProfileName);
    /**
     * По какому полю сортировать
     */
    $sOrder='user_rating';
    if (getRequest('order')) {
      $sOrder=getRequestStr('order');
    }
    /**
     * В каком направлении сортировать
     */
    $sOrderWay='desc';
    if (getRequest('order_way')) {
      $sOrderWay=getRequestStr('order_way');
    }
    $aFilter=array(
      'activate' => 1
    );
    /**
     * Передан ли номер страницы
     */
    $iPage=$this->GetParamEventMatch(0,2) ? $this->GetParamEventMatch(0,2) : 1;
    /**
     * Получаем список юзеров
     */
    $aResult=$this->User_GetUsersByProfileFilter($ProfileName, $aFilter,array($sOrder=>$sOrderWay),$iPage,Config::Get('module.user.per_page'));
    $aUsers=$aResult['collection'];
    /**
     * Формируем постраничность
     */
    $aPaging=$this->Viewer_MakePaging($aResult['count'],$iPage,Config::Get('module.user.per_page'),Config::Get('pagination.pages.count'),Router::GetPath('people').'index',array('order'=>$sOrder,'order_way'=>$sOrderWay));
    /**
     * Получаем алфавитный указатель на список пользователей
     */
    $aPrefixUser=$this->User_GetGroupPrefixUser(1);
    /**
     * Загружаем переменные в шаблон
     */
    $this->Viewer_Assign('aPaging',$aPaging);
    $this->Viewer_Assign('aUsersRating',$aUsers);
    $this->Viewer_Assign('aPrefixUser',$aPrefixUser);
    $this->Viewer_Assign("sUsersOrder",htmlspecialchars($sOrder));
    $this->Viewer_Assign("sUsersOrderWay",htmlspecialchars($sOrderWay));
    $this->Viewer_Assign("sUsersOrderWayNext",htmlspecialchars($sOrderWay=='desc' ? 'asc' : 'desc'));
    /**
     * Устанавливаем шаблон вывода
     */
    $this->SetTemplateAction('index');
  }

  protected function EventIndex() {
    /**
     * Получаем статистику
     */
    $this->GetStatsProfile();
    /**
     * По какому полю сортировать
     */
    $sOrder='user_rating';
    if (getRequest('order')) {
      $sOrder=getRequestStr('order');
    }
    /**
     * В каком направлении сортировать
     */
    $sOrderWay='desc';
    if (getRequest('order_way')) {
      $sOrderWay=getRequestStr('order_way');
    }
    $aFilter=array(
      'activate' => 1
    );
    /**
     * Передан ли номер страницы
     */
    $iPage=$this->GetParamEventMatch(0,2) ? $this->GetParamEventMatch(0,2) : 1;
    /**
     * Получаем список юзеров
     */
    $aResult=$this->User_GetUsersByProfileFilter('',$aFilter,array($sOrder=>$sOrderWay),$iPage,Config::Get('module.user.per_page'));
    $aUsers=$aResult['collection'];
    /**
     * Формируем постраничность
     */
    $aPaging=$this->Viewer_MakePaging($aResult['count'],$iPage,Config::Get('module.user.per_page'),Config::Get('pagination.pages.count'),Router::GetPath('people').'index',array('order'=>$sOrder,'order_way'=>$sOrderWay));
    /**
     * Получаем алфавитный указатель на список пользователей
     */
    $aPrefixUser=$this->User_GetGroupPrefixUser(1);
    /**
     * Загружаем переменные в шаблон
     */
    $this->Viewer_Assign('aPaging',$aPaging);
    $this->Viewer_Assign('aUsersRating',$aUsers);
    $this->Viewer_Assign('aPrefixUser',$aPrefixUser);
    $this->Viewer_Assign("sUsersOrder",htmlspecialchars($sOrder));
    $this->Viewer_Assign("sUsersOrderWay",htmlspecialchars($sOrderWay));
    $this->Viewer_Assign("sUsersOrderWayNext",htmlspecialchars($sOrderWay=='desc' ? 'asc' : 'desc'));
    /**
     * Устанавливаем шаблон вывода
     */
    $this->SetTemplateAction('index');
  }

  protected function GetStatsProfile() {
    /**
     * Статистика кто, где и т.п.
     */
    $aStat=$this->User_GetStatUsersProfile();
    /**
     * Загружаем переменные в шаблон
     */
    $this->Viewer_Assign('aStat',$aStat);
  }

}
?>