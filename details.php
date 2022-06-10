<?php
if (isset($_GET['ID'])) {

  $servername = 'pi.cs.oswego.edu:3306';
  $username = 'fsanche3';
  $password = 'isc496';
  $dbname = 'fsanche3_22S';

  $conn = new mysqli($servername,$username,$password,$dbname);
  $ID = mysqli_real_escape_string($conn, $_GET['ID']);

$sql = "SELECT * FROM exo WHERE exoID= '$ID' ";

$result = mysqli_query($conn, $sql) or die ("Bad Query: $sql");


} else {
  header('Location: index.php');
}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <script src="https://kit.fontawesome.com/004a7bb312.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles3.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>The Exoplanet Archive</title>
<link rel="icon" type="image/x-icon" href="https://static01.nyt.com/images/2022/02/21/opinion/sunday/18shesol/18shesol-superJumbo.jpg">

<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet'
type='text/css'/>

</head>
 <body>
<section class="wrapper"> <div id="stars"></div> <div id="stars2"></div> <div
id="stars3"></div> </section>

<section class="grid">

<section class="back-to" style= font-family = "Lato"><h1> <a href= "index.php"> Back to Archive </a> </h1>
 </section>

<section class="nav"><nav>
  <ul>
    <li><a href="about.html"> About </a></li>
  <li><a href= "whats-an-exoplanet.html"> What's An Exoplanet?</a></li>
  <li><a href="index.php"> Home</a><li>
  </ul>
</nav>
</section>
<?php
 while ($row = mysqli_fetch_array($result)) {

   echo " <section class='header' style=font-family = 'Audiowide'>
         <h2 style=font-family = 'Audiowide'> {$row['PlanetName']}</h2>
       </section>

       <section class='dataTable'>
       <section class= 'gridcon'>

         <section class='grid1'>
         <h4> Distance(pc) From the Sun </h4><br>
         <p>  {$row['SyDist']} </p>
           </section>

           <section class='grid2'>
             <h4> Discovery Year </h4><br>
         <p>   {$row['DiscYear']} </p>
             </section>

             <section class='grid3'>
               <h4> Discovery Method </h4> <br>
           <p>    {$row['DiscMeth']} </p>
               </section>

               <section class='grid4'>
                 <h4> Discovery Telescope </h4><br>
           <p>    {$row['DiscTel']} </p>
                 </section>

                 <section class='grid5'>
                   <h4> Planet Orbital Period(days) </h4><br>
             <p>    {$row['PlOrb']} </p>
                   </section>

                   <section class='grid6'>
                     <h4> Jupiter Radius </h4><br>
               <p>     {$row['PlRadj']} </p>
                     </section>

                     <section class='grid7'>
                       <h4> Earth Mass </h4><br>
                 <p>   {$row['PlMasse']}</p>
                       </section>

                       <section class='grid8'>
                         <h4> Planet Orbital Eccentricity </h4><br>
                   <p>    {$row['PlOrbeccen']}</p>
                   </section>

                   <section class='grid9'>
                     <h4> Moons </h4><br>
                  <p>    {$row['Moons']}</p>
                  </section>

                  <section class='grid10'>
                    <h4> Earth Radius </h4><br>
              <p>    {$row['PlRade']}</p>
</section>
              <section class='grid11'>
                <h4> Jupiter Mass </h4><br>
          <p>    {$row['PlMassj']}</p>
</section>
          <section class='grid12'>
            <h4> Density(kg/m^3) </h4><br>
      <p>    {$row['Density']}</p>
</section>
      <section class='grid13'>
        <h4> Discovery Facility </h4><br>
  <p>    {$row['DiscFac']}</p>
</section>




       </section>
       </section>
"
;}
   ?>
<br>
   <section align="center" class="dash2">
     <ul style="list-style-type:none;">
       <h4> How to compare? </h4>
       <li>Hover over planet's to see details on the bottom right.</li>
       <li>Change measurement comparison using the drop down menu on the top right.</li>
       <li>Hover over bar to see exact measurement.</li>
     </ul>

   </section>

<section class="dashboard" style="text-align:center">
  <h2> Compared to Solar System Bodies</h2>

<div class='tableauPlaceholder' id='viz1651351019475' style='position: relative'><noscript><a href='#'><img alt='Dashboard 1 ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;8H&#47;8HRZJRFQC&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='path' value='shared&#47;8HRZJRFQC' /> <param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;8H&#47;8HRZJRFQC&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /><param name='language' value='en-US' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1651351019475');                    var vizElement = divElement.getElementsByTagName('object')[0];                    if ( divElement.offsetWidth > 800 ) { vizElement.style.width='100%';vizElement.style.height='812px';} else if ( divElement.offsetWidth > 500 ) { vizElement.style.width='1024px';vizElement.style.height='712px';} else { vizElement.style.width='100%';vizElement.style.height='694px';}                     var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>

</section>








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





</section>








</body>
</html>
