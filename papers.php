<?php
  ob_start();
  require_once 'core/init.php';
  include 'lang/' . $_SESSION['lang'] . '.php';
  include 'includes/header.php';
  include 'includes/navigation.php';
  include 'wrappers/helpers.php';
  //header('Content-type: text/html; charset=utf-8');

  //echo $_SESSION['lang'];
  //unset($_SESSION['lang']);
?>
<div class="container">
<?php
$errors = array();
  //delete paper
  if(isset($_GET['delete'])){
    $id = sanitize($_GET['delete']);
    $db->query("DELETE FROM paper_supervisor WHERE paper_id = '$id'");
    $db->query("DELETE FROM paper WHERE id = '$id'");
    header('Location: papers.php');
  }
  //add page / edit page
  if(isset($_GET['add']) || isset($_GET['edit'])){
    $authorinfo = $db->query("SELECT * FROM employee WHERE professor_id is not null ORDER By department_name_fa");
    $supervisorinfo = $db->query("SELECT * FROM employee ORDER By department_name_fa");

    $title_fa = ((isset($_POST['title_fa']) && !empty($_POST['title_fa']))?sanitize($_POST['title_fa']):'');
    $abstract_fa = ((isset($_POST['abstract_fa']) && !empty($_POST['abstract_fa']))?sanitize($_POST['abstract_fa']):'');
    $description_fa = ((isset($_POST['description_fa']) && !empty($_POST['description_fa']))?sanitize($_POST['description_fa']):'');
    $category_fa = ((isset($_POST['category_fa']) && !empty($_POST['category_fa']))?sanitize($_POST['category_fa']):'');
    $varification_date = ((isset($_POST['vdate']) && !empty($_POST['vdate']))?sanitize($_POST['vdate']):'');
    $defence_date = ((isset($_POST['ddate']) && !empty($_POST['ddate']))?sanitize($_POST['ddate']):'');
    $author_id = ((isset($_POST['author_id']))?$_POST['author_id']:'0');
    $supervisor_id = ((isset($_POST['supervisor_id']) && !empty($_POST['supervisor_id']))?sanitize($_POST['supervisor_id']):'0');
    $dbpath = ((isset($_POST['paperfile']) && !empty($_POST['paperfile']))?sanitize($_POST['paperfile']):'');

    $osname = ((isset($_POST['osname']) && !empty($_POST['osname']))?sanitize($_POST['osname']):'');
    $oslname = ((isset($_POST['oslname']) && !empty($_POST['oslname']))?sanitize($_POST['oslname']):'');
    $osdegree = ((isset($_POST['osdegree']) && !empty($_POST['osdegree']))?sanitize($_POST['osdegree']):'');
    $osuniversity = ((isset($_POST['osuniversity']) && !empty($_POST['osuniversity']))?sanitize($_POST['osuniversity']):'');
    $osfaculty = ((isset($_POST['osfaculty']) && !empty($_POST['osfaculty']))?sanitize($_POST['osfaculty']):'');


    $edit_id =0;
    if(isset($_GET['edit'])){
      $edit_id = (int)$_GET['edit'];
      $paperResults = $db->query("SELECT * from paper_edit WHERE id = '$edit_id'");
      $paper = mysqli_fetch_assoc($paperResults);
      $title_fa = ((isset($_POST['title_fa']) && !empty($_POST['title_fa']))?sanitize($_POST['title_fa']):$paper['title_fa']);
      $abstract_fa = ((isset($_POST['abstract_fa']) && !empty($_POST['abstract_fa']))?sanitize($_POST['abstract_fa']):$paper['abstract_fa']);
      $description_fa = ((isset($_POST['description_fa']) && !empty($_POST['description_fa']))?sanitize($_POST['description_fa']):$paper['description_fa']);
      $category_fa = ((isset($_POST['category_fa']) && !empty($_POST['category_fa']))?sanitize($_POST['category_fa']):$paper['category_fa']);
      $varification_date = ((isset($_POST['vdate']) && !empty($_POST['vdate']))?sanitize($_POST['vdate']):date('Y-m-d',strtotime($paper['varification_date'])));
      $defence_date = ((isset($_POST['ddate']) && !empty($_POST['ddate']))?sanitize($_POST['ddate']):$paper['defence_date']);
      $author_id = ((isset($_POST['author_id']) && !empty($_POST['author_id']))?sanitize($_POST['author_id']):$paper['author_id']);
      $supervisor_id = ((isset($_POST['supervisor_id']) && !empty($_POST['supervisor_id']))?sanitize($_POST['supervisor_id']):$paper['supervisor_id']);
      $dbpath = ((isset($_POST['paperfile']) && !empty($_POST['paperfile']))?sanitize($_POST['paperfile']):$paper['file']);
    }

    if($_POST){
      // if(isset($_POST['paperfile']) && !empty($_FILES)){
      // $allowedExts = array("pdf");
      // $temp = explode(".", $_FILES["paperfile"]["name"]);
      // $extension = end($temp);
      // $upload_pdf=$_FILES["paperfile"]["name"];
      // $dbpath = BASEURL."files/papers/" . $_FILES["paperfile"]["name"];
      // }
      if($_POST['title_fa'] == '' && $_POST['author'] == 0){
        $errors[] .= 'the title of the paper and author is not entered, please add title and author!';
      }

      if(!empty($errors)){
        echo display_errors($errors);
      }else{
        //upload file and insert into database
        move_uploaded_file($_FILES["paperfile"]["tmp_name"],"".BASEURL."files/papers/" . $_FILES["paperfile"]["name"]);
        $dbpath = "files/papers/" . $_FILES["paperfile"]["name"];
        $insert_date = date("Y-m-d H:i:s");
        $insertSql = "INSERT INTO paper (`title_fa`,`abstract_fa`,`description_fa`, `varification_date`, `defence_date`, `file`, `insert_date`, `category_fa`)
        VALUES ('$title_fa', '$abstract_fa', '$description_fa', ". (empty($varification_date) ? "NULL" : "'$varification_date'").", ". (empty($defence_date) ? "NULL" : "'$defence_date'").", '$dbpath', '$insert_date', '$category_fa')";
        if(isset($_GET['edit'])){
          $insertSql = "UPDATE paper SET `title_fa` = '$title_fa', `abstract_fa` = '$abstract_fa', `description_fa` = '$description_fa',
          `varification_date` = '$varification_date', `defence_date` = '$defence_date', `file` = '$dbpath' WHERE id ='$edit_id'";
        }
        $db->query($insertSql);

        //if author is mentioned then add the foriegn key into paper-supervisor table
        $paper = $db->query("SELECT `id` FROM paper WHERE insert_date = '$insert_date'");
        $paper_id = mysqli_fetch_assoc($paper);
        $pid = $paper_id['id'];
        foreach($author_id as $a_id){
        $insertPSSQLa = "INSERT INTO paper_supervisor (`paper_id`, `employee_id`, `type`) VALUES ($pid,'$a_id', 'A')";
          if(isset($_GET['edit'])){
            $insertPSSQLa = "UPDATE paper_supervisor SET `employee_id` = '$a_id' WHERE paper_id ='$edit_id' AND type = 'A'";
          }
          $db->query($insertPSSQLa);
        }
        if((int)$supervisor_id > 0){
        $insertPSSQLs = "INSERT INTO paper_supervisor (`paper_id`, `employee_id`, `type`) VALUES ('$pid','$supervisor_id', 'S')";
          if(isset($_GET['edit'])){
            $insertPSSQLs = "UPDATE paper_supervisor SET `employee_id` = '$supervisor_id' WHERE paper_id ='$edit_id' AND type = 'S'";
          }
          $db->query($insertPSSQLs);
        }
        // if there exists other supervisor then add the supervisor name into employee table
        if(isset($_POST['osname']) && !empty($_POST['osname']) && (int)$supervisor_id == 0){
          $insertEmployeeSql = "INSERT INTO employee (`first_name_fa`, `last_name_fa`,`degree_fa`,`university_name_fa`, `faculty_name_fa`)
          VALUES ('$osname', '$oslname', '$osdegree', '$osuniversity', '$osfaculty')";
          $db->query($insertEmployeeSql);
          $s = $db->query("SELECT `id` FROM employee WHERE university_name_fa ='$osuniversity' AND faculty_name_fa ='$osfaculty'");
          $sid = mysqli_fetch_assoc($s);
          $supervisor_id = $sid['id'];
          $insertPSSQLs = "INSERT INTO paper_supervisor (`paper_id`, `employee_id`, `type`) VALUES ('$pid','$supervisor_id', 'S')";
        }
        header('Location: papers.php');
        ob_get_clean();
      }
    } //end of [if($_POST)]
?>

<div id="add_employee">
      <form action="papers.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="POST" enctype="multipart/form-data">
        <h4 class="text-center"><?=$lang['paperadd-page-title']?></h4>
        <fieldset class="form-group">
          <div class="row col-md-9 mx-auto">

            <p class="text-right" style="font-size: 90%;"><?=$lang['paperadd-header']?></p>
            <hr>
              <legend class="col-md-4 col-form-label pt-0 float-right text-right"><?=$lang['paperadd-info']?></legend>
              <div class="col-md-8">
                  <div class="form-group">
                    <label for="title" class="col-form-label-sm float-right"><?=$lang['paperadd-title']?><span class="text-danger">*</span></label>
                    <input type="text" class="form-control col-form-label-sm text-right" id="title_fa" name="title_fa" value="<?=$title_fa;?>">
                  </div>
                  <div class="form-group">
                    <label for="abstract" class="col-form-label-sm float-right"><?=$lang['paperadd-abstract']?></label>
                    <textarea class="form-control form-control-sm" id="abstract_fa" name="abstract_fa" ><?=$abstract_fa?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="description" class="col-form-label-sm float-right"><?=$lang['paperadd-description']?></label>
                    <textarea class="form-control form-control-sm" id="description_fa" name="description_fa" rows="7"><?=$description_fa?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="category" class="col-form-label-sm float-right"><?=$lang['paperadd-category']?><span class="text-danger">*</span></label>
                    <select class="custom-select custom-select-sm" id="category_fa" name="category_fa">
                      <?php if(isset($_GET['edit'])) { ?>
                        <option value="" selected="selected"><?=$category_fa?></option>
                      <?php } ?>
                      <option value="">یکی را انتخاب کنید</option>
                      <option value="Book">Book</option>
                      <option value="Paper">Paper</option>
                      <option value="Research">Research</option>
                      <option value="Translation">Translation</option>
                    </select>
                  </div>
                </div>
            </div>
          </fieldset>

          <fieldset class="form-group">
            <div class="row col-md-9 mx-auto">
                <legend class="col-md-4 col-form-label pt-0 text-right"><?=$lang['paperadd-dates']?></legend>

                <div class="col-md-8">
                  <div class="form-group">
                    <label for="vdate" class="col-form-label-sm float-right"><?=$lang['paperadd-vdate']?></label>
                    <input type="text" id="vdate" name="vdate" />
                    <button id="vdatebtn">تاریخ</button>
                    <script type="text/javascript">
                      Calendar.setup(
                        {
                          inputField  : "vdate",         // ID of the input field
                          ifFormat    : "%Y-%m-%d",    // the date format
                          button      : "vdatebtn",
                          dateType    : 'jalali'       // ID of the button
                        }
                      );
                    </script>
                  </div>
                  <div class="form-group">
                    <label for="abstract" class="col-form-label-sm float-right"><?=$lang['paperadd-ddate']?></label>
                    <input type="text" id="ddate" name="ddate" />
                    <button id="ddatebtn">تاریخ</button>
                    <script type="text/javascript">
                      Calendar.setup(
                        {
                          inputField  : "ddate",         // ID of the input field
                          ifFormat    : "%Y-%m-%d",    // the date format
                          button      : "ddatebtn",
                          dateType    : 'jalali'       // ID of the button
                        }
                      );
                    </script>
                  </div>
              </div>
          </div>
        </fieldset>

        <fieldset class="form-group">
          <div class="row col-md-9 mx-auto">
              <div class="col-md-4">
              <legend class="col-form-label pt-0 text-right"><?=$lang['paperadd-authors']?></legend>
              <p class="help-block text-right" style="font-size: 80%;"><?=$lang['paperadd-helpForAuthors']?></p>
            </div>
              <div class="col-md-8">
              <div class="form-group">
                <label for="author" class="col-form-label-sm float-right"><?=$lang['paperadd-author']?><span class="text-danger">*</span></label>
                <select class="custom-select custom-select-sm" id="author_id" name="author_id[]" multiple="multiple">
                  <option value=""<?=(($author_id == '')?' selected':'');?>></option>
                  <?php while($a = mysqli_fetch_assoc($authorinfo)): ?>
                  <option value="<?=$a['id'];?>"<?=(($author_id == $a['id'])?' selected':'');?>><?=$a['department_name_fa'].' | '.$a['first_name_fa'].' | '.$a['last_name_fa'];?>
                  </option>
                <?php endwhile;?>
                </select>
              </div>
              <div class="form-group">
                <label for="supervisor" class="col-form-label-sm float-right"><?=$lang['paperadd-supervisor']?></label>
                <select class="custom-select custom-select-sm" id="supervisor_id" name="supervisor_id">
                  <option value=""<?=(($supervisor_id == '')?' selected':'');?>></option>
                  <?php while($s = mysqli_fetch_assoc($supervisorinfo)): ?>
                  <option value="<?=$s['id'];?>"<?=(($supervisor_id == $s['id'])?' selected':'');?>><?=$s['department_name_fa'].' | '.$s['first_name_fa'].' | '.$s['last_name_fa'];?>
                  </option>
                  <?php endwhile; ?>
                </select>

                <a href="#addOtherSupervisor" data-toggle="collapse">
                  <div class="">
                    <span class="text-right"><?=$lang['paperadd-otherSupervisor']?></span>
                  </div>
                </a>
              </div>


          <div id="addOtherSupervisor" class="collapse">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="osname" class="col-form-label-sm float-right"><?=$lang['paperadd-osfname']?></label>
                <input type="text" class="form-control col-form-label-sm" id="osname" name="osname" value="">
              </div>
              <div class="form-group col-md-6">
                <label for="oslname" class="col-form-label-sm float-right"><?=$lang['paperadd-oslname']?></label>
                <input type="text" class="form-control col-form-label-sm" id="oslname" name="oslname" value="">
              </div>
              <div class="form-group col-md-12">
                <label for="osdegree" class="col-form-label-sm float-right"><?=$lang['paperadd-osdegree']?></label>
                <input type="text" class="form-control col-form-label-sm" id="osdegree" name="osdegree" value="">
              </div>
              <div class="form-group col-md-6">
                <label for="osuniversity" class="col-form-label-sm float-right"><?=$lang['paperadd-osuniversity']?></label>
                <input type="text" class="form-control col-form-label-sm" id="osuniversity" name="osuniversity" value="">
              </div>
              <div class="form-group col-md-6">
                <label for="osfaculty" class="col-form-label-sm float-right"><?=$lang['paperadd-osfaculty']?></label>
                <input type="text" class="form-control col-form-label-sm" id="osfaculty" name="osfaculty" value="">
              </div>
            </div>
          </div>

          <div class="form-group">
            <input type="file" class="col-form-label-sm form-control" id="paperfile" name="paperfile" accept="application/pdf">
            <p class="help-block text-right" style="font-size: 80%;"><?=$lang['paperadd-helpForFile']?></p>
            <span><?php
              if (isset($_GET['edit'])) { ?>
                file is : <a href="' <?= $dbpath; ?> '"> <?= $dbpath; ?> </a>
              <?php }
            ?></span>
          </div>
          <div class="form-group float-right">
            <a href="papers.php" class="btn btn-default"><?=$lang['paperadd-cancelbtn']?></a>
            <input type="submit" class="btn btn-success float-right" value="<?=((isset($_GET['edit']))?$lang['submiteditbtn']:$lang['submitaddbtn']);?>">
          </div>


          </div>
          </div>
        </fieldset>
      </form>

</div>

<!-- // end of add page -->
<?php }else{ ?>
<h2 class="text-center"><?=$lang['paperlist_page_title']?></h2>
    <a href="papers.php?add=1" class="btn btn-success" id="add-paper-btn"><?=$lang['paperlist_add_btn']?></a><div class="clearfix"></div>
    <hr>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all"aria-selected="true">همه</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="research-tab" data-toggle="tab" href="#research" role="tab" aria-controls="research"aria-selected="false">تحقیق</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="translation-tab" data-toggle="tab" href="#translation" role="tab" aria-controls="translation"
      aria-selected="false">ترجمه</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="publication-tab" data-toggle="tab" href="#publication" role="tab" aria-controls="publication"
      aria-selected="false">تالیف</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="essay-tab" data-toggle="tab" href="#essay" role="tab" aria-controls="essay"
      aria-selected="false">مقاله</a>
      </li>
    </ul>

    <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
    <table id="papers_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="text-center"><?=$lang['paperlist_title']?></th>
                <th class="text-center"><?=$lang['paperlist_abstract']?></th>
                <th class="text-center"><?=$lang['paperlist_author']?></th>
                <th class="text-center"><?=$lang['paperlist_faculty']?></th>
                <th class="text-center"><?=$lang['paperlist_department']?></th>
                <th class="text-center"><?=$lang['paperlist_category']?></th>
                <th class="text-center"><?=$lang['paperlist_vd']?></th>
                <th class="text-center"><?=$lang['paperlist_dd']?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
          <?php
          $paperslist = $db->query("SELECT * FROM paper_list");
          while($paper = mysqli_fetch_assoc($paperslist)): ?>
          <tr>
            <td class="text-right"><?= $paper['title_fa'] ?></td>
            <td class="text-right"><?= $paper['abstract_fa'] ?></td>
            <td class="text-right"><?= $paper['author_firstname'].' '.$paper['author_lastname'] ?></td>
            <td class="text-right"><?= $paper['faculty'] ?></td>
            <td class="text-right"><?= $paper['department'] ?></td>
            <td class="text-right"><?= $paper['category_fa'] ?></td>
            <td class="text-right" style="font-size: 80%;"><?= $paper['varification_date'] ?></td>
            <td class="text-right" style="font-size: 80%;"><?= $paper['defence_date'] ?></td>
            <td><button class="btn btn-primary btn-sm" onclick="detailsmodalpaper(<?= $paper['id']; ?>)">...</button></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="research" role="tabpanel" aria-labelledby="research-tab">
    <table id="papers_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="text-center"><?=$lang['paperlist_title']?></th>
                <th class="text-center"><?=$lang['paperlist_abstract']?></th>
                <th class="text-center"><?=$lang['paperlist_author']?></th>
                <th class="text-center"><?=$lang['paperlist_faculty']?></th>
                <th class="text-center"><?=$lang['paperlist_department']?></th>
                <th class="text-center"><?=$lang['paperlist_category']?></th>
                <th class="text-center"><?=$lang['paperlist_vd']?></th>
                <th class="text-center"><?=$lang['paperlist_dd']?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
          <?php
          $paperslist = $db->query("SELECT * FROM paper_list WHERE category_fa = 'research'");
          while($paper = mysqli_fetch_assoc($paperslist)): ?>
          <tr>
            <td class="text-right"><?= $paper['title_fa'] ?></td>
            <td class="text-right"><?= $paper['abstract_fa'] ?></td>
            <td class="text-right"><?= $paper['author_firstname'].' '.$paper['author_lastname'] ?></td>
            <td class="text-right"><?= $paper['faculty'] ?></td>
            <td class="text-right"><?= $paper['department'] ?></td>
            <td class="text-right"><?= $paper['category_fa'] ?></td>
            <td class="text-right" style="font-size: 80%;"><?= $paper['varification_date'] ?></td>
            <td class="text-right" style="font-size: 80%;"><?= $paper['defence_date'] ?></td>
            <td><button class="btn btn-primary btn-sm" onclick="detailsmodalpaper(<?= $paper['id']; ?>)">...</button></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
  </div>

  <div class="tab-pane fade" id="translation" role="tabpanel" aria-labelledby="translation-tab">
    <table id="papers_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="text-center"><?=$lang['paperlist_title']?></th>
                <th class="text-center"><?=$lang['paperlist_abstract']?></th>
                <th class="text-center"><?=$lang['paperlist_author']?></th>
                <th class="text-center"><?=$lang['paperlist_faculty']?></th>
                <th class="text-center"><?=$lang['paperlist_department']?></th>
                <th class="text-center"><?=$lang['paperlist_category']?></th>
                <th class="text-center"><?=$lang['paperlist_vd']?></th>
                <th class="text-center"><?=$lang['paperlist_dd']?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
          <?php
          $paperslist = $db->query("SELECT * FROM paper_list WHERE category_fa = 'translation'");
          while($paper = mysqli_fetch_assoc($paperslist)): ?>
          <tr>
            <td class="text-right"><?= $paper['title_fa'] ?></td>
            <td class="text-right"><?= $paper['abstract_fa'] ?></td>
            <td class="text-right"><?= $paper['author_firstname'].' '.$paper['author_lastname'] ?></td>
            <td class="text-right"><?= $paper['faculty'] ?></td>
            <td class="text-right"><?= $paper['department'] ?></td>
            <td class="text-right"><?= $paper['category_fa'] ?></td>
            <td class="text-right" style="font-size: 80%;"><?= $paper['varification_date'] ?></td>
            <td class="text-right" style="font-size: 80%;"><?= $paper['defence_date'] ?></td>
            <td><button class="btn btn-primary btn-sm" onclick="detailsmodalpaper(<?= $paper['id']; ?>)">...</button></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
  </div>

  <div class="tab-pane fade" id="publication" role="tabpanel" aria-labelledby="publication-tab">
    <table id="papers_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="text-center"><?=$lang['paperlist_title']?></th>
                <th class="text-center"><?=$lang['paperlist_abstract']?></th>
                <th class="text-center"><?=$lang['paperlist_author']?></th>
                <th class="text-center"><?=$lang['paperlist_faculty']?></th>
                <th class="text-center"><?=$lang['paperlist_department']?></th>
                <th class="text-center"><?=$lang['paperlist_category']?></th>
                <th class="text-center"><?=$lang['paperlist_vd']?></th>
                <th class="text-center"><?=$lang['paperlist_dd']?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
          <?php
          $paperslist = $db->query("SELECT * FROM paper_list WHERE category_fa = 'publication'");
          while($paper = mysqli_fetch_assoc($paperslist)): ?>
          <tr>
            <td class="text-right"><?= $paper['title_fa'] ?></td>
            <td class="text-right"><?= $paper['abstract_fa'] ?></td>
            <td class="text-right"><?= $paper['author_firstname'].' '.$paper['author_lastname'] ?></td>
            <td class="text-right"><?= $paper['faculty'] ?></td>
            <td class="text-right"><?= $paper['department'] ?></td>
            <td class="text-right"><?= $paper['category_fa'] ?></td>
            <td class="text-right" style="font-size: 80%;"><?= $paper['varification_date'] ?></td>
            <td class="text-right" style="font-size: 80%;"><?= $paper['defence_date'] ?></td>
            <td><button class="btn btn-primary btn-sm" onclick="detailsmodalpaper(<?= $paper['id']; ?>)">...</button></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
  </div>

  <div class="tab-pane fade" id="essay" role="tabpanel" aria-labelledby="essay-tab">
    <table id="papers_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="text-center"><?=$lang['paperlist_title']?></th>
                <th class="text-center"><?=$lang['paperlist_abstract']?></th>
                <th class="text-center"><?=$lang['paperlist_author']?></th>
                <th class="text-center"><?=$lang['paperlist_faculty']?></th>
                <th class="text-center"><?=$lang['paperlist_department']?></th>
                <th class="text-center"><?=$lang['paperlist_category']?></th>
                <th class="text-center"><?=$lang['paperlist_vd']?></th>
                <th class="text-center"><?=$lang['paperlist_dd']?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
          <?php
          $paperslist = $db->query("SELECT * FROM paper_list WHERE category_fa = 'paper'");
          while($paper = mysqli_fetch_assoc($paperslist)): ?>
          <tr>
            <td class="text-right"><?= $paper['title_fa'] ?></td>
            <td class="text-right"><?= $paper['abstract_fa'] ?></td>
            <td class="text-right"><?= $paper['author_firstname'].' '.$paper['author_lastname'] ?></td>
            <td class="text-right"><?= $paper['faculty'] ?></td>
            <td class="text-right"><?= $paper['department'] ?></td>
            <td class="text-right"><?= $paper['category_fa'] ?></td>
            <td class="text-right" style="font-size: 80%;"><?= $paper['varification_date'] ?></td>
            <td class="text-right" style="font-size: 80%;"><?= $paper['defence_date'] ?></td>
            <td><button class="btn btn-primary btn-sm" onclick="detailsmodalpaper(<?= $paper['id']; ?>)">...</button></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
  </div>
</div>
    <hr>

    <?php } ?>

  <script>
    $(document).ready(function() {
      $("#papers_table").DataTable(
        {
          //"autoWidth": false,
          "lengthMenu": [[15,30,45,60,-1],[15,30,45,60,"All"]],
          "ordering": true,
          stateSave: true,
          "language": {
            "info": "نشان دهنده از _START_ تا _END_ ازمجموعه _TOTAL_ رکود",
            "search": "جستجو",
            "lengthMenu": "تعداد _MENU_ نشان داده شده است |",
            "zeroRecords": "No Data Found"
          },
          scrollX:        true,
          scrollCollapse: true,
          autoWidth:         true,
          columnDefs: [
          { "width": "200px", "targets": [0] },
          { "width": "200px", "targets": [1] },
          { "width": "80px", "targets": [4] }
          ]
        }
      );
    });
  </script>
  <?php include 'includes/footer.php'; ?>
