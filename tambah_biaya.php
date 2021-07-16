<?php
include 'koneksi.php';
?>

<fieldset>
    <legend>Tambah Biaya</legend>

    <?php
    $carikode = mysqli_query($koneksi, "select max(kode_biaya) from tb_biaya") or die (mysqli_error($koneksi));
    $datakode = mysqli_fetch_array($carikode);
    if($datakode) {
        $nilaikode = substr($datakode[0], 1);
        $kode = (int) $nilaikode;
        $kode = $kode + 1;
        $hasilkode = "B".str_pad($kode, 3, "0", STR_PAD_LEFT);
    } else {
        $hasilkode = "B001";
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Kode Biaya</td>
                <td>:</td>
                <td><input type="text" name="kode_biaya" value="<?php echo $hasilkode; ?>" readonly /></td>
            </tr>
            <tr>
                <td>Nama Jasa</td>
                <td>:</td>
                <td><input type="text" name="nama_jasa" /></td>
            </tr>
            <tr>
                <td>Perkiraan Waktu</td>
                <td>:</td>
                <td><input type="text" name="perkiraan_waktu" /></td>
            </tr>
            <tr>
                <td>Perkiraan Harga</td>
                <td>:</td>
                <td><input type="text" name="harga" onkeypress="return event.charCode >= 48 && event.charCode <=57" /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="tambah" value="Tambah" /> <input type="reset" value="Reset" /></td>
            </tr>
        </table>
    </form>

    <?php
    $kode_biaya = @$_POST['kode_biaya'];
    $nama_jasa = @$_POST['nama_jasa'];
    $perkiraan_waktu = @$_POST['perkiraan_waktu'];
    $harga = @$_POST['harga'];

    $tambah_biaya = @$_POST['tambah'];

    if($tambah_biaya){
        if($kode_biaya == "" || $nama_jasa == "" || $perkiraan_waktu == "" || $harga == "") {
           ?>
            <script type="text/javascript">
            alert("Inputan tidak boleh ada yang kosong");
            </script>
           <?php
        }else {
                mysqli_query($koneksi, "insert into tb_biaya VALUES ('$kode_biaya','$nama_jasa','$perkiraan_waktu','$harga')") or die (mysqli_error($koneksi));
                ?>
                <script type="text/javascript">
                alert("Tambah data Biaya berhasil");
                window.location.href="?page=biaya";
                </script>
            <?php
            }
        }
    ?>
</fieldset>