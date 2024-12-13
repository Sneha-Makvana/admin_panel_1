<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $category_id = $_POST['id'];
    $category_name = $_POST['category_name'];

    if (empty($category_id) || empty($category_name)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
        exit;
    }

    $sql = "UPDATE categories SET category_name = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the query']);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "si", $category_name, $category_id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success', 'message' => 'Category updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update category']);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

mysqli_close($conn);
?>
