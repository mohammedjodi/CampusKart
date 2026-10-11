
//===================USER PROFILE===================
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.ck-profile-tab');
    const contents = document.querySelectorAll('.ck-tab-content');
    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            const target = this.dataset.tab;
            // Remove active state from tabs
            tabs.forEach(item => {
                item.classList.remove('active');
            });
            // Hide all content
            contents.forEach(content => {
                content.classList.remove('active');
            });
            // Activate selected tab
            this.classList.add('active');
            const targetContent = document.getElementById(target);
            if (targetContent) {
                targetContent.classList.add('active');
            }
        });
    });

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



