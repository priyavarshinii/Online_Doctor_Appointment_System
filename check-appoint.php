<?php
session_start();
//error_reporting(0);
include('./dbconnection.php');

?>
<!doctype html>
<html lang="en">
    <head>
        <title>Doctor Appointment Management System || Home Page</title>

        <!-- CSS FILES -->        
        <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- custom css file link -->
<link rel="stylesheet" href="./css/appoint.css">
        <script>
function getdoctors(val) {
     alert(val);
$.ajax({

type: "POST",
url: "get_doctors.php",
data:'sp_id='+val,
success: function(data){
$("#doctorlist").html(data);
}
});
}
</script>
    </head>
    
    <body id="top">
    
        <main>

        <!-- header section starts -->
    <header class="header">
        <a href="./user_page.php" class="logo"><i class="fas fa-heartbeat"></i>UrFine</a>

        <nav class="navbar">
        <a href="./user_page.php">home</a>
            <a href="./check-appoint.php">Check appointment</a>
            <a href="./appoint.php">Booking</a>
        </nav>

        <div id="menu-btn" class="fas fa-bars">

        </div>
    </header>
    <!-- header section ends -->

          
       
            

            

            <section class="appointment" id="booking">
                <div class="row">
                                <form role="form" method="post">
                                <h3>Search Appointment History by Name/Mobile No</h3>
                                        <input id="searchdata" type="text" name="searchdata" required="true" class="box" placeholder="Name/Mobile No.">
                                            <button type="submit" class="btn" name="search" id="submit-button">Check</button>
                                    
                                </form>
                                </div>
                            <?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];
  ?>
  <h3 style = "color:var(--black);
    padding-bottom: 1rem;
    font-size: 3rem;">Result against "<?php echo $sdata;?>" keyword </h3>
                    
                    <div>
                        <div>
                            <table style="border-collapse:collapse;
                            margin: 25px 50px;font-size: 2em;min-width:400px;border-radius:5px 5px 0 0;overflow:hidden;">
                                <thead>
                                    <tr style="background-color:#048BA8;color:#ffffff; text-align:left; font-weight:bold;">
                                        <th style="padding:2px 15px;">S.No</th>
                                        <th style="padding:12px 15px;">Appointment Number</th>
                                        <th style="padding:12px 15px;">Patient Name</th>
                                        <th style="padding:12px 15px;">Mobile Number</th>
                                        <th style="padding:12px 15px;">Email</th>
                                        <th style="padding:12px 15px;">Status</th>
                                        <th style="padding:12px 15px;">Remark</th>
                                        
                                    </tr>
                                </thead>
                            
                                <tbody>
                  <?php
             
$sql="SELECT * from tblappointment where AppointmentNumber like '$sdata%' || Name like '$sdata%' || MobileNumber like '$sdata%'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                    <tr style="border-bottom:2px solid #048BA8;border-left:2px solid #048BA8;border-right:2px solid #048BA8;">
                                        <td style="padding:2px 15px;"><?php echo htmlentities($cnt);?></td>
                                        <td style="padding:2px 15px;"><?php  echo htmlentities($row->AppointmentNumber);?></td>
                                        <td style="padding:2px 15px;"><?php  echo htmlentities($row->Name);?></td>
                                        <td style="padding:2px 15px;"><?php  echo htmlentities($row->MobileNumber);?></td>
                                        <td style="padding:2px 15px;"><?php  echo htmlentities($row->Email);?></td>
                                        <?php if($row->Status==""){ ?>

                     <td style="padding:2px 15px;"><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->Status);?>
                  </td>
                  <?php } ?>             
                 
                                        <?php if($row->Remark==""){ ?>

                     <td style="padding:2px 15px;"><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->Remark);?>
                  </td>
                  <?php } ?>
                                        
                                    </tr>
                                
    
                                </tbody>
             
                <?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="8" style="padding:2px 15px;"> No record found against this search</td>

  </tr>
  <?php } }?>
                            </table>
                </div>
            </section>
        </main>
</br>
        <!-- footer section starts -->
    <section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>quick links</h3>
            <a href="./user_page.php"> <i class="fas fa-chevron-right"></i> home </a>
            <a href="./appoint.php"> <i class="fas fa-chevron-right"></i> appointment </a>
            <a href="./check-appoint.php"> <i class="fas fa-chevron-right"></i> Check Appointment </a>
        </div>
        <!-- <div class="box">
            <h3>services</h3>
            <a href="#"> <i class="fas fa-chevron-right"></i> Home checkup </a>
            <a href="#"> <i class="fas fa-chevron-right"></i> medicine delivery </a>
            <a href="#"> <i class="fas fa-chevron-right"></i> 24/7 ambulance </a>
            <a href="#"> <i class="fas fa-chevron-right"></i> medical camps cancer </a>
        </div> -->
        <div class="box">
            <h3>contact info</h3>
            <a href="tel: +91- 97573 91070" target=""> <i class="fas fa-phone"></i> +91-9757391070 </a>
            <a href="#"> <i class="fa-brands fa-whatsapp"></i> +91-9757391070 </a>
            <a href="#"> <i class="fas fa-envelope"></i> info@group10.com </a>
            <a href="#"> <i class="fas fa-envelope"></i> group10@yahoo.co.in </a>
            <a href="#"> <i class="fas fa-map-marker-alt"></i> patna, bihar - 800005 </a><!--set location page here too-->
        </div>
        <div class="box">
            <h3>follow us</h3>
            <a href="#" target="blank"><i class="fa-brands fa-facebook"></i>facebook</a>
            <a href="#" target="blank"><i class="fa-brands fa-instagram"></i>instagram</a>
            <a href="#" target="blank"><i class="fa-brands fa-linkedin"></i>linkedin</a>
            <a href="#" target="blank"><i class="fa-brands fa-twitter"></i>twitter</a>
        </div>
    </div>
    <div class="credit"> created by <span> group-10</span></div>
</section>

    <!-- footer section ends -->
        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/scrollspy.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>