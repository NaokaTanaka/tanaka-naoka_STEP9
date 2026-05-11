document.addEventListener('DOMContentLoaded', function () {
  const likeBtn = document.getElementById('like-btn');

  if (likeBtn) {
    likeBtn.addEventListener('click', function () {
      const productId = this.getAttribute('data-product-id');
      const url = `/products/${productId}/like`;
      const isLiked = this.classList.contains('liked');
      const method = isLiked ? 'DELETE' : 'POST';

      fetch(url, {
        method: method,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Content-Type': 'application/json'
        }
      })

      .then(data => {
        this.classList.toggle('liked', method === 'POST');
      });
    });
  }
});