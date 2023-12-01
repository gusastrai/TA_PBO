<?php 
	include "db_config.php";
	class User{
		protected $db;
		protected $username;
		public function __construct(){
			$this->db = new DB_con();
			$this->db = $this->db->get_con();
		}

		public function check_login($username, $password){
			// $password = md5($password);
			
			$query = "SELECT uid from users WHERE uname='$username' and upass='$password'";
			
			$result = $this->db->query($query) or die($this->db->error);
	
			$user_data = $result->fetch_array(MYSQLI_ASSOC);
			$count_row = $result->num_rows;
			
			if ($count_row == 1) {
				$_SESSION['login'] = true; 
				$_SESSION['uid'] = $user_data['uid'];
				return true;
			} else { 
				return false;
			}
		}

		public function get_info() {
			return $this->username;
		}

		public function set_info($username) {
			$this->username = $username;
		}
		
		public function user_logout() {
			$_SESSION['login'] = False;
			unset($_SESSION);
			session_destroy();
		}	

	}

class Admin extends User {

	
}

class Pasien extends User {
	private $nama;
	private $gender;
	private $tel;
	private $alamat;

	public function reg_user(&$error, $inputan){
		extract($inputan);	
		// $password = md5($password);

		if (!empty($username) && !empty($password) && !empty($nama) && !empty($gender) && !empty($tel) && !empty($alamat)) {
			$query = "SELECT * FROM users WHERE uname='$username' ";
			$result = $this->db->query($query) or die($this->db->error);
			$count_row = $result->num_rows;
				
			if($count_row == 0){
				$query = "INSERT INTO users SET uname='$username', upass='$password' ";
				$this->db->query($query) or die($this->db->error);

				$query1 = $this->db->query("SELECT * FROM users WHERE uname='$username'");
				$result = mysqli_fetch_assoc($query1);
				$id_user = $result['uid'];

				$query2 = "INSERT INTO pasien SET nama_pasien='$nama', jk='$gender', no_telp='$tel', alamat='$alamat', id_user='$id_user' ";
				$this->db->query($query2) or die($this->db->error);

				return true;
			} else {
				$error = "username sudah digunakan";
				return false;
			}
		} else {
			$error = "data tidak boleh ada yang kosong";
			return false;
		}
	}

	function set_info($username) {
		$query = "SELECT * FROM users u JOIN pasien p ON p.id_user = u.uid WHERE uname='$username' ";
		$result = $this->db->query($query) or die($this->db->error);
		$result = mysqli_fetch_assoc($result);

		$this->username = $result['uname'];
		$this->nama = $result['nama_pasien'];
		$this->gender = $result['jk'];
		$this->tel = $result['no_telp'];
		$this->alamat = $result['alamat'];
	}

	function get_info() {
		$info = array(
			"username" => $this->username,
			"nama" => $this->nama, 
			"gender" => $this->gender, 
			"telepon" => $this->tel,
			"alamat" => $this->alamat);
		return $info;
	}

}