
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
});


