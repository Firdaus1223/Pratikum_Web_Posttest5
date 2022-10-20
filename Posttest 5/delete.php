<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM pemesanan WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$order) {
        exit('order doesn\'t exist with that ID!');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM pemesanan WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the order!';
        } else {
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete Order #<?=$order['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <script>window.location="read.php";</script>
    <?php else: ?>
	<p>Are you sure you want to delete Order #<?=$order['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$order['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$order['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>