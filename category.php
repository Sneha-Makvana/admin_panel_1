<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

include 'conn.php';

$sql = "SELECT * FROM categories ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Category</title>
    <?php include "links.php"; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .error-message {
            color: red;
            display: none;
        }

        .success-message {
            color: green;
            display: none;
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
                                <form id="categoryForm">
                                    <div class="card-body">
                                        <label for="category_name" class="text-dark mb-3 fs-4">Event Category</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter your category">
                                        </div>
                                        <small id="error_message" class="error-message">Category name is required and must be at least 3 characters long.</small>
                                    </div>
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-info btn-lg">Add Category</button>
                                    </div>
                                    <div id="response_message" class="success-message"></div>
                                </form>
                            </div>
                        </div>

                        <div class="col-12 col-lg-8 mx-5 mt-5">
                            <div class="card">
                                <h5 class="card-header text-secondary fs-4 text-center">Events Category</h5>
                                <div class="card-body">
                                    <div class="table table-striped table-hover table-bordered">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="bg-dark text-light">Category</th>
                                                    <th class="bg-dark text-light">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>";
                                                        echo "<td>" . $row['category_name'] . "</td>";
                                                        echo "<td>
                                                            <a href='edit_category.php?id=" . $row['id'] . "'><i class='align-middle me-2' data-feather='edit'></i></a>
                                                            
                                                            <a href='javascript:void(0);' class='deleteBtn' data-id='" . $row['id'] . "'>
                                                            <i class='align-middle me-2' data-feather='trash-2'></i>
                                                        </a>                            
                                                            </td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='2'>No categories found</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include "footer.php"; ?>
        </div>
    </div>
    <?php include "flinks.php"; ?>
    <?php mysqli_close($conn); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#categoryForm").submit(function(event) {
                event.preventDefault();

                var categoryName = $("#category_name").val().trim();
                var errorMessage = $("#error_message");
                var responseMessage = $("#response_message");


                errorMessage.hide();
                responseMessage.hide();


                if (categoryName === "" || categoryName.length < 3) {
                    errorMessage.text("Category name is required and must be at least 3 characters long.");
                    errorMessage.show();
                    return;
                }

                var formData = new FormData();
                formData.append('category_name', categoryName);

                $.ajax({
                    url: 'insert_category.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        try {
                            response = JSON.parse(response);
                            if (response.status === 'success') {
                                $("#response_message").html('<small class="text-success">' + response.message + '</small>');
                                setTimeout(function() {
                                    location.reload();
                                }, );
                            } else {
                                $("#response_message").html('<small style="color:red;">' + response.message + '</small>');
                            }
                        } catch (e) {
                            console.error('Invalid JSON response:', response);
                            $("#response_message").html('<p style="color:red;">An error occurred while processing the response.</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        $("#response_message").html('<p style="color:red;">Failed to send request: ' + error + '</p>');
                    }
                });
            });
        });

        $(document).ready(function() {

            $(document).on('click', '.deleteBtn', function() {
                var categoryId = $(this).data('id');

                if (confirm('Are you sure you want to delete this category?')) {
                    $.ajax({
                        url: 'delete_category.php',
                        type: 'POST',
                        data: {
                            category_id: categoryId
                        },
                        success: function(response) {
                            try {
                                var jsonResponse = JSON.parse(response);
                                if (jsonResponse.status === 'success') {

                                    alert(jsonResponse.message);
                                    location.reload();
                                } else {

                                    alert(jsonResponse.message);
                                }
                            } catch (e) {
                                console.error('Error parsing the response:', response);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error:', error);
                            alert('An error occurred while deleting the category.');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>