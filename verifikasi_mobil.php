<?php
include 'koneksi.php';
?>

<fieldset>
    <legend>Verifikasi Iklan</legend>

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
                <td>Verifikasi</td>
                <td>:</td>
                <td><select name="verifikasi">
                        <option value="pending">Pending</option>
                        <option value="setujui">Setujui</option>
                    </select></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="simpan" value="Simpan" /></td>
            </tr>
        </table>
    </form>

    <?php
    $merk = @$_POST['merk'];
    $type = @$_POST['type'];
    $warna = @$_POST['warna'];
    $harga = @$_POST['harga'];
    $no_hp = @$_POST['no_hp'];
    $status = @$_POST['status'];
    $verifikasi = @$_POST['verifikasi'];

    $sumber = @$_FILES['gambar']['tmp_name'];
    $target = 'iklan/';
    $nama_gambar = @$_FILES['gambar']['name'];

    $verifikasi_mobil = @$_POST['simpan'];

    if($verifikasi_mobil){
        if($merk == "" || $type == "" || $warna == "" || $harga == "" || $no_hp == "" || $status == "" || $verifikasi == "") {
           ?>
            <script type="text/javascript">
            alert("Inputan tidak boleh ada yang kosong");
            </script>
           <?php
        }else {
            if($nama_gambar == ""){
                mysqli_query($koneksi, "update tb_mobil set merk = '$merk', type = '$type', warna = '$warna', harga = '$harga', no_hp = '$no_hp', status = '$status' , verifikasi = '$verifikasi' where kode_mobil = '$kdmobil'") or die (mysqli_error($koneksi));
                ?>
                    <script type="text/javascript">
                    alert("Verifikasi data iklan berhasil");
                    window.location.href="?page=iklan_manajemen";
                    </script>
                <?php
            }else{
                $pindah = move_uploaded_file($sumber, $target.$nama_gambar);
                if($pindah){
                    mysqli_query($koneksi, "update tb_mobil set merk = '$merk', type = '$type', warna = '$warna', harga = '$harga', no_hp = '$no_hp', status = '$status', gambar = '$nama_gambar' , verifikasi = '$verifikasi' where kode_mobil = '$kdmobil'") or die (mysqli_error($koneksi));
                    ?>
                    <script type="text/javascript">
                    alert("Verifikasi data iklan berhasil");
                    window.location.href="?page=iklan_manajemen";
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
    }
    ?>

</fieldset>