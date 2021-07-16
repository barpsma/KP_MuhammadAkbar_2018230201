<?php
include 'koneksi.php';
?>

<fieldset>
    <legend>Edit Data User</legend>

    <?php
    $iduser = @$_GET['iduser'];
    $sql = mysqli_query($koneksi, "select * from user where id = '$iduser'") or die (mysqli_error($koneksi));
    $data = mysqli_fetch_array($sql);
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Id</td>
                <td>:</td>
                <td><input type="text" name="id" value="<?php echo $data['id']; ?>" readonly /></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama" value="<?php echo $data['nama']; ?>" /></td>
            </tr>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username" value="<?php echo $data['username']; ?>" /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="text" name="password" value="<?php echo $data['password']; ?>" /></td>
            </tr>
            <tr>
                <td>Level</td>
                <td>:</td>
                <td><input type="text" name="level" value="<?php echo $data['level']; ?>" readonly /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="edit" value="Edit" /> <input type="reset" value="Reset" /></td>
            </tr>
        </table>
    </form>

    <?php
    $nama = @$_POST['nama'];
    $username = @$_POST['username'];
    $password = @$_POST['password'];


    $edit_user = @$_POST['edit'];

    if($edit_user){
        if($nama == "" || $username == "" || $password == "") {
           ?>
            <script type="text/javascript">
            alert("Inputan tidak boleh ada yang kosong");
            </script>
           <?php
        }else{
                    mysqli_query($koneksi, "update user set nama = '$nama', username = '$username', password = '$password' where id = '$iduser'") or die (mysqli_error($koneksi));
                    ?>
                    <script type="text/javascript">
                    alert("Edit data user berhasil, Silahkan Login Ulang untuk melihat perubahan");
                    window.location.href="?page=";
                    </script>
                <?php
                }
            }

    ?>

</fieldset>