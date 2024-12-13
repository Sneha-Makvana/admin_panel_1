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

    $sql = "SELECT * FROM customers WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $customer = mysqli_fetch_assoc($result);

    if (!$customer) {
        // header("Location:view_customer.php");
        exit;
    }
} else {
    // header("Location:view_customer.php");
    exit;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Customer Form</title>
    <?php include "links.php"; ?>
</head>

<body>
    <div class="wrapper">
        <?php include "sidebar.php"; ?>
        <div class="main">
            <?php include "header.php"; ?>
            <main class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content">
                    <div class="row">
                        <div class="col-12 col-lg-8 mx-auto">
                            <div class="card mt-5">
                                <div class="card-header">
                                    <h5 class="card-title mb-0 text-secondary fs-4">Edit Customer</h5>
                                </div>
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="form-row align-items-center">
                                            <!-- Hidden ID Field -->
                                            <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">

                                            <!-- Name Field -->
                                            <div class="form-group col-md-3">
                                                <label for="name" class="col-form-label">Name</label>
                                            </div>
                                            <div class="form-group col-md-9">
                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i data-feather="user"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($customer['name']); ?>" placeholder="Enter your name" aria-describedby="basic-addon1">
                                                </div>
                                            </div>

                                            <!-- Email Field -->
                                            <div class="form-group col-md-3">
                                                <label for="email" class="col-form-label">Email</label>
                                            </div>
                                            <div class="form-group col-md-9">
                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i data-feather="mail"></i>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" placeholder="Enter your email" aria-describedby="basic-addon1">
                                                </div>
                                            </div>

                                            <!-- Gender Field (Radio Buttons) -->
                                            <div class="form-group col-md-3">
                                                <label class="col-form-label">Gender</label>
                                            </div>
                                            <div class="form-group col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" value="male" <?php echo ($customer['gender'] === 'male') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="genderMale">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" value="female" <?php echo ($customer['gender'] === 'female') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="genderFemale">Female</label>
                                                </div>
                                            </div>

                                            <!-- Address Field -->
                                            <div class="form-group col-md-3">
                                                <label for="address" class="col-form-label">Address</label>
                                            </div>
                                            <div class="form-group col-md-9">
                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i data-feather="map-pin"></i>
                                                        </span>
                                                    </div>
                                                    <textarea class="form-control" name="address" rows="2" placeholder="Enter your address" aria-describedby="basic-addon1"><?php echo htmlspecialchars($customer['address']); ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="city" class="col-form-label">City</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i data-feather="map-pin"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control" id="city" name="city" aria-describedby="basic-addon1">
                                                        <!-- <option value="">Select your city</option>  -->
                                                        <option value="India" <?php echo ($customer['city'] == 'India') ? 'selected' : ''; ?>>India</option>
                                                        <option value="London" <?php echo ($customer['city'] == 'London') ? 'selected' : ''; ?>>London</option>
                                                        <option value="Japan" <?php echo ($customer['city'] == 'Japan') ? 'selected' : ''; ?>>Japan</option>
                                                        <option value="USA" <?php echo ($customer['city'] == 'USA') ? 'selected' : ''; ?>>USA</option>
                                                        <option value="Dubai" <?php echo ($customer['city'] == 'Dubai') ? 'selected' : ''; ?>>Dubai</option>
                                                        <option value="Canada" <?php echo ($customer['city'] == 'Canada') ? 'selected' : ''; ?>>Canada</option>
                                                        <option value="UK" <?php echo ($customer['city'] == 'UK') ? 'selected' : ''; ?>>UK</option>
                                                        <option value="Africa" <?php echo ($customer['city'] == 'Africa') ? 'selected' : ''; ?>>Africa</option>
                                                    </select>
                                                    <span class="error"></span>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="pincode" class="col-form-label">Pincode</label>
                                            </div>
                                            <div class="form-group col-md-9 mb-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i data-feather="crosshair"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="pincode" name="pincode" value="<?php echo htmlspecialchars($customer['pincode']); ?>" placeholder="Enter your pincode" pattern="[0-9]{6}" aria-describedby="basic-addon1">
                                                    <span class="error"></span>
                                                </div>
                                            </div>

                                            <!-- Phone Number Field -->
                                            <div class="form-group col-md-3">
                                                <label for="phone_no" class="col-form-label">Phone No.</label>
                                            </div>
                                            <div class="form-group col-md-9">
                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i data-feather="phone-call"></i>
                                                        </span>
                                                    </div>
                                                    <input type="tel" class="form-control" name="phone_no" value="<?php echo htmlspecialchars($customer['phone_no']); ?>" placeholder="Enter your Phone no" pattern="[0-9]{10}">
                                                </div>
                                            </div>

                                            <!-- Image Upload Field -->
                                            <div class="form-group col-md-3">
                                                <label for="image" class="col-form-label">Profile Image</label>
                                            </div>
                                            <div class="form-group col-md-9">
                                                <input type="file" class="form-control-file" name="image" accept="image/*">
                                                <p>Current Image: <?php echo $customer['image_path']; ?></p><br>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="form-group col-md-12 text-center">
                                                <button type="submit" class="btn btn-info btn-lg mt-3">Update</button>
                                            </div>
                                        </div>
                                        <div id="message"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include "footer.php"; ?>
        </div>
    </div>
    <?php include "flinks.php"; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("form").on("submit", function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                $.ajax({
                    url: 'update_customer.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $("#message").html(`<div class="text-success">${response}<a href="view_customer.php" class="fs-4"> View </a></div>`);
                        // alert(response);
                        // window.location.href = "all_customer.php";
                    },
                    error: function() {
                        $("#message").html(`<div class="text-danger">${response}</div>`);
                    }
                });
            });
        });
    </script>

</body>

</html>