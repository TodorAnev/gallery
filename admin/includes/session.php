<?php 


/**
 * 
 */
class Session 
{
	private $signed_in = false;
	public  $u_id;
	public  $u_username;
	// public  $message;
	public  $count;

	function __construct()
	{
		session_start();
		$this->check_login();
		// $this->check_message();
		$this->visitor_count();
	}

	public function visitor_count(){
		if(isset($_SESSION['count'])){
			return $this->count = $_SESSION['count']++;
		} else {
			return $_SESSION['count'] = 1;
		}
	}

	// public function message($msg=""){
	// 	if(!empty($msg)){
	// 		$_SESSION['message'] = $msg;
	// 	} else {
	// 		return $this->message;
	// 	}
	// }

	// private function check_message(){
	// 	if(isset($_SESSION['message'])){
	// 		$this->message = $_SESSION['message'];
	// 		unset($_SESSION['message']);
	// 	} else {
	// 		$this->message = "";
	// 	}
	// }

	public function is_signed_in(){
		return $this->signed_in;
	}

	public function login($user){
		if($user){
			$this->u_id = $_SESSION['u_id'] = $user->id; // last one is reffering to users.php page
			$this->u_username = $_SESSION['u_username'] = $user->u_username;
			$this->signed_in = true;
		}
	}

	public function logout(){
		unset($_SESSION['u_id']);
		unset($this->u_id);
		$this->signed_in = false; // we unset everything when the user logs out
	}

	private function check_login(){
		if(isset($_SESSION['u_id'])){
			$this->u_id = $_SESSION['u_id'];
			$this->signed_in = true;
		} else {
			unset($this->u_id);
			$this->signed_in = false;
		}
	}

}

$session = new Session();

 ?>