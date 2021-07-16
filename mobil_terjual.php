<?php
include 'koneksi.php';
?>

<fieldset>
    <legend>Verifikasi Mobil Terjual</legend>

    <?php
    $kdmobil = @$_GET['kdmobil'];
    $sql = mysqli_query($koneksi, "select * from tb_mobil where kode_mobil = '$kdmobil'") or die (mysqli_error($koneksi));
    $data = mysqli_fetch_array($sql);
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Kode Mobil</td>
                <td>:</td>
                <td><input type="text" name="kode_mobil" value="<?php echo $data['kode_mobil']; ?>" readonly /></td>
            </tr>
            <tr>
                <td>Merk</td>
                <td>:</td>
                <td><input type="text" name="merk" value="<?php echo $data['merk']; ?>" readonly /></td>
            </tr>
            <tr>
                <td>Type</td>
                <td>:</td>
                <td><input type="text" name="type" value="<?php echo $data['type']; ?>" readonly /></td>
            </tr>
            <tr>
                <td>Warna</td>
                <td>:</td>
                <td><input type="text" name="warna" value="<?php echo $data['warna']; ?>" readonly /></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td>:</td>
                <td><input type="text" name="harga" value="<?php echo $data['harga']; ?>" readonly /></td>
            </tr>
            <tr>
                <td>Nama Pengiklan</td>
                <td>:</td>
                <td><input type="text" name="nama_pengiklan" value="<?php echo $data['nama_pengiklan']; ?>" readonly /></td>
            </tr>
            <tr>
                <td>No HP</td>
                <td>:</td>
                <td><input type="text" name="no_hp" value="<?php echo $data['no_hp']; ?>" readonly /></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:</td>
                <td><input type="text" name="status" value="<?php echo $data['status']; ?>" readonly /></td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td>:</td>
                <td><input type="text" name="gambar" value="<?php echo $data['gambar']; ?>" readonly /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="simpan" value="Simpan" /></td>
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
    $status = @$_POST['status'];
    $gambar = @$_POST['gambar'];

    $mobil_terjual = @$_POST['simpan'];

    if($mobil_terjual){
        if($kode_mobil == "" || $merk == "" || $type == "" || $warna == "" || $harga == "" || $nama_pengiklan == "" || $no_hp == "" || $status == "" || $gambar == "") {
           ?>
            <script type="text/javascript">
            alert("Inputan tidak boleh ada yang kosong");
            </script>
           <?php
        }else {
            if($status == "tersedia"){
                ?>
                    <script type="text/javascript">
                    alert("Mobil masih tersedia");
                    </script>
                <?php
            }
            else{
                mysqli_query($koneksi, "insert into tb_mobil_terjual VALUES ('$kode_mobil','$merk','$type','$warna','$harga','$nama_pengiklan','$no_hp','$status','$gambar')") or die (mysqli_error($koneksi));
                ?>
                    <script type="text/javascript">
                    alert("Data berhasil tersimpan");
                    window.location.href="?page=data_mobil_terjual";
                    </script>
                <?php
                }
            }
        }
    
    ?>

</fieldset>