<?php
include 'koneksi.php';
?>

<fieldset>
    <legend>Tambah Iklan</legend>

    <?php
    $carikode = mysqli_query($koneksi, "select max(kode_mobil) from tb_mobil") or die (mysqli_error($koneksi));
    $datakode = mysqli_fetch_array($carikode);
    if($datakode) {
        $nilaikode = substr($datakode[0], 1);
        $kode = (int) $nilaikode;
        $kode = $kode + 1;
        $hasilkode = "M".str_pad($kode, 3, "0", STR_PAD_LEFT);
    } else {
        $hasilkode = "M001";
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Kode Mobil</td>
                <td>:</td>
                <td><input type="text" name="kode_mobil" value="<?php echo $hasilkode; ?>" readonly /></td>
            </tr>
            <tr>
                <td>Merk</td>
                <td>:</td>
                <td><input type="text" name="merk" /></td>
            </tr>
            <tr>
                <td>Type</td>
                <td>:</td>
                <td><input type="text" name="type" /></td>
            </tr>
            <tr>
                <td>Warna</td>
                <td>:</td>
                <td><input type="text" name="warna" /></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td>:</td>
                <td><input type="text" name="harga" onkeypress="return event.charCode >= 48 && event.charCode <=57" /></td>
            </tr>
            <tr>
                <td>Nama Pengiklan</td>
                <td>:</td>
                <td><input type="text" name="nama_pengiklan" value="<?php echo $_SESSION['nama'];?>" readonly /></td>
            </tr>
            <tr>
                <td>No HP</td>
                <td>:</td>
                <td><input type="text" name="no_hp" onkeypress="return event.charCode >= 48 && event.charCode <=57" /></td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td>:</td>
                <td><input type="file" name="gambar" /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="tambah" value="Tambah" /> <input type="reset" value="Reset" /></td>
            </tr>
        </table>
    </form>

    <?php
    $kode_mobil = @$_POST['kode_mobil'];
    $merk = @$_POST['merk'];
    $type = @$_POST['type'];
    $warna = @$_POST['warna'];
    $harga = @$_POST['harga'];
    $nama_pengiklan = @$_POST['nama_pengiklan'];
    $no_hp = @$_POST['no_hp'];
    $status = ("tersedia");
    $verifikasi = ("pending");

    $sumber = @$_FILES['gambar']['tmp_name'];
    $target = 'iklan/';
    $nama_gambar = @$_FILES['gambar']['name'];

    $tambah_mobil = @$_POST['tambah'];

    if($tambah_mobil){
        if($kode_mobil == "" || $merk == "" || $type == "" || $warna == "" || $harga == "" || $nama_pengiklan == "" || $no_hp == "" || $status == "" || $nama_gambar == "" || $verifikasi == "") {
           ?>
            <script type="text/javascript">
            alert("Inputan tidak boleh ada yang kosong");
            </script>
           <?php
        }else {
            $pindah = move_uploaded_file($sumber, $target.$nama_gambar);
            if($pindah){
                mysqli_query($koneksi, "insert into tb_mobil VALUES ('$kode_mobil','$merk','$type','$warna','$harga','$nama_pengiklan','$no_hp','$status','$nama_gambar','$verifikasi')") or die (mysqli_error($koneksi));
                ?>
                <script type="text/javascript">
                alert("Tambah data iklan berhasil");
                window.location.href="?page=iklan";
                </script>
            <?php
            }else{
                ?>
                <script type="text/javascript">
                alert("Gambar gagal diupload");
                </script>
                <?php
            }
        }
    }
    ?>
</fieldset>