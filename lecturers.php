<?php
require_once 'core/init.php';
include 'lang/' . $_SESSION['lang'] . '.php';
include 'includes/header.php';
include 'includes/navigation.php';
include 'wrappers/helpers.php';
//unset($_SESSION);
?>

<div class="container">
  <?php
    $lecturerlist = $db->query("SELECT * FROM employee WHERE professor_id is not null");
    if(isset($_GET['add']) || isset($_GET['edit'])){ ?>
      <div id="add_employee">
        <form action="papers.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="POST" enctype="multipart/form-data">
        <h4 class="text-center"><?=$lang['lectureradd-page-title']?></h4>
          <fieldset class="form-group">
            <div class="row col-md-9 mx-auto">
              <p class="text-right" style="font-size: 90%;"><?=$lang['lectureradd-header']?></p>
              <hr>
              <legend class="col-md-4 col-form-label pt-0 float-right text-right"><?=$lang['lectureradd-info']?></legend>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="title" class="col-form-label-sm float-right"><?=$lang['paperadd-title']?><span class="text-danger">*</span></label>
                  <input type="text" class="form-control col-form-label-sm text-right" id="title_fa" name="title_fa" value="<?=$title_fa;?>">
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
                      <select class="custom-select custom-select-sm" id="author_id" name="author_id">
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
  <?php  } else {
  ?>

  <h3 class="text-center"><?=$lang['lecturerlist-title'] ?></h3>
  <a href="lecturers.php?add=1" class="btn btn-success" id="add-lecturer-btn"><?=$lang['lecturerlist_add_btn']?></a><div class="clearfix"></div>
  <hr>
  <div class="table-responsive">
    <table id="lecturers_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="text-center"><?=$lang['lecturerlist-id'] ?></th>
                <th class="text-center"><?=$lang['lecturerlist-first_name_fa'] ?></th>
                <th class="text-center"><?=$lang['lecturerlist-last_name_fa'] ?></th>
                <th class="text-center"><?=$lang['lecturerlist-position_fa'] ?></th>
                <th class="text-center"><?=$lang['lecturerlist-department_name_fa'] ?></th>
                <th class="text-center"><?=$lang['lecturerlist-faculty_fa'] ?></th>
                <th class="text-center"><?=$lang['lecturerlist-contact-no'] ?></th>

                <th class="text-center"><?=$lang['lecturerlist-age'] ?></th>
                <th class="text-center"><?=$lang['lecturerlist-details'] ?></th>

            </tr>
        </thead>
        <tbody>
          <?php while($lecturer = mysqli_fetch_assoc($lecturerlist)): ?>

          <tr>
            <td class="text-right"><?= $lecturer['id'] ?></td>
            <td class="text-right"><?= $lecturer['first_name_fa'] ?></td>
            <td class="text-right"><?= $lecturer['last_name_fa'] ?></td>
            <td class="text-right"><?= $lecturer['position_fa'] ?></td>
            <td class="text-right"><?= $lecturer['department_name_fa'] ?></td>
            <td class="text-right"><?= $lecturer['faculty_name_fa'] ?></td>
            <td class="text-right"><?= $lecturer['contact_no'] ?></td>
            <td><?php
            $shamsi = strtok($lecturer['date_of_birth'], '-');
            $year = date("Y", time()) - $shamsi - 621;
             echo $year?></td>
            <!-- <td><button class="btn btn-sm" onclick="detailsmodal(<?= $lecturer['id']; ?>)"><?=$lang['lecturerlist-details'] ?></button></td> -->
            <td><a href="lecturer-info.php?id=<?= $lecturer['id']?>"><?=$lang['lecturerlist-details'] ?></a></td>
          </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
  </div>


  <hr>

<?php } ?>

<script>
  $(document).ready(function() {
    $("#lecturers_table").DataTable(
      {
        //"autoWidth": false,
        "lengthMenu": [[15,30,45,60,-1],[15,30,45,60,"All"]],
        "ordering": true,
        stateSave: true,
        "language": {
          "info": "نشان دهنده از _START_ تا _END_ ازمجموعه _TOTAL_ رکود",
          "search": "جستجو",
          "lengthMenu": "تعداد _MENU_ نشان داده شده است |"
        },
        scrollX:        true,
        scrollCollapse: true,
        autoWidth:         true,
        columnDefs: [
        { "width": "30px", "targets": [0] },
        { "width": "40px", "targets": [4] }
        ]
      }
    );
  });
</script>

<?php include 'includes/footer.php'; ?>
