<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoryName = mysqli_real_escape_string($conn, $_POST['category_name']);

    if (empty($categoryName)) {
        echo json_encode(['status' => 'error', 'message' => 'Category cannot be empty.']);
        exit;
    }

    $checkQuery = "SELECT * FROM categories WHERE category_name = '$categoryName'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Category already exists.']);
        exit;
    }

    $sql = "INSERT INTO categories (category_name) VALUES ('$categoryName')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Category added successfully!']);
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . mysqli_error($conn)]);
    }
}

mysqli_close($conn);
?>

