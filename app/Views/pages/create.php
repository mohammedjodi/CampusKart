
<?= $this->extend('layouts/auth_page_layout')?>


<?= $this->section('title')?>
  Post Product
<?= $this->endSection('title')?>

<?= $this->section('content')?>
    <!-- Post Ad Form -->
<div class=" post-container">

  <div class="top-bar d-flex justify-content-between align-items-center">
    <div class="fw-semibold ">Post an Item </div>
    <a href="#" id="clearBtn" class="text-decoration-none" style="color: #F87171;">Clear</a>
  </div>

  <div class="post-card">
    <form id="postForm">
      <!-- TITLE -->
      <div class="mb-3 position-relative">
        <input type="text" id="title" class="form-control" placeholder="Title*" maxlength="70" required>
        <div class="position-absolute top-0 end-0 small text-muted pe-2 pt-1"><span id="charCount">0</span> / 70</div>
      </div>

      <!-- CATEGORY -->
      <div class="mb-3 select-wrapper">
        <select id="category" class="form-select" required>
          <option value="" disabled selected>Category*</option>
          <option>Mobile Phones</option>
          <option>Vehicles</option>
          <option>Electronics</option>
          <option>Fashion</option>
        </select>
      </div>

      <!-- LOCATION -->
      <div class="mb-3 select-wrapper">
        <select id="location" class="form-select" disabled required>
          <option value="" disabled selected>Select Location*</option>
          <option>Lagos</option>
          <option>Abuja</option>
          <option>Port Harcourt</option>
        </select>
      </div>

      <!-- ADD PHOTO -->
      <div class="mb-3">
        <label class="fw-semibold mb-2">Add photo</label>
        <p class="small mb-2" style="color: #bbb;">
          First picture is the title picture.
        </p>
        <div class="photo-grid" id="photoGrid">
          <label class="add-photo-box" for="photoInput">
            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
          </label>
        </div>
        <input type="file" id="photoInput" accept=".jpg,.jpeg,.png" multiple hidden>
        <p class="small text-muted mt-2">Supported formats are *.jpg and *.png</p>
      </div>

      <!-- NEXT BUTTON -->
      <button type="submit" id="nextBtn" class="btn btn-next">Next</button>
    </form>
  </div>

</div>
<!-- JS SCRIPT FOR THIS PAGE  -->
<script src="<?= base_url('js/main.js')?>"></script>

<?= $this->endSection('content')?>