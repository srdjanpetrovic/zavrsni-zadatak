<?php
	require_once('../config/db_con.php');

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['gender'])) {
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$gender = $_POST['gender'];

			$query = "INSERT INTO author(firstname, lastname, gender) VALUES(:firstname, :lastname, :gender)";

			$stmt = $pdo->prepare($query);
			$stmt->execute(['firstname' => $firstname, 'lastname' => $lastname, 'gender' => $gender]);
		} else {
			$err_message = '* Please fill all fields';
		}
	}

	include_once('../partials/header.php');
?>

	<div class="row">

		<div class="col-sm-8 blog-main">

			<h1>Create Author</h1>

			<form action="" method="post">
				<div class="form-group">
					<label for="firstname">First name</label>
					<input type="text" name="firstname" class="form-control" id="firstname" placeholder="firstname@example.com" />
				</div>
				<div class="form-group">
					<label for="lastname">Last name</label>
					<input type="text" name="lastname" class="form-control" id="lastname" placeholder="lastname@example.com" />
				</div>
				<div class="form-group">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="gender" value="m" id="male">
						<label class="form-check-label" for="male">
							Male
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="gender" value="f" id="female">
						<label class="form-check-label" for="female">
							Female
						</label>
					</div>
				</div>

				<div class="form-group">
					<input type="submit" value="Enter author" class="btn btn-primary" />
				</div>
				<?php if(!empty($err_message)): ?>
					<div class="c-err_message">
						<p class="c-err_message__text"><?php echo $err_message; ?></p>
					</div>
				<?php endif; ?>
			</form>

		</div><!-- /.blog-main -->

		<?php include_once('../partials/sidebar.php'); ?>

	</div><!-- /.row -->

<?php include_once('../partials/footer.php'); ?>
