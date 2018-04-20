<?php
class Image_Model{
  public $id;
  public $name;
  public $url;

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from images';
    $result = mysqli_query($conn, $sql);
    $list_image = array();

    if(!$result)
      die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
            $image = new Image_Model();
            $image->id = $row['id'];
            $image->name = $row['name'];
            $image->url = $row['url'];
            $list_image[] = $image;
        }

        return $list_image;
  }

  public function save(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("INSERT INTO images (name, url)
      VALUES (?, ?)");
    $stmt->bind_param("ss", $this->name, $this->url);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from images where id='.$id;
    $result = mysqli_query($conn, $sql);

    if(!$result)
      die('Error: ');

    $row = mysqli_fetch_assoc($result);
        $image = new Image_Model();
            $image->id = $row['id'];
            $image->name = $row['name'];
            $image->url = $row['url'];

        return $image;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from images where id='.$this->id;
    $result = mysqli_query($conn, $sql);

    return $result;
  }

  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE images SET name=?, url=? WHERE id=?");
    $stmt->bind_param("ssi", $this->name, $this->url, $_POST['id']);
    $stmt->execute();
    $stmt->close();
  }
}
?>
