setTimeout(function () {
    const notif = document.getElementById('notification');
    if (notif) {
        notif.classList.add('opacity-0', 'translate-x-full');
        setTimeout(function() {
            notif.remove();
        }, 500);
    }
}, 3000);