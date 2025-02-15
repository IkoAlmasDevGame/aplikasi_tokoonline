<?php if ($_SESSION['akses'] == ""): ?>
<?php
   header("location:../../index.php");
   exit(0);
?>
<?php endif; ?>

<?php if ($_SESSION['akses'] == "pelanggan"): ?>
<?php else: ?>
<?php
   header("location:../../index.php");
   exit(0);
?>
<?php endif; ?>