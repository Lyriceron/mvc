<?php
class Playlist_Model{
  public $id;
  public $name;
  public $description;
  public $id_user;
  public $id_image;

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from playlists';
    $result = mysqli_query($conn, $sql);
    $list_playlist = array();

    if(!$result)
      die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
            $playlist = new Playlist_Model();
            $playlist->id = $row['id'];
            $playlist->name = $row['name'];
            $playlist->description = $row['description'];
            $playlist->id_user = $row['id_user'];
            $playlist->id_image = $row['id_image'];

            $list_playlist[] = $playlist;
        }

        return $list_playlist;
  }

  public function save(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("INSERT INTO playlists (name, description, id_user, id_image)
      VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $this->name, $this->description, $this->id_user, $this->id_image);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from playlists where id='.$id;
    $result = mysqli_query($conn, $sql);

    if(!$result)
      die('Error: ');

    $row = mysqli_fetch_assoc($result);
        $playlist = new Playlist_Model();
            $playlist->id = $row['id'];
            $playlist->name = $row['name'];
            $playlist->description = $row['description'];
            $playlist->id_user = $row['id_user'];
            $playlist->id_image = $row['id_image'];

        return $playlist;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from playlists where id='.$this->id;
    $result = mysqli_query($conn, $sql);

    return $result;
  }

  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE playlists SET id_user=?, name=?, description=?, id_image=? WHERE id=?");
    $stmt->bind_param("ssiii", $this->name, $this->description, $this->id_user, $this->id_image, $_POST['id']);
    $stmt->execute();
    $stmt->close();
  }
}
?>
