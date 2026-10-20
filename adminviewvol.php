<?php
include("adminheader.php");
include("connection.php");

// // Update NGO status if ID and status are set
// if (isset($_GET['id'], $_GET['sts'])) {
//     $id = intval($_GET['id']);
//     $sts = ($_GET['sts'] === 'active') ? 'active' : 'inactive';

//     $updateQuery = "UPDATE login SET status = ? WHERE id = ?";
//     $stmt = $conn->prepare($updateQuery);
//     $stmt->bind_param("si", $sts, $id);
//     $stmt->execute();

//     echo '<script>location.href="adminviewngo.php"</script>';
//     exit;
// }
// ?>

<!-- NGO Section -->
<section id="chefs" class="chefs section py-5">
    <div class="container">
        <!-- Section Title -->
        <div class="section-title text-center mb-5">
            <h2 class="fw-bold">Registered VOLUNTEER's</h2>
            <p class="text-black">Manage VOLUNTEER account statuses from here.</p>
        </div>

        <div class="row gy-4">
            <?php
            $sql = "SELECT * FROM volunteer";
            $result = $conn->query($sql);

            while ($row = mysqli_fetch_array($result)){
                // Fetch status from login table
                // $id=$row['id'];
                // $qrysts = "SELECT * FROM login WHERE user_id = '$id' and user_type='volunteer' ";
                // $exe=mysqli_query($conn,$qrysts);
                // $fetch=mysqli_fetch_array($exe);
            ?>
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card shadow w-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary"><?php echo $row['email']?></h5>
                        <p class="mb-1"><strong>Email:</strong> <?php echo $row['email']?></p>
                        <p class="mb-1"><strong>Phone:</strong> <?php echo $row['phone']?></p>
                        <p class="mb-1"><strong>Address:</strong> <?php echo $row['address']?></p>

                        <!-- Status Button -->
                         <?php
                          $l="select * from `login` where `user_id`={$row['id']}";
             //  echo $l;
               $ex=mysqli_query($conn,$l);
               $rows=mysqli_fetch_array($ex);
               $id=$rows['id'];
                         if ($rows['status'] == 'active'){
                      
                    echo "<a href='adminviewvol.php?id={$rows['id']}&sts=inactive' class='btn btn-outline-danger btn-sm'>Make Inactive</a>";
                    }
                else{ 
                  echo "<a href='adminviewvol.php?id={$rows['id']}&sts=active' class='btn btn-success btn-sm'>Make Active</a>";
                  
                    }
                ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>


<?php include("commonfooter.php"); ?>

<?php
if (isset($_GET['id'])){
    $id=$_GET['id'];
    $sts=$_GET['sts'];
    echo $sts;
    $u="update `login` set `status` = '$sts' where `id`= $id";
    echo $u;
    $exx=mysqli_query($conn,$u);
    echo '<script>location.href="adminviewvol.php"</script>';
   
}
?>
