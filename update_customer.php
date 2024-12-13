<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $phone_no = $_POST['phone_no'];

    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp' ];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $fileType = mime_content_type($_FILES['image']['tmp_name']);
        if (in_array($fileType, $allowedTypes)) {
            $imageName = basename($_FILES['image']['name']);
            $imagePath = 'uploads/' . $imageName;
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, WEBP and GIF files are allowed.";
            exit;
        }
    } else {
        $imagePath = null;
    }

    if ($imagePath) {
        $sql = "UPDATE customers SET name = ?, email = ?, gender = ?, address = ?, city = ?, pincode = ?, phone_no = ?, image_path = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssi", $name, $email, $gender, $address, $city, $pincode, $phone_no, $imagePath, $id);
    } else {
        $sql = "UPDATE customers SET name = ?, email = ?, gender = ?, address = ?, city = ?, pincode = ?, phone_no = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssi", $name, $email, $gender, $address, $city, $pincode, $phone_no, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo "Customer updated successfully!";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
