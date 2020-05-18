<?php include_once("includes/init.php"); 
if(!$session->is_signed_in()){redirect("login.php");} 


if(empty($_GET['id'])){
  redirect("comments.php");
} 

$comment = Comment::find_by_id($_GET['id']);
if($comment){
  $comment->delete($comment);
  redirect("comment_photo.php?id=$comment->p_id");
} else {
  redirect("comment_photo.php?id=$comment->p_id");
}








?>
