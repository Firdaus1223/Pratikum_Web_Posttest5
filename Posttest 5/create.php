<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $nama_makanan = isset($_POST['nama_makanan']) ? $_POST['nama_makanan'] : '';
    $jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $notelp = isset($_POST['notelp']) ? $_POST['notelp'] : '';

    $stmt = $pdo->prepare('INSERT INTO pemesanan VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nama, $nama_makanan, $jumlah, $alamat, $email, $notelp,]);
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create Order</h2>
    <form action="" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" value="auto" id="id">
        <label for="nama">Nama</label>        
        <input type="text" name="nama" id="nama">
        <label  for="nama_makanan">Nama Makanan</label>
        <select class = "option" type="text" name="nama_makanan" id="nama_makanan">
        <option value="pilih">-Pilih Makanan-</option>
        <option value="nasi-kuning">Nasi Kuning</option>
        <option value="nasi-bekepor">Nasi Bakepor</option>
        <option value="sate-payau">Sate Payau</option>
        <option value="sate-ayam">Sate Ayam</option>
        <option value="sate-kambing">Sate Kambing</option>
        <option value="bakso-gresik">Bakso Gresik</option>
        </select>
<br>
        <label for="jumlah">Jumlah</label>        
        <input type="text" name="jumlah" id="jumlah">
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat">
        <label for="notelp">No. Telp</label>
        <input type="text" name="notelp" id="notelp">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <script>window.location="read.php", sleep(10);</script>
    
    <?php endif; ?>
</div>

<?=template_footer()?>