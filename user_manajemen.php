<?php
include 'koneksi.php';
?>

<fieldset>
    <legend>Data User</legend>

    <div style="margin-bottom:15px;" align="right">

            <form action="" method="post">
                    <input type="text" name="inputan_pencarian" placeholder="Masukan Nama User" style="width:200px; padding:5px;" />
                    <input type="submit" name="cari_user" value="Cari" style="padding:3px;" />
            </form>
            </div>


    <table width="100%" border="1px" style="border-collapse:collapse;">
        <tr style="background-color:#355c7d; color:white;">
            <th>Id</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Password</th>
            <th>Level</th>
            <th>Opsi</th>
        </tr>
        <?php
        $inputan_pencarian = @$_POST['inputan_pencarian'];
        $cari_user = @$_POST['cari_user'];
        if($cari_user){
            if($inputan_pencarian != ""){
            $sql = mysqli_query($koneksi, "select * from user where nama like '%$inputan_pencarian%' or username like '%$inputan_pencarian%'") or die (mysqli_error($koneksi));
            } else{
                $sql = mysqli_query($koneksi, "select * from user") or die (mysqli_error($koneksi));
            }
        } else {
            $sql = mysqli_query($koneksi, "select * from user") or die (mysqli_error($koneksi));
        }

        $cek = mysqli_num_rows($sql);
        if($cek < 1){
            ?>
            <tr>
                <td colspan="6" align="center" style="padding:10px;">User Tidak ditemukan</td>
            </tr>
            <?php
        }else {

        while($data = mysqli_fetch_array($sql)){
        ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['username']; ?></td>
                <td><?php echo $data['password']; ?></td>
                <td><?php echo $data['level']; ?></td>
                <td align="center">
                    <a onclick="return confirm('Yakin ingin menghapus iklan?')" href="?page=user_manajemen&action=hapus&id=<?php echo $data['id']; ?>"><button>Hapus</button></a>
                </td>
            </tr>
        <?php
        }
    }
        ?>
    </table>
</fieldset>