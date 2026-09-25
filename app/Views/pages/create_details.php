<?= $this->extend('layouts/auth_page_layout')?>

<?= $this->section('title')?>
  Post Product Details
<?= $this->endSection('title')?>
<?= $this->section('content')?>


<div class="container  bottom-space d-flex flex-column  justify-content-center" style="max-width: 800px;">

  <!-- TOP BAR: Back | Post ad | Clear -->
  <div class="bg-white rounded d-flex justify-content-between align-items-center px-3 py-2 mb-3">
    <a href="#" class="text-success text-decoration-none"><i class="fa-solid fa-chevron-left"></i> Back</a>
    <div class="fw-bold">Post an Item</div>
    <a href="#" class="text-danger text-decoration-none">Clear</a>
  </div>

  <form>
    <!-- SECTION 1: PRODUCT DETAILS -->
    <div class="bg-white rounded p-3 mb-3 shadow-sm">
      <div class="row g-3">
       <div class="col-md-6">
        <div class="select-wrapper">
            <select class="form-select" required>
            <option value="" disabled selected>Brand*</option>
            <option value="samsung">Samsung</option>
            <option value="iphone">iPhone</option>
            <option value="tecno">Tecno</option>
            </select>
        </div>
        </div>

        <div class="col-md-6">
            <div class="select-wrapper">
                <select class="form-select" required>
                <option value="" disabled selected>Model*</option>
                <option value="galaxy-s21">Galaxy S21</option>
                <option value="iphone-12">iPhone 12</option>
                <option value="spark-7">Spark 7</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="select-wrapper">
                <select class="form-select" required >
                <option value="" disabled selected>Color*</option>
                <option value="red">Red</option>
                <option value="black">Black</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="select-wrapper">
                <select class="form-select" required >
                <option value="" selected disabled>Physical Condition*</option>
                <option value="new">New</option>
                <option value="like-new">Like New</option>
                <option value="used">Used</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="select-wrapper">
                <select class="form-select" required >
                <option value="" selected disabled>Internal Storage*</option>
                <option value="64gb">64GB</option>
                <option value="128gb">128GB</option>
                <option value="256gb">256GB</option>
                </select>
            </div>
        </div>
   

        <div class="col-12">
          <textarea class="form-control" rows="4" placeholder="Description*"></textarea>
          <div class="text-end text-muted small mt-1">0 / 350</div>
        </div>
      </div>
    </div>

    <!-- SECTION 2: PRICE -->
    <div class="bg-white rounded p-3 mb-3">
      <div class="d-flex justify-content-center">
        <div class="w-100" style="max-width:400px">
          <div class="input-group mb-2">
            <span class="input-group-text  text-green fw-bold">₦</span>
            <input type="number" class="form-control" placeholder="Price*">
          </div>
          <!-- <button type="button" class="form-select text-start d-flex justify-content-between mb-3">Add bulk price <i class="fa-solid fa-chevron-right"></i></button> -->
          
          <div class="small fw-medium">Are you open to negotiation?</div>
          <div class="d-flex gap-4 mt-2">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="negotiate" id="yes">
              <label class="form-check-label" for="yes">Yes</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="negotiate" id="no">
              <label class="form-check-label" for="no">No</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="negotiate" id="notsure" checked>
              <label class="form-check-label text-success" for="notsure">Not sure</label>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- SECTION 3: CONTACT -->
    <div class="bg-white rounded p-3 mb-3">
      <div class="row g-3">
        <div class="col-md-6">
          <input type="tel" class="form-control" placeholder="Your phone number">
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" placeholder="Name" value="Jodi Mohammed" >
        </div>
      </div>
    </div>

  
    <div class="justify-content-center">
        <!-- POST BUTTON -->
      <button type="submit" class="  btn post-ad w-100 fw-bold py-2">Post</button>
     
    </div>
    
    </div>

  </form>
</div>

<?= $this->endSection('content')?>

