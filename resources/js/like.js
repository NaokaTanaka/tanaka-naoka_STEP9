document.addEventListener('DOMContentLoaded', function () {
  const likeBtn = document.getElementById('like-btn');

  if (likeBtn) {
    likeBtn.addEventListener('click', function () {
      const productId = this.getAttribute('data-product-id');
      const url = `/products/${productId}/like`;
      const method = this.querySelector('i').style.color === 'red' ? 'DELETE' : 'POST';

      fetch(url, {
        method: method,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Content-Type': 'application/json'
        }
      })

      .then(response => response.json())
      .then(url => {
        const heartIcon = this.querySelector('i');
        heartIcon.style.color = method === 'POST' ? 'red' : 'black';
      });
    });
  }
});