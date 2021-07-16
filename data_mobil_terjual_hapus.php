<?php
include 'koneksi.php';

$kdmobil = @$_GET['kdmobil'];

mysqli_query($koneksi, "delete from tb_mobil_terjual where kode_mobil = '$kdmobil'") or die (mysqli_error($koneksi));
?>

<script type="text/javascript">
    window.location.href="?page=data_mobil_terjual";
</script>