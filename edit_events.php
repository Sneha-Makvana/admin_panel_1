<?php
session_start(); 

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

?>
<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM events WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $event = mysqli_fetch_assoc($result);

    $categoryQuery = "SELECT id, category_name FROM categories";
    $categoryResult = mysqli_query($conn, $categoryQuery);

    if (!$event) {
        header("Location: all_events.php");
        exit;
    }
} else {
    header("Location: all_events.php");
    exit;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Event</title>
    <?php include "links.php"; ?>
</head>

<body>
    <div class="wrapper">
        <?php include "sidebar.php"; ?>
        <div class="main">
            <?php include "header.php"; ?>
            <main class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content">
                    <div class="row">
                        <div class="col-12 col-lg-8 mx-auto mt-5">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0 text-secondary fs-4">Edit Event</h5>
                                </div>
                                <form action="update_event.php" id="addEvent" method="POST" enctype="multipart/form-data">
                                    <div class="card-body">

                                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                                        <!-- Event Name -->
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="event_name" class="col-form-label">Event Name</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <input type="text" class="form-control" name="event_name" id="event_name" value="<?php echo htmlspecialchars($event['event_name']); ?>" placeholder="Enter your event name" required>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="description" class="col-form-label">Description</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter description" required><?php echo htmlspecialchars($event['description']); ?></textarea>
                                            </div>
                                        </div>

                                        <!-- Location -->
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="location" class="col-form-label">Location</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <input type="text" class="form-control" name="location" id="location" value="<?php echo htmlspecialchars($event['location']); ?>" placeholder="Enter Location" required>
                                            </div>
                                        </div>

                                        <!-- Start Date -->
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="start_date" class="col-form-label">Start Date</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <input type="datetime-local" class="form-control" name="start_date" id="start_date" value="<?php echo htmlspecialchars($event['start_date']); ?>" required>
                                            </div>
                                        </div>

                                        <!-- End Date -->
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="end_date" class="col-form-label">End Date</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <input type="datetime-local" class="form-control" name="end_date" id="end_date" value="<?php echo htmlspecialchars($event['end_date']); ?>" required>
                                            </div>
                                        </div>

                                        <!-- Booking Ticket -->
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="booking_ticket" class="col-form-label">Booking Ticket Price</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <input type="text" class="form-control" name="booking_ticket" id="booking_ticket" value="<?php echo htmlspecialchars($event['booking_ticket']); ?>" placeholder="Enter Booking ticket price" required>
                                            </div>
                                        </div>

                                        <!-- Number of Tickets -->
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="no_of_tickets" class="col-form-label">No of Tickets</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <input type="number" class="form-control" name="no_of_tickets" id="no_of_tickets" value="<?php echo htmlspecialchars($event['no_of_tickets']); ?>" placeholder="Enter number of tickets" max="100" required>
                                            </div>
                                        </div>

                                        <!-- Category -->
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="category" class="col-form-label">Category</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <select class="form-select" name="category" id="category" required>
                                                    <option selected disabled>Select Category</option>
                                                    <?php
                                                    if (mysqli_num_rows($categoryResult) > 0) {
                                                        while ($row = mysqli_fetch_assoc($categoryResult)) {
                                                            $selected = ($row['id'] == $event['category_id']) ? 'selected' : '';
                                                            echo "<option value='" . $row['id'] . "' $selected>" . $row['category_name'] . "</option>";
                                                        }
                                                    } else {
                                                        echo "<option disabled>No categories available</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Upload New Images -->
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="event_images">Upload New Images</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <input type="file" name="event_images[]" multiple accept="image/*">

                                                <?php if (!empty($event['event_images'])) : ?>
                                                    <div class="existing-images">
                                                        <?php
                                                        $images = json_decode($event['event_images'], true);
                                                        foreach ($images as $image) :
                                                        ?>
                                                            <div style="display: inline-block; margin: 5px;">
                                                                <img src="<?php echo htmlspecialchars($image); ?>" alt="Event Image" width="100"></br>
                                                                <label>
                                                                    <input type="checkbox" name="delete_images[]" value="<?php echo htmlspecialchars($image); ?>"> Delete
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>

                                                    <input type="hidden" name="existing_images" value="<?php echo htmlspecialchars($event['event_images']); ?>">
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="form-row">
                                            <div class="form-group col-md-12 text-center">
                                                <button type="submit" id="submitBtn" class="btn btn-info btn-lg mt-2">Update</button>
                                            </div>
                                        </div>
                                        <div id="msg"></div>
                                    </div>
                                   
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </main>
            <?php include "footer.php"; ?>
        </div>
    </div>
    <?php include "flinks.php"; ?>


    <script>
        feather.replace();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("form").on("submit", function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                $.ajax({
                    url: 'update_event.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $("#msg").html(`<div class="text-success">${response} <a href= all_events.php class="fs-3">View</div>`);
                        // alert(response); 
                        // window.location.href = "all_events.php";
                    },
                    error: function() {
                        $("#msg").html(`<div class="text-danger">${response}</div>`);
                    }
                });
            });
        });
    </script>

</body>

</html>