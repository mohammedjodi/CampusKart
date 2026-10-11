<?= $this->extend('layouts/auth_page_layout')?>

<?= $this->section('title')?>
  Post Product Details
<?= $this->endSection('title')?>
<?= $this->section('content')?>
<?php
//Get the product data if we are in edit mode
  $isEdit = $isEdit ?? false;
  $product = $product?? [];
  $formAction = site_url('products/'.$product['id'].'/edit/details');
  $brandVal = old('brand_id', $product['brand_id']?? '');
  $condVal = old('condition_id', $product['condition_id']?? '');
  $descVal = old('description', $product['description']?? '');
  $priceVal = old('price', $product['price']?? '');
?>
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

  <form action="<?= $formAction ?>"  method="POST" enctype="multipart/form-data">
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
                        <?= $brandVal == $brand['id'] ? 'selected' : '' ?>
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
                        <?= $condVal == $condition['id'] ? 'selected' : '' ?>
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
          <textarea class="form-control" rows="4"  name="description" id="description" placeholder="Describe your product......"  maxlength="500"><?= $descVal ?></textarea>
          <div class="text-end text-muted small mt-1" id="descCount">0 /500</div>
          <?php if (isset($errors['description'])): ?>
              <small class="form-error">
                  <?= esc($errors['description']) ?>
              </small>
          <?php endif; ?>
        </div>
      </div>
    </div>
   <div class="bg-white rounded p-3 mb-3">
    <label class="fw-semibold mb-2">Add photo</label>
    <p class="small mb-2" style="color: #bbb;">
      First picture is the title picture.
    </p>
    
    <div class="photo-grid" id="photoGrid">
      
      <!--  SHOW EXISTING IMAGES ONLY WHEN EDITING -->
      <?php if(($isEdit ?? false) && !empty($images)): ?>
        <?php foreach($images as $img): ?>
          <div class="photo-item existing-photo">
            <img src="<?= base_url($img['image_path']) ?>">
            <!-- delete single image button -->
            <a href="<?= site_url('products/image/'.$img['id'].'/delete') ?>" class="photo-remove" onclick="return confirm('Delete this image?')">×</a>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

      <!-- 2. THIS PLUS BOX IS ALWAYS THERE - For create and edit -->
      <label class="add-photo-box" for="photoInput" id="addPhotoBox">
        <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
      </label>
    </div>

    <input type="file" 
            id="photoInput" 
            name="images[]"
            multiple 
            accept='.jpg,.jpeg,.png,.webp'
            hidden
            >
    <p class="small text-muted mt-2">Supported formats are *.jpg and *.png</p>

    <?php if(($isEdit ?? false)): ?>
      <small class="text-muted">Uploading new photos will delete all old photos from folder.</small>
    <?php endif; ?>
</div>
        <!--  PRICE -->
    <div class="bg-white rounded p-3 mb-3">
      <div class="d-flex justify-content-center">
        <div class="w-100" style="max-width:400px">
          <div class="input-group mb-2">
            <span class="input-group-text  text-green fw-bold">₦</span>
            <input type="number" class="form-control"  name="price" id="price" placeholder="Price*" value="<?= $priceVal ?>">
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
<!-- Show Toastr Messages -->
<?php if($message = session()->getFlashdata('error')) : ?>
  <script>
    document.addEventListener('DOMContentLoaded' , function(){
      toastr.error(<?= json_encode($message)?>);
    })
  </script>
<?php elseif($message = session()->getFlashdata('success')) : ?>
    <script>
    document.addEventListener('DOMContentLoaded' , function(){
      toastr.success(<?= json_encode($message)?>);
    })
  </script>
<?php endif?>

<!-- EXTRA STYLES FOR PHOTO GRID -->
 <style>
.photo-grid {
    display: flex;
  gap: 10px;
  flex-wrap: wrap;
}
.photo-item {
  width: 90px;
  height: 90px;
  object-fit: cover;
  border: 1px solid #ddd;
  position: relative;
}
.photo-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 8px;

}
.photo-item .photo-remove {
  position: absolute;
  top: -3px;
  right: -6px;
  background: #EF4444;
  color: var(--color-white);
  border-radius: 50%;
  width: 18px;
  height: 18px;
  font-size: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
.add-photo-box {
  width: 90px;
  height: 90px;
  border-radius: 8px;
  background: #F0FDF4;
  border: 1px dashed #00B53A;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #00B53A;
  font-size: 24px;
  cursor: pointer;
  position: relative;
}
.add-photo-box:hover {
  border-color: #16A34A;
  color: #16A34A;
  background: #f0fdf4;
}
</style>
<!-- JS SCRIPT FOR THIS PAGE  -->
<script src="<?= base_url('js/edit_details.js')?>"></script>

<?= $this->endSection('content')?>

