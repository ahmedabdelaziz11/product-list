<?php ob_start(); ?>

<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <h1  class="d-flex align-items-center col-md-3 mb-2 mb-md-0">
            Product List
        </h1>

        <div class="col-md-3 text-end">
            <a href="<?= BASE_URL . 'add-product' ?>" class="btn btn-outline-primary me-2">ADD</a>
            <button type="button" id="delete-product-btn" class="btn btn-primary">MASS DELETE</button>
        </div>
    </header>

    <div class="row g-4 products">
        <!-- Products will be dynamically loaded here -->
    </div>
</div>

<script>
$(document).ready(() => {
    function getProducts() {
        $(".products").html("");
        fetch("products")
            .then((response) => response.json())
            .then((data) => {
                data.forEach((product) => {
                    $(".products").append(`
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <div class="form-check-inline p-3">
                                <label class="form-check-label">
                                    <input type="checkbox" class="delete-checkbox" name="products[]" value="${product.sku}">
                                </label>
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title">${product.sku}</h5>
                                <p class="card-text">${product.name}</p>
                                <p class="card-text">${product.price} $</p>
                                <p class="card-text">${product.attribute}</p>
                            </div>
                        </div>
                    </div>
                `);
                });
            })
            .catch((error) => console.error("Error loading products:", error));
    }

    getProducts();

    $("#delete-product-btn").on("click", function () {
        const selectedProducts = $(".delete-checkbox:checked")
            .map(function () {
                return $(this).val();
            })
            .get();

        if (selectedProducts.length > 0) {
            $.ajax({
                url: `<?= BASE_URL ?>products/delete`,
                method: "POST",
                data: {
                    products: selectedProducts,
                },
                success: function (response) {
                    getProducts();
                },
                error: function () {
                    console.error("Error deleting products.");
                },
            });
        }
    });
});
</script>

<?php
$content = ob_get_clean();
require_once(APP . 'views/layout/master.php');
?>