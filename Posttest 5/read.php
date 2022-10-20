<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;

$stmt = $pdo->prepare('SELECT * FROM pemesanan ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_orders = $pdo->query('SELECT COUNT(*) FROM pemesanan')->fetchColumn();
?>


<?=template_header('Read')?>

<div class="content read">
	<h2>Read Orders</h2>
	<a href="create.php" class="create-order">Create Order</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nama</td>
                <td>Nama Makanan</td>
                <td>Jumlah</td>
                <td>Alamat</td>
                <td>Email</td>
                <td>No. Telp</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?=$order['id']?></td>
                <td><?=$order['nama']?></td>
                <td><?=$order['nama_makanan']?></td>
                <td><?=$order['jumlah']?></td>
                <td><?=$order['alamat']?></td>
                <td><?=$order['email']?></td>
                <td><?=$order['notelp']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$order['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$order['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_orders): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>