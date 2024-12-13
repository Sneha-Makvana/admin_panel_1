<?php
include 'conn.php';

$results_per_page = 5;

// Get the current page from the AJAX request, default to page 1
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$page = max(1, $page);

// Calculate the starting limit for the query
$starting_limit = ($page - 1) * $results_per_page;

// Fetch customers for the current page
$sql = "SELECT * FROM customers ORDER BY id DESC LIMIT $starting_limit, $results_per_page";
$result = $conn->query($sql);

$customers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
}

// Get the total number of records
$total_result = $conn->query("SELECT COUNT(id) AS total FROM customers")->fetch_assoc()['total'];
$total_pages = ceil($total_result / $results_per_page);

$conn->close();

// Send data as JSON
echo json_encode([
    'customers' => $customers,
    'total_pages' => $total_pages,
    'current_page' => $page
]);
