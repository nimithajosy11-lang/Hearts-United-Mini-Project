
<?php
session_start();
include("volheader.php");  // Donor header file
include("connection.php");

$vol_id = $_SESSION['user_id'];

// Fetch all donations for this donor along with existing feedback
$q = "SELECT f.id AS feedback_id, f.review, f.rating, f.created_at,
             n.id AS ngo_id, n.name AS ngo_name, 
             d.id AS donation_id, fd.Title AS food_title, fd.image
      FROM feedback f
      JOIN donation d ON f.donation_id = d.id
      JOIN `food donation` fd ON d.food_id = fd.id
      JOIN ngo n ON f.ngo_id = n.id
      WHERE d.volunteer_id = $vol_id 
        AND f.feedback_type = 'volunteer'
      ORDER BY f.id DESC";

$res = mysqli_query($conn, $q);
?>

<div class="container mt-5">
  <h3 class="text-center mb-4">My Feedback</h3>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Donation ID</th>
        <th>Food Title</th>
        <th>NGO</th>
        <th>Image</th>
        <th>Feedback</th>
        <th>Rating</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      if (mysqli_num_rows($res) > 0) {
        $i = 1;
        while ($row = mysqli_fetch_assoc($res)) { ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['donation_id']; ?></td>
            <td><?php echo $row['food_title']; ?></td>
            <td><?php echo $row['ngo_name']; ?></td>
            <td>
              <img src="<?php echo $row['image']; ?>" 
                   style="height:70px;width:70px;object-fit:cover;border-radius:5px;">
            </td>
            <td><?php echo $row['review']; ?></td>
           <td> <?php echo str_repeat('★', $row['rating']); ?></td>

            <td>
              <a href="vol_add_feedback.php?donation_id=<?php echo urlencode($row['donation_id']); ?>&ngo_id=<?php echo urlencode($row['ngo_id']); ?>" 
                 class="btn btn-sm btn-primary">Give/Update Feedback</a>
            </td>
          </tr>
      <?php } 
      } else { ?>
        <tr>
          <td colspan="8" class="text-center text-danger">No feedback found.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include("commonfooter.php"); ?>
