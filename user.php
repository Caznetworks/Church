<?php
SESSION_start();

@include 'config.php';


if(!isset($_SESSION['UserName'])){
	header('location:login_form.php');
}
?>

<DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Service.css" media="screen">
  <title>Church Appointment</title>
  <link rel="icon" type="F APPOINTMENT" href="Image/logo2.jpg" width=100px height=100px>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <header>
    <div class="navbar">
      <div class="logo"><a href="#">St. Thomas Aquinas Parish Church</a></div>
      <ul class="links">
        <li><a href="Home.html"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="Service.html"><i class="fa-regular fa-books"></i> Services</a></li>
        <li><a href="Requirements.html"><i class="fas fa-book"></i> Prayers</a></li>
        <li><a href="aboutus.html" class="Aboutus"><i class="fas fa-question-circle"></i> About us</a></li>
      </ul>
      <div class="toggle_btn">
        <i class="fa-solid fa-bars"></i>
      </div>
    </div>
    <div class="dropdown_menu">
      <li><a href="Home.html"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="Service.html"><i class="fa-regular fa-books"></i> Services</a></li>
      <li><a href="Requirements.html"><i class="fas fa-book"></i> Prayers</a></li>
      <li><a href="aboutus.html" class="Aboutus"><i class="fas fa-question-circle"></i> About us</a></li>
    </div>
  </header>
  <main>
    <div class="Service_menu">
      <li><a href="Wedd.html">Wedding</a></li>
      <li><a href="Funeral.html">Funeral</a></li>
      <li><a href="Baptist.html">Baptism</a></li>
    </div>
    <section id="Context">
    </section>
  </main>

<!-- JAVA SCRIPT-->

  <script>
    const toggleBtn = document.querySelector('.toggle_btn')
    const toggleBtnIcon = document.querySelector('.toggle_btn i')
    const dropDownMenu = document.querySelector('.dropdown_menu')

    toggleBtn.onclick = function(){
      dropDownMenu.classList.toggle('open')
      const isOpen = dropDownMenu.classList.contains('open')

      toggleBtnIcon.classList = isOpen
      ? 'fa-solid fa-xmark'
      : 'fa-solid fa-bars'
    }
  </script>
    <<nav>
      <ul>
        <li><a href="Home.html"><i class="fas fa-home"></i>Home</a></li>
        <li class="dropdown"><a href="#"><i class="fas fa-list"></i>Services<span>&rsaquo;</span></a>
          <ul>
            <li><a href="Wedding.html">Wedding</a></li>
            <li><a href="Funeral.html">Funeral</a></li>
            <li><a href="Baptist.html">Baptism</a></li>
          </ul>
        </li>
        <li><a href="Requirements.html"><i class="fas fa-book"></i>Prayers</a></li>
        <li><a href="aboutus.html" class="Aboutus"><i class="fas fa-question-circle"></i>About us</a></li>
      </ul>
    </nav>
    <div class="text">
      
      <H1>St. Thomas Aquinas</H1>
      <H2>Parish Church</H2>
    </div>>
</body>
</html>