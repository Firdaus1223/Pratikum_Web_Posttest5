<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $nama_makanan = isset($_POST['nama_makanan']) ? $_POST['nama_makanan'] : '';
        $jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : '';
        $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $notelp = isset($_POST['notelp']) ? $_POST['notelp'] : '';
        
        $stmt = $pdo->prepare('UPDATE pemesanan SET id = ?, nama = ?, nama_makanan = ?, jumlah = ?, email = ?, notelp = ? WHERE id = ?');
        $stmt->execute([$id, $nama, $nama_makanan, $jumlah, $email, $notelp, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    $stmt = $pdo->prepare('SELECT * FROM pemesanan WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$order) {
        exit('order doesnt exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Order #<?=$order['id']?></h2>
    <form action="update.php?id=<?=$order['id']?>" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" value="<?=$order['id']?>" id="id">
        <label for="nama">Nama</label>        
        <input type="text" name="nama" value="<?=$order['nama']?>" id="nama">
        <label for="nama_makanan">Nama Makanan</label>
        <input type="text" name="nama_makanan" value="<?=$order['nama_makanan']?>" id="nama_makanan">
        <label for="jumlah">Jumlah</label>        
        <input type="text" name="jumlah" value="<?=$order['jumlah']?>" id="jumlah">
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" value="<?=$order['alamat']?>" id="alamat">
        <label for="notelp">No. Telp</label>        
        <input type="text" name="notelp" value="<?=$order['notelp']?>" id="notelp">
        <label for="email">Email</label>
        <input type="text" name="email" value="<?=$order['email']?>" id="email">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <script>window.location="read.php";</script>
    <?php endif; ?>
</div>

<?=template_footer()?>