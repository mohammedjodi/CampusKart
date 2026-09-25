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

            <button type="button" class="category-chip active">
                Electronics
            </button>

            <button type="button" class="category-chip">
                Books & Stationery
            </button>

            <button type="button" class="category-chip">
                Fashion & Accessories
            </button>

            <button type="button" class="category-chip">
                Sports & Outdoors
            </button>

            <button type="button" class="category-chip">
                Home & Living
            </button>

            <button type="button" class="category-chip">
                Health & Beauty
            </button>

            <button type="button" class="category-chip">
                Food & Beverages
            </button>

            <button type="button" class="category-chip">
                Services
            </button>

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
                    src="https://images.unsplash.com/photo-1592286927505-2fd7c9d5f5f0?auto=format&fit=crop&w=300&q=80"
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

                <button
                    type="button"
                    class="product-thumbnail active"
                    onclick="changeProductImage(this)"
                >
                    <img
                        src="https://images.unsplash.com/photo-1592286927505-2fd7c9d5f5f0?auto=format&fit=crop&w=300&q=80"
                        alt="iPhone front"
                    >
                </button>

                <button
                    type="button"
                    class="product-thumbnail"
                    onclick="changeProductImage(this)"
                >
                    <img
                        src="https://images.unsplash.com/photo-1603921326210-6edd2d60ca68?auto=format&fit=crop&w=300&q=80"
                        alt="iPhone back"
                    >
                </button>

                <button
                    type="button"
                    class="product-thumbnail"
                    onclick="changeProductImage(this)"
                >
                    <img
                        src="https://images.unsplash.com/photo-1611791484670-ce19b801d192?auto=format&fit=crop&w=300&q=80"
                        alt="iPhone side"
                    >
                </button>

                <button
                    type="button"
                    class="product-thumbnail"
                    onclick="changeProductImage(this)"
                >
                    <img
                        src="https://images.unsplash.com/photo-1556656793-08538906a9f8?auto=format&fit=crop&w=300&q=80"
                        alt="iPhone"
                    >
                </button>

            </div>

        </div>


        <!-- =====================================
             PRODUCT INFORMATION
        ====================================== -->
        <div class="product-info-card">

            <h1 class="single-product-title">
                iPhone 13 (128GB)
            </h1>


            <!-- Status -->
            <div class="product-status-row">

                <span class="condition-badge">
                    Used
                </span>

                <span class="verified-badge">
                    <i class="fa-solid   fa-shield"></i>
                    Verified Seller
                </span>

            </div>


            <!-- Price -->
            <div class="single-product-price">
                ₦420,000
            </div>


            <!-- Location -->
            <div class="product-meta-row">

                <span>
                    <i class="fa-solid fa-location-dot"></i>
                    Lagos State, Yaba
                </span>

                <span class="meta-divider"></span>

                <span>
                    <i class="fa-regular fa-clock"></i>
                    2 hours ago
                </span>

            </div>


            <!-- Quick Details -->
            <div class="product-quick-details">

                <div class="quick-detail">

                    <i class="fa-brands fa-apple"></i>

                    <div>
                        <span>Brand</span>
                        <strong>Apple</strong>
                    </div>

                </div>


                <div class="quick-detail">

                    <i class="fa-solid fa-mobile-screen-button"></i>

                    <div>
                        <span>Model</span>
                        <strong>iPhone 13</strong>
                    </div>

                </div>


                <div class="quick-detail">

                    <i class="fa-solid fa-hard-drive"></i>

                    <div>
                        <span>Storage</span>
                        <strong>128GB</strong>
                    </div>

                </div>


                <div class="quick-detail">

                    <i class="fa-solid fa-box"></i>

                    <div>
                        <span>Condition</span>
                        <strong>Good</strong>
                    </div>

                </div>

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

                Clean and neat iPhone 13 with 128GB storage.
                Everything works perfectly including the camera,
                Face ID and battery. No major scratches, just minor
                signs of use. Comes with original charger and cable.

            </div>


            <h3 class="details-heading">
                Key Details
            </h3>


            <div class="key-details">

                <div class="detail-row">
                    <span>Brand</span>
                    <strong>Apple</strong>
                </div>

                <div class="detail-row">
                    <span>Model</span>
                    <strong>iPhone 13</strong>
                </div>

                <div class="detail-row">
                    <span>Storage</span>
                    <strong>128GB</strong>
                </div>

                <div class="detail-row">
                    <span>Condition</span>
                    <strong>Good</strong>
                </div>

                <div class="detail-row">
                    <span>Color</span>
                    <strong>Blue</strong>
                </div>

                <div class="detail-row">
                    <span>Category</span>
                    <strong>Phones & Tablets</strong>
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
                        src="https://i.pravatar.cc/150?img=12"
                        alt="Umar Faruq"
                    >

                </div>


                <div class="seller-name-area">

                    <h3>
                        Umar Faruq
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
                    href="#"
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
                        LASU
                    </strong>

                </div>


                <div class="seller-detail-row">

                    <i class="fa-solid fa-location-dot"></i>

                    <span>
                        Location
                    </span>

                    <strong>
                        Lagos State, Yaba
                    </strong>

                </div>


                <div class="seller-detail-row">

                    <i class="fa-regular fa-calendar"></i>

                    <span>
                        Joined
                    </span>

                    <strong>
                        Jan 2024
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

   <section class=" show-product-category product-section all-products  container" id="all-products">

    <!-- Products -->
    <div class="product-grid marketplace-grid">

        <?php for ($i = 1; $i <= 8; $i++): ?>

            <article class="product-card">

                <div class="product-image">

                    <img
                        src="<?= base_url('public/assets/images/products/product-' . $i . '.jpg') ?>"
                        alt="CampusKart product"
                    >

                    <button
                        type="button"
                        class="favorite-btn"
                        aria-label="Add to favourites"
                    >
                        <i class="fa-regular fa-heart"></i>
                    </button>

                </div>


                <div class="product-body">

                    <div class="product-category">
                        Electronics
                    </div>

                    <h3>
                        Campus Product <?= $i ?>
                    </h3>


                    <div class="product-meta">

                        <span>
                            <i class="fa-solid fa-location-dot"></i>
                            Your Campus
                        </span>

                        <span>
                            <?= $i ?>h ago
                        </span>

                    </div>


                    <div class="product-footer">

                        <strong>
                            ₦<?= number_format(5000 + ($i * 5000)) ?>
                        </strong>

                        <span class="condition">
                            Good
                        </span>

                    </div>

                </div>

            </article>

        <?php endfor; ?>

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