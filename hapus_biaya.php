<?php
include 'koneksi.php';

$kdbiaya = @$_GET['kdbiaya'];

mysqli_query($koneksi, "delete from tb_biaya where kode_biaya = '$kdbiaya'") or die (mysqli_error($koneksi));
?>

<script type="text/javascript">
    window.location.href="?page=biaya";
</script>