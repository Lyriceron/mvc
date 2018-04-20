<?php
class Album_Deltail{
  public $id;
  public $id_album;
  public $id_artist;
  public $id_image;

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from album_details';
    $result = mysqli_query($conn, $sql);
    $list_album_detail = array();

    if(!$result)
      die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
            $album_detail = new Album_Deltail
          ();
            $album_detail->id = $row['id'];
            $album_detail->id_album = $row['id_album'];
            $album_detail->id_artist = $row['id_artist'];
            $album_detail->id_image = $row['id_image'];

            $list_album_detail[] = $album_detail;
        }

        return $list_album_detail;
  }

  public function save(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("INSERT INTO album_details (id_album, id_artist, id_image)
      VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $this->id_album, $this->id_artist, $this->id_image);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from album_details where id='.$id;
    $result = mysqli_query($conn, $sql);

    if(!$result)
      die('Error: ');

    $row = mysqli_fetch_assoc($result);
        $album_detail = new Album_Deltail
      ();
            $album_detail->id = $row['id'];
            $album_detail->id_album = $row['id_album'];
            $album_detail->id_artist = $row['id_artist'];
            $album_detail->id_image = $row['id_image'];

        return $album_detail;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from album_details where id='.$this->id;
    $result = mysqli_query($conn, $sql);

    return $result;
  }

  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE album_details SET id_album=?, id_artist=?, id_image=? WHERE id=?");
    $stmt->bind_param("iiii", $this->id_album, $this->id_artist, $this->id_image, $_POST['id']);
    $stmt->execute();
    $stmt->close();
  }
}
?>
