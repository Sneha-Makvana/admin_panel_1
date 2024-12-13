<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php
	include "links.php";
	?>
	<title>Blank Page</title>

</head>

<body>
	<div class="wrapper">
		<?php
		include "sidebar.php";
		?>
		<div class="main">
			<?php
			include "header.php";
			?>
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Blank Page</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Empty card</h5>
								</div>
								<div class="card-body">
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			<?php
			include "footer.php";
			?>
		</div>
	</div>
	<?php
	include "flinks.php";
	?>


</body>
</html>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: 20px auto;
        }
        .header {
            text-align: center;
            margin: 20px 0;
            color: #333;
        }
        .header h1 {
            font-size: 2.5em;
            margin-bottom: 0.5em;
        }
        #calendar {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }
    </style>


CREATE TABLE `admin_panel`.`customer` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `gender` ENUM('male','female') NOT NULL , `address` TEXT NOT NULL , `city` VARCHAR(255) NOT NULL , `pincode` VARCHAR(10) NOT NULL , `phone_no` VARCHAR(10) NOT NULL , `profile_image` VARCHAR(255) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB

CREATE TABLE `admin_panel`.`event` (`id` INT(11) NOT NULL AUTO_INCREMENT , `category_id` INT(11) NOT NULL , `event_name` VARCHAR(255) NOT NULL , `description` TEXT NOT NULL , `location` VARCHAR(255) NOT NULL , `start_date` DATETIME NOT NULL , `end_date` DATETIME NOT NULL , `booking_ticket` DECIMAL NOT NULL , `no_of_tickets` INT(11) NOT NULL , `event_images` VARCHAR(255) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `admin_panel`.`booking` (`id` INT NOT NULL AUTO_INCREMENT , `event_id` INT NOT NULL , `customer_id` INT NOT NULL , `booking_date` TIMESTAMP NOT NULL , `total` DECIMAL NOT NULL , `qty` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `admin_panel`.`category` (`id` INT NOT NULL AUTO_INCREMENT , `category_name` VARCHAR(255) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `admin_panel`.`users` (`id` INT NOT NULL , `email` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL ) ENGINE = InnoDB