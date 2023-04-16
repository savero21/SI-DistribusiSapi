<?php 
    include 'sidebarnav.php';
    include_once 'config.php';
    ob_start();

    $redirect_path = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] ;
    if(isset($_POST['create'])) {
        $id_pengumpulan_susu = $conn->real_escape_string($_POST['id_pengumpulan_susu']);
        $id_petugas_transaksi = $conn->real_escape_string($_POST['id_petugas_transaksi']);
        $harga_total = $conn->real_escape_string($_POST['harga_total']);
     

        $sql = "INSERT INTO pembayaran (id_pengumpulan_susu, id_petugas_transaksi , harga_total) VALUES ('$id_pengumpulan_susu', '$id_petugas_transaksi', '$harga_total')";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
        </script>
        <?php
    }  
    
    if (isset($_POST['update'])) {
        $id_pengumpulan_susu = $conn->real_escape_string($_POST['update']);
        $id_petugas_transaksi = $conn->real_escape_string($_POST['id_petugas_transaksi']);
        $harga_total = $conn->real_escape_string($_POST['harga_total']);
      
        $sql = "UPDATE pembayaran SET  id_petugas_transaksi = '$id_petugas_transaksi', harga_total = '$harga_total' WHERE id_pengumpulan_susu = '$id_pengumpulan_susu'";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
        </script>
        <?php
    }  
    
    
    if (isset($_POST['delete'])) {
        $id_pengumpulan_susu = $conn->real_escape_string($_POST['id_pengumpulan_susu']);
        $id_pengumpulan_susu = $conn->real_escape_string($_POST['delete']);
        $sql = "DELETE FROM pembayaran WHERE id_pengumpulan_susu = '$id_pengumpulan_susu'";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
        </script>
        <?php
    }
?>

<!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="page-breadcrumb">
                    <div class="row align-items-center">
                        <div class="align-self-center d-flex gap-3">
                            <h3 class="page-title mb-0 p-0">Data Pembayaran</h3>
                        </div>
                    </div>
                    <div class="mt-4 align-items-right">
                        <div class="text-end upgrade-btn">
                            <?php if(!isset($_GET['add'])): ?>
                                <a href="?add=true"
                                class="btn btn-success d-none d-md-inline-block text-white">Add Data Pembayaran <i class="fa-solid fa-plus"></i></a>
                            <?php endif?>
                        </div>
                    </div>

                    <!-- table  -->
                    <?php if(isset($_GET['add'])): ?>
                        <form class="mt-2" action="" method="post">
                            <div class="form-group">
                                <label for="id_pengumpulan_susu">id_pengumpulan_susu</label>
                                <input id="id_pengumpulan_susu" name="id_pengumpulan_susu" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="id_petugas_transaksi">id_petugas_transaksi</label>
                                <input id="id_petugas_transaksi" name="id_petugas_transaksi" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="harga_total">harga_total</label>
                                <input id="harga_total" name="harga_total" type="text" class="form-control">
                            </div>
                          
                            <button type="submit" class="btn btn-block btn-success" name="create">Tambah</button>
                        </form>
                        
                    <?php endif?>

                    <?php if(isset($_GET['edit'])): ?>
                        <form class="mt-2" action="" method="post">
                        <div class="form-group">
                                <label for="id_pengumpulan_susu">id_pengumpulan_susu</label>
                                <input id="id_pengumpulan_susu" name="id_pengumpulan_susu" type="text" class="form-control" value="<?= $_GET['edit']?>"disabled>
                            </div>
                            <div class="form-group">
                                <label for="id_petugas_transaksi">id_petugas_transaksi</label>
                                <input id="id_petugas_transaksi" name="id_petugas_transaksi" type="text" class="form-control" value="<?= $_GET['id_petugas_transaksi']?>">
                            </div>
                            <div class="form-group">
                                <label for="harga_total">harga_total</label>
                                <input id="harga_total" name="harga_total" type="text" class="form-control" value="<?= $_GET['harga_total']?>">
                            </div>

                            <button type="submit" class="btn btn-block btn-success" name="update" value="<?= $_GET['edit']?>">Ubah</button>
                        </form>
                    <?php endif?>

                    <?php if(!isset($_GET['add']) && !isset($_GET['edit'])): ?>
                        <div class="my-4">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id_pengumpulan_susu</th>
                                    <th>id_petugas_transaksi</th>
                                    <th>harga_total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $result = mysqli_query($conn, "SELECT * FROM pembayaran"); ?>
                                <?php while ($data = mysqli_fetch_array($result)): ?>
                                    <tr>
                                        <td><?= $data['id_pengumpulan_susu'] ?></td>
                                        <td><?= $data['id_petugas_transaksi'] ?></td>
                                        <td><?= $data['harga_total'] ?></td>
                                        <td class="d-flex gap-3">
                                            <a class="btn btn-outline-primary" href="?edit=<?= $data['id_pengumpulan_susu'] ?>&id_petugas_transaksi=<?= $data['id_petugas_transaksi']?>&harga_total=<?= $data['harga_total']?>">Ubah</a>

                                            <form action="" method="post">
                                                <button type="submit" class="btn btn-outline-danger" name="delete" value="<?= $data['id_pengumpulan_susu'] ?>">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif?>

                    </div>
                </div>        
            </div>
            <?php require_once('footer.php') ?>
        </div>
    <!-- ============================================================== -->
<!-- End Wrapper -->

<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
</script>


