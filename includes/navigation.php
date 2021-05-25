<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <a class="navbar-brand" href="#"><img src="images/fu_logo.jpg" width="30" height="30"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav navbar-right">
      <li class="nav-item active">
        <a class="nav-link" href="index.php"><?php echo $lang['menu_home'] ?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $lang['menu_faculty'] ?></a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="faculty.php"><?php echo $lang['submenu_duration'] ?></a>
          </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="department.php"><?php echo $lang['menu_department'] ?></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $lang['menu_scientific_affairs']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="lecturers.php"><?php echo $lang['submenu_hom'] ?></a>
          <a class="dropdown-item" href="papers.php"><?php echo $lang['submenu_hosr'] ?></a>
          <a class="dropdown-item" href="papers.php">آمریت ارتقای کیفیت و اعتبار دهی</a>
          <a class="dropdown-item" href="papers.php">آمریت انکشاف مسلکی استادان</a>
        </div>
      </li>
    </ul>

    <!-- <span class="my-2 my-lg-0">
        <a href="?lang=dr"><img src="images/af.svg" width="15" heigth="15"></a>
        <a href="?lang=en"><img src="images/us.svg" width="15" heigth="15"></a>
    </span> -->
  </div>
</nav>
