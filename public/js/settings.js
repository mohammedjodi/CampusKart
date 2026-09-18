
// Settings Toggle 
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    const panels = document.querySelectorAll('.panel');
    const toggles = document.querySelectorAll('.toggle');

    // Switch panels
    sidebarItems.forEach(item => {
        item.addEventListener('click', () => {
            // remove active from all
            sidebarItems.forEach(i => i.classList.remove('active'));
            panels.forEach(p => p.classList.remove('active'));

            // add active to clicked
            item.classList.add('active');
            const panelId = item.getAttribute('data-panel');
            document.getElementById(panelId).classList.add('active');
        })
    })

    // Toggle switches
    toggles.forEach(t => {
        t.addEventListener('click', () => t.classList.toggle('active'))
    });