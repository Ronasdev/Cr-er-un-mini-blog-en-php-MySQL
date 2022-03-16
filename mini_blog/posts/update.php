<?php 
$errors = array();
$id = "";
$author ="";
$title = "";
$content = "";

if (isset($_GET['id'])) {
    $id =$_GET['id'];
    $post = selectOne($id);
    
    if (!$post) {
        header('Location:index.php');
        exit();
    }
    $title = $post['title'];
    $author = $post['author'];
    $content = $post['content'];
}
if (isset($_POST['update-post'])) {
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
       array_push($errors, "Une image es demandée");
    }

    if (count($errors) == 0) {
        $id = $_POST['id'];
        unset($_POST['update-post'], $_POST['id']);
       
        $_POST['content'] = nl2br(htmlentities($_POST['content']));
    
        $post_id = updatePost($id,$_POST['author'],$_POST['title'],$_POST['content'],$_POST['image']);
        $_SESSION['message'] = "Post updated successfully";
        $_SESSION['type'] = "success";
        header("location: index.php");       
    } else {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $content = $_POST['content'];
    }
}
if (isset($_GET['delete_id'])) {
    
    $count = deletePost($_GET['delete_id']);
    $_SESSION['message'] = "Post deleted successfully";
    $_SESSION['type'] = "success";
    header("Location: index.php"); 
    exit();
}
?>