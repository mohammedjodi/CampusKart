<?= $this->extend('layouts/pages_layout')?>
<?= $this->section('title')?>
    Product Listings
<?= $this->endSection('title')?>
<?= $this->section('content') ?>
<main class="marketplace ">

    <!-- HERO -->
    <section class="market-hero ">

        <div class="hero-content">
            <span class="hero-label">
                CAMPUSKART MARKETPLACE
            </span>

            <h1>
                Buy & Sell<br>
                <span>Around Campus.</span>
            </h1>

            <p>
                Find what you need from students around you,
                or sell things you no longer need.
            </p>

            <div class="hero-actions">
                <a href="#all-products" class="btn btn-primary">
                    Start Shopping
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

                <a href="<?= base_url('product/create') ?>" class="btn btn-light">
                    Sell an Item
                </a>
            </div>
        </div>

        <div class="hero-info">

            <div class="info-card">
                <div class="info-icon">
                    <i class="fa-solid fa-store"></i>
                </div>

                <div>
                    <strong>Campus Listings</strong>
                    <span>Buy directly from students</span>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>

                <div>
                    <strong>Near Your Campus</strong>
                    <span>Find products around you</span>
                </div>
            </div>

            <div class="info-card wide">
                <div class="info-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>

                <div>
                    <strong>Student Marketplace</strong>
                    <span>Built specifically for campus buying and selling.</span>
                </div>
            </div>

        </div>

    </section>


    <!-- POPULAR PRODUCTS -->
    <section class="product-section all-products" id="all-products">

    <div class="section-heading">
        <div>
            <span class="section-label">MARKETPLACE</span>

            <h2>All Products</h2>

            <p>
                Explore items listed by students around campus.
            </p>
        </div>

        <a href="<?= base_url('products/create') ?>" class="sell-button">
            <i class="fa-solid fa-plus"></i>
            Sell an Item
        </a>
    </div>


    <!-- Marketplace filters -->
    <div class="marketplace-toolbar">

        <div class="category-scroll">

            <button type="button" class="category-chip active">
                All
            </button>

            <button type="button" class="category-chip">
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
</main>

<?= $this->endSection() ?>