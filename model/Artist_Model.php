<?php
class Artist_Model{
  public $id;
  public $name;
  public $description;
  public $id_image;

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from aritists';
    $result = mysqli_query($conn, $sql);
    $list_aritist = array();

    if(!$result)
      die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
            $aritist = new Artist_Model
          ();
            $aritist->id = $row['id'];
            $aritist->name = $row['name'];
            $aritist->description = $row['description'];
            $aritist->id_image = $row['id_image'];

            $list_aritist[] = $aritist;
        }

        return $list_aritist;
  }

  public function save(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("INSERT INTO aritists (name, description, id_image)
      VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $this->name, $this->description, $this->id_image);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from aritists where id='.$id;
    $result = mysqli_query($conn, $sql);

    if(!$result)
      die('Error: ');

    $row = mysqli_fetch_assoc($result);
        $aritist = new Artist_Model
      ();
            $aritist->id = $row['id'];
            $aritist->name = $row['name'];
            $aritist->description = $row['description'];
            $aritist->id_image = $row['id_image'];

        return $aritist;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from aritists where id='.$this->id;
    $result = mysqli_query($conn, $sql);

    return $result;
  }

  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE aritists SET name=?, description=?, id_image=? WHERE id=?");
    $stmt->bind_param("ssii", $this->name, $this->description, $this->id_image, $_POST['id']);
    $stmt->execute();
    $stmt->close();
  }
}
?>
