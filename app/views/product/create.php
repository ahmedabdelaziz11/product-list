<?php ob_start(); ?>

<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-between py-3 mb-4 border-bottom">
        <h1 class="d-flex align-items-center col-md-3 mb-2 mb-md-0">
            Add Product
        </h1>
        <div class="col-md-3 text-end">
            <button type="button" form="product_form" class="btn btn-outline-primary me-2" id="save-button">Save</button>
            <a href="/" id="delete-product-btn" class="btn btn-primary">Cancel</a>
        </div>
    </header>

    <form id="product_form" method="post">
        <div class="mb-3">
            <label for="sku" class="form-label">SKU</label>
            <input type="text" id="sku" name="sku" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price ($)</label>
            <input type="number" step="0.01" id="price" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="productType" class="form-label">Type Switcher</label>
            <select id="productType" name="productType" class="form-select" required onchange="toggleAttributes()">
                <option value="" disabled selected>Select product type</option>
                <option value="DVD">DVD</option>
                <option value="Furniture">Furniture</option>
                <option value="Book">Book</option>
            </select>
        </div>

        <!-- DVD Attributes -->
        <div id="DVD" class="product-attributes" style="display: none;">
            <div class="mb-3">
                <label for="size" class="form-label">Size (MB)</label>
                <input type="number" id="size" name="size" class="form-control">
                <small class="form-text text-muted">Please,provide size in MB.</small>
            </div>
        </div>

        <!-- Furniture Attributes -->
        <div id="Furniture" class="product-attributes" style="display: none;">
            <div class="mb-3">
                <label for="height" class="form-label">Height (CM)</label>
                <input type="number" id="height" name="height" class="form-control">
            </div>
            <div class="mb-3">
                <label for="width" class="form-label">Width (CM)</label>
                <input type="number" id="width" name="width" class="form-control">
            </div>
            <div class="mb-3">
                <label for="length" class="form-label">Length (CM)</label>
                <input type="number" id="length" name="length" class="form-control">
            </div>
            <small class="form-text text-muted">Please,provide dimensions in HxWxL format.</small>
        </div>

        <!-- Book Attributes -->
        <div id="Book" class="product-attributes" style="display: none;">
            <div class="mb-3">
                <label for="weight" class="form-label">Weight (KG)</label>
                <input type="number" id="weight" name="weight" class="form-control">
                <small class="form-text text-muted">Please,provide weight in KG.</small>
            </div>
        </div>
    </form>
</div>

<script>
    function toggleAttributes() {
        document.querySelectorAll('.product-attributes').forEach(function (section) {
            section.style.display = 'none';
        });

        const selectedType = document.getElementById('productType').value;

        if (selectedType) {
            document.getElementById(selectedType).style.display = 'block';
        }
    }
    $('#save-button').on('click', function (e) {
        e.preventDefault();

        const formData = $('#product_form').serialize();
        $('.error-message').remove();
        $.ajax({
            url: '/products/store',
            method: 'POST',
            data: formData,
            success: function (response) {
                if (response.status === false && response.message) {
                    $('.error-message').remove();

                    $.each(response.message, function(field, message) {
                        const inputField = $(`#${field}`);
                        const errorMessage = `<small class="error-message text-danger">${message}</small>`;
                        inputField.after(errorMessage); 
                    });
                } else if(response.status === true) 
                {
                    window.location.href = '/';
                }
            },
            error: function () {
                console.log('error');
            }
        });
    });
</script>

<?php
$content = ob_get_clean();
require_once(APP . 'views/layout/master.php');
