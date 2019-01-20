<?php 
	/**
	 * 
	 */
	
	class User
	{
		protected $pdo;


		function __construct($pdo)
		{
			$this->pdo = $pdo;
		}

		public function checkInput($var){
			$var = htmlspecialchars($var);
			$var = trim($var);
			$var = stripcslashes($var);
			return $var;
		}

		public function login($table,$username,$password){
			$password =md5($password);
			$stmt = $this->pdo->prepare("SELECT * FROM {$table} WHERE u_name=:username AND password=:password");
			$stmt -> bindParam(":username",$username, PDO::PARAM_STR);
			$stmt -> bindParam(":password",$password, PDO::PARAM_STR);
			$stmt -> execute();

			$user = $stmt->fetch(PDO::FETCH_OBJ);
			$count = $stmt->rowCount();

			if ($count>0) {
				if ($table=="users" && $user->status=="yes") {
					$_SESSION['user_id'] = $user->id;
					$_SESSION['loggedIn'] = true;
					header("location: student/home.php");
				}else if($table=="users" && $user->status=="no"){
					$GLOBALS['user_err'] ="Your account is under moderation.wait for admin approval.";
				}else if($table=="admin"){
					$_SESSION['admin_id'] = $user->id;
					$_SESSION['loggedIn'] = true;
					header("location: librarian/home.php");
				}else{
					$GLOBALS['user_err']="Invalid input";
				}
				
			}else{
				return false;
			}
		}
		//CHECK USER LOGGED  IN OR NOT
		public function loggedIn(){
			return (isset($_SESSION['loggedIn'])) ? true :false;
		}
		
		public function logout(){
			$_SESSION = array();
			session_destroy();
			header("location: ../index.php");
		}
		//CHECK DATA FROM DATABASE,IT CHECK DATA ALREADY EXISTS OR NOT.
		public function checkData($tablename,$field,$var){
			$stmt = $this->pdo->prepare("SELECT {$field} FROM {$tablename} WHERE {$field}=:{$field}");
			$stmt ->bindParam(":{$field}",$var);
			$stmt ->execute();
			$count = $stmt->rowCount();
			return ($count==1)? true : false;
		}

		public function register($table,$field=array()){
			$columns = implode(",",array_keys($field));
			$values  = ":".implode(",:",array_keys($field));
			$sql     = "INSERT INTO {$table}({$columns},status) VALUES({$values},'no')";

			if ($stmt = $this->pdo->prepare($sql)) {
				foreach ($field as $key => $value) {
					$stmt -> bindValue(":{$key}",$value);
				}
				$stmt ->execute();
				$count = $stmt->rowCount();
				if ($count>0) {
					$GLOBALS['succes']= "Registration succesfull.Now your Account is Under Moderation.";
					return true; 
				}else{
					return false;
				}
			}
		}


		public function select($table){
			$stmt = $this->pdo->prepare("SELECT * FROM {$table}");
			$stmt ->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function create($table,$field=array()){
			$columns = implode(",",array_keys($field));
			$values  = ":".implode(",:",array_keys($field));

			$sql     = "INSERT INTO {$table}({$columns}) VALUES({$values})";

			if ($stmt = $this->pdo->prepare($sql)) {
				foreach($field as $key=>$val){
					$stmt -> bindValue(":{$key}",$val);
				}
				$stmt ->execute();
				$count = $stmt->rowCount();

				if ($count>0) {
					return true;		
				}else{
					return false;
				}
			}
		}

		public function update($table,$id,$field=array()){
			$columns ='';
			$i=0;
			foreach ($field as $key=>$data) {
				$i++;
				$columns .= "{$key}=:{$key}";
				if ($i<count($field)) {
					$columns .=",";
				}
			}
			$sql = "UPDATE {$table} SET {$columns} WHERE id={$id}";

			if ($stmt = $this->pdo->prepare($sql)) {
				foreach ($field as $key => $value) {
					$stmt ->bindValue(":{$key}",$value);
				}
				$stmt ->execute();
				$count = $stmt->rowCount();
				return ($count>0)? true : false;
			}
		}


		public function uploadImage($file){
			$filename = basename($file['name']);
			$filetmp  = $file['tmp_name'];
			$filesize = $file['size'];
			$err      = $file['error'];
			$ext      = explode('.',$filename);
			$ext      = end($ext);
			$allowed_ext = array('jpeg','jpg','png');

			if (in_array($ext,$allowed_ext)) {
				if ($err == 0 && $filesize<=2097152) {
					$fileroot = 'img/'.$filename;
					move_uploaded_file($filetmp,$fileroot);
					return $fileroot;
				}else{
					$GLOBALS['error'] = "Something wrong to upload image.";
				}
			}else{
				$GLOBALS['error'] = "This extension is not allowed.You can only use JPG,JPEG,PNG.";
				
			}
			
		}

		public function userData($table,$id){
			$stmt = $this->pdo->prepare("SELECT * FROM {$table} WHERE id=:id");
			$stmt ->bindParam(":id",$id,PDO::PARAM_INT);
			$stmt ->execute();

			return $stmt->fetch(PDO::FETCH_OBJ);
		}
		
		public function userAllData($table,$field,$id){
			$stmt = $this->pdo->prepare("SELECT * FROM {$table} WHERE {$field}=:{$field}");
			$stmt ->bindValue(":{$field}",$id,PDO::PARAM_INT);
			$stmt ->execute();

			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function delete($sql){
			$stmt = $this->pdo->prepare($sql);
			$stmt ->execute();
			$count = $stmt->rowCount();
			return ($count>0)? true : false;
		}
	}
 ?>
