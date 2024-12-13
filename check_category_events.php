<?php
include 'conn.php';
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $categoryId = intval($_GET['id']);

    $sql = "SELECT COUNT(*) as event_count FROM all_events WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    echo json_encode(['hasEvents' => $row['event_count'] > 0]);
} else {
    echo json_encode(['error' => 'No category ID provided']);
}

$conn->close();
?>
