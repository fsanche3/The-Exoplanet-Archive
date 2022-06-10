
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <script src="https://kit.fontawesome.com/004a7bb312.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

   <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta
http-equiv="X-UA-Compatible" content="ie=edge">
<title>The Exoplanet Archive</title>
<link rel="icon" type="image/x-icon" href="https://static01.nyt.com/images/2022/02/21/opinion/sunday/18shesol/18shesol-superJumbo.jpg">
<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet'
type='text/css'/>

<style>


a{
  color: black;
}

a:hover{
  color: black;
  text-decoration: none;
}

h1{
  font-family: 'Lato';
  color: black;
  text-align: left
  justify-content: center;
}




</style>

</head>

 <body>
<section class="wrapper"> <div id="stars"></div> <div id="stars2"></div> <div
id="stars3"></div> </section>


<section class="grid">
<section class="title" style= font-family = "Lato"><h1> <a href= "index.php">The Exoplanet Archive </a> </h1> </section>
<section class="nav"><nav>
  <ul>
    <li><a href="about.html"> About </a></li>
    <li><a href= "whats-an-exoplanet.html"> What's An Exoplanet?</a></li>
      <li><a href="index.php"> Home</a><li>
  </ul>
</nav></section>

<section class="slideshow">
<!-- slideshow start --->
<!--image slider start-->
    <div class="slider">
      <div class="slides">
        <!--radio buttons start-->
        <input type="radio" name="radio-btn" id="radio1">
        <input type="radio" name="radio-btn" id="radio2">
        <input type="radio" name="radio-btn" id="radio3">
        <input type="radio" name="radio-btn" id="radio4">
        <!--radio buttons end-->


        <!--slide images start-->
        <div class="slide first">
          <img class="imageser" src="https://exoplanets.nasa.gov/system/resources/detail_files/307_iau1301a_s.jpg" alt="What Is an Exoplanet?">
          <div class="bottom-left"> <h3>What is an Exoplanet?</h3>
          <p>An exoplanet is a planet outside of our solar system. Just like in ours, there are various types of planets.</p><a href="whats-an-exoplanet.html"> Click here to learn more. </a></div>
      </div>
        <div class="slide">
          <img class="imageser" src="https://exoplanets.nasa.gov/system/resources/detail_files/15_super600.jpg" alt="Something useful">
          <div class="bottom-left"> <h3>There are various Exoplanet types!</h3>
          <p>For example, Super Earth exoplanets are larger terrestrial or rocky planets larger then Earth yet lighter then Neptune!</p><a href="whats-an-exoplanet.html#1">Click here to learn more</a>  </div>
        </div>
        <div class="slide">
          <img class="imageser" src="https://scx2.b-cdn.net/gfx/news/2022/james-webb-space-teles-2.jpg" alt="Something Important">
          <div class="bottom-left"> <h3>NASA Telescope's</h3>
          <p>The last telescope launched into space in 2021.The James Webb Space Telescope detects through infared light.</p> <a href="https://exoplanets.nasa.gov/discovery/missions/#first-planetary-disk-observed">Click here to learn more</a></div>
        </div>
        <div class="slide">
          <img class="imageser" src="https://caltechsites-prod.s3.amazonaws.com/etlab/images/PlanetsAndDebrisDisks_R31.2e16d0ba.fill-1600x900-c100.jpg" alt="">
          <div class="bottom-left"> <h3>Detection Methods</h3>
          <p>There are a few Detection Methods. A few key ones are Pulsar timing, Transit photometry, and Radial Velocity.</p><a href="https://exoplanets.nasa.gov/alien-worlds/ways-to-find-a-planet/">Click here to learn more</a> </div>
        </div>
        <!--slide images end-->
        <!--automatic navigation start-->
        <div class="navigation-auto">
          <div class="auto-btn1"></div>
          <div class="auto-btn2"></div>
          <div class="auto-btn3"></div>
          <div class="auto-btn4"></div>
        </div>
        <!--automatic navigation end-->
      </div>
      <!--manual navigation start-->
      <div class="navigation-manual">
        <label for="radio1" class="manual-btn"></label>
        <label for="radio2" class="manual-btn"></label>
        <label for="radio3" class="manual-btn"></label>
        <label for="radio4" class="manual-btn"></label>
      </div>
      <!--manual navigation end-->
    </div>
    <!--image slider end-->

    <script type="text/javascript">
    var counter = 1;
    setInterval(function(){
      document.getElementById('radio' + counter).checked = true;
      counter++;
      if(counter > 4){
        counter = 1;
      }
    }, 8500);
    </script>

</section>



<section class="content" >

<?php include 'HomeTable.php'; ?>

</section>
<br>
<section class="footer">
<hr>
<section class="DataSources">
<h4>  Data Sources </h4>
<ul style="list-style-type:none;" style="text-align:left;">
  <li>The Exoplanet dataset was exracted from NASA's Exoplanet Archive. <a href= "https://exoplanetarchive.ipac.caltech.edu/">Click here to be redirected.</a> </li>
  <li>The Solar Bodies dataset was retrieved from <a href= "https://www.kaggle.com/datasets"> kaggle.com</a> </li>
</ul>
</section>
<section class="Linked">
  <ul>
<a href="https://www.linkedin.com/in/franklyn-sanchez/"><li><i class="fa-brands fa-linkedin"></i></li></a>
</ul>
</section>




</section>









  </body>
</html>
