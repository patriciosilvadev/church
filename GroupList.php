<?php
/*******************************************************************************
*
*  filename    : GroupList.php
*  website     : http://www.ecclesiacrm.com
*  copyright   : Copyright 2001, 2002 Deane Barker
*  update      : 2017-11-02, Philippe Logel
*
*
*  Additional Contributors:
*  2006 Ed Davis
*  2016 Charles Crossan

******************************************************************************/
//Include the function library
require 'Include/Config.php';
require 'Include/Functions.php';

//Set the page title
$sPageTitle = gettext('Group Listing');
require 'Include/Header.php';

use EcclesiaCRM\ListOptionQuery;
use EcclesiaCRM\dto\SystemURLs;

$rsGroupTypes = ListOptionQuery::create()->filterById('3')->find();

?>

<div class="row">
  <div class="col-lg-3">
    <label>
      <?= gettext("Show type of group:") ?>
    </label>
  </div>
  <div class="col-lg-3">
    <select id="table-filter" class="form-control input-sm">
    <option value=""><?= gettext("All") ?></option>
    <?php
      echo '<option>'.gettext("Unassigned").'</option>';
      foreach ($rsGroupTypes as $groupType) {
          echo '<option>'.$groupType->getOptionName().'</option>';
      } ?>
    </select>
  </div>
  <div class="col-lg-5" align="right">
    <label>
      <?= gettext("Groups count:") ?>
    </label>
    <span id="numberOfGroups"></span>
  </div>
</div>

<br>

<div class="box box-body">
<table class="table table-striped table-bordered data-table" id="groupsTable" style="width:100%">
</table>
<?php
if ($_SESSION['user']->isManageGroupsEnabled()) {
      ?>


<br>
<form action="#" method="get" class="form">
    <label for="addNewGroup"><?= gettext('Add New Group') ?> :</label>
    <input class="form-control newGroup" name="groupName" id="groupName" style="width:100%">
    <br>
    <button type="button" class="btn btn-primary" id="addNewGroup"><?= gettext('Add New Group') ?></button>
</form>
<?php
  }
?>

</div>

<script src="skin/js/GroupList.js"></script>
<script nonce="<?= SystemURLs::getCSPNonce() ?>">
$( document).ready(function() {
  var gS = localStorage.getItem("groupSelect");
  if (gS != null)
  {
    tf = document.getElementById("table-filter");
    tf.selectedIndex = gS;

    window.groupSelect = tf.value;
  }
});

</script>

<?php
require 'Include/Footer.php';
?>
