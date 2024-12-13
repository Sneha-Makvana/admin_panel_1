<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

?>

<?php
include 'conn.php';

$sql = "SELECT id, category_name FROM categories";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Events </title>
    <style>
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
    <?php
    include "links.php";
    ?>

</head>

<body>
    <div class="wrapper">
        <?php
        include "sidebar.php";
        ?>
        <div class="main">
            <?php
            include "header.php";
            ?>
            <main class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content">
                    <div class="row">
                        <div class="col-12 col-lg-8 mx-auto mt-5">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0 text-secondary fs-4">Add Event</h5>
                                </div>
                                <form action="insert_event.php" id="addEvent" method="POST" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <!-- Event Name -->
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="event_name" class="col-form-label">Event Name</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="user"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="event_name" id="event_name" placeholder="Enter your event name" required>
                                                </div>
                                                <div class="error" id="nameError"></div>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="description" class="col-form-label">Event Description</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="map"></i>
                                                        </span>
                                                    </div>
                                                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter description" required></textarea>
                                                </div>
                                                <div class="error" id="desError"></div>
                                            </div>
                                        </div>

                                        <!-- Location -->
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="location" class="col-form-label">Event Location</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="map-pin"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="location" id="location" placeholder="Enter Location" required>
                                                </div>
                                                <div class="error" id="locationError"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="location" class="col-form-label">Event Start Date</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="arrow-up-circle"></i>
                                                        </span>
                                                    </div>
                                                    <input type="datetime-local" class="form-control" name="start_date" id="start_date" placeholder="Start Date" required>
                                                </div>
                                                <div class="error" id="startdateError"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="location" class="col-form-label">Event End Date</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="arrow-down-circle"></i>
                                                        </span>
                                                    </div>
                                                    <input type="datetime-local" class="form-control" name="end_date" id="end_date" placeholder="End Date" required>
                                                </div>
                                                <div class="error" id="enddateError"></div>
                                            </div>
                                        </div>

                                        <!-- Booking Ticket -->
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="booking_ticket" class="col-form-label">Event Booking Ticket Price</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="tablet"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="booking_ticket" id="booking_ticket" placeholder="Enter Booking ticket price" required>
                                                </div>
                                                <div class="error" id="priceError"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="category" class="col-form-label">Category</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="cast"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-select" name="category" id="category" required>
                                                        <option selected disabled>Select Category</option>
                                                        <?php
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<option value='" . $row['id'] . "'>" . $row['category_name'] . "</option>";
                                                            }
                                                        } else {
                                                            echo "<option disabled>No categories available</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="error" id="cityError"></div>
                                            </div>
                                        </div>
                                        <!-- Number of Tickets -->
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="no_of_tickets" class="col-form-label">No of Tickets</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i data-feather="tag"></i>
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-control" name="no_of_tickets" id="no_of_tickets" placeholder="Enter number of tickets" max="100" required>
                                                </div>
                                                <div class="error" id="noticketError"></div>
                                            </div>
                                        </div>

                                        <!-- Upload Multiple Images -->
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="event_images" class="col-form-label">Event Images</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <input type="file" class="form-control" id="event_images" name="event_images[]" multiple accept="image/*">
                                                <div class="error" id="eventimgError"></div>
                                            </div>
                                            
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="form-row">
                                            <div class="form-group col-md-12 text-center">
                                                <button type="submit" id="submitBtn" class="btn btn-info btn-lg mt-3">Submit</button>
                                            </div>
                                        </div>
                                        <div id="message"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php
            include "footer.php";
            ?>
        </div>
    </div>
    <?php
    include "flinks.php";
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $("#submitBtn").click(function(e) {
            e.preventDefault();

            let isValid = true;
            $(".error").text("");

            if ($("#event_name").val().trim() === "") {
                $("#nameError").text("Event Name is required.");
                isValid = false;
            }

            if ($("#description").val().trim() === "") {
                $("#desError").text("Description is required.");
                isValid = false;
            }

            if ($("#location").val().trim() === "") {
                $("#locationError").text("Location is required.");
                isValid = false;
            }

            if ($("#start_date").val() === "") {
                $("#startdateError").text("Start Date is required.");
                isValid = false;
            }
            if ($("#end_date").val() === "") {
                $("#enddateError").text("End Date is required.");
                isValid = false;
            }

            const startDate = new Date($("#start_date").val());
            const endDate = new Date($("#end_date").val());
            if (startDate >= endDate) {
                $("#enddateError").text("End Date should be after Start Date.");
                isValid = false;
            }

            const bookingTicket = $("#booking_ticket").val().trim();
            if (bookingTicket === "") {
                $("#priceError").text("Ticket Price is required.");
                isValid = false;
            } else if (isNaN(bookingTicket) || parseFloat(bookingTicket) <= 0) {
                $("#priceError").text("Please enter a valid positive number for Ticket Price.");
                isValid = false;
            }

            if ($("#category").val() === null) {
                $("#cityError").text("Please select a category.");
                isValid = false;
            }

            const noOfTickets = $("#no_of_tickets").val();
            if (noOfTickets === "" || isNaN(noOfTickets) || parseInt(noOfTickets) <= 0 || parseInt(noOfTickets) > 100) {
                $("#noticketError").text("Please enter a valid number of tickets (1-100).");
                isValid = false;
            }

            if ($("#event_images")[0].files.length === 0) {
                $("#eventimgError").text("Please upload at least one event image.");
                isValid = false;
            }

            if (isValid) {
                const formData = new FormData($('#addEvent')[0]);
                $.ajax({
                    url: 'insert_event.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.includes('success')) {
                            $("#message").html(`<div class="text-success">${response} <a href= all_events.php class="fs-3">View</div>`);
                        } else {
                            $("#message").html(`<div class="text-danger">${response}</div>`);
                        }
                    },
                    error: function(xhr, status, error) {
                        $("#message").html(`<div class="text-danger">An error occurred: ${error}</div>`);
                    }
                });
            }
        });
    </script>
    <script>
        feather.replace();
    </script>
</body>

</html>
<?php mysqli_close($conn); ?>