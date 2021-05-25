<?php
require_once 'core/init.php';
include 'lang/' . $_SESSION['lang'] . '.php';
include 'includes/header.php';
include 'includes/navigation.php';
include 'wrappers/helpers.php';
//unset($_SESSION);

?>
<div class="container">

<?php $edit_id =0;
//if(isset($_GET['edit'])){
  $edit_id = (int)$_GET['edit'];
  $result = $db->query("SELECT * from employee WHERE id = '$edit_id'");
  $employee = mysqli_fetch_assoc($result);
?>
  <h3 class="text-center">ویرایش سوانح استاد یا کارمند محترم <?=$employee['first_name_fa'].'  '.$employee['last_name_fa']?></h3>
  <div id="edit_employee">
    <form action="lecturer-info.php?id=<?=$edit_id?>" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-1"></div>
        <!-- right panel -->
        <div class="col-md-5 bg-primary text-right">
          <div class="panel panel-default">
  				<div class="panel-body bg-dark" style="width:200px; height:200px;">
  					<img th:src=""
  						class="img-responsive center-block" />
  				</div>
  				</div>
          <hr>
          <div>
            <label for="national_id">نمبر تذکره:</label>
            <input type="text" id="national_id" name="national_id" value="<?=$employee['national_id']?>"></input>
          </div>
          <div>
            <label for="first_name_fa">اسم و تخلص:</label>
            <input type="text" id="first_name_fa" name="first_name_fa" value="<?=$employee['first_name_fa']?>"></input>
            <input type="text" id="last_name_fa" name="last_name_fa" value="<?=$employee['last_name_fa']?>"></input>
          </div>
          <div>
            <label for="father_name_fa">اسم پدر:</label>
            <input type="text" id="father_name_fa" name="father_name_fa" value="<?=$employee['father_name_fa']?>"></input>
          </div>
          <div>
            <label for="g_father_name_fa">اسم پدر کلان:</label>
            <input type="text" id="g_father_name_fa" name="g_father_name_fa" value="<?=$employee['g_father_name_fa']?>"></input>
          </div>
          <div>
            <label for="nationality_fa">ملیت:</label>
            <input type="text" id="nationality_fa" name="nationality_fa" value="<?=$employee['nationality_fa']?>"></input>
          </div>
          <div>
            <label for="dob">تاریخ تولد:</label>
            <input type="text" id="dob" name="dob" value="<?=$employee['date_of_birth']?>"></input>
          </div>
          <div>
            <label for="gender_fa">جنسیت:</label>
            <input type="text" id="gender_fa" name="gender_fa" value="<?=$employee['gender_fa']?>"></input>
          </div>
          <div>
            <label for="blood_group">گروپ خون:</label>
            <input type="text" id="blood_group" name="blood_group" value="<?=$employee['blood_group']?>"></input>
          </div>
          <div>
            <label for="marital_status_fa">حالت مدنی:</label>
            <input type="text" id="marital_status_fa" name="marital_status_fa" value="<?=$employee['marital_status_fa']?>"></input>
          </div>
        </div>

        <!-- left panel -->
        <div class="col-md-5 bg-warning text-right">
          <div>
            <label for="degree_fa">درجه تحصیل:</label>
            <input type="text" id="degree_fa" name="degree_fa" value="<?=$employee['degree_fa']?>"></input>
          </div>
          <div>
            <label for="field_fa">رشته تحصیل:</label>
            <input type="text" id="field_fa" name="field_fa" value="<?=$employee['field_fa']?>"></input>
          </div>
          <div>
            <label for="grade_fa">رتبه علمی:</label>
            <input type="text" id="grade_fa" name="grade_fa" value="<?=$employee['grade_fa']?>"></input>
          </div>
          <hr>
          <div>
            <label for="professor_id">نمبر آی دی:</label>
            <input type="text" id="professor_id" name="professor_id" value="<?=$employee['professor_id']?>"></input>
          </div>
          <div>
            <label for="department_name_fa">دیپارتمنت:</label>
            <input type="text" id="department_name_fa" name="department_name_fa" value="<?=$employee['department_name_fa']?>"></input>
          </div>
          <div>
            <label for="faculty_name_fa">پوهنحی:</label>
            <input type="text" id="faculty_name_fa" name="faculty_name_fa" value="<?=$employee['faculty_name_fa']?>"></input>
          </div>
          <div>
            <label for="position_fa">وظیفه:</label>
            <input type="text" id="position_fa" name="position_fa" value="<?=$employee['position_fa']?>"></input>
          </div>
          <div>
            <label for="enrollment_date">تاریخ شمولیت:</label>
            <input type="text" id="enrollment_date" name="enrollment_date" value="<?=$employee['enrollment_date']?>"></input>
          </div>
          <div>
            <label for="status_fa">حالت:</label>
            <input type="text" id="status_fa" name="status_fa" value="<?=$employee['status_fa']?>"></input>
          </div>
          <div>
            <label for="contact_no">شماره موبایل:</label>
            <input type="text" id="contact_no" name="contact_no" value="<?=$employee['contact_no']?>"></input>
          </div>
          <div>
            <label for="email">ایمیل آدرس:</label>
            <input type="text" id="email" name="email" value="<?=$employee['email']?>"></input>
          </div>
          <hr>
          <div>
            <label for="award_fa">مکافات:</label>
            <input type="text" id="award_fa" name="award_fa" value="<?=$employee['award_fa']?>"></input>
          </div>
          <div>
            <label for="panishment_fa">مجازات:</label>
            <input type="text" id="panishment_fa" name="panishment_fa" value="<?=$employee['panishment_fa']?>"></input>
          </div>
          <hr>
          <div>
            <label for="current_province_fa">آدرس فعلی:</label>
            <input type="text" id="current_district_fa" name="current_district_fa" value="<?=$employee['current_district_fa']?>"></input>
            <input type="text" id="current_province_fa" name="current_province_fa" value="<?=$employee['current_province_fa']?>"></input>
          </div>
          <div>
            <label for="permanent_province_fa">آدرس اصلی:</label>
            <input type="text" id="permanent_district_fa" name="permanent_district_fa" value="<?=$employee['permanent_district_fa']?>"></input>
            <input type="text" id="permanent_province_fa" name="permanent_province_fa" value="<?=$employee['permanent_province_fa']?>"></input>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>

      <!-- second row -->
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 text-right">
          <div>
            <label for="description_fa">معلومات بیشتر:</label>
            <textarea id="description_fa" name="description_fa" value="<?=$employee['description_fa']?>" cols="90"></textarea>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>

      <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3 text-right">
          <div>
            <a href="lecturer-info.php?id=<?=$edit_id?>" class="btn btn-default"><?=$lang['paperadd-cancelbtn']?></a>
            <input type="submit" id="submit" name="submit" class="btn btn-success float-right" value="ثبت تغییرات"></input>
          </div>
        </div>

      </div>

    </form>
  </div>

<?php include 'includes/footer.php'; ?>
