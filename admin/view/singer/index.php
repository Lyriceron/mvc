<?php if ( ! defined('PATH_PUBLIC')) die ('Bad requested!');
    require_once(PATH_PUBLIC . '/template/admin/header.php');
?>
<div class="container">
    <div class="row">
        <h3>Danh sach singer</h3>
    </div>
    <table class="table">
        <thead>
          <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Mota</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($list_singer as $singer) { ?>
          <tr>
            <td><?php echo increment_once($index); ?></td>
            <td><?php echo $singer->name; ?></td>
            <td><?php echo $singer->mota; ?></td>
            <td><a href="admin.php?c=singer&a=edit&id=<?php echo $singer->id; ?>">Edit</a></td>
            <td><a href="admin.php?c=singer&a=delete&id=<?php echo $singer->id; ?>">Delete</a</td>
          </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php require_once(PATH_PUBLIC . '/template/admin/footer.php'); ?>
