<?php
include 'koneksi.php';

$kdmobil = @$_GET['kdmobil'];

mysqli_query($koneksi, "delete from tb_mobil where kode_mobil = '$kdmobil'") or die (mysqli_error($koneksi));
?>

<script type="text/javascript">
    window.location.href="?page=iklan_manajemen";
</script>