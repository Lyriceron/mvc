<?php
 class Song_Model{
  public $id;
  public $url;
  public $name;
  public $id_albuml_detail;
  public $id_image;
  public $id_genre;
  public $id_artist;
  public $id_favorite_song;

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from songs';
    $result = mysqli_query($conn, $sql);
    $list_song = array();

    if(!$result)
      die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
            $song = new Song_Model();
            $song->id = $row['id'];
            $song->url = $row['url'];
            $song->name = $row['name'];
            $song->id_albuml_detail = $row['id_albuml_detail'];
            $song->id_image = $row['id_image'];
            $song->id_genre = $row['id_genre'];
            $song->id_artist = $row['id_artist'];
            $song->id_favorite_song = $row['id_favorite_song'];
            $list_song[] = $song;
        }

        return $list_song;
  }

  public function save(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("INSERT INTO songs (url, name, id_albuml_detail, id_image, id_genre, id_artist, id_favorite_song)
      VALUES ('?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiiii", $this->url, $this->name, $this->id_albuml_detail, $this->id_image, $this->id_genre, $this->id_artist, $this->id_favorite_song);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from songs where id='.$id;
    $result = mysqli_query($conn, $sql);

    if(!$result)
      die('Error: ');

    $row = mysqli_fetch_assoc($result);
        $song = new Song_Model();
            $song->id = $row['id'];
            $song->url = $row['url'];
            $song->name = $row['name'];
            $song->id_albuml_detail = $row['id_albuml_detail'];
            $song->id_image = $row['id_image'];
            $song->id_genre = $row['id_genre'];
            $song->id_artist = $row['id_artist'];
            $song->id_favorite_song = $row['id_favorite_song'];

        return $song;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from songs where id='.$this->id;
    $result = mysqli_query($conn, $sql);

    return $result;
  }

  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE songs SET url=?, name=?, id_albuml_detail=? id_image=? id_genre=?, id_artist=?, id_favorite_song=?
      WHERE id=?");
    $stmt->bind_param("ssiiiiii", $this->url, $this->name, $this->id_albuml_detail, $this->id_image, $this->id_genre, $this->id_artist, $this->id_favorite_song $_POST['id']);
    $stmt->execute();
    $stmt->close();
  }
}
?>
