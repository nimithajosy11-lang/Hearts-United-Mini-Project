<?php
session_start();
include("volheader.php");
include("connection.php");
$uid = $_SESSION['user_id'];

// Fetch only assigned but not delivered requests
$q = "SELECT d.id as donation_id, d.qty, d.donation_staus, d.delivery_status, 
             u.name as donor_name, f.Title, f.Quantity, f.`Date of donation`, 
             n.name as ngo_name
      FROM donation d
      JOIN `food donation` f ON d.food_id = f.id
      JOIN user u ON d.donor_id = u.id
      JOIN ngo n ON f.`Organization id` = n.id
      WHERE d.volunteer_id = '$uid' AND d.delivery_status!='Delivered'
      ORDER BY d.id DESC";
$res = mysqli_query($conn,$q);

// Mark as Delivered
if (isset($_POST['mark_delivered'])) {
    $donation_id = $_POST['donation_id'];
    $update_qry = "UPDATE `donation` 
                   SET `delivery_status`='Delivered' 
                   WHERE id='$donation_id' AND volunteer_id='$uid'";
    mysqli_query($conn, $update_qry);
    echo "<script>alert('Marked as Delivered'); window.location.href='vol_viewassigned.php';</script>";
}
?>  

<div class="container mt-5">
    <BR><BR>
  <h3 class="text-center">Assigned Requests</h3>
  <BR><BR><BR>

  <?php if (mysqli_num_rows($res) > 0) { ?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Donation ID</th>
          <th>Food Title</th>
          <th>Donor</th>
          <th>Quantity</th>
          <th>Status</th>
          <th>NGO</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($res)) { ?>
          <tr>
            <td><?php echo $row['donation_id']; ?></td>
            <td><?php echo $row['Title']; ?></td>
            <td><?php echo $row['donor_name']; ?></td>
            <td><?php echo $row['qty']; ?></td>
            <td><?php echo $row['donation_staus']; ?></td>
            <td><?php echo $row['ngo_name']; ?></td>
            <td>
              <form method="post" action="">
                <input type="hidden" name="donation_id" value="<?php echo $row['donation_id']; ?>">
                <button type="submit" name="mark_delivered" class="btn btn-success btn-sm">Mark as Delivered</button>
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } else { ?>
    <div class="alert alert-warning text-center">
      No delivery is assigned.
    </div>
  <?php } ?>
</div>
<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>

<?php include("commonfooter.php"); ?>
