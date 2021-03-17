<?php
	require_once('../config/db_con.php');

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(!empty($_POST['title']) && !empty($_POST['body']) && !empty($_POST['author'])) {
			$title = $_POST['title'];
			$body = $_POST['body'];
			$author = $_POST['author'];

			$query = "INSERT INTO
			posts(title, body, author, created_at)
			VALUES(:title, :body, :author, NOW())";

			$stmt = $pdo->prepare($query);
			$stmt->execute(['title' => $title, 'body' => $body, 'author' => $author]);

			header('Location: /index.php');
		} else {
			$err_message = '* Please fill all fields';
		}
	}

	include_once('../partials/header.php');
?>

	<div class="row">

		<div class="col-sm-8 blog-main">

			<h1>Create Post</h1>

			<form action="" method="post">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" class="form-control" placeholder="name@example.com" />
				</div>
				<div class="form-group">
					<label for="body">Body</label>
					<textarea name="body" class="form-control" placeholder="body@example.com" rows="8"></textarea>
				</div>
				<div class="form-group">
					<label for="author">Author</label>
					<input type="text" name="author" class="form-control"  placeholder="author@example.com" />
				</div>
				<div class="form-group">
					<input type="submit" value="Enter post" class="btn btn-primary" />
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
