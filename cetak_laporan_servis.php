<?php
include 'koneksi.php';
$tgl    =date("Y-m-d");

?>



<!DOCTYPE html>
<html>
<head>
	<title>LAPORAN DATA SERVIS PELANGGAN</title>
</head>
<body>

	<center>

		<h2>DATA SERVIS PELANGGAN</h2>
		<h4>Ananda Motor</h4>
	</center>

    <i><b>Informasi : </b> Data per Tanggal: <b><?php echo $tgl?></b></i><br><br>

	<?php 
	include 'koneksi.php';
	?>

	<table border="1" style="width: 100%">
		<tr>
                <tr>
                    <th>Kode Servis</th>
                    <th>Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Jasa</th>
                    <th>Biaya</th>
                </tr>
		</tr>
		<?php 
		$no = 1;
		$sql = mysqli_query($koneksi,"select * from tb_servis WHERE tanggal='$tgl'");
		while($data = mysqli_fetch_array($sql)){
		?>
		<tr>
                    <tr>
                        <td><?php echo $data['kode_servis']; ?></td>
                        <td><?php echo $data['tanggal']; ?></td>
                        <td><?php echo $data['nama_pelanggan']; ?></td>
                        <td><?php echo $data['jasa']; ?></td>
                        <td>Rp. <?php echo number_format($data['biaya']) ?></td>
                    </tr>
		<?php 
		}
        $sql3 = mysqli_query($koneksi, "SELECT SUM(biaya) FROM tb_servis WHERE tanggal='$tgl'");
                while($data3 = mysqli_fetch_array($sql3)) {
                    ?>
                        <tr>
                            <td colspan="4">Total Pemasukan:</td></a>
                            <td><?php echo "Rp. " . number_format($data3['SUM(biaya)']) ;?></td>
                        </tr>
                    <?php
                }
		?>
	</table>

	<script>
		window.print();
	</script>

</body>
</html>