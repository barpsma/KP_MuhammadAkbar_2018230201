<?php
include 'koneksi.php';
?>

<fieldset>
    <legend>Edit Biaya</legend>

    <?php
    $kdbiaya = @$_GET['kdbiaya'];
    $sql = mysqli_query($koneksi, "select * from tb_biaya where kode_biaya = '$kdbiaya'") or die (mysqli_error($koneksi));
    $data = mysqli_fetch_array($sql);
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Kode Biaya</td>
                <td>:</td>
                <td><input type="text" name="kode_biaya" value="<?php echo $data['kode_biaya']; ?>" readonly /></td>
            </tr>
            <tr>
                <td>Nama Jasa</td>
                <td>:</td>
                <td><input type="text" name="nama_jasa" value="<?php echo $data['nama_jasa']; ?>" /></td>
            </tr>
            <tr>
                <td>Perkiraan Waktu</td>
                <td>:</td>
                <td><input type="text" name="perkiraan_waktu" value="<?php echo $data['perkiraan_waktu']; ?>" /></td>
            </tr>
            <tr>
                <td>Perkiraan Harga</td>
                <td>:</td>
                <td><input type="text" name="harga" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="<?php echo $data['harga']; ?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="edit" value="Edit" /> <input type="reset" value="Reset" /></td>
            </tr>
        </table>
    </form>

    <?php
    $nama_jasa = @$_POST['nama_jasa'];
    $perkiraan_waktu = @$_POST['perkiraan_waktu'];
    $harga = @$_POST['harga'];

    $edit_biaya = @$_POST['edit'];

    if($edit_biaya){
        if($nama_jasa == "" || $perkiraan_waktu == "" || $harga == "") {
           ?>
            <script type="text/javascript">
            alert("Inputan tidak boleh ada yang kosong");
            </script>
           <?php
        }else{
                    mysqli_query($koneksi, "update tb_biaya set nama_jasa = '$nama_jasa', perkiraan_waktu = '$perkiraan_waktu', harga = '$harga' where kode_biaya = '$kdbiaya'") or die (mysqli_error($koneksi));
                    ?>
                    <script type="text/javascript">
                    alert("Edit data Biaya berhasil");
                    window.location.href="?page=biaya";
                    </script>
                <?php
                }
            }
    ?>

</fieldset>