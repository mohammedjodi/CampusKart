<?= $this->extend('layouts/auth_page_layout')?>

<?= $this->section('title')?>
  Preview Product
<?= $this->endSection('title')?>
<?= $this->section('content')?>
<!-- SINGLE PRODUCT PAGE -->
<div class="single-product-page container">

      <!-- Marketplace filters -->
    <div class="marketplace-toolbar">

        <div class=" show-product-category category-scroll">

            <button type="button" class="category-chip ">
                All
            </button>
        <?php foreach($categories as $category):?>
            <button type="button" class="category-chip  <?= $category['id'] ===  $product['category_id'] ? 'active' : ''?> ">
                <?= esc($category['name'])?>
            </button>
        <?php endforeach?>
            

        </div>

        <button type="button" class="filter-button">
            <i class="fa-solid fa-sliders"></i>
            Filters
        </button>

    </div>



    <!-- MAIN PRODUCT AREA -->
    <div class="product-main-grid">

        <!-- =====================================
             PRODUCT GALLERY
        ====================================== -->
        <div class="product-gallery-card">

            <div class="main-product-image">

                <img
                    id="mainProductImage"
                    src="<?= base_url($images[0]['image_path'] ?? 'https://via.placeholder.com/500') ?>"
                    alt="iPhone 13"
                >

                <span class="featured-badge">
                    Featured
                </span>

                <button class="image-wishlist" type="button">
                    <i class="fa-regular fa-heart"></i>
                </button>

                <button class="gallery-arrow gallery-prev" type="button">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <button class="gallery-arrow gallery-next" type="button">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>

            </div>

            <!-- Thumbnails -->
            <div class="product-thumbnails">
            <?php foreach($images as $image) : ?>
            
                <button
                    type="button"
                    class="product-thumbnail active"
                    onclick="changeProductImage(this)"
                >
                    <img
                        src="<?= base_url($image['image_path'] ?? 'https://via.placeholder.com/500') ?>"
                        alt="iPhone front"
                    >
                </button> 
            <?php endforeach?>

            </div>

        </div>



        <!-- =====================================
             PRODUCT INFORMATION
        ====================================== -->
        <div class="product-info-card">

            <h1 class="single-product-title">
                <?= esc($product['title'])?>
            </h1>


            <!-- Status -->
            <div class="product-status-row">

                <span class="condition-badge">
                    <?= esc($product['condition_name'])?>

                </span>

                <span class="verified-badge">
                    <i class="fa-solid   fa-shield"></i>
                    Verified Seller
                </span>

            </div>


            <!-- Price -->
            <div class="single-product-price">
                ₦<?= number_format($product['price'])?>

            </div>


            <!-- Location -->
            <div class="product-meta-row">

                <span>
                    <i class="fa-solid fa-location-dot"></i>
                    <?= esc($product['university_name'])?>

                </span>

                <!-- <span class="meta-divider"></span> -->

                <span>
                    <i class="fa-solid fa-clock"></i>
                        <?= timeAgo($product['created_at'])?>

                </span>

            </div>


            <!-- Actions -->
            <div class="product-actions">

                <button
                    type="button"
                    class="btn-primary-action"
                >
                    <i class="fa-solid fa-message"></i>
                    Make Offer
                </button>


                <button
                    type="button"
                    class="btn-secondary-action"
                >
                    <i class="fa-solid fa-phone"></i>
                    Contact Seller
                </button>

            </div>


            <!-- Save / Share -->
            <div class="secondary-actions">

                <button type="button">
                    <i class="fa-solid fa-bookmark"></i>
                    Save
                </button>

                <button type="button">
                    <i class="fa-solid fa-share-nodes"></i>
                    Share
                </button>

            </div>

        </div>

    </div>



    <!-- =====================================
         BOTTOM AREA
    ====================================== -->
    <div class="product-bottom-grid">


        <!-- =====================================
             DESCRIPTION
        ====================================== -->
        <div class="product-description-card">

            <h2>
                Product Description
            </h2>


            <div class="product-description">

                <?= esc($product['description'])?>

            </div>


            <h3 class="details-heading">
                Key Details
            </h3>


            <div class="key-details">

                <div class="detail-row">
                    <span>Brand</span>
                    <strong>     <?= esc($product['brand_name'])?></strong>
                </div>

                <div class="detail-row">

                    <span>Condition</span>
                    <strong><?= esc($product['condition_name'])?></strong>



                </div>


                <div class="detail-row">
                    <span>Category</span>
                    <strong><?= esc($product['category_name'])?></strong>
                </div>

            </div>


            <button
                type="button"
                class="additional-info-btn"
            >
                <span>
                    <i class="fa-solid fa-chevron-down"></i>
                    Additional Information
                </span>
            </button>

        </div>



        <!-- =====================================
             SELLER INFORMATION
        ====================================== -->
        <div class="seller-card">

            <h2>
                Seller Information
            </h2>


            <div class="seller-header">

                <div class="seller-avatar">

                    <img
                        src="<?= base_url($product['seller_avatar'] ?? 'https://via.placeholder.com/500') ?>"
                        alt="Umar Faruq"
                    >

                </div>


                <div class="seller-name-area">

                    <h3>
                        <?= esc($product['seller_first_name'])?> <?= esc($product['seller_last_name'])?>
                    </h3>

                    <span class="seller-type">
                        Student
                    </span>


                    <div class="seller-rating">

                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>

                        <span>(12)</span>

                    </div>

                </div>


                <a
                    href=""
                    class="view-profile-btn"
                >
                    View Profile
                </a>

            </div>


            <!-- Seller Details -->
            <div class="seller-details">

                <div class="seller-detail-row">

                    <i class="fa-solid fa-graduation-cap"></i>

                    <span>
                        University
                    </span>

                    <strong>
                        <?= esc($product['university_name'])?>

                    </strong>

                </div>


                <div class="seller-detail-row">

                    <i class="fa-solid fa-location-dot"></i>

                    <span>
                        Location
                    </span>

                    <strong>
                        <?= esc($product['state_name'])?>

                    </strong>

                </div>


                <div class="seller-detail-row">

                    <i class="fa-regular fa-calendar"></i>

                    <span>
                        Joined
                    </span>

                    <strong>
                        <?= date('F j, Y' , strtotime($product['seller_joined_at']))?>
                    </strong>

                </div>

            </div>


            <!-- Verification -->
            <div class="seller-verification">

                <div class="verification-icon">

                    <i class="fa-solid fa-shield"></i>

                </div>


                <div>

                    <strong>
                        Verified Seller
                    </strong>

                    <p>
                        This seller has been verified by CampusKart.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="section-heading container">
        <div>
            <span class="section-label">MARKETPLACE</span>

            <h2>Related Products:</h2>

            <p>
                Explore items listed by students around campus.
            </p>
        </div>

    </div>

   <section class="  show-product-category product-section all-products  container" id="all-products">

    <!-- Products -->
    <div class="preview-product-grid">

        <?php foreach ($relatedProducts as $rp) : ?>

             <article class="home-product-card">
             <a href="<?= route_to('listing.view' , $rp['id'])?>?category=<?= esc($category['name'])?>">

                <div class="home-product-image">


                    <img
                        src="<?= base_url($rp['image_path'] ?? 'https://via.placeholder.com/500') ?>"
                        alt="<?= esc($rp['title']) ?>"
                    >

                    <button
                        type="button"
                        class="home-favorite"
                    >
                        <i class="fa-regular fa-heart"></i>
                    </button>

                </div>

                <div class="home-product-body">

                    <span class="home-condition my-3">
                        <?= esc($rp['condition_name']) ?>

                    </span>

                    <a class="home-product-title" href="<?= route_to('listing.view' , $rp['id'])?>"><h3 class="home-product-title">
                        <?= esc($rp['title']) ?>
                    </h3>
                    </a>

                    <p class="home-product-description">
                        <?= esc(mb_strimwidth($rp['description'] ?? '', 0, 140, '...')) ?>
                    </p>

                    <strong class="home-price">
                        ₦<?= number_format($rp['price']) ?>
                    </strong>

                    <div class="home-meta">

                        <span>
                            <i class="fa-solid fa-location-dot"></i>
                            <?= esc($rp['university_name']) ?>
                        </span>

                        <span>
                            <i class="fa-solid fa-clock"></i>
                            <?= timeAgo($rp['created_at']) ?>
                        </span>

                    </div>

                   

                </div>
            </a>
            </article>
            

        <?php endforeach; ?>

    </div>


    <!-- Load more -->
    <div class="load-more-wrapper">

        <button type="button" class="load-more-button">
            Load More Products
            <i class="fa-solid fa-arrow-down"></i>
        </button>

    </div>

</section>


<!-- IMAGE SWITCHING -->
<script>

function changeProductImage(button) {

    const image = button.querySelector('img');
    const mainImage = document.getElementById('mainProductImage');
    
    mainImage.src = image.src;

    document
        .querySelectorAll('.product-thumbnail')
        .forEach(item => {
            item.classList.remove('active');
        });

    button.classList.add('active');
}

</script>

<?= $this->endSection('content')?>