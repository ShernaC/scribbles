function openModal(postId) {
    const postData = document.getElementById('post-data-' + postId);
    
    // Get data from hidden elements
    const title = postData.querySelector('[data-title]').getAttribute('data-title');
    const content = postData.querySelector('[data-content]').getAttribute('data-content');
    const author = postData.querySelector('[data-author]').getAttribute('data-author');
    const date = postData.querySelector('[data-date]').getAttribute('data-date');
    const words = postData.querySelector('[data-words]').getAttribute('data-words');
    const image = postData.querySelector('[data-image]');
    
    // Populate modal
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalContent').textContent = content;
    document.getElementById('modalAuthor').textContent = author;
    document.getElementById('modalDate').textContent = date;
    document.getElementById('modalWords').textContent = words;
    
    const imageContainer = document.getElementById('modalImageContainer');
    const modalImage = document.getElementById('modalImage');

    if (image) {
        const imageSrc = image.getAttribute('data-image');
        modalImage.src = imageSrc;
        imageContainer.style.display = 'block';
    } else {
        imageContainer.style.display = 'none';
    }
    
    // Show modal and blur background
    document.getElementById('postModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('postModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

window.openModal = openModal;
window.closeModal = closeModal;

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('postModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
});