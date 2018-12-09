<?php
require '../Include/Config.php';
require '../Include/Functions.php';

use EcclesiaCRM\Service\DashboardService;
use EcclesiaCRM\Service\SundaySchoolService;
use EcclesiaCRM\dto\SystemURLs;
use EcclesiaCRM\Utils\OutputUtils;

$dashboardService = new DashboardService();
$sundaySchoolService = new SundaySchoolService();

$groupStats = $dashboardService->getGroupStats();

$kidsWithoutClasses = $sundaySchoolService->getKidsWithoutClasses();
$classStats = $sundaySchoolService->getClassStats();
$classes = $groupStats['sundaySchoolClasses'];
$teachers = 0;
$kids = 0;
$families = 0;
$maleKids = 0;
$femaleKids = 0;
$familyIds = [];
foreach ($classStats as $class) {
    $kids = $kids + $class['kids'];
    $teachers = $teachers + $class['teachers'];
    $classKids = $sundaySchoolService->getKidsFullDetails($class['id']);
    foreach ($classKids as $kid) {
        array_push($familyIds, $kid['fam_id']);
        if ($kid['kidGender'] == '1') {
            $maleKids++;
        } elseif ($kid['kidGender'] == '2') {
            $femaleKids++;
        }
    }
}

// Set the page title and include HTML header
$sPageTitle = gettext('Sunday School Dashboard');
require '../Include/Header.php';

?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"><?= gettext('Functions') ?></h3>
  </div>
  <div class="box-body">
    <?php if ($_SESSION['user']->isManageGroupsEnabled()) {
    ?>
      <button class="btn btn-app" data-toggle="modal" data-target="#add-class"><i
          class="fa fa-plus-square"></i><?= gettext('Add New Class') ?></button>
    <?php
      } 
    ?>
    <?php 
      if ($_SESSION['bExportSundaySchoolPDF'] || $_SESSION['user']->isAdmin()) { 
    ?>  
     <a href="SundaySchoolReports.php" class="btn btn-app"
       title="<?= gettext('Generate class lists and attendance sheets'); ?>"><i
        class="fa fa-file-pdf-o"></i><?= gettext('Reports'); ?></a>
    <?php
      }
    ?>
    <?php 
      if ($_SESSION['bExportCSV'] || $_SESSION['bExportSundaySchoolCSV'] || $_SESSION['user']->isAdmin()) { 
    ?>
     <a href="SundaySchoolClassListExport.php" class="btn btn-app"
       title="<?= gettext('Export All Classes, Kids, and Parent to CSV file'); ?>"><i
        class="fa fa-file-excel-o"></i><?= gettext('Export to CSV') ?></a><br/>
    <?php 
      } 
    ?>
  </div>
</div>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-gg"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><?= gettext('Classes') ?></span>
        <span class="info-box-number"> <?= $classes ?> <br/></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-olive"><i class="fa fa-group"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><?= gettext('Teachers') ?></span>
        <span class="info-box-number"> <?= $teachers ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-orange"><i class="fa fa-child"></i></span>
      <div class="info-box-content">
        <span class="info-box-text"><?= gettext('Students') ?></span>
        <span class="info-box-number"> <?= $kids ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-gray"><i class="fa fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><?= gettext('Families') ?></span>
        <span class="info-box-number"> <?= count(array_unique($familyIds)) ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-blue"><i class="fa fa-male"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><?= gettext('Boys') ?></span>
        <span class="info-box-number"> <?= $maleKids ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-fuchsia"><i class="fa fa-female"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><?= gettext('Girls') ?></span>
        <span class="info-box-number"> <?= $femaleKids ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div><!-- /.row -->
<!-- on continue -->
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><?= gettext('Sunday School Classes') ?></h3>
      <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
          </button>
      </div>
  </div>
  <div class="box-body">
    <table id="sundayschoolMissing" class="table table-striped table-bordered data-table" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th></th>
        <th><?= gettext('Class') ?></th>
        <th><?= gettext('Teachers') ?></th>
        <th><?= gettext('Students') ?></th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($classStats as $class) {
        ?>
        <tr>
          <td style="width:80px">
            <a href='SundaySchoolClassView.php?groupId=<?= $class['id'] ?>'>
            <span class="fa-stack">
              <i class="fa fa-square fa-stack-2x"></i>
              <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
            </span>
            </a>
            <a href='/GroupEditor.php?GroupID=<?= $class['id'] ?>'>
            <span class="fa-stack">
              <i class="fa fa-square fa-stack-2x"></i>
              <i class="fa fa fa-pencil fa-stack-1x fa-inverse"></i>
            </span>
            </a>
          </td>
          <td><?= $class['name'] ?></td>
          <td><?= $class['teachers'] ?></td>
          <td><?= $class['kids'] ?></td>
        </tr>
      <?php
    } ?>
      </tbody>
    </table>
  </div>
</div>


<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title"><?= gettext('Students not in a Sunday School Class') ?></h3>
      <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
          </button>
      </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="sundayschoolMissing" class="table table-striped table-bordered data-table" cellspacing="0" width="100%">
      <thead>
      <tr>
        <th></th>
        <th><?= gettext('First Name') ?></th>
        <th><?= gettext('Last Name') ?></th>
        <th><?= gettext('Birth Date') ?></th>
        <th><?= gettext('Age') ?></th>
        <th><?= gettext('Home Address') ?></th>
      </tr>
      </thead>
      <tbody>
      <?php

      foreach ($kidsWithoutClasses as $child) {
          extract($child);
          
          $hideAge = $flags == 1 || $birthYear == '' || $birthYear == '0';
          $birthDate = OutputUtils::FormatBirthDate($birthYear, $birthMonth, $birthDay, '-', $flags);
          $birthDateDate = OutputUtils::BirthDate($birthYear, $birthMonth, $birthDay, $hideAge);

          echo '<tr>';
          echo "<td><a href='../PersonView.php?PersonID=".$kidId."'>";
          echo '  <span class="fa-stack">';
          echo '  <i class="fa fa-square fa-stack-2x"></i>';
          echo '  <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>';
          echo '  </span></a></td>';
          echo '<td>'.$firstName.'</td>';
          echo '<td>'.$LastName.'</td>';
          if ($_SESSION['user']->isSeePrivacyDataEnabled()) {          
            echo '<td>'.$birthDate.'</td>';
            echo "<td data-birth-date='".($hideAge ? '' : $birthDateDate->format('Y-m-d'))."'></td>";
            echo '<td>'.$Address1.' '.$Address2.' '.$city.' '.$state.' '.$zip.'</td>';
            echo '</tr>';
          } else {
            echo '<td>'.gettext("Private Data").'</td>';
            echo "<td>".gettext("Private Data")."</td>";
            echo '<td>'.gettext("Private Data").'</td>';
            echo '</tr>';
          }
      }

      ?>
      </tbody>
    </table>
  </div>
</div>
<?php if ($_SESSION['user']->isManageGroupsEnabled()) {
          ?>
  <div class="modal fade" id="add-class" tabindex="-1" role="dialog" aria-labelledby="add-class-label"
       aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"
              id="delete-Image-label"><?= gettext("Add Sunday School Class") ?> </h4>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <input type="text" id="new-class-name" class="form-control" placeholder="<?= gettext('Enter Name') ?>"
                   maxlength="20" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?= gettext('Cancel') ?></button>
          <button type="button" id="addNewClassBtn" class="btn btn-primary"
                  data-dismiss="modal"><?= gettext('Add') ?></button>
        </div>
      </div>
    </div>
  </div>
  <script nonce="<?= SystemURLs::getCSPNonce() ?>">
    $(document).ready(function () {
      $('.data-table').DataTable({"language": window.CRM.plugin.dataTable.language,responsive: true});

      $("#addNewClassBtn").click(function (e) {
        var groupName = $("#new-class-name").val(); // get the name of the from the textbox
        if (groupName) // ensure that the user entered a name
        {
          $.ajax({
            method: "POST",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            url: window.CRM.root + "/api/groups/",
            data: JSON.stringify({
              'groupName': groupName,
              'isSundaySchool': true
            })
          }).done(function (data) {                               //yippie, we got something good back from the server
            window.location.href = window.CRM.root + "/sundayschool/SundaySchoolClassView.php?groupId=" + data.Id;
          });
        }
        else {

        }
      });

    });
  </script>

<?php
      } else {
?>
  <script nonce="<?= SystemURLs::getCSPNonce() ?>">
    $(document).ready(function () {
      $('.data-table').DataTable({"language": window.CRM.plugin.dataTable.language,responsive: true});
  });
  </script>
<?php
      }
?>
<?php
require '../Include/Footer.php' 
?>