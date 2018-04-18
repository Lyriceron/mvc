<?php
class Album_Song_Model{
  public $id;
  public $album_id;
  public $song_id;

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from album_songs';
    $result = mysqli_query($conn, $sql);
    $list_album_song = array();

    if(!$result)
      die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
            $album_song = new Album_Song_Model();
            $album_song->id = $row['id'];
            $album_song->album_id = $row['album_id'];
            $album_song->song_id = $row['song_id'];
            $list_album_song[] = $album_song;
        }

        return $list_album_song;
  }

  public function save(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("INSERT INTO album_songs (album_id, song_id)
      VALUES (?, ?)");
    $stmt->bind_param("ii", $this->album_id, $this->song_id);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from album_songs where id='.$id;
    $result = mysqli_query($conn, $sql);

    if(!$result)
      die('Error: ');

    $row = mysqli_fetch_assoc($result);
        $album_song = new Album_Song_Model();
            $album_song->id = $row['id'];
            $album_song->album_id = $row['album_id'];
            $album_song->song_id = $row['song_id'];

        return $album_song;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from album_songs where id='.$this->id;
    $result = mysqli_query($conn, $sql);

    return $result;
  }

  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE album_songs SET album_id=?, song_id=? WHERE id=?");
    $stmt->bind_param("iii", $this->album_id, $this->song_id, $_POST['id']);
    $stmt->execute();
    $stmt->close();
  }
}
?>
