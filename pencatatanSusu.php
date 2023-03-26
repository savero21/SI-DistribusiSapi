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
                                    <th>No</th>
                                    <th>Nama Petugas</th>
                                    <th>Nama Peternak</th>
                                    <th>Nama Peternakan</th>
                                    <th>Kandungan Lemak</th>
                                    <th>Jumlah</th>
                                    <th>Harga Susu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $result = mysqli_query($conn, "SELECT ps.id_pengumpulan_susu,pet.nama,pe.nama_pemilik,pe.nama_peternakan,ps.kandungan_lemak, ps.jumlah,ps.harga_susu FROM pengumpulan_susu ps JOIN peternak pe ON pe.id_peternak = ps.id_peternak JOIN petugas pet ON pet.id_petugas = ps.id_petugas_pencatatan; ");
                                    $number = 1;
                                    while($data = mysqli_fetch_array($result)) {         
                                        echo "<tr>";
                                        // echo "<td>".$data['id_pengumpulan_susu']."</td>";
                                        echo "<td>".$number++."</td>";
                                        echo "<td>".$data['nama']."</td>";
                                        echo "<td>".$data['nama_pemilik']."</td>";    
                                        echo "<td>".$data['nama_peternakan']."</td>";    
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