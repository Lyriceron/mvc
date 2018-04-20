<?php
class User_Model{
	public $id;
	public $email;
	public $password;
  public $role;
	public $status;
	public $token;
  public $display_name;
  public $id_image;

	public function all(){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'select * from users';
		$result = mysqli_query($conn, $sql);
		$list_user = array();

		if(!$result)
			die('Error: '.mysqli_query_error());

		while ($row = mysqli_fetch_assoc($result)){
            $user = new User_Model();
            $user->id = $row['id'];
            $user->email = $row['email'];
            $user->password = $row['password'];
            $user->role = $row['role'];
            $user->status = $row['status'];
            $user->token = $row['token'];
            $user->display_name = $row['display_name'];
            $user->id_image = $row['id_image'];
            $list_user[] = $user;
        }

        return $list_user;
	}

	public function save(){
		$conn = FT_Database::instance()->getConnection();
		$stmt = $conn->prepare("INSERT INTO users (email, password, role, status, token, display_name, id_image) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssi", $this->email, $this->password, $this->role, $this->status, $this->token, $this->display_name, $this->id_image);
		$rs = $stmt->execute();
		$this->id = $stmt->insert_id;
		$stmt->close();
		return $rs;
	}

	public function findById($id){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'select * from users where id='.$id;
		$result = mysqli_query($conn, $sql);

		if(!$result)
			die('Error: ');

		$row = mysqli_fetch_assoc($result);
        $user = new User_Model();
        $user->id = $row['id'];
        $user->email = $row['email'];
        $user->password = $row['password'];
        $user->role = $row['role'];
        $user->status = $row['status'];
        $user->display_name = $row['display_name'];
        $user->id_image = $row['id_image'];


        return $user;
	}

	public function delete(){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'delete from users where id='.$this->id;
		$result = mysqli_query($conn, $sql);

		return $result;
	}

	public function update(){
		$conn = FT_Database::instance()->getConnection();
		$stmt = $conn->prepare("UPDATE users SET email=?, password=?, role=?, status=?, display_name=?, id_image=? WHERE id=?");
		$stmt->bind_param("sssssii", $this->email, $this->password, $this->role, $this->status,$this->display_name, $this->id_image, $_POST['id']);
		$stmt->execute();
		$stmt->close();
	}
}
?>
