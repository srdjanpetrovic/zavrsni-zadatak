<?php
  require_once('config/db_con.php');

  $query = "SELECT id, title, body, author, created_at
	FROM posts
	ORDER BY created_at DESC";

  // PREPARED STATEMENTS (prepare & execute)
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$posts = $stmt->fetchAll();

  include_once('partials/header.php');
?>

<div class="row">

  <div class="col-sm-8 blog-main">

    <?php foreach($posts as $post): ?>

      <div class="blog-post">
        <a href="pages/single-post.php?id=<?php echo $post->id; ?>" class="blog-post-title-link">
          <h2 class="blog-post-title"><?php echo $post->title; ?></h2>
        </a>
        <p class="blog-post-meta">
          <span><?php echo $post->created_at; ?></span>
          <span> by </span>
          <a href="#"><?php echo $post->author; ?></a>
        </p>
        <p><?php echo $post->body; ?></p>
      </div>
    <?php endforeach; ?>

    <nav class="blog-pagination">
      <a class="btn btn-outline-primary" href="#">Older</a>
      <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
    </nav>

  </div><!-- /.blog-main -->

  <?php include_once('partials/sidebar.php'); ?>

</div><!-- /.row -->

<?php include_once('partials/footer.php'); ?>