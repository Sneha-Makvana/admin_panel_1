<?php

include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $address = $_POST['address'];
    $phone_no = $_POST['phone_no'];

    $sql_check = "SELECT * FROM customers WHERE email = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "s", $email);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if (mysqli_stmt_num_rows($stmt_check) > 0) {
        echo "This email is already registered.";
        exit;
    }

    mysqli_stmt_close($stmt_check);

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif' ,'image/webp'];
        $file_type = mime_content_type($_FILES['image']['tmp_name']);
        
        if (in_array($file_type, $allowed_types)) {
            $imageName = basename($_FILES['image']['name']);
            $imagePath = 'uploads/' . $imageName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                echo "File uploaded successfully.";
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, WEBP and GIF files are allowed.";
            exit;
        }
    } else {
        $imagePath = null;
    }
    
    $sql = "INSERT INTO customers (name, email, gender, address, city, pincode, phone_no, image_path)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $gender, $address, $city, $pincode, $phone_no, $imagePath);

    if (mysqli_stmt_execute($stmt)) {
        echo "Customer added successfully.";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
