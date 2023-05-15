<?php 
    include 'sidebarnav.php';
    include_once 'config.php';

    $tz = 'Asia/Jakarta';
    $dt = new DateTime("now", new DateTimeZone($tz));
    $timestamp = $dt->format('Y-m-d');
    //insert session
    $id = $_SESSION['id_petugas'];
    ob_start();

    $redirect_path = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] ;
    if(isset($_POST['create'])) {
        // $id_pengumpulan_susu = $conn->real_escape_string($_POST['id_pengumpulan_susu']);
        $id_petugas_transaksi = $id;
        $id_peternak = $conn->real_escape_string($_POST['id_peternak']);
        $periode = $conn->real_escape_string($_POST['periode']);
        $date_pay = $timestamp;

        //logic total bayar
        $date_start = $conn->real_escape_string($_POST['date_start']);
        $date_end = $conn->real_escape_string($_POST['date_end']);
        $sql_sum = "SELECT SUM(harga_total) as jumlah_bayar FROM pengumpulan_susu
        WHERE id_peternak = '$id_peternak' AND tanggal_pengumpulan between '$date_start' and '$date_end' ";
        $harga_total = mysqli_fetch_array(mysqli_query($conn, $sql_sum))['jumlah_bayar'];
        
        $sql = "INSERT INTO pembayaran (id_pembayaran, id_petugas_transaksi, id_peternak, periode,tanggal_pembayaran, harga_total) VALUES (NULL, '$id_petugas_transaksi','$id_peternak','$periode', '$date_pay', '$harga_total')";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
        </script>
        <?php
    }  
   
    // belum kepikiran atau tidak soalnya berhubungan dengan uang
     if (isset($_POST['update'])) {
        $id_pembayaran = $conn->real_escape_string($_POST['update']);
        $id_petugas_transaksi = $id;
        $id_peternak = $conn->real_escape_string($_POST['id_peternak']);
        $periode = $conn->real_escape_string($_POST['periode']);
        $date_pay = $conn->real_escape_string($_POST['date_pay']);
      
        $sql = "UPDATE pembayaran SET id_petugas_transaksi = '$id_petugas_transaksi', id_peternak = '$id_peternak', tanggal_pembayaran = '$date_pay', periode = '$periode' WHERE id_pembayaran = '$id_pembayaran'";
        echo $sql;
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
        </script>
        <?php
     }  
    
    
    if (isset($_POST['delete'])) {
        $id_pembayaran = $conn->real_escape_string($_POST['id_pembayaran']);
        $id_pembayaran = $conn->real_escape_string($_POST['delete']);
        $sql = "DELETE FROM pembayaran WHERE id_pembayaran = '$id_pembayaran'";
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
                            <?php if(!isset($_GET['add']) && !isset($_GET['edit'])): ?>
                                <a href="?add=true"
                                class="btn btn-success d-none d-md-inline-block text-white">Add Data Pembayaran <i class="fa-solid fa-plus"></i></a>
                            <?php endif?>
                        </div>
                    </div>

                    <!-- table  -->
                    <?php if(isset($_GET['add'])): ?>
                        <?php 
                            //get session
                             $dataPetugas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM Petugas WHERE id_petugas =" .$id));
                            ?>
                        <form class="mt-2" action="" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nama Petugas</label>
                                    <input type="text" class="form-control" id="id_petugas" placeholder=" <?= $dataPetugas['nama']?>" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="name">nama peternak</label>
                                <select id="id_peternak" name="id_peternak" class="form-control">
                                    <?php 
                                        $data=mysqli_query($conn, "SELECT * FROM Peternak");
                                        while($dataPeternak = mysqli_fetch_array($data)) { 
                                        ?>
                                            <option value="<?= $dataPeternak['id_peternak']?>"> <?= $dataPeternak['nama_pemilik'] ?></option>
    
                                        <?php 
                                        };
                                    ?>
                                </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="name">Tanggal & Waktu</label>
                                    <input type="text" class="form-control" id="date_pay" name="date_pay" placeholder=" <?= $timestamp?>"disabled>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="periode">periode</label>
                                    <select id="periode" name="periode" type="number" class="form-control">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="date_start">tanggal awal</label>
                                    <input id="date_start" name="date_start" type="date" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="date_end">tanggal akhir</label>
                                    <input id="date_end" name="date_end" type="date" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="sum_total">Total yang harus dibayarkan</label>
                                    <input id="sum_total" name="sum_total" type="text" class="form-control" placeholder="Hasil pembayaran akan keluar setelah di submit" disabled>
                                </div>
                            </div>
                          
                            <button type="submit" class="btn btn-block btn-success" name="create">Tambah</button>
                        </form>
                        
                    <?php endif?>

                    <?php if(isset($_GET['edit'])): ?>
                        <form class="mt-2" action="" method="post">
                            <div class="form-row">
                                <!-- <div class="form-group">
                                    <label for="id_petugas">Id Pembyaran</label>
                                    <input id="id_pembayaran" name="id_pembayaran" type="text" class="form-control" value="<?= $_GET['edit']?>" disabled>
                                </div> -->
                                <div class="form-group col-md-6">
                                    <label for="name">Nama Petugas</label>
                                    <input id="id_pembayaran" name="id_petugas" type="text" class="form-control" value="<?= $_GET['id_petugas_transaksi']?>" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">nama peternak</label> 
                                    <select id="id_peternak" name="id_peternak" class="form-control" aria-readonly="">
                                    <?php 
                                        $data=mysqli_query($conn, "SELECT * FROM Peternak");
                                        while($dataPeternak = mysqli_fetch_array($data)) { 
                                        ?>
                                            <option value="<?= $dataPeternak['id_peternak']?> <?php if('id_peternak'==$_GET['id_peternak']) echo 'selected="selected"'; ?>"> <?= $dataPeternak['nama_pemilik'] ?></option>
    
                                        <?php 
                                        };
                                    ?>
                                </select>
                                </div>
    
                                <div class="form-group col-md-3">
                                    <label for="name">Tanggal & Waktu</label>
                                    <input type="text" class="form-control" id="date_pay" name="date_pay" value=" <?= $_GET['tanggal_pembayaran']?>">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="periode">periode</label>
                                    <select id="periode" name="periode" type="number" class="form-control" disable>
                                        <option value="1" <?php if($_GET['periode']=="1") echo 'selected="selected"'; ?>>1</option>
                                        <option value="2" <?php if($_GET['periode']=="2") echo 'selected="selected"'; ?>>2</option>
                                        <option value="3" <?php if($_GET['periode']=="3") echo 'selected="selected"'; ?>>3</option>
                                    </select>
                                </div>
                                <!-- <div class="form-group col-md-4">
                                    <label for="date_start">tanggal awal</label>
                                    <input id="date_start" name="date_start" type="date" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="date_end">tanggal akhir</label>
                                    <input id="date_end" name="date_end" type="date" class="form-control">
                                </div> -->
                                <div class="form-group col-md-4">
                                    <label for="sum_total">Total yang harus dibayarkan</label>
                                    <input id="sum_total" name="sum_total" type="text" class="form-control" value="<?= $_GET['harga_total']?>" disabled>
                                </div>
                            </div>
                          
                            <button type="submit" class="btn btn-block btn-success" name="update" value="<?= $_GET['edit']?>">Edit</button>
                        </form> 
                    <?php endif?>

                    <?php if(!isset($_GET['add']) && !isset($_GET['edit'])): ?>
                        <div class="my-4">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama petugas</th>
                                    <th>Nama peternak</th>
                                    <th>tanggal pembayaran</th>
                                    <th>Periode pembayaran</th>
                                    <th>Total yang dibayarkan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $result = mysqli_query($conn, "SELECT * FROM pembayaran JOIN petugas ON pembayaran.id_petugas_transaksi = petugas.id_petugas JOIN peternak ON pembayaran.id_peternak = peternak.id_peternak"); 
                                    $nomor = 1;
                                ?>
                                <?php while ($data = mysqli_fetch_array($result)): ?>
                                    <tr>
                                        <td><?= $nomor++ ?></td>
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= $data['nama_pemilik'] ?></td>
                                        <td><?= $data['tanggal_pembayaran'] ?></td>
                                        <td><?= $data['periode'] ?></td>
                                        <td><?= $data['harga_total'] ?></td>
                                        <td class="d-flex gap-3">
                                            <a class="btn bg-warning text-white" href="?edit=<?= $data['id_pembayaran'] ?>&id_petugas_transaksi=<?= $data['id_petugas_transaksi']?>&id_peternak=<?= $data['id_peternak']?>&tanggal_pembayaran=<?= $data['tanggal_pembayaran']?>&periode=<?= $data['periode']?>&harga_total=<?= $data['harga_total']?>">Ubah</a>

                                            <form action="" method="post">
                                                <button type="submit" class="btn bg-danger text-white" name="delete" value="<?= $data['id_pembayaran'] ?>">Hapus</button>
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


