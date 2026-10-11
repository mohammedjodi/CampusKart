<?= $this->extend('layouts/auth_page_layout')?>

<?= $this->section('title')?>
  My Listings
<?= $this->endSection('title')?>
<?= $this->section('content')?>
<div class="my-listings-page container my-5  py-5 px-5">

    <!-- Page Header -->
    <div class="listings-header ">

        <div class="listings-heading">
            <h1>My Listings</h1>
            <p>Items you currently have listed for sale.</p>
        </div>

        <a href="<?= base_url('products/create') ?>" class="add-listing-btn">
            <i class="fa-solid fa-plus"></i>
            Add Listing
        </a>

    </div>
    <!-- Listing Filters -->
    <div class="listing-filters">

        <button class="listing-filter active" data-filter="all">
            All
        </button>

        <button class="listing-filter" data-filter="Active">
            Active
        </button>

        <button class="listing-filter" data-filter="Sold">
            Sold
        </button>

    </div>

<?php if(!empty($listings)) : ?>
    <!-- Listings -->
    <div class="listings-container">
        <!-- Listing Card -->
    <?php foreach($listings as $listing) : ?>
        <article class="listing-card" data-status="<?=esc($listing['status_name'])?>">

            <a href="#" class="listing-image">
                <img src="<?= base_url($listing['image_path'] ?? 'https://via.placeholder.com/500') ?>" alt="">
            </a>

            <div class="listing-content">

                <div class="listing-main">

                    <div class="listing-title-row">

                        <a href="#" class="listing-title">
                            <?=esc($listing['title'])?>
                        </a>

                        <span class="listing-status <?= $listing['status_name'] === 'Active' ? 'active-status' : 'sold-status'?>">
                            <?=esc($listing['status_name'])?>
                        </span>

                    </div>

                    <div class="listing-price">
                       ₦<?=number_format($listing['price'])?>
                    </div>

                    <div class="listing-meta">

                        <span>
                            <i class="fa-solid fa-location-dot"></i>
                            <?=esc($university['name'])?>
                        </span>

                        <span>
                            <i class="fa-solid fa-clock"></i><?= timeAgo($listing['created_at'])?>
                        </span>

                    </div>

                </div>


                <!-- Action Menu -->
                <div class="listing-actions">

                    <button class="listing-menu-btn" type="button" aria-label="Listing actions">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>

                    <div class="listing-menu">

                        <a href="<?= route_to('listing.view' , $listing['id'])?>">
                            <i class="fa-regular fa-eye"></i>
                            View Listing
                        </a>

                        <a href="<?= route_to('edit-basic', $listing['id']) ?>">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Edit Listing
                        </a>

                        <!-- MARK PRODUCT AS SOLD -->
                         <?php if($listing['status_name'] !== 'Sold') : ?>
                            <form action="<?= route_to('markAsSold', $listing['id'])?>" method="post">
                                <?= csrf_field()?>
                                <button type="submit">
                                    <i class="fa-solid fa-check"></i>
                                    Mark as Sold
                                </button>
                            </form>
                        <?php else :?>
                            <form action="<?= route_to('markAsActive', $listing['id'])?>" method="post">
                                <?= csrf_field()?>
                                <button type="submit">
                                    <i class="fa-solid fa-times"></i>
                                    Unmark as Sold
                                </button>
                            </form>
                         <?php endif ?>
                         <!-- DELETE PRODUCT -->
                        <form action="<?= route_to('delete', $listing['id'])?>" method="post">
                            <?= csrf_field()?>
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')" class="delete-action">
                                <i class="fa-regular fa-trash-can"></i>
                                Delete
                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </article>
        <!-- Empty State -->
        <div class="listings-empty" hidden>

            <div class="empty-icon">
                <i class="fa-regular fa-rectangle-list"></i>
            </div>

            <h3>No listings found</h3>

            <p>
                You don't have any listings in this category.
            </p>
        </div>
    <?php endforeach ?>
<?php else :?>
        <!-- Empty State -->
        <div class="listings-empty" >

            <div class="empty-icon">
                <i class="fa-regular fa-rectangle-list"></i>
            </div>

            <h3>No listings found</h3>

            <p>
                You don't have any listings in this category.
            </p>
        </div>

    </div>
<?php endif?>
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
<!-- JS SCRIPT FOR THIS PAGE  -->
<script>

document.addEventListener("DOMContentLoaded" , function(){
    const filterButtons = document.querySelectorAll('.listing-filter');
    const listingCards = document.querySelectorAll('.listing-card');

    const emptyState = document.querySelector('.listings-empty');


    /*
    |--------------------------------------------------------------------------
    | Listing Filters
    |--------------------------------------------------------------------------
    */

    filterButtons.forEach(button => {

        button.addEventListener('click', () => {

            //Getting the filter attribute of the clicked button
            const filter = button.dataset.filter;

            // Update active filter
            filterButtons.forEach(btn => {
                btn.classList.remove('active');
            });

            button.classList.add('active');


            let visibleListings = 0;


            listingCards.forEach(card => {

                const status = card.dataset.status;

                if (filter === 'all' || status === filter) {

                    card.style.display = 'flex';
                    visibleListings++;

                } else {

                    card.style.display = 'none';

                }

            });


            // Show empty state when no listings match
            if (visibleListings === 0) {

                emptyState.hidden = false;

            } else {

                emptyState.hidden = true;

            }

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Listing Action Menus
    |--------------------------------------------------------------------------
    */

    const menuButtons = document.querySelectorAll('.listing-menu-btn');


    menuButtons.forEach(button => {

        button.addEventListener('click', event => {

            event.stopPropagation();

            const menu = button.nextElementSibling;


            // Close every other menu
            document.querySelectorAll('.listing-menu').forEach(otherMenu => {

                if (otherMenu !== menu) {
                    otherMenu.classList.remove('show');
                }

            });


            // Toggle current menu
            menu.classList.toggle('show');

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Close menu when clicking outside
    |--------------------------------------------------------------------------
    */

    document.addEventListener('click', () => {

        document.querySelectorAll('.listing-menu').forEach(menu => {
            menu.classList.remove('show');
        });

    });

});
</script>
<?= $this->endSection('content')?>