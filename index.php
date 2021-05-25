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
  <div class="row">
  <div class="col-md-12">
    <p class="text-right">پوهنتون فاریاب به منظور بر آورده شدن نیازمندی های جامعه و ارتقای سطح اقتصاد کشور، جهت تربیه کادر های مسلکی در رشته های تعلیم و تربیه، ادبیات و علوم بشری، انجنیری،‌زراعت، اقتصاد و حقوق به سویه لیسانس در زمره سایر پوهنتون های کشور عرض اندام نموده و فارغ التحصیلان این پوهنتون جهت رفع نیازمندی های موجوده جامعه در عرصه های مختلف موسساتی تولیدی و تحصیلی نقش اساسی را ایفا می نماید.</p>
    <p class="text-right">پوهنتون فاریاب منحیث یگانه نهاد تحصیلی دولتی در فاریاب کادر های مسلکی را در رشته های تعلیم و تربیه، ادبیات و علوم بشری، زراعت، حقوق،‌انجنیری و اقتصاد به سویه لیسانس تربیه نموده و تقدیم جامعه می نماید همواره در صدد آن است تا به تربیه کادر های مسلکی ماهر در رشته های فوق الذکر سهم دینی خویش را در برابر ملت و کشور ادا نموده و جایگاه خود را در بین بهترین پوهنتون های کشور احراز نماید. درین نهاد تحصیلی، بیشتراز ۱۶۰ تن عضو کادر علمی با رتب علمی متفاوت در پوهنحی های مختلف مصروف تدریس هستند که گراف ذیل نشان دهنده آن است.</p>

    <div id="gradeChart"></div>
  </div>
</div>

<!-- 2nd row -->
<div class="row">
  <div class="col-md-12 bg-success">for age of the lecturers</div>
</div>

<script>
Highcharts.chart('gradeChart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'تعداد استادان پوهنحی ها باساس رتب علمی'
    },
    xAxis: {
        categories: ['ادبیات و علوم بشری', 'اقتصاد', 'انجنیری', 'تعلیم وتربیه', 'حقوق و علوم سیاسی', 'زراعت']
    },
    yAxis: {
        allowDecimals: false,
        min: 0,
        title: {
            text: 'تعداد استادان'
        }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.x + '</b><br/>' +
                this.series.name + ': ' + this.y + '<br/>' +
                'Total: ' + this.point.stackTotal;
        }
    },
    plotOptions: {
        column: {
            stacking: 'normal'
        }
    },
    series: [{
        name: 'پوهیالی',
        data: [18, 11, 11, 14, 5, 17],
        stack: 'female'
    }, {
        name: 'نامزد پوهنیار',
        data: [1, 3, 4, 3, 2, 0],
        stack: 'female'
    }, {
        name: 'پوهنیار',
        data: [11, 1, 2, 8, 4, 8],
        stack: 'female'
    }, {
        name: 'پوهنمل',
        data: [7, 0, 0, 7, 1, 0],
        stack: 'female'
    }, {
        name: 'پوهنوال',
        data: [3, 0, 0, 4, 0, 0],
        stack: 'female'
    }, {
        name: 'پوهندوی',
        data: [3, 0, 1, 7, 0, 1],
        stack: 'female'
    }, {
        name: 'پوهاند',
        data: [1, 0, 0, 1, 0, 0],
        stack: 'female'
    }]
});
</script>

<?php include 'includes/footer.php'; ?>
