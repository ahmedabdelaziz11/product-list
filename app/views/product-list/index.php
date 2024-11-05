<?php ob_start(); ?>

<h1>Hello world !</h1>
<?php 
$content = ob_get_clean(); 
require_once(APP . 'views/layout/master.php'); 
?>
