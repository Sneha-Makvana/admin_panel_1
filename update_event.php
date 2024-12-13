<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $event_name = $_POST['event_name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $booking_ticket = $_POST['booking_ticket'];
    $no_of_tickets = $_POST['no_of_tickets'];
    $category = $_POST['category'];

    $uploadDir = 'uploads/';
    $newImagePaths = [];

    if (!empty($_FILES['event_images']['name'][0])) {
        foreach ($_FILES['event_images']['name'] as $key => $name) {
            $targetFilePath = $uploadDir . basename($name);
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                if (move_uploaded_file($_FILES['event_images']['tmp_name'][$key], $targetFilePath)) {
                    $newImagePaths[] = $targetFilePath;
                }
            }else{
                echo "Only jpg, jpeg, png, gif, webp allow";
                exit();
            }
        }
    }else{
        $targetFilePath = null;
    }

    $existingImages = !empty($_POST['existing_images']) ? json_decode($_POST['existing_images'], true) : [];
    $imagesToKeep = [];

    if (!empty($existingImages)) {
        $imagesToDelete = isset($_POST['delete_images']) ? $_POST['delete_images'] : [];
        foreach ($existingImages as $existingImage) {
            if (!in_array($existingImage, $imagesToDelete)) {
                $imagesToKeep[] = $existingImage;
            } else {
                if (file_exists($existingImage)) {
                    unlink($existingImage);
                }
            }
        }
    }
    
    $finalImagePaths = array_merge($imagesToKeep, $newImagePaths);
    $encodedImages = json_encode($finalImagePaths);

    $sql = "UPDATE events SET event_name = ?, description = ?, location = ?, start_date = ?, end_date = ?, booking_ticket = ?, no_of_tickets = ?, event_images = ?, category_id = ? WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
        $stmt,
        "ssssssissi",$event_name,$description,$location,$start_date,$end_date,$booking_ticket,$no_of_tickets,$encodedImages,$category,$id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Update Successfully";
        // header("Location: all_events.php");
    } else {
        echo "Error updating event: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
