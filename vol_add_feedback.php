<?php
session_start();
include("donorheader.php");
include("connection.php");

$donor_id = $_SESSION['user_id'];
$donation_id = intval($_GET['donation_id']);
$ngo_id = intval($_GET['ngo_id']);

// Handle feedback submission
if (isset($_POST['submit_feedback'])) {
    $review = mysqli_real_escape_string($conn, $_POST['review']);
    $rating = intval($_POST['rating']);

    // Check if feedback already exists for this donation
    $check = mysqli_query($conn, "SELECT * FROM feedback 
                                  WHERE donation_id=$donation_id AND vol_id=$donor_id AND feedback_type='ngo'");
    
    if (mysqli_num_rows($check) > 0) {
        // Update existing feedback
        $update = "UPDATE feedback 
                   SET review='$review', rating=$rating, created_at=NOW() 
                   WHERE donation_id=$donation_id AND vol_id=$donor_id AND feedback_type='ngo'";
        mysqli_query($conn, $update);
    } else {
        // Insert new feedback
        $insert = "INSERT INTO feedback 
                   (donation_id, ngo_id, vol_id, feedback_type, review, rating)
                   VALUES ($donation_id, $ngo_id, $donor_id, 'ngo', '$review', $rating)";
        mysqli_query($conn, $insert);
    }

    header("Location: vol_viewfeedback.php");
    exit;
}
    
// Fetch donation info for display
// $donation = mysqli_query($conn, "SELECT d.id AS donation_id, fd.Title AS food_title, n.name AS ngo_name
//                                  FROM donation d
//                                  JOIN `food donation` fd ON d.food_id = fd.id
//                                  JOIN ngo n ON d.ngo_id = n.id
//                                  WHERE d.id = $donation_id AND d.volunteer_id = $donor_id");
// $row = mysqli_fetch_assoc($donation);
// ?>

<div class="container mt-5">
  <!-- <h3 class="text-center mb-4">Give Feedback to <?php echo $row['ngo_name']; ?></h3> -->
  <div class="card p-3" style="max-width:600px;margin:auto;">
    <!-- <p><strong>Donation:</strong> <?php echo $row['food_title']; ?></p> -->
    
    <form method="POST">
      <div class="mb-2">
        <label>Review:</label>
        <textarea name="review" class="form-control" required></textarea>
      </div>
      
       <div class="mb-3">
  <label class="form-label"><strong>Rating</strong></label>
  <select name="rating" class="form-control" required>
    <option value="">Select Rating</option>
    <option value="1">★</option>
    <option value="2">★★</option>
    <option value="3">★★★</option>
    <option value="4">★★★★</option>
    <option value="5">★★★★★</option>
  </select>
</div>
      
      <button type="submit" name="submit_feedback" class="btn btn-primary">Submit Feedback</button>
      <a href="view_feedback.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>

<?php include("commonfooter.php"); ?>
