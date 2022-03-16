<?php require_once('../refactoring.php'); ?>
<?php include('validatePost.php'); ?>
<?php include('update.php'); ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Custom Styling -->
        <link rel="stylesheet" href="../css/style.css">

        <!-- Admin Styling -->
        <link rel="stylesheet" href="../css/admin.css">

        <title>Admin Section - Edit Post</title>
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

                    <h2 class="page-title">Edit Post</h2>

                   <?php include 'formErrors.php'; ?>
                    <form action="edit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div>
                            <label>Author</label>
                            <input type="text" name="author" value="<?php echo $author ?>" class="text-input">
                        </div>
                        <div>
                            <label>Title</label>
                            <input type="text" name="title" value="<?php echo $title ?>" class="text-input">
                        </div>
                        <div>
                            <label>Contenu</label>
                            <textarea cols="130", rows="10" name="content" id="body"><?php echo $content ?></textarea>
                        </div>
                        <div>
                            <label>Image</label>
                            <input type="file" name="image"  class="text-input">
                        </div>
                        <div>
                            <button type="submit" name="update-post" class="btn btn-big">Mettre à jours</button>
                        </div>
                    </form>

                </div>

            </div>
            <!-- // Admin Content -->

        </div>
        <!-- // Page Wrapper -->
        <?php include('../inc/footer.php') ?>

    </body>

</html>