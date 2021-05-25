<?php
  require_once 'core/init.php';
  include 'lang/' . $_SESSION['lang'] . '.php';
  include 'includes/header.php';
  include 'includes/navigation.php';
  include 'wrappers/helpers.php';
?>

<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>
<div class="container">
  <div id="durationChart"></div>
<?php
  $employeesql = $db->query("SELECT * FROM employee WHERE enrollment_date is not null");


    //echo $emp['first_name_fa'].'  '.date("Y", time()) - intval($year). '<br>';
  //}

  ?>

<script>

  // console.log('<?php
  // $datearray = '';
  // $empname = '';
  // while($emp = mysqli_fetch_assoc($employeesql)){
  //
  //   $shamsi = strtok($emp['enrollment_date'], '-');
  //   $year = date("Y", time()) - $shamsi - 621;
  //   $datearray .= $year.",";
  //   $empname .= $emp['first_name_fa'].",";
  //   //echo $datearray;
  //   //echo $emp['first_name_fa'].",";
  // }
  // $datearray .= '0';
  // $empname .= 'x';
  // echo $datearray;
  // echo $empname;
  //  ?>');

   Highcharts.chart('durationChart', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'مدت خدمت استادان پوهنتون فاریاب'
    },
    subtitle: {
        text: 'پوهنحی تعلیم وتربیه'
    },
    xAxis: {
        categories: [
          <?php
          $employeesql = $db->query("SELECT * FROM employee WHERE enrollment_date is not null
           and faculty_name_en in('Education')");
          $empname = '';
          $mm = 'خالی';
          while($emp = mysqli_fetch_assoc($employeesql)){
            $empname .= "'".$emp['first_name_fa']."'".",";
          }
          $empname .= "'".'me'."'";
          echo $empname;
           ?>
        ],
        layout: 'vertical'
    },
    yAxis: {
        title: {
            text: 'مدت خدمت به (سال)'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: false
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Tokyo',
        data: [
          <?php
          $employeesql = $db->query("SELECT * FROM employee WHERE enrollment_date is not null
           and faculty_name_en in('Education')");
          $datearray = '';
          while($emp = mysqli_fetch_assoc($employeesql)){
            $shamsi = strtok($emp['enrollment_date'], '-');
            $year = date("Y", time()) - $shamsi - 621;
            $datearray .= $year.",";
          }
          $datearray .= '0';
          echo $datearray;
           ?>
        ]
    }
    // , {
    //     name: 'London',
    //     data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
    // }
  ]
});



</script>

  <?php include 'includes/footer.php'; ?>
