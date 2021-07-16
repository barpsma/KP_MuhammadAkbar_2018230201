<?php
include 'koneksi.php';
?>

<fieldset>
    <legend>Data Biaya</legend>

    <div style="margin-bottom:15px;" align="right">

            <form action="" method="post">
                    <input type="text" name="inputan_pencarian" placeholder="Masukan Nama Jasa" style="width:200px; padding:5px;" />
                    <input type="submit" name="cari_biaya" value="Cari" style="padding:3px;" />
            </form>
            </div>

    <table width="100%" border="1px" style="border-collapse:collapse;">
        <tr style="background-color:#355c7d; color:white;">
            <th>Kode Biaya</th>
            <th>Nama Jasa</th>
            <th>Perkiraan Waktu</th>
            <th>Perkiraan Harga</th>
            <th>Opsi</th>
        </tr>
        <?php
        $inputan_pencarian = @$_POST['inputan_pencarian'];
        $cari_biaya = @$_POST['cari_biaya'];
        if($cari_biaya){
            if($inputan_pencarian != ""){
            $sql = mysqli_query($koneksi, "select * from tb_biaya where nama_jasa like '%$inputan_pencarian%' or kode_biaya like '%$inputan_pencarian%'") or die (mysqli_error($koneksi));
            } else{
                $sql = mysqli_query($koneksi, "select * from tb_biaya") or die (mysqli_error($koneksi));
            }
        } else {
            $sql = mysqli_query($koneksi, "select * from tb_biaya") or die (mysqli_error($koneksi));
        }

        $cek = mysqli_num_rows($sql);
        if($cek < 1){
            ?>
            <tr>
                <td colspan="5" align="center" style="padding:10px;">Jasa Tidak ditemukan</td>
            </tr>
            <?php
        }else {

        $sql = mysqli_query($koneksi, "select * from tb_biaya") or die (mysqli_error($koneksi));
        while($data = mysqli_fetch_array($sql)){
        ?>
            <tr>
                <td><?php echo $data['kode_biaya']; ?></td>
                <td><?php echo $data['nama_jasa']; ?></td>
                <td><?php echo $data['perkiraan_waktu']; ?></td>
                <td>Rp. <?php echo number_format($data['harga']) ?></td>
                <td align="center">
                    <a href="?page=biaya&action=edit&kdbiaya=<?php echo $data['kode_biaya']; ?>"><button>Edit</button></a>
                    <a onclick="return confirm('Yakin ingin menghapus iklan?')" href="?page=biaya&action=hapus&kdbiaya=<?php echo $data['kode_biaya']; ?>"><button>Hapus</button></a>
                </td>
            </tr>
        <?php
        }
    }
        ?>
    </table>
</fieldset>