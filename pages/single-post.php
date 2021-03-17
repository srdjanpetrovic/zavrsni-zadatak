<?php
	require_once('../config/db_con.php');

	if(isset($_GET['id'])) {
		$post_id = $_GET['id'];

		$query = "SELECT posts.id, posts.title, posts.body, posts.created_at, author.firstname AS author_firstname, author.lastname AS author_lastname, author.gender AS author_gender
		FROM posts
		LEFT JOIN author ON posts.author_id = author.id
		WHERE posts.id = '$post_id'";

		$stmt = $pdo->prepare($query);
		$stmt->execute();
		$post = $stmt->fetch();

		if($post->author_gender === 'm') {
			$gender_class = 'is-male';
		} else if($post->author_gender === 'f') {
			$gender_class = 'is-female';
    }
	}

	$queryComments = "SELECT id, author, text, post_id
	FROM comments
	ORDER BY id DESC";

	// PREPARED STATEMENTS (prepare & execute)
	$stmt = $pdo->prepare($queryComments);
	$stmt->execute();
	$comments = $stmt->fetchAll();

	include_once('../partials/header.php');
?>

	<div class="row">

		<div class="col-sm-8 blog-main">

		<div class="blog-post">
			<h2 class="blog-post-title"><?php echo $post->title; ?></h2>
			<p class="blog-post-meta">
				<span><?php echo $post->created_at; ?></span>
				<span> by </span>
				<a href="#" class="<?php echo $gender_class; ?>"><?php echo $post->author_firstname . ' ' . $post->author_lastname; ?></a>
			</p>
			<p><?php echo $post->body; ?></p>

			<div class="post-comments">
				<?php foreach($comments as $comment): ?>
					<ul>
						<li>
							<p>Comment by: <?php echo $comment->author; ?></p>
							<p><?php echo $comment->text; ?></p>
						</li>
				</ul>
				<hr />
				<?php endforeach; ?>
			</div>
		</div>

		</div><!-- /.blog-main -->

		<?php include_once('../partials/sidebar.php'); ?>

	</div><!-- /.row -->

<?php include_once('../partials/footer.php'); ?>
