<?php
session_start();
//error_reporting(0);
include('./dbconnection.php');
    if(isset($_POST['submit']))
  {
 $name=$_POST['name'];
  $mobnum=$_POST['number'];
 $email=$_POST['email'];
 $appdate=$_POST['date'];
 $aaptime=$_POST['time'];
 $specialization=$_POST['specialization'];
  $doctorlist=$_POST['doctorlist'];
 $message=$_POST['message'];
 $aptnumber=mt_rand(100000000, 999999999);
 $cdate=date('Y-m-d');

if($appdate<=$cdate){
       echo '<script>alert("Appointment date must be greater than todays date")</script>';
} else {
$sql="insert into tblappointment(AppointmentNumber,Name,MobileNumber,Email,AppointmentDate,AppointmentTime,Specialization,Doctor,Message)values(:aptnumber,:name,:mobnum,:email,:appdate,:aaptime,:specialization,:doctorlist,:message)";
$query=$dbh->prepare($sql);
$query->bindParam(':aptnumber',$aptnumber,PDO::PARAM_STR);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':mobnum',$mobnum,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':appdate',$appdate,PDO::PARAM_STR);
$query->bindParam(':aaptime',$aaptime,PDO::PARAM_STR);
$query->bindParam(':specialization',$specialization,PDO::PARAM_STR);
$query->bindParam(':doctorlist',$doctorlist,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);

 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Your Appointment Request Has Been Send. We Will Contact You Soon")</script>';
echo "<script>window.location.href ='appoint.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custom css file link -->
    <link rel="stylesheet" href="./css/styles.css">

    <script>
function getdoctors(val) {
  //  alert(val);
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
<body>
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


    <!-- booking section starts -->
    <section class="appointment" id="appointment">

    <h1 class="heading"> <span>appointment</span> now </h1>    

    <div class="row">

        <div class="image">
            <img src="./images/appoint.svg" alt="">
        </div>

        <form role="form" method="post">

            <h3>make appointment</h3>
            <input type="text" name="name" placeholder="your name" class="box" required='true'>
            <input type="number"name="number" placeholder="your number" class="box">
            <input type="email"name="email" pattern="[^ @]*@[^ @]*" placeholder="your email" class="box" required='true'>
            <input type="date"name="date" value="" class="box">
            <input type="time" name="time" id="time" value="" class="box">
            <div>
            <select onChange="getdoctors(this.value);"  name="specialization" id="specialization" class="box" required>
<option value="">Select specialization</option>
<!--- Fetching States--->
<?php
$sql="SELECT * FROM tblspecialization";
$stmt=$dbh->query($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while($row =$stmt->fetch()) { 
  ?>
<option value="<?php echo $row['ID'];?>"><?php echo $row['Specialization'];?></option>
<?php }?>
</select>
            </div>
            <div>
            <select name="doctorlist" id="doctorlist" class="box"><option value="">Select Doctor</option></select></div>
            <div>
            <textarea class="box" rows="5" id="message" name="message" placeholder="Additional Message"></textarea>
            </div>
            <div>
            <input type="submit" name="submit" value="appointment now" class="btn"></div>
            
        </form>

    </div>

</section>
    <!-- booking section ends -->

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
    <div class="credit"> created by <span> Kalyan</span></div>
</section>

    <!-- footer section ends -->

    <!-- footer section ends -->
    
    <!-- custom js file link-->
    <script src="./js/javascript.js"></script>
    <script src="./js/jquery.min.js"></script>
    
</body>
</html>