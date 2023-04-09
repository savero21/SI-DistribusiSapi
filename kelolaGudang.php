<?php 
    require_once('sidebarnav.php');
    include_once 'config.php';
?>
<!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="page-breadcrumb">
                    <div class="row align-items-center">
                        <div class="align-self-center">
                            <h3 class="page-title mb-0 p-0">Kelola Gudang</h3>
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
                                    <th>id_Transaksi</th>
                                    <th>Jumlah </th>
                                    <th>Kandungan Lemak</th>
                                    <th>Kandungan Protein</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $result = mysqli_query($conn, "SELECT gd.id_gudang,gd.jumlah,gd.kandungan_lemak,gd.kandungan_protein FROM gudang gd;");
                                    $number = 1;
                                    while($data = mysqli_fetch_array($result)) {         
                                        echo "<tr>";
                                        // echo "<td>".$data['id_gudang']."</td>";
                                        echo "<td>".$number++."</td>";
                                        echo "<td>".$data['jumlah']."</td>";
                                        echo "<td>".$data['kandungan_lemak']."</td>";    
                                        echo "<td>".$data['kandungan_protein']."</td>";        
                                        echo "<td><a href='edit.php?id=$data[id_gudang]' class='btn btn-warning'><i class='fa-solid fa-pen-to-square'></i> Edit</a>
                                        <a href='edit.php?id=$data[id_gudang]' class='btn btn-danger'><i class='fa-solid fa-xmark'></i> Delete</a></td></tr>";        
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    </div>
                </div>        
            </div>

         <?php require_once('sidebarnav.php') ?>   
<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
</script>