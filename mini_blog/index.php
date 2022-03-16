<?php 
  require_once 'refactoring.php';
  
  $page =1;
  $perPage =3;
  $total = pagination();
  $pages = ceil($total / $perPage);
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
    
  }
    $posts = selectAll($page,$perPage);    
      
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <title>Mini-Blog</title>
</head>
<body>
 <?php include('inc/header.php') ?>

  <!-- Page Wrapper -->
  <div class="page-container">

    <!-- Post Slider -->
    <div class="posts">
      <h1 class="posts-title">Articles</h1>
      <div class="post-container">
        <?php foreach ($posts as $post): ?>
            <div class="post">
              <img src="<?php echo 'images/' . $post['image']; ?>" alt="" class="slider-image">
              <div class="post-info">
                <h4><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h4>
                <i > <?php echo $post['author']; ?></i>
                &nbsp;
                <i > <?php echo date('d F, Y', strtotime($post['created_at'])); ?></i>
              </div>
            </div>
          <?php endforeach; ?>
      </div>
    </div>
    <div class="pagination">
      <?php
        for ($i=1; $i <= $pages ; $i++) { ?>
          <a class="page <?= ($page == $i)?'active':'' ?>" href="index.php?page=<?= $i ?>"><?= $i ?></a>
      <?php }
      ?>
    </div>
    
    <!-- footer -->
    <?php include('inc/footer.php') ?>
  <!-- // footer --> 