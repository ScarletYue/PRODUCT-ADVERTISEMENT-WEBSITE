// script.js
document.addEventListener("DOMContentLoaded", function() {
    var favoriteButtons = document.querySelectorAll('.favorite-button');
    favoriteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            var product = button.dataset.product;
            // Thêm hiệu ứng nhảy vào sản phẩm ở đây
            // Ví dụ:
            alert('Đã thêm sản phẩm ' + product + ' vào yêu thích!');
        });
    });
});
