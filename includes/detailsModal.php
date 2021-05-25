<?php
ob_start();
require_once '../core/init.php';
//require 'header.php';
$id = $_POST['id'];
$id = (int)$id;
$sql = "SELECT * FROM employee WHERE id = '$id'";
$result = $db->query($sql);
$employees  = mysqli_fetch_assoc($result);
?>
<!-- modal -->
<div class="modal fade" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">This Modal title</h4>
      </div>
     <div class="modal-body">
       <div class="row">
        <div class="col-md-2 bg-warning">Add some text here
        </div>
        <div class="col-md-5 bg-primary text-right">
          <b>اسم و تخلص: </b><?=$employees['first_name_fa'] .'   '.$employees['last_name_fa'];?>
        </div>
        <div class="col-md-5 bg-dark"><a href="lecturers.php?edit=<?=$employees['id'];?>">edit</a></div>
      </div>
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-default" onclick="closeModal()">Close</button>
      <button type="button" class="btn btn-primary">Submit changes</button>
     </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal -->



<script>
  function closeModal(){
    jQuery('#details-modal').modal('hide');
    setTimeout(function(){
      jQuery('#details-modal').remove();
    },500);
  }
</script>
<?php echo ob_get_clean(); ?>
