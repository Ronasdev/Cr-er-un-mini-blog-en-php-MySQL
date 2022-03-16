<?php require_once '../refactoring.php';
$page =1;
$perPage =5;
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

        <!-- Custom Styling -->
        <link rel="stylesheet" href="../css/style.css">

        <!-- Admin Styling -->
        <link rel="stylesheet" href="../css/admin.css">

        <title>Section Admin - Gestions des articles</title>
    </head>

    <body>
    <?php include('../inc/header.php') ?>

        <!-- Admin Page Wrapper -->
        <div class="admin-container">
            <!-- Admin Content -->
            <div class="admin-content">
                <div class="button-group">
                    <a href="create.php" class="btn btn-big">Ajouter un article</a>
                    <a href="index.php" class="btn btn-big">Gérer des articles</a>
                </div>
                <div class="container">
                    <h2 class="page-title">Manage Posts</h2>
                    <table>
                        <thead>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th colspan="3">Action</th>
                        </thead>
                        <tbody>
                        <?php foreach ($posts as $key => $post): ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $post['title'] ?></td>
                                    <td><?php echo $post['author'] ?></td>
                                    <td><a href="edit.php?id=<?php echo $post['id']; ?>" class="edit">edit</a></td>
                                    <td><a href="edit.php?delete_id=<?php echo $post['id']; ?>" class="delete">delete</a></td>  
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pagination">
      <?php
        for ($i=1; $i <= $pages ; $i++) { ?>
          <a class="page <?= ($page == $i)?'active':'' ?>" href="index.php?page=<?= $i ?>"><?= $i ?></a>
      <?php }
      ?>
    </div>
        <!-- // Page Wrapper -->
        <?php include('../inc/footer.php') ?>


    </body>

</html>