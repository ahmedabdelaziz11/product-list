<?php ob_start(); ?>

<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <h1  class="d-flex align-items-center col-md-3 mb-2 mb-md-0">
            Add Product
        </h1>

        <div class="col-md-3 text-end">
            <button type="button" class="btn btn-outline-primary me-2">Save</button>
            <a href="/" id="delete-product-btn" class="btn btn-primary">Cancel</a>
        </div>
    </header>

    <div class="row g-4">
        <!-- Products will be dynamically loaded here -->
    </div>
</div>


<script>

</script>


<?php
$content = ob_get_clean();
require_once(APP . 'views/layout/master.php');
?>