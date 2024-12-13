<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $event_name = $_POST['event_name'];
    $description =  $_POST['description'];
    $location =  $_POST['location'];
    $start_date = $_POST['start_date'];
    $end_date =  $_POST['end_date'];
    $booking_ticket =  $_POST['booking_ticket'];
    $category = $_POST['category'];
    $no_of_tickets = $_POST['no_of_tickets'];

    $error = "";

    $uploadDir = 'uploads/';
    $imagePaths = [];

    if (!empty($_FILES['event_images']['name'][0])) {
        foreach ($_FILES['event_images']['name'] as $key => $name) {
            $targetFilePath = $uploadDir . basename($name);
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                if (move_uploaded_file($_FILES['event_images']['tmp_name'][$key], $targetFilePath)) {
                    $imagePaths[] = $targetFilePath;
                } else {
                    $error = "Error uploading file $name.";
                    break;
                }
            } else {
                $error = "Only JPG, JPEG, PNG, and GIF files are allowed.";
                break;
            }
        }
    }

    if ($error) {
        echo $error;
        exit();
    }

    $event_images = json_encode($imagePaths);

    $sql = "INSERT INTO events (event_name, description, location, start_date, end_date, booking_ticket, category_id, no_of_tickets, event_images)
            VALUES ('$event_name', '$description', '$location', '$start_date', '$end_date', '$booking_ticket', '$category', '$no_of_tickets', '$event_images')";

    if (mysqli_query($conn, $sql)) {
        echo "success";
        
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
