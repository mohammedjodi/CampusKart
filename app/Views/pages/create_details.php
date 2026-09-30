<?= $this->extend('layouts/auth_page_layout')?>

<?= $this->section('title')?>
  Post Product Details
<?= $this->endSection('title')?>
<?= $this->section('content')?>
<!-- GET ERRORS FROM CONTROLLER  -->
 <?php
    $errors = session()->getFlashdata('errors') ?? [];
    $flashError = session()->getFlashdata('error');
?>

<div class="container  bottom-space d-flex flex-column  justify-content-center" style="max-width: 800px;">

  <!-- TOP BAR: Back | Post ad | Clear -->
  <div class="bg-white rounded d-flex justify-content-between align-items-center px-3 py-2 mb-3">
    <a href="<?= base_url('products/create')?>" class="text-success text-decoration-none"><i class="fa-solid fa-chevron-left"></i> Back</a>
    <div class="fw-bold">Post an Item</div>
    <a href="#" class="text-danger text-decoration-none">Clear</a>
  </div>

  <form action="<?= route_to('store')?>"  method="POST" enctype="multipart/form-data">
    <?= csrf_field()?>
    <!--PRODUCT DETAILS -->
    <div class="bg-white rounded p-3 mb-3 shadow-sm">
      <div class="row g-3">
        <div class="col-md-6">
          <!-- Brand -->
          <div class="select-wrapper">
            <select
                name="brand_id"
                class="form-select"
                id="brand"
                required
            >
                <option value="" disabled selected> Brand*</option>

                <?php foreach ($brands as $brand): ?>
                    <option
                        value="<?= esc($brand['id']) ?>"
                        <?= old('brand_id') == $brand['id'] ? 'selected' : '' ?>
                    >
                        <?= esc($brand['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <?php if (isset($errors['brand_id'])): ?>
                <small class="form-error">
                    <?= esc($errors['brand_id']) ?>
                </small>
            <?php endif; ?> 
          </div>
        </div>

        <!-- condition -->
        <div class="col-md-6">
            <div class="select-wrapper">
              <select
                name="condition_id"
                class="form-select"
                id="condition"
                required
              >
                <option value="" disabled selected>Condition*</option>

                <?php foreach ($conditions as $condition): ?>
                    <option
                        value="<?= esc($condition['id']) ?>"
                        <?= old('condition_id') == $condition['id'] ? 'selected' : '' ?>
                    >
                        <?= esc($condition['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <?php if (isset($errors['condition_id'])): ?>
                <small class="form-error">
                    <?= esc($errors['condition_id']) ?>
                </small>
            <?php endif; ?>
            </div>
        </div>
        <!-- Description -->

        <div class="col-12">
          <textarea class="form-control" rows="4"  name="description" id="description" placeholder="Describe your product......"  maxlength="500"><?= old('description')?></textarea>
          <div class="text-end text-muted small mt-1" id="descCount">0 /500</div>
          <?php if (isset($errors['description'])): ?>
              <small class="form-error">
                  <?= esc($errors['description']) ?>
              </small>
          <?php endif; ?>
        </div>
      </div>
    </div>
     <!-- ADD PHOTO -->
    <div class="bg-white rounded p-3 mb-3">
        <label class="fw-semibold mb-2">Add photo</label>
        <p class="small mb-2" style="color: #bbb;">
          First picture is the title picture.
        </p>
        <div class="photo-grid" id="photoGrid">
          <label class="add-photo-box" for="photoInput">
            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
          </label>
        </div>
        <input type="file" 
                id="photoInput" 
                name="images[]"
                multiple 
                accept='.jpg,.jpeg,.png'
                hidden
                >
        <p class="small text-muted mt-2">Supported formats are *.jpg and *.png</p>
    </div>
        <!--  PRICE -->
    <div class="bg-white rounded p-3 mb-3">
      <div class="d-flex justify-content-center">
        <div class="w-100" style="max-width:400px">
          <div class="input-group mb-2">
            <span class="input-group-text  text-green fw-bold">₦</span>
            <input type="number" class="form-control"  name="price" id="price" placeholder="Price*" value="<?= old('price') ?>">
          </div>

          <?php if (isset($errors['price'])): ?>
              <small class="form-error">
                  <?= esc($errors['price']) ?>
              </small>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- SECTION 3: CONTACT -->
    <div class="bg-white rounded p-3 mb-3">
      <div class="row g-3">
        <div class="col-md-6">
          <input type="tel" class="form-control" placeholder="<?= auth()->user()->phone?>" disabled>
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" placeholder="Name" value="<?= auth()->user()->first_name?> <?= auth()->user()->last_name?>" disabled>
        </div>
      </div>
    </div>

  
    <div class="justify-content-center">
        <!-- POST BUTTON -->
      <button type="submit" id="postBtn" class="btn btn-next" disabled>Post</button>
     
    </div>
    
  </div>

  </form>
</div>
<!-- SHOW TOASTR ERROR  -->
 <?php if ($flashError): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            toastr.error(<?= json_encode($flashError) ?>);
        });
    </script>
<?php endif; ?>
<!-- JS SCRIPT FOR THIS PAGE  -->
<script src="<?= base_url('js/details.js')?>"></script>

<?= $this->endSection('content')?>

