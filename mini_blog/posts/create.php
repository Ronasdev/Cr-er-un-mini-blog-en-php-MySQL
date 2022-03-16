<?php require_once('../refactoring.php'); ?>
<?php include('validatePost.php'); ?>
<?php
$errors = array();
    if (isset($_POST['add-post'])) {
        $errors = validatePost($_POST);
    
        if (!empty($_FILES['image']['name'])) {
            $image_name = time() . '_' . $_FILES['image']['name'];
            $destination = "../images/" . $image_name;
    
            $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
    
            if ($result) {
               $_POST['image'] = $image_name;
            } else {
                array_push($errors, "Failed to upload image");
            }
        } else {
           array_push($errors, "Une image demandée");
        }
        if (count($errors) == 0) {
            unset($_POST['add-post']);
           
            $_POST['content'] = htmlentities($_POST['content']);
        
            $post_id = create($_POST['author'],$_POST['title'],$_POST['content'],$_POST['image']);
            
            header("location: index.php"); 
            exit();    
        } else {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $content = $_POST['content'];
        }
    }
?>
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

        <title>Admin Section - Add Post</title>
    </head>

    <body>
    <?php include('../inc/header.php') ?>

        <!-- Admin Page Wrapper -->
        <div class="admin-container">
            <!-- Admin Content -->
            <div class="admin-content">
                <div class="button-group">
                    <a href="create.php" class="btn btn-big">Add Post</a>
                    <a href="index.php" class="btn btn-big">Manage Posts</a>
                </div>


                <div class="container">

                    <h2 class="page-title">Manage Posts</h2>
                    <?php include 'formErrors.php'; ?>
                    <form action="create.php" enctype="multipart/form-data" method="post">
                        <div>
                            <label>Author</label>
                            <input type="text" name="author"  class="text-input">
                        </div>
                        <div>
                            <label>Title</label>
                            <input type="text" name="title"  class="text-input">
                        </div>
                        <div>
                            <label>Contenu</label>
                            <textarea cols="130", rows="10" name="content" id="body"></textarea>
                        </div>
                        <div>
                            <label>Image</label>
                            <input type="file" name="image"  class="text-input">
                        </div>
                        
                        <div>
                            <button type="submit" name="add-post" class="btn btn-big">Add Post</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
        <!-- footer -->
    <?php include('../inc/footer.php') ?>
  <!-- // footer -->


   
    </body>

</html>