<?= $this->extend('layouts/auth_page_layout')?>

<?= $this->section('title')?>
  Preview Product
<?= $this->endSection('title')?>
<?= $this->section('content')?>

<div class="container my-4">
  <div class="row g-3">
    
    <!-- LEFT: MAIN PRODUCT INFO - 8 cols -->
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm">
        
        <!-- IMAGE GALLERY -->
        <div class="product-gallery">
          <img src="https://placehold.co/700x400/ff0000/fff" class="main-img" alt="Toyota Camry">
          <div class="thumb-row">
            <img src="https://placehold.co/100x70/ff0000/fff" alt="">
            <img src="https://placehold.co/100x70/ff0000/fff" alt="">
            <img src="https://placehold.co/100x70/ff0000/fff" alt="">
            <img src="https://placehold.co/100x70/ff0000/fff" alt="">
            <img src="https://placehold.co/100x70/ff0000/fff" alt="">
          </div>
        </div>

        <div class="card-body">
          <!-- LOCATION + VIEWS -->
          <div class="d-flex justify-content-between text-muted small mb-2">
            <div><i class="fa-solid fa-location-dot"></i> Lagos, Agege, 1 hour ago <span class="ms-3"><i class="fa-regular fa-eye"></i> 165 views</span></div>
            <span class="text-primary fw-medium">Promoted</span>
          </div>

          <!-- TITLE -->
          <div class="d-flex justify-content-between align-items-start">
            <h1 class="h5 fw-bold">Toyota Camry LE 4dr Sedan (2.5L 4cyl 6A) 2014 Red</h1>
            <i class="fa-regular fa-bookmark fs-5"></i>
          </div>

          <!-- QUICK SPECS ICONS -->
          <div class="row text-center my-3 py-2 bg-light rounded">
            <div class="col-4"><i class="fa-solid fa-file-invoice fs-4 text-muted"></i><div class="small mt-1">Foreign Used</div></div>
            <div class="col-4"><i class="fa-solid fa-gas-pump fs-4 text-muted"></i><div class="small mt-1">Petrol</div></div>
            <div class="col-4"><i class="fa-solid fa-gears fs-4 text-muted"></i><div class="small mt-1">Automatic</div></div>
          </div>

          <!-- SPECS GRID -->
          <div class="card border-0 bg-light mb-3">
            <div class="card-body">
              <div class="row g-3">
                <div class="col-6"><div class="spec-label">SECOND CONDITION</div><div class="spec-value">No faults</div></div>
                <div class="col-6"><div class="spec-label">MAKE</div><div class="spec-value text-success">Toyota</div></div>
                <div class="col-6"><div class="spec-label">MODEL</div><div class="spec-value text-success">Camry</div></div>
                <div class="col-6"><div class="spec-label">YEAR</div><div class="spec-value">2014</div></div>
              </div>
              <a href="#" class="text-success small fw-medium d-block mt-2">Show more <i class="fa-solid fa-chevron-down"></i></a>
            </div>
          </div>

          <!-- DESCRIPTION -->
          <div class="card border-0 bg-light mb-3">
            <div class="card-body">
              <p class="mb-0">Excellent car. You just need to see the car and carry out your checks to confirm. I am the owner of the car and so, it is parked right in my compound.</p>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- RIGHT: SIDE PANEL - 4 cols -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm sticky-top" style="top: 80px;">
        <div class="card-body">
          
          <!-- PRICE -->
          <h2 class="fw-bold text-success mb-3">₦ 8,600,000</h2>

          <!-- CTA BUTTONS -->
          <button class="btn btn-success w-100 fw-bold mb-2">
            <i class="fa-solid fa-phone"></i> Show contact
          </button>
          <button class="btn btn-outline-success w-100 fw-bold mb-3">
            Make an offer
          </button>

          <!-- REQUEST PHONE CALL -->
          <div class="border rounded p-3 mb-3">
            <div class="fw-bold mb-2">Request a phone call</div>
            <input type="text" class="form-control mb-2" placeholder="Your name">
            <input type="tel" class="form-control mb-2" placeholder="Phone number">
            <button class="btn btn-warning w-100 fw-bold">Request</button>
          </div>

          <!-- SELLER INFO -->
          <div class="d-flex align-items-center gap-2 mb-3">
            <img src="https://placehold.co/40x40" class="rounded-circle" alt="">
            <div>
              <div class="fw-bold">John D.</div>
              <small class="text-muted">Member since Jan 2023</small>
            </div>
          </div>

          <!-- SAFETY TIPS -->
          <div class="bg-light p-3 rounded">
            <div class="fw-bold mb-2"><i class="fa-solid fa-shield-halved text-success"></i> Safety tips</div>
            <ul class="small mb-0 ps-3">
              <li>Meet in a public place</li>
              <li>Check the item before you buy</li>
              <li>Pay only after collecting the item</li>
            </ul>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<?= $this->endSection('content')?>