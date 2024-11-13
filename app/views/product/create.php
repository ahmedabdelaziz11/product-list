<?php ob_start(); ?>
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-between py-3 mb-4 border-bottom">
        <h1 class="d-flex align-items-center col-md-3 mb-2 mb-md-0">
            Add Product
        </h1>
        <div class="col-md-3 text-end">
            <button type="button" form="product_form" class="btn btn-outline-primary me-2" id="save-button">Save</button>
            <a href="<?=BASE_URL?>" id="delete-product-btn" class="btn btn-primary">Cancel</a>
        </div>
    </header>

    <form id="product_form" method="post">
        <div class="row mb-3 align-items-center">
            <label for="sku" class="col-sm-2 col-form-label">SKU</label>
            <div class="col-sm-4">
                <input type="text" id="sku" name="sku" class="form-control" placeholder="#SKU" required>
            </div>
        </div>

        <div class="row mb-3 align-items-center">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-4">
                <input type="text" id="name" name="name" class="form-control" placeholder="#Name" required>
            </div>
        </div>

        <div class="row mb-3 align-items-center">
            <label for="price" class="col-sm-2 col-form-label">Price ($)</label>
            <div class="col-sm-4">
                <input type="number" step="0.01" id="price" name="price" class="form-control" placeholder="#Price" required>
            </div>
        </div>

        <div class="row mb-3 align-items-center">
            <label for="productType" class="col-sm-2 col-form-label">Type Switcher</label>
            <div class="col-sm-4">
                <select id="productType" name="productType" class="form-select" required onchange="toggleAttributes()">
                    <option value="" disabled selected>Type Switcher</option>
                    <option value="DVD">DVD</option>
                    <option value="Furniture">Furniture</option>
                    <option value="Book">Book</option>
                </select>
            </div>
        </div>

        <!-- DVD Attributes -->
        <div id="DVD" class="product-attributes" style="display: none;">
            <div class="row mb-3 align-items-center">
                <label for="size" class="col-sm-2 col-form-label">Size (MB)</label>
                <div class="col-sm-4">
                    <input type="number" id="size" name="size" class="form-control">
                    <small class="form-text text-muted">Please, provide size in MB.</small>
                </div>
            </div>
        </div>

        <!-- Furniture Attributes -->
        <div id="Furniture" class="product-attributes" style="display: none;">
            <div class="row mb-3 align-items-center">
                <label for="height" class="col-sm-2 col-form-label">Height (CM)</label>
                <div class="col-sm-4">
                    <input type="number" id="height" name="height" class="form-control">
                </div>
            </div>
            <div class="row mb-3 align-items-center">
                <label for="width" class="col-sm-2 col-form-label">Width (CM)</label>
                <div class="col-sm-4">
                    <input type="number" id="width" name="width" class="form-control">
                </div>
            </div>
            <div class="row mb-3 align-items-center">
                <label for="length" class="col-sm-2 col-form-label">Length (CM)</label>
                <div class="col-sm-4">
                    <input type="number" id="length" name="length" class="form-control">
                </div>
            </div>
            <small class="form-text text-muted">Please, provide dimensions in HxWxL format.</small>
        </div>

        <!-- Book Attributes -->
        <div id="Book" class="product-attributes" style="display: none;">
            <div class="row mb-3 align-items-center">
                <label for="weight" class="col-sm-2 col-form-label">Weight (KG)</label>
                <div class="col-sm-4">
                    <input type="number" id="weight" name="weight" class="form-control">
                    <small class="form-text text-muted">Please, provide weight in KG.</small>
                </div>
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
            url: `<?= BASE_URL ?>products/store`,
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
