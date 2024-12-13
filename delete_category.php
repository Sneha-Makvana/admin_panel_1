<?php
include 'conn.php';

if (isset($_POST['category_id'])) {
    $categoryId = $_POST['category_id'];

    $checkSql = "SELECT * FROM events WHERE category_id = $categoryId";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'This category cannot be deleted as it is associated with one or more events.']);
    } else {

        $deleteSql = "DELETE FROM categories WHERE id = $categoryId";
        if (mysqli_query($conn, $deleteSql)) {
            echo json_encode(['status' => 'success', 'message' => 'Category deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting category: ' . mysqli_error($conn)]);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}

mysqli_close($conn);
?>
