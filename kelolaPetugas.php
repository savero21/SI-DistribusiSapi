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
                            <h3 class="page-title mb-0 p-0">Kelola Petugas</h3>
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
                                    <th>Nama </th>
                                    <th>No Hp</th>
                                    <th>Alamat</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $result = mysqli_query($conn, "SELECT pt.id_petugas ,pt.nama,pt.no_hp,pt.alamat,pt.username, rl.nama_roles FROM petugas pt JOIN roles rl ON pt.id_role = rl.id_role;");
                                    $number = 1;
                                    while($data = mysqli_fetch_array($result)) {         
                                        echo "<tr>";
                                        // echo "<td>".$data['id_gudang']."</td>";
                                        echo "<td>".$number++."</td>";
                                        echo "<td>".$data['nama']."</td>";
                                        echo "<td>".$data['no_hp']."</td>";    
                                        echo "<td>".$data['alamat']."</td>";
                                        echo "<td>".$data['username']."</td>";
                                        echo "<td>".$data['nama_roles']."</td>";        
                                        echo "<td><a href='edit.php?id=$data[id_petugas]' class='btn btn-warning'><i class='fa-solid fa-pen-to-square'></i> Edit</a>
                                        <a href='edit.php?id=$data[id_petugas]' class='btn btn-danger'><i class='fa-solid fa-xmark'></i> Delete</a></td></tr>";        
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

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