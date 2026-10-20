<?php
session_start();
include("volheader.php");
include("connection.php");
$uid = $_SESSION['user_id'];
?>
<?php
// Display assigned donations to the volunteer
$q = "SELECT d.id as donation_id, d.qty, d.donation_staus, d.delivery_status, 
             u.name as donor_name, f.Title, f.Quantity, f.`Date of donation`, 
             n.name as ngo_name
      FROM donation d
      JOIN `food donation` f ON d.food_id = f.id
      JOIN user u ON d.donor_id = u.id
      JOIN ngo n ON f.`Organization id` = n.id
      WHERE d.volunteer_id = '$uid'AND delivery_status='Delivered'";
$res = mysqli_query($conn,$q);
?>  
<div class="container mt-5">
      <BR><BR><BR>

  <h3 class="text-center">History</h3>
  <br><br>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Donation ID</th>
        <th>Food Title</th>
        <th>Donor</th>
        <th>Quantity Donated</th>
        <th>Status</th>
        <th>Delivery Status</th>
        <th>NGO</th>
        
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($res)) { ?>
        <tr>
          <td><?php echo $row['donation_id']; ?></td>
          <td><?php echo $row['Title']; ?></td>
          <td><?php echo $row['donor_name']; ?></td>
          <td><?php echo $row['qty']; ?></td>
          <td><?php echo $row['donation_staus']; ?> </td>
          <td><?php echo $row['delivery_status']; ?></td>
          <td><?php echo $row['ngo_name']; ?></td>
           
        </tr>
      
      <?php } ?>
    </tbody>
  </table>


</div>
<br><br><br><br><br>  <BR><BR><BR>
  <BR><BR>

<?php include("commonfooter.php"); ?>