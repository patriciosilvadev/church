<?php

namespace EcclesiaCRM\Tasks;
use EcclesiaCRM\dto\SystemConfig;
use EcclesiaCRM\dto\SystemURLs;

class ChurchAddress implements iTask
{
  public function isActive(){
    return $_SESSION['user']->isAdmin() && empty(SystemConfig::getValue('sChurchAddress'));
  }
  public function isAdmin(){
    return true;
  }
  public function getLink(){
    return SystemURLs::getRootPath() . '/SystemSettings.php';
  }
  public function getTitle(){
    return gettext('Set Church Address');
  }
  public function getDesc(){
    return gettext("Church Address is not Set.");
  }

}
