<?php
include 'koneksi.php';
$result = mysqli_query($koneksi, "select * from tb_biaya"); 
$jsArray = "var biaya = new Array();\n"; 

?>

<fieldset>
    <legend>Tambah Data Servis</legend>
    <?php
    $carikode = mysqli_query($koneksi, "select max(kode_servis) from tb_servis") or die (mysqli_error($koneksi));
    $datakode = mysqli_fetch_array($carikode);
    if($datakode) {
        $nilaikode = substr($datakode[0], 1);
        $kode = (int) $nilaikode;
        $kode = $kode + 1;
        $hasilkode = "S".str_pad($kode, 3, "0", STR_PAD_LEFT);
    } else {
        $hasilkode = "S001";
    }
    ?>

    
    <form action="" method="post" enctype="multipart/form-data">
    <?php 
    echo '<table>';
    ?>
            <tr>
                <td>Kode Servis</td>
                <td>:</td>
                <td><input type="text" name="kode_servis" value="<?php echo $hasilkode; ?>" readonly /></td>
            </tr>
            <tr>
                <td>Nama Pelanggan</td>
                <td>:</td>
                <td><input type="text" name="nama_pelanggan" /></td>
            </tr>
    <?php
    echo '<tr>';
    echo '<td> Kode Jasa </td><td> : </td><td><select name="kode_biaya" onchange="changeValue(this.value)">'; 
    echo '<option>-------</option>'; 
    while ($row = mysqli_fetch_array($result)) { 
    echo '<option value="' . $row['kode_biaya'] . '">' . $row['kode_biaya'] . '</option>'; 
    $jsArray .= "biaya['" . $row['kode_biaya'] . "'] = {name:'" . addslashes($row['nama_jasa']) . "',desc:'".addslashes($row['harga'])."'};\n"; 
    } 
    echo '</select></td>'; 
    echo '</tr>';
    
    ?>
            <tr>
                <td>Nama Jasa</td>
                <td>:</td>
                <td><input type="text" name="nama_jasa" id="nama_jasa"/></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td>:</td>
                <td><input type="text" name="harga" id="harga"/></td>
            </tr>

    <script type="text/javascript"> 
    <?php echo $jsArray; ?>
    function changeValue(id){
    document.getElementById('nama_jasa').value = biaya[id].name;
    document.getElementById('harga').value = biaya[id].desc;
    };
    </script>

            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="tambah" value="Tambah" /> <input type="reset" value="Reset" /></td>
            </tr>
    <?php
    echo '</table>';
    ?>
    </form>

    <?php
    $kode_servis = @$_POST['kode_servis'];
    $nama_pelanggan = @$_POST['nama_pelanggan'];
    $nama_jasa = @$_POST['nama_jasa'];
    $harga = @$_POST['harga'];
    $tanggal = date("Y-m-d H:i:s");


    $tambah_data_servis = @$_POST['tambah'];

    if($tambah_data_servis){
        if($kode_servis == "" || $nama_pelanggan == "" || $nama_jasa == "" || $harga == "" || $tanggal == "") {
           ?>
            <script type="text/javascript">
            alert("Inputan tidak boleh ada yang kosong");
            </script>
           <?php
        } else {
                mysqli_query($koneksi, "insert into tb_servis VALUES ('$kode_servis','$tanggal','$nama_pelanggan','$nama_jasa','$harga')") or die (mysqli_error($koneksi));
                ?>
                <script type="text/javascript">
                alert("Tambah data Servis berhasil");
                window.location.href="?page=data_servis";
                </script>
            <?php
            }
        }
    ?>
</fieldset>

