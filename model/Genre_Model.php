<?php
class Genre_Model{
  public $id;
  public $name;
  public $description;
  public $id_image;

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from genres';
    $result = mysqli_query($conn, $sql);
    $list_genre = array();

    if(!$result)
      die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
            $genre = new Genre_Model
          ();
            $genre->id = $row['id'];
            $genre->name = $row['name'];
            $genre->description = $row['description'];
            $genre->id_image = $row['id_image'];

            $list_genre[] = $genre;
        }

        return $list_genre;
  }

  public function save(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("INSERT INTO genres (name, description, id_image)
      VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $this->name, $this->description, $this->id_image);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from genres where id='.$id;
    $result = mysqli_query($conn, $sql);

    if(!$result)
      die('Error: ');

    $row = mysqli_fetch_assoc($result);
        $genre = new Genre_Model
      ();
            $genre->id = $row['id'];
            $genre->name = $row['name'];
            $genre->description = $row['description'];
            $genre->id_image = $row['id_image'];

        return $genre;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from genres where id='.$this->id;
    $result = mysqli_query($conn, $sql);

    return $result;
  }

  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE genres SET name=?, description=?, id_image=? WHERE id=?");
    $stmt->bind_param("ssii", $this->name, $this->description, $this->id_image, $_POST['id']);
    $stmt->execute();
    $stmt->close();
  }
}
?>
