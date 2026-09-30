
<?= $this->extend('layouts/auth_page_layout')?>


<?= $this->section('title')?>
  Post Product
<?= $this->endSection('title')?>

<?= $this->section('content')?>
    <!-- Post Ad Form -->
<div class=" post-container">
  <div class="alert-error">
      <?php $error = session('error') ?? []?>

      
  </div>
  <div class="top-bar d-flex justify-content-between align-items-center">
    <div class="fw-semibold ">Post an Item </div>
    <a href="#" id="clearBtn" class="text-decoration-none" style="color: #F87171;">Clear</a>
  </div>

  <div class="post-card">
    <form id="postForm" action="<?= route_to('StoreBasicInfo')?>"  method="POST">
      <?= csrf_field() ?>
      <!-- TITLE -->
      <div class="mb-3 position-relative">
        <input type="text"  
               name="title" 
               value="<?= old('title')?>"
               id="title" 
               class="form-control" 
               placeholder="Title*" 
               maxlength="70" 
               required>
        <div class="position-absolute top-0 end-0 small text-muted pe-2 pt-1"><span id="charCount">0</span> / 70</div>
        <!-- Get The Session Errors -->
        <?php $errors = session('errors') ?? []?>
        <?php if(isset($errors['title'])) :?>
          <small class="form-error">
            <?= esc($errors['title'])?>
          </small>
        <?php endif?>
      </div>

      <!-- CATEGORY -->
      <div class="mb-3 select-wrapper ">
          <select id="category" class="form-select "  name="category_id" required>
            <option value="" disabled selected>Category*</option>
            <?php foreach($categories as $category) : ?>
              <option value="<?= esc($category['id'])?>"
                      <?= old('category_id') == $category['id'] ? 'selected' : '' ?>
              >
                <?= esc($category['name'])?>
              </option>
            <?php endforeach ?>   
          </select>
          <?php if(isset($errors['title'])) :?>
          <small class="form-error">
            <?= esc($errors['category_id'])?>
          </small>
        <?php endif?>
      </div>

     <div class="almost-there-card">
        <div class="almost-there-icon">
          <i class="fa fa-check"></i>
        </div>
        <div class="almost-there-content">
          <h6>Almost there!</h6>
          <p>
            Your basic product information is ready.
            Click <strong>Next</strong> to add photos and complete your listing.
          </p>
        </div>

     </div>

      <!-- NEXT BUTTON -->
      <button type="submit" id="nextBtn" class="btn btn-next">Next</button>
    </form>
  </div>
</div>

<!-- Show Redirect Error From Details -->
<?php if($message = session()->getFlashdata('error')) : ?>
  <script>
    document.addEventListener('DOMContentLoaded' , function(){
      toastr.error(<?= json_encode($message)?>);
    })
  </script>
<?php endif?>
<!-- JS SCRIPT FOR THIS PAGE  -->
<script src="<?= base_url('js/main.js')?>"></script>

<?= $this->endSection('content')?>