<?php
include("commonheader.php");
include("connection.php");
?>

<section id="volunteer-register" class="py-5 bg-light">
  <div class="container" data-aos="fade-up">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-body p-5">
            <h2 class="text-center mb-4 fw-bold text-danger">Volunteer Registration</h2>
            <p class="text-center text-muted mb-4">
              <!-- Join as a volunteer and help us deliver food to those in need. -->
            </p>

            <form action="" method="post" data-aos="fade-up" data-aos-delay="200">
              <div class="row g-4">

                <div class="col-md-6">
                  <label class="form-label fw-semibold">Full Name</label>
                  <input type="text" name="name" class="form-control form-control-lg" placeholder="Enter your name" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">Email Address</label>
                  <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter your email" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">Phone Number</label>
                  <input type="text" name="tel" class="form-control form-control-lg" placeholder="10-digit mobile number" required maxlength="10" pattern="[6789][0-9]{9}">
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">Password</label>
                  <input type="password" name="password" class="form-control form-control-lg" placeholder="Create a password" required>
                </div>

                <div class="col-12">
                  <label class="form-label fw-semibold">Address</label>
                  <textarea class="form-control form-control-lg" name="address" rows="4" placeholder="Enter your address" required></textarea>
                </div>

                <div class="col-12 text-center mt-3">
                  <button type="submit" name="register" class="btn btn-danger btn-lg px-5 rounded-pill shadow-sm">
                    Register
                  </button>
                </div>

              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
include("commonfooter.php")
?>

<?php
if (isset($_REQUEST['register'])){
  $name=$_REQUEST['name'];
  $email=$_REQUEST['email'];
  $phone=$_REQUEST['tel'];
  $address=$_REQUEST['address'];
  $password=$_REQUEST['password'];
  $q="select count(*) as cnt from `volunteer` where `email`='$email'";
  $e=mysqli_query($conn,$q);
  $f=mysqli_fetch_array($e);
  $count=mysqli_num_rows($e);
  if ($f['cnt']>0){
    echo "<script>alert('Username alerady Exist!')</script>";
  }
  else{
    $qry="INSERT INTO `volunteer`(`name`,`email`,`phone`,`address`) VALUES ('$name','$email','$phone','$address')";
    echo $qry;
    $res=mysqli_query($conn,$qry);
    $qryLog = "INSERT INTO `login`(`user_id`,`user_name`,`password`,`user_type`,`status`) VALUES ((SELECT MAX(`id`) FROM `volunteer`),'$email','$password','volunteer','inactive')";
    echo $qryLog;
    $res2 = mysqli_query($conn,$qryLog);
    if($res && $res2){
        echo "<script>alert('Registration successfull')</script>";
    }else{
        echo "<script>alert('Error Occured')</script>"; 
    }
  }
}
?>
