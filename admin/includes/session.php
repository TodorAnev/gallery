<?php 


/**
 * 
 */
class Session 
{
	private $signed_in = false;
	public  $u_id;
	public  $u_username;
	public  $count;

	function __construct()
	{
		session_start();
		$this->check_login();
	}

	public function post_views(){
		if(isset($_SESSION['count'])){
			return $this->count = $_SESSION['count']++;
		} else {
			return $_SESSION['count'] = 1;
		}
	}
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