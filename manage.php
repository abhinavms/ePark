<?php
include("php/credentials.php");
// Opens a connection to a MySQL server
$db_selected = mysqli_connect($host, $username, $password, $database);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}
$stat = $_POST['status'];
// Select all the rows in the markers table
if(isset($_POST['submit']) && $_POST['submit'] == "submit"){
    $entered = TRUE;
    $query = "SELECT * FROM nippon WHERE 1";
    $result = mysqli_query($db_selected,$query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error());
    }
    $i=0;
while($row = mysqli_fetch_assoc($result)){
    $license[$i] = $row['VNumber'];
    $arrival[$i] = $row['Arrival'];
    $depart[$i] = $row['Departure'];
    $rate[$i] = $row['Rate'];
    $i++;
}
if($stat == 'taken1'){
    $query = "UPDATE nippon SET `Arrival` = now() WHERE `slno` = '1'";
    $result = mysqli_query($db_selected,$query);
}
else if($stat == 'free1'){
    $query = "UPDATE nippon SET `Departure` = now() WHERE `slno` = '1'";
    $result = mysqli_query($db_selected,$query);
}
else if($stat == 'taken2'){
    $query = "UPDATE nippon SET `Arrival` = now() WHERE `slno` = '2'";
    $result = mysqli_query($db_selected,$query);
}
else if($stat == 'free2'){
    $query = "UPDATE nippon SET `Departure` = now() WHERE `slno` = '2'";
    $result = mysqli_query($db_selected,$query);
}
}
?>
<html class="no-js" lang="en">

<head>

    <meta charset="utf-8">
    <title>ePark</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="js/modernizr.js"></script>
    <script src="js/pace.min.js"></script>

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
<style>
    .s-clients {
        background-color: black;
    }
    .btn, button, input[type="submit"], input[type="reset"], input[type="button"] {
        padding: 0%;
    }
    
    [type="radio"]:checked,
    [type="radio"]:not(:checked) {
        position: absolute;
        left: -9999px;
    }
    [type="radio"]:checked + label,
    [type="radio"]:not(:checked) + label
    {
        position: relative;
        padding-left: 28px;
        cursor: pointer;
        line-height: 20px;
        display: inline-block;
        color: #666;
    }
    [type="radio"]:checked + label:before,
    [type="radio"]:not(:checked) + label:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 18px;
        height: 18px;
        border: 1px solid #ddd;
        border-radius: 100%;
        background: #fff;
    }
    [type="radio"]:checked + label:after,
    [type="radio"]:not(:checked) + label:after {
        content: '';
        width: 12px;
        height: 12px;
        background: rgb(41, 209, 55);
        position: absolute;
        top: 4px;
        left: 4px;
        border-radius: 100%;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }
    [type="radio"]:not(:checked) + label:after {
        opacity: 0;
        -webkit-transform: scale(0);
        transform: scale(0);
    }
    [type="radio"]:checked + label:after {
        opacity: 1;
        -webkit-transform: scale(1);
        transform: scale(1);
    }
</style>
</head>

<body id="top">

    <header class="s-header">

        <div class="header-logo">
            <a class="site-logo" href="index.html">
                <img src="images/logo.png" alt="Homepage">
            </a>
        </div>

        <nav class="header-nav">

<a href="#0" class="header-nav__close" title="close"><span>Close</span></a>

<div class="header-nav__content">
    <h3>Welcome Carl Smith</h3>
    
    <ul class="header-nav__list">
        <li> <img style="padding-top:0%; padding-bottom:20% ;width: 30%" src="images/user.png"> </li>
        <li class="current"><a class="smoothscroll"  href="#0" title="home">Home</a></li>
        <li><a onclick="location.href='join.html'" title="add">Add Parking Spots</a></li>
        <li><a href="#0" title="Payment">Payment Details</a></li>
        <li><a href="#0" title="Accout">Account Information</a></li>
        <li><a href="#0" title="Settings">Settings</a></li>
    </ul>

</div>

</nav> 

        <a class="header-menu-toggle" href="#0">
            <span class="header-menu-text">Menu</span>
            <span class="header-menu-icon"></span>
        </a>

    </header> 

    <section id='home' class="s-about">

        <div class="row section-header has-bottom-sep" data-aos="fade-up">
            <div class="col-full">
                <h3 class="subhead subhead--dark"> Status of your</h3>
                <h1 class="display-1 display-1--light">Parking Spot</h1>
            </div>

        </div>

        <div class="container" style="background-color: white; border-radius: 25px; margin-left: 6%; margin-right: 6%; margin-top: 10%; margin-bottom: 0%">
            <div> <h4 style="padding-left:5%; padding-top:3%; margin: 0%;"> Spot 1 : </h4> </div> 
            <div> <h6 style="padding-left:5%; padding-top:3%; margin: 0%;"> License Number - <?php if($entered){echo $license[0]; }?> </h6> </div>             
            <div> <h6 style="padding-left:5%; padding-top:2%; margin: 0%;"> Current Status 
            <form method = "POST">
            <p style=" margin-top:2%;  margin-bottom:0%">
                  <input type="radio" id = "test1" name = "status" value = "free" checked>
                  <label for="test1">Free</label>
                </p>
                <p style="padding-top:0%; margin-top:0%; margin-bottom:2%;">
                  <input type="radio" id = "test2" name = "status" value = "taken" >
                  <label for="test2">Taken</label>
                  <br>
                  <input type="submit"style="background-color:green; color: white;" name = "submit" value = "submit">
                </p>
          </form>  


                </h6> </div>
             
            <div> <h6 style="padding-left:5%; padding-top:2%; margin: 0%;">Arrival Time - <?php echo $arrival[0]; ?></h6> </div>   
            <div> <h6 style="padding-left:5%; padding-top:2%; margin: 0%;">Departure Time - <?php echo $depart[0]; ?></h6> </div>    
            <div> <h6 style="padding-left:5%; padding-top:2%; padding-bottom:3%; margin: 0%;">Total Fee -  <?php echo $rate[0]; ?></h6> </div>

  
        </div>

          <div class="container" style="background-color: white; border-radius: 25px; margin-left: 6%; margin-right: 6%; margin-top: 10%; margin-bottom: 0%">

                <div> <h4 style="padding-left:5%; padding-top:3%; margin: 0%;"> Spot 2 : </h4> </div> 
    <h6 style="padding-left:5%; padding-top:3%; margin: 0%;"> License Number - <?php echo $license[1]; ?> </h6>   
             <div> <h6 style="padding-left:5%; padding-top:2%; margin: 0%;"> Current Status 
            <form method = "POST">
            <p style=" margin-top:2%;  margin-bottom:0%">
                  <input type="radio" id = "test4" name = "status" value = "free2" checked>
                  <label for="test4">Free</label>
                </p>
                <p style="padding-top:0%; margin-top:0%; margin-bottom:2%;">
                  <input type="radio" id = "test3" name = "status" value = "taken2" >
                  <label for="test3">Taken</label>
                  <br>
                  <input type="submit"style="background-color:green; color: white;" name = "submit" value = "submit">
                </p>
          </form>  
           

                </h6> 
            
            <div> <h6 style="padding-left:5%; padding-top:2%; margin: 0%;">Arrival Time - <?php echo $arrival[1]; ?></h6> </div>   
            <div> <h6 style="padding-left:5%; padding-top:2%; margin: 0%;">Departure Time - <?php echo $depart[1]; ?></h6> </div>    
            <div> <h6 style="padding-left:5%; padding-top:2%; padding-bottom:3%; margin: 0%;">Total Fee -  <?php echo $rate[1]; ?></h6> </div>
        </div>
        </div>
</div>

    </section>

    <footer>
        <div>
                <div class="go-top">
                    <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon-arrow-up" aria-hidden="true"></i></a>
                </div>
            </div>

        </div>

    </footer> 

    <div aria-hidden="true" class="pswp" role="dialog" tabindex="-1">

        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">

            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button> <button class="pswp__button pswp__button--share" title=
                    "Share"></button> <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button> <button class="pswp__button pswp__button--zoom" title=
                    "Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button> <button class="pswp__button pswp__button--arrow--right" title=
                "Next (arrow right)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>

        </div>

    </div>

    <div id="preloader">
        <div id="loader">
            <div class="line-scale-pulse-out">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function change1(){
            var a = document.querySelector("#arrive1");
            a.value="Taken";
            a.style.color="red";
        }   
    </script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

</body>

</html>
