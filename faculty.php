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
    <div id="litChart"></div>
    <div id="eduChart"></div>
    <div id="agrChart"></div>
    <?php
  $employeesql = $db->query("SELECT * FROM employee WHERE enrollment_date is not null");

  $litduration = array(); $litname = array();
  $eduduration = array(); $eduname = array();
  $agrduration = array(); $agrname = array();
  $ecoduration = array(); $econame = array();
  $lawduration = array(); $lawname = array();
  $engduration = array(); $engname = array();
  while($d = mysqli_fetch_assoc($employeesql)){
    switch ($d['faculty_name_en']) {
      case 'Literature':
        array_push($litname, "'".$d['first_name_fa'].' '.$d['last_name_fa']."'");
        $shamsi = strtok($d['enrollment_date'], '-');
        $year = date("Y", time()) - $shamsi - 621;
        array_push($litduration, $year);
        break;
      case 'Education':
        array_push($eduname, "'".$d['first_name_fa'].' '.$d['last_name_fa']."'");
        $shamsi = strtok($d['enrollment_date'], '-');
        $year = date("Y", time()) - $shamsi - 621;
        array_push($eduduration, $year);
        break;
      case 'Agriculture':
        array_push($agrname, "'".$d['first_name_fa'].' '.$d['last_name_fa']."'");
        $shamsi = strtok($d['enrollment_date'], '-');
        $year = date("Y", time()) - $shamsi - 621;
        array_push($agrduration, $year);
        break;
      case 'Economic':
        array_push($econame, "'".$d['first_name_fa'].' '.$d['last_name_fa']."'");
        $shamsi = strtok($d['enrollment_date'], '-');
        $year = date("Y", time()) - $shamsi - 621;
        array_push($ecoduration, $year);
        break;
      case 'Politics and Law':
        array_push($lawname, "'".$d['first_name_fa'].' '.$d['last_name_fa']."'");
        $shamsi = strtok($d['enrollment_date'], '-');
        $year = date("Y", time()) - $shamsi - 621;
        array_push($lawduration, $year);
        break;
      case 'Engineering':
        array_push($engname, "'".$d['first_name_fa'].' '.$d['last_name_fa']."'");
        $shamsi = strtok($d['enrollment_date'], '-');
        $year = date("Y", time()) - $shamsi - 621;
        array_push($engduration, $year);
        break;
    }
  }
  $litname = implode(',', $litname);
  $litduration = implode(',', $litduration);

  $eduname = implode(',', $eduname);
  $eduduration = implode(',', $eduduration);

  $agrname = implode(',', $agrname);
  $agrduration = implode(',', $agrduration);

  ?>
    <script>
    var litname = <?php echo '['.$litname.']'; ?>;
    var litduration = <?php echo '['.$litduration.']'; ?>;

    var eduname = <?php echo '['.$eduname.']'; ?>;
    var eduduration = <?php echo '['.$eduduration.']'; ?>;

    var agrname = <?php echo '['.$agrname.']'; ?>;
    var agrduration = <?php echo '['.$agrduration.']'; ?>;

    Highcharts.chart('litChart', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'مدت خدمت استادان پوهنتون فاریاب'
        },
        subtitle: {
            text: 'پوهنحی ادبیات و علوم بشری'
        },
        xAxis: {
            categories: litname,
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
            name: 'مدت خدمت',
            data: litduration
        }]
    });

    Highcharts.chart('eduChart', {
        chart: {
            type: 'area'
        },
        title: {
            text: 'مدت خدمت استادان پوهنتون فاریاب'
        },
        subtitle: {
            text: 'پوهنحی تعلیم وتربیه'
        },
        xAxis: {
            categories: eduname,
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
            name: 'مدت خدمت',
            data: eduduration,
            color: 'green'
        }]
    });

    Highcharts.chart('agrChart', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'مدت خدمت استادان پوهنتون فاریاب'
        },
        subtitle: {
            text: 'پوهنحی زراعت'
        },
        xAxis: {
            categories: agrname,
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
            name: 'مدت خدمت',
            data: agrduration,
            color: 'yellow'
        }]
    });
    </script>

    <?php include 'includes/footer.php'; ?>