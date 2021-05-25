<footer class="page-footer font-small p-3 mb-2 bg-light text-dark">

<div class="footer-copyright text-center py-3">© 2020 در
    <a href="https:http://faryab.edu.af/en"> پوهنتون فاریاب</a> تهیه شده است
</div>
</footer>

</div>
<!-- end of the container -->

<script>

function detailsmodal(id){
  var data = {"id" : id};
  jQuery.ajax({
    url : 'includes/detailsModal.php',
    method : "post",
    data : data,
    success: function(data){
      jQuery('body').append(data);
      jQuery('#details-modal').modal('toggle');
    },
    error: function(){
      alert("something went wrong!");
    }
  });
}

function detailsmodalpaper(id){
  var data = {"id" : id};
  jQuery.ajax({
    url : 'includes/detailsModalPaper.php',
    method : "post",
    data : data,
    success: function(data){
      jQuery('body').append(data);
      jQuery('#details-modal-paper').modal('toggle');
    },
    error: function(){
      alert("something went wrong!");
    }
  });
}
</script>

</body>
</html>
