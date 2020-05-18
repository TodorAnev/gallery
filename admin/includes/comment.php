<?php 

class Comment extends Db_object
{

	protected static $db_table = "tbl_comments";
	protected static $db_table_fields = array('id','p_id','c_author','c_body');
	public $id;
	public $p_id;
	public $c_author;
	public $c_body;
	

	public static function create_comment($p_id, $c_author= "John", $c_body=""){
		if(!empty($p_id) && !empty($c_author) && !empty($c_body)){
			$comment = new Comment();

			$comment->p_id 	   = (int)$p_id;
			$comment->c_author = $c_author;
			$comment->c_body   = $c_body;

			return $comment;
		} else {
			return false;
		}
	}

	public static function find_comments($p_id=0){
		global $database;
		$sql = "SELECT * FROM " . self::$db_table . " WHERE p_id = " . $database->escape_string($p_id) . " ORDER BY p_id ASC";
		return self::find_by_query($sql);

	}

} // End of Class Comment


 ?>