<?php

namespace EcclesiaCRM\Tasks;

use EcclesiaCRM\dto\SystemConfig;
use EcclesiaCRM\dto\SystemURLs;

class EmailTask implements iTask
{
  public function isActive()
  {
    return $_SESSION['user']->isAdmin() && empty(SystemConfig::hasValidMailServerSettings());
  }

  public function isAdmin()
  {
    return true;
  }

  public function getLink()
  {
    return SystemURLs::getRootPath() . '/SystemSettings.php';
  }

  public function getTitle()
  {
    return gettext('Set Email Settings');
  }

  public function getDesc()
  {
    return gettext("SMTP Server info are blank");
  }

}
