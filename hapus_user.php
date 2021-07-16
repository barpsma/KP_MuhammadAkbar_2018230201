<?php
include 'koneksi.php';

$id = @$_GET['id'];

mysqli_query($koneksi, "delete from user where id = '$id'") or die (mysqli_error($koneksi));
?>

<script type="text/javascript">
    window.location.href="?page=user_manajemen";
</script>