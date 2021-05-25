<?php
ob_start();
require_once '../core/init.php';
include '../lang/' . $_SESSION['lang'] . '.php';
//require 'header.php';
$id = $_POST['id'];
$id = (int)$id;
$sql = "SELECT * FROM paper_list WHERE id = '$id'";
$result = $db->query($sql);
$paper  = mysqli_fetch_assoc($result);
?>
<!-- modal -->
<div class="modal fade" id="details-modal-paper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close text-left" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title text-right" id="myModalLabel">معلومات بیشتر درباره مقاله یا اثر</h4>
      </div>
     <div class="modal-body">
       <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-11 text-right">
          <h4><?=$paper['title_fa']?></h4>
          <?=$lang['paperlist_author'].': '.$paper['author_firstname'].' '.$paper['author_lastname']?><br>
          <?=$lang['paperlist_supervisor'].': '.$paper['supervisor_firstname'].' '.$paper['supervisor_lastname']?><br>
          <?=$lang['paperlist_faculty'].': '.$paper['faculty']?><br>
          <?=$lang['paperlist_department'].': '.$paper['department']?><br>
          <?=$lang['paperlist_description'].': '.$paper['description_fa']?><br>
          <?=$lang['paperlist_file'].': '?><a href="<?=$paper['file']?>"><?=$paper['file']?></a><br>
          <div class="btn-group-xs">
            <a href="papers.php?edit=<?=$paper['id']?>">
            <button type="button" class="btn btn-default bg-dark">ویرایش</button></a>
            <a href="papers.php?delete=<?=$paper['id']?>">
            <button type="button" class="btn btn-default bg-danger">حذف مقاله</button></a>
          </div>
          <p class="text-warning text-sm">ازین که معلومات درج شونده مقاله یا اثر کم است بنا خذف آن و دوباره درج آن ترجیح داده میشود نسبت به ویرایش آن.</p>
        </div>
      </div>
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-default" onclick="closeModal()">بستن</button>
      <!-- <button type="button" class="btn btn-primary">Submit changes</button> -->
     </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal -->
<script>
  function closeModal(){
    jQuery('#details-modal-paper').modal('hide');
    setTimeout(function(){
      jQuery('#details-modal-paper').remove();
    },500);
  }
</script>
<?php echo ob_get_clean(); ?>
