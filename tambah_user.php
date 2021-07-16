<?php
include 'koneksi.php';
?>

<fieldset>
    <legend>Tambah User</legend>

    <?php
    $carikode = mysqli_query($koneksi, "select max(id) from user") or die (mysqli_error($koneksi));
    $datakode = mysqli_fetch_array($carikode);
    if($datakode) {
        $nilaikode = substr($datakode[0], 1);
        $kode = (int) $nilaikode;
        $kode = $kode + 1;
        $hasilkode = "U".str_pad($kode, 3, "0", STR_PAD_LEFT);
    } else {
        $hasilkode = "U001";
    }
    ?>

    
    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Id User</td>
                <td>:</td>
                <td><input type="text" name="id" value="<?php echo $hasilkode; ?>" readonly /></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama" /></td>
            </tr>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username" /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="text" name="password" /></td>
            </tr>
            <tr>
                <td>Level</td>
                <td>:</td>
                <td><select name="level">
                        <option value="admin">Admin</option>
                        <option value="pengunjung">Pengunjung</option>
                    </select></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="tambah" value="Tambah" /> <input type="reset" value="Reset" /></td>
            </tr>
        </table>
    </form>

    <?php
    $id = @$_POST['id'];
    $nama = @$_POST['nama'];
    $username = @$_POST['username'];
    $password = @$_POST['password'];
    $level = @$_POST['level'];

    $tambah_user = @$_POST['tambah'];

    if($tambah_user){
        if($id == "" || $nama == "" || $username == "" || $password == "" || $level == "") {
           ?>
            <script type="text/javascript">
            alert("Inputan tidak boleh ada yang kosong");
            </script>
           <?php
        } else {
                mysqli_query($koneksi, "insert into user VALUES ('$id','$nama','$username','$password','$level')") or die (mysqli_error($koneksi));
                ?>
                <script type="text/javascript">
                alert("Tambah user berhasil");
                window.location.href="?page=user_manajemen";
                </script>
            <?php
            }
        }
    
    ?>
</fieldset>