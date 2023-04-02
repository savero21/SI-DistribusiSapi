<?php 
    include_once 'config.php';
    require_once('sidebarnav.php');

    $tz = 'Asia/Jakarta';
    $dt = new DateTime("now", new DateTimeZone($tz));
    $timestamp = $dt->format('Y-m-d G:i:s');
?>

<!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="page-breadcrumb">
                    <div class="row align-items-center">
                        <div class="align-self-center">
                            <h3 class="page-title mb-0 p-0">Pencatatan Susu</h3>
                        </div>
                    </div>
                    <!-- table  -->
                    <div class="mt-4 align-items-right">
                        <div class="text-end upgrade-btn">
                            <?php if(!isset($_GET['add'])): ?>
                                <a href="?add=true"
                                class="btn btn-success d-none d-md-inline-block text-white">Add Data Baru <i class="fa-solid fa-plus"></i></a>
                            <?php endif?>
                        </div>
                    </div>

                    <!-- table  -->
                    <?php if(isset($_GET['add'])): ?>
                    <?php 
                        //fetch data session login
                        $id = $_SESSION['id_petugas'];
                        $dataPetugas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM Petugas WHERE id_petugas =" .$id));
                    ?>
                        <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="name">Tanggal & Waktu</label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder=" <?= $timestamp?>"disabled>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="name">Nama Petugas</label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder=" <?= $dataPetugas['nama']?>" disabled>
                            </div>
                        </div> <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="name">nama peternak</label>
                            <select id="peternak" name="nama_pemilik" class="form-control">
                                <?php 
                                    $data=mysqli_query($conn, "SELECT * FROM Peternak");
                                    while($dataPeternak = mysqli_fetch_array($data)) { 
                                    ?>
                                        <option value="<?= $dataPeternak['id_peternak']?>"><?= $dataPeternak['nama_pemilik'] ?></option>

                                    <?php 
                                    };
                                ?>
                            </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity">Kandungan Lemak</label>
                                <input type="text" class="form-control" id="inputCity" placeholder="Lemak">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity">Kandungan Protein</label>
                                <input type="text" class="form-control" id="inputCity" placeholder="Protein">
                            </div>
                        </div>  
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputCity">Total Liter</label>
                                <input type="number" class="form-control" id="inputCity" placeholder="Liter">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputCity">Harga per-Liter</label>
                                <input type="text" class="form-control" id="inputCity" placeholder="Liter">
                            </div>
                        </div>          
                                    
                        <div class="form-group"> 
                            <button type="submit" class="btn btn-success fa-plus "> Tambah Data</button>
                        </div>
                    </form>
                    <?php endif?>
                    
                    <?php if(!isset($_GET['add']) && !isset($_GET['edit'])): ?>                      
                    <div class="my-4">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Petugas</th>
                                    <th>Nama Peternak</th>
                                    <th>Lemak</th>
                                    <th>Jumlah</th>
                                    <th>Harga Susu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $result = mysqli_query($conn, "SELECT * FROM pengumpulan_susu ps JOIN peternak pe ON pe.id_peternak = ps.id_peternak JOIN petugas pet ON pet.id_petugas = ps.id_petugas_pencatatan; ");
                                    $number = 1;
                                    while($data = mysqli_fetch_array($result)) {         
                                        echo "<tr>";
                                        // echo "<td>".$data['id_pengumpulan_susu']."</td>";
                                        echo "<td>".$number++."</td>";
                                        echo "<td>".$data['nama']."</td>";
                                        echo "<td>".$data['nama_pemilik']."</td>";  
                                        echo "<td>".$data['kandungan_lemak']."</td>";    
                                        echo "<td>".$data['jumlah_liter']."</td>";    
                                        echo "<td>".$data['harga_susu']."</td>";    
                                        echo "<td><a href='edit.php?id=$data[id_pengumpulan_susu]' class='btn btn-warning'><i class='fa-solid fa-pen-to-square'></i> Edit</a>
                                        <a href='edit.php?id=$data[id_pengumpulan_susu]' class='btn btn-danger'><i class='fa-solid fa-xmark'></i> Delete</a></td></tr>";        
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif?>

                    </div>
                </div>        
            </div>

            <?php require_once('footer.php'); ?>

            <script>
                $(document).ready(function () {
                    $('#example').DataTable();
                    responsive: true;
                    });
            </script>

