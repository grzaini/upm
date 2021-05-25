<?php
require_once 'core/init.php';
include 'lang/' . $_SESSION['lang'] . '.php';
include 'includes/header.php';
include 'includes/navigation.php';
include 'wrappers/helpers.php';

$id = $_GET['id'];
$id = (int)$id;
$sql = "SELECT * FROM employee WHERE id = '$id'";
$result = $db->query($sql);
$employee  = mysqli_fetch_assoc($result);
?>

<div class="container">
<?php

?>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 text-right">
      <h3 class="text-center">سوانح استاد  یا کارمند</h3>
    </div>
    <div class="col-md-1">
      <span><a href="lecturers.php"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>....</a></span>
      <span><i class="fa fa-long-arrow-left" aria-hidden="true"></i>edit</a></span>
    </div>
  </div>



  <div class="row">
    <div class="col-md-1"></div>
      <div class="col-md-5 bg-warning text-right">
        <div class="panel panel-default">
				<div class="panel-body bg-dark" style="width:200px; height:200px;">
					<img th:src=""
						class="img-responsive center-block" />
				</div>
				</div>
        <hr>
        <b>نمبره تذکره: </b><?=$employee['national_id'] ;?><br>
        <b>اسم و تخلص: </b><?=$employee['first_name_fa'] .'   '.$employee['last_name_fa'];?><br>
        <b>اسم پدر: </b><?=$employee['father_name_fa'] ;?><br>
        <b>اسم پدرکلان: </b><?=$employee['g_father_name_fa'] ;?><br>
        <b>ملیت: </b><?=$employee['nationality_fa'] ;?><br>
        <b>تاریخ تولد: </b><?=$employee['date_of_birth'] ;?><br>
        <b>سن: </b><?php
        $shamsi = strtok($employee['date_of_birth'], '-');
        $year = date("Y", time()) - $shamsi - 621;
         echo $year?><br>
        <b>جنسیت: </b><?=$employee['gender_fa'] ;?><br>
        <b>گروپ خون: </b><?=$employee['blood_group'] ;?><br>
        <b>حالت مدنی: </b><?=$employee['marital_status_fa'] ;?><br>

      </div>
      <div class="col-md-5 bg-primary text-right"> <br><br><br><br>
      <b>درجه تحصیل: </b><?=$employee['degree_fa'] ;?><br>
      <b>رشته تحصیل: </b><?=$employee['field_fa'] ;?><br>
      <b>رتبه علمی: </b><?=$employee['grade_fa'] ;?><br>
      <hr>
      <b>آی دی نمبر: </b><?=$employee['professor_id'] ;?><br>
      <b>دیپارتمنت: </b><?=$employee['department_name_fa'] ;?><br>
      <b>پوهنحی: </b><?=$employee['faculty_name_fa'] ;?><br>
      <b>وظیفه: </b><?=$employee['position_fa'] ;?><br>
      <b>تاریخ شمولیت: </b><?=$employee['enrollment_date'] ;?><br>
      <b>مدت خدمت به سال: </b><?php
        $shamsi = strtok($employee['enrollment_date'], '-');
        $year = date("Y", time()) - $shamsi - 621;
         echo $year?> سال<br>
      <b>حالت: </b><?=$employee['status_fa'] ;?><br>
      <b>شماره موبایل: </b><?=$employee['contact_no'] ;?><br>
      <b>ایمیل آدرس: </b><?=$employee['email'] ;?><br>
      <hr>
      <b>مکافات: </b><?=$employee['award_fa'] ;?><br>
      <b>مجازات: </b><?=$employee['panishment_fa'] ;?><br>
      <hr>
      <b>آدرس فعلی: </b><?=$employee['current_district_fa'].' - '.$employee['current_province_fa'];?><br>
      <b>آدرس اصلی: </b><?=$employee['permanent_district_fa'].' - '.$employee['permanent_province_fa'];?><br>
      </div>

    <div class="col-md-1"></div>

  </div>


  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 text-right">
      <hr>
      <b>بیشتر معلومات: </b><?=$employee['description_fa'];?><br>
    </div>
    <div class="col-md-1"></div>
  </div>

  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 text-right">
      <a href="lecturer-edit.php?edit=<?=$id?>">
      <input type="button" class="btn btn-success form-control" value=" ویرایش سوانح "></input></a>
    </div>
    <div class="col-md-1"></div>
  </div>

<?php include 'includes/footer.php'; ?>
