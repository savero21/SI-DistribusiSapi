<?php 
    include 'sidebarnav.php';
    include_once 'config.php';
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

                    <!-- table  -->
                    <div class="mt-4 align-items-right">
                        <div class="text-end upgrade-btn">
                            <a href="tambahPencatatan.php"
                                class="btn btn-success d-none d-md-inline-block text-white">Add Data Baru <i class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="my-4">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id pengumpulan susu</th>
                                    <th>id peternak</th>
                                    <th>id petugas pencatatan</th>
                                    <th>kandungan lemak</th>
                                    <th>jumlah</th>
                                    <th>harga susu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $result = mysqli_query($conn, "SELECT * FROM pengumpulan_susu   ");
                                    
                                    while($data = mysqli_fetch_array($result)) {         
                                        echo "<tr>";
                                        echo "<td>".$data['id_pengumpulan_susu']."</td>";
                                        echo "<td>".$data['id_peternak']."</td>";
                                        echo "<td>".$data['id_petugas_pencatatan']."</td>";    
                                        echo "<td>".$data['kandungan_lemak']."</td>";    
                                        echo "<td>".$data['jumlah']."</td>";    
                                        echo "<td>".$data['harga_susu']."</td>";    
                                        echo "<td><a href='edit.php?id=$data[id_pengumpulan_susu]' class='btn btn-warning'><i class='fa-solid fa-pen-to-square'></i> Edit</a>
                                        <a href='edit.php?id=$data[id_pengumpulan_susu]' class='btn btn-danger'><i class='fa-solid fa-xmark'></i> Delete</a></td></tr>";        
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    </div>
                </div>        
            </div>

        
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                © <?= date('Y') ?> by Workshop
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
    <!-- ============================================================== -->
<!-- End Wrapper -->

<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
</script>