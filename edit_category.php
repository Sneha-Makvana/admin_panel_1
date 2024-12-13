<?php
session_start(); 

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

?>
<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM categories WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $category = mysqli_fetch_assoc($result);

    if (!$category) {
        echo "Category not found!";
        exit;
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Invalid category ID!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'];

    $update_sql = "UPDATE categories SET category_name = ? WHERE id = ?";
    $update_stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($update_stmt, "si", $category_name, $id);

    if (mysqli_stmt_execute($update_stmt)) {
        header("Location: category.php");
    } else {
        echo "Error updating category: " . mysqli_error($conn);
    }

    mysqli_stmt_close($update_stmt);
    mysqli_close($conn);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Category</title>
    <?php include "links.php"; ?>
    <style>
        .dashboard-content {
            height: 520px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include "sidebar.php"; ?>
        <div class="main">
            <?php include "header.php"; ?>
            <main class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content">
                    <div class="row">
                        <div class="col-12 col-lg-8 mx-5 mt-5">
                            <div class="card">
                                <form action="edit_category.php?id=<?php echo $id; ?>" method="POST">
                                    <div class="card-body">
                                        <label for="category_name" class="text-dark mb-3 fs-4">Edit Category</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i data-feather="cast"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="category_name" value="<?php echo htmlspecialchars($category['category_name']); ?>" placeholder="Enter new category name" aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-info btn-lg">Update Category</button>
                                    </div>
                                </form>
                            </div>
                            <div id="Message"></div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include "footer.php"; ?>
        </div>
    </div>
    <?php include "flinks.php"; ?>

    <script>
        feather.replace();
    </script>
    <script>
        $(document).ready(function() {

            $("#editCategoryForm").on("submit", function(event) {
                event.preventDefault();

                var category_id = $("#category_id").val();
                var category_name = $("#category_name").val();
                $.ajax({
                    url: "update_category.php",
                    type: "POST",
                    data: {
                        id: category_id,
                        category_name: category_name
                    },
                    dataType: "json",
                    success: function(response) {

                        if (response.status === "success") {
                            $("#Message").html("<div class='text text-success'>" + response.message + "</div>");
                            // setTimeout(function() {
                            //     window.location.href = "category.php";
                            // }, 2000);
                        } else {
                            $("#Message").html("<div class='text text-danger'>" + response.message + "</div>");
                        }
                    },
                    error: function() {
                        $("#resultMessage").html("<div class='text text-danger'>An error occurred while updating the category.</div>");
                    }
                });
            });
        });
    </script>
</body>

</html>