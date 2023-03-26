<?php 
    include 'sidebarnav.php';
    include_once 'config.php';

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
                        <div class="align-items-center">
                            <h3 class="page-title">Tambah data pencatatan</h3>
                        </div>
                    </div>

                    <div class="row align-items-center">
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
                        </div>

                        <div class="form-row">
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
                                    
                    </form>
                    <div class="form-group"> 
                        <button type="submit" class="btn btn-success fa-plus "> Tambah Data</button>
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
<!-- End Wrapper -->
<script type="text/javascript">
 $(document).ready(function() {
     $('#peternak').select2({
        theme: "bootstrap4"  
     });
 });
</script>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>