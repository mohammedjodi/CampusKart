<?= $this->extend('layouts/pages_layout')?>

<?= $this->section('title')?>
  CampusKart
<?= $this->endSection('title')?>

<?= $this->section('content')?>
<main>
        <!-- =====================Hero Section Start ============================ -->
    <div class="hero-section">
        <h2>What are you looking for?</h2>
    
            <form class="search-box">
                <div class="select-together">
                <div class="select-wrapper">
                    <select name="school" class="home-select" >
                    <option>All Schools </option>
                    <option>UNILAG</option>
                    <option>UI</option>
                </select>
                </div>
                
                </div>
                <div class="search-wrap">
                    <input type="text" name="search" placeholder="Search for laptops, phones, textbooks...">
                <button type="submit" style="margin: 0; padding: 0;  height: 50px;"><span class="input-group-text"><i class="icon-copy bi bi-search"></i></span></button> 
                </div>
            
            </form>
            </div>
            <!-- =====================Hero Section End ============================ -->
            <!-- =============================== Main Section Section ======================================= -->
    <section class="container">
            <!-- MAIN CONTENT: SIDE + MAIN PANEL -->
        <div class="container mt-4">
            <div class="row g-3">
            
            <!-- 1. SIDE PANEL: col-lg-3 -->
            <div class="col-lg-3 d-none  d-lg-block">
                <div class="side-panel">
                <div class="category-item">
                    <i class="icon-copy fa fa-book mx-3 "   caria-hidden="true"></i>
                    <div class="category-text">
                    <div>Text Books</div>
                    <small>343,108 ads</small>
                    </div>
                    <span class="text-dark"><i class="icon-copy fa fa-chevron-right" aria-hidden="true"></i></span>
                </div>
                <div class="category-item">
                    <i class="icon-copy fi-laptop mx-3"></i>
                    <div class="category-text">
                    <div>Laptops</div>
                    <small>99,965 ads</small>
                    </div>
                    <span class="text-dark"><i class="icon-copy fa fa-chevron-right" aria-hidden="true"></i></span>
                </div>
                <div class="category-item">
                    <img src="https://cdn-icons-png.flaticon.com/512/15/15874.png " alt="">
                    <div class="category-text">
                    <div>Phones & Tablets</div>
                    <small>88,546 ads</small>
                    </div>
                    <span class="text-dark"><i class="icon-copy fa fa-chevron-right" aria-hidden="true"></i></span>
                </div>
                <!-- Add more categories -->
                </div>
            </div>

            <!-- 2. MAIN PANEL: col-lg-9 -->
            <div class="col-12 col-lg-9 main-panel">
                
                <!-- Top 4 Feature Cards -->
                <div class="row g-3 mb-3 justify-content-center">
                
                <div class="col-6 col-md-3 ">
                    <div class="feature-card" style="background:#ffffff;  border:3px solid rgb(0, 38, 255) ;">
                    <img src="https://cdn-icons-png.flaticon.com/512/2972/2972185.png" width="30">
                    <span class="text-dark">Apply for job</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="feature-card" style="background:#ffffff;  border:3px solid green ;">
                    <img src="https://cdn-icons-png.flaticon.com/512/2331/2331970.png" width="30">
                    <span class="text-dark">How to sell</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="feature-card" style="background:#ffffff ; border:3px solid red ;">
                    <img src="https://cdn-icons-png.flaticon.com/512/8913/8913997.png" width="30">
                    <span class="text-dark">How to buy</span>
                    </div>
                </div>
                </div>

                <!-- Trending Ads -->
                <h5 class="mb-3 text-dark">Trending ads:</h5>
                <div class="row g-3">
                <div class="col-12 col-md-4 col-lg-3 ">
                    <div class="ad-card">
                    <img src="<?= base_url('src/images/img3.jpg')?>" alt="">
                    <div class="p-2">
                        <div class="ad-price">₦ 8,600,000</div>
                        <div class="small">Toyota Camry LE 4dr Sedan</div>
                        <small class="text-muted">Lagos</small>
                    </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="ad-card">
                    <img src="<?= base_url('src/images/img2.jpg')?>" alt="">
                    <div class="p-2">
                        <div class="ad-price">₦ 4,750,000</div>
                        <div class="small">Hyundai Elantra GLS</div>
                        <small class="text-muted">Lagos, Ikeja</small>
                    </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="ad-card">
                    <img src="<?= base_url('src/images/img1.jpg')?>" alt="">
                    <div class="p-2">
                        <div class="ad-price">₦ 4,750,000</div>
                        <div class="small">Hyundai Elantra GLS</div>
                        <small class="text-muted">Lagos, Ikeja</small>
                    </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 ">
                    <div class="ad-card">
                    <img src="<?= base_url('src/images/banner-img.png')?>" alt="">
                    <div class="p-2">
                        <div class="ad-price">₦ 4,750,000</div>
                        <div class="small">Hyundai Elantra GLS</div>
                        <small class="text-muted">Lagos, Ikeja</small>
                    </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="ad-card">
                    <img src="<?= base_url('src/images/img2.jpg')?>" alt="">
                    <div class="p-2">
                        <div class="ad-price">₦ 4,750,000</div>
                        <div class="small">Hyundai Elantra GLS</div>
                        <small class="text-muted">Lagos, Ikeja</small>
                    </div>
                    </div>
                </div>
                <!-- Add 2 more cards -->
                </div>

            </div>
            </div>
        </div>

     </section>

</main>
<?= $this->endSection('content')?>
