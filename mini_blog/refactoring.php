<?php
function getPDO(){
    
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'mini_blog';

$conn =new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $user,$pass,[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    return $conn;
}

function create($author,$title,$content,$image){
    $pdo =getPDO();
    $query = $pdo->prepare('INSERT INTO posts(author,title,content,image,created_at) VALUES(:author,:title,:content,:image,NOW())');
    $query->execute(compact('author','title','content','image'));
    $id = $query->insert_id;
    return $id;
}
function selectAll($page,$perPage){
    $perPage = $perPage;
    $page =  $page;
    $pdo =getPDO();
    $resultats = $pdo->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT '.($perPage *($page-1)).','. $perPage );
    $posts = $resultats->fetchAll();
    return $posts;
} 
function pagination(){
    $pdo =getPDO();
    $query = $pdo->query("SELECT COUNT(*) as nbr_articles FROM posts");
        $nombres= $query->fetch();
    return $nombres['nbr_articles'];
    
}
function selectOne($id){
    $pdo =getPDO();
    $query = $pdo->prepare('SELECT * FROM posts WHERE id = :post_id');
    $query->execute(['post_id' => $id]);

    $post = $query->fetch();
    return $post;
}
function findAllComments($post_id){
    $pdo =getPDO();
    $query = $pdo->prepare('SELECT * FROM comments WHERE post_id = :post_id');
    $query->execute(['post_id' => $post_id]);

    $comments = $query->fetchAll();
    return $comments;
}

function findComment($id){
    $pdo =getPDO();
    $query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
    $query->execute(['id'=> $id]); 
    $comment =$query->fetch();
    return $comment;
}

function deletePost($id){
    $pdo =getPDO();
    $query = $pdo->prepare('DELETE FROM posts WHERE id = :id');
    $query->execute(['id'=> $id]); 
}
function updatePost($id,$author,$title,$content,$image){
    $pdo =getPDO();
    $query = $pdo->prepare('UPDATE posts SET author = :author, title = :title,content = :content,image = :image WHERE id =:id'); 
    $query->execute(compact('author','title','content','image','id'));
    $id = $stmt->insert_id;
    return $id;
}


function deleteComment($id){
    $pdo =getPDO();
    $query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
    $query->execute(['id'=> $id]); 
}

function saveComment($author,$post_id,$comment){
    $pdo =getPDO();
    $query = $pdo->prepare('INSERT INTO comments(post_id,author,comment,created_at) VALUES(:post_id,:author,:comment,NOW())');
    $query->execute(compact('post_id','author','comment'));
    return $query;
}
?>