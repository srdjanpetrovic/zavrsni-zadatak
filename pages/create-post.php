<?php
	require_once('../config/db_con.php');

	// Get all authors
	$getAuthors = "SELECT id, firstname, lastname
	FROM author
	ORDER BY firstname DESC";

	// PREPARED STATEMENTS (prepare & execute)
	$stmt = $pdo->prepare($getAuthors);
	$stmt->execute();
	$authors = $stmt->fetchAll();

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(!empty($_POST['title']) && !empty($_POST['body']) && !empty($_POST['author'])) {
			$title = $_POST['title'];
			$body = $_POST['body'];
			$author_id = $_POST['author'];

			// echo $title . ' ' . $body . ' ' . $author_id;

			$query = "INSERT INTO posts(title, body, created_at, author_id) VALUES(:title, :body, NOW(), :author_id)";

			$stmt = $pdo->prepare($query);
			$stmt->execute(['title' => $title, 'body' => $body, 'author_id' => $author_id]);
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
					<select name="author" class="custom-select">
						<option selected>Choose Author</option>
						<?php foreach ($authors as $author): ?>
							<option value="<?php echo $author->id;?>"><?php echo $author->firstname . ' ' . $author->lastname;  ?></option>
						<?php endforeach; ?>
					</select>
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
