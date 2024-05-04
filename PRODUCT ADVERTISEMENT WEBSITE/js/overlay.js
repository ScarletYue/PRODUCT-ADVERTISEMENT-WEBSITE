// Khi hình ảnh phụ được nhấp chuột
$('.overlay-trigger').click(function() {
    var imgSrc = $(this).attr('src'); // Lấy đường dẫn của hình ảnh đã nhấp chuột

    // Hiển thị lớp overlay
    $('.overlay').fadeIn();

    // Thay đổi đường dẫn và hiển thị hình ảnh trong lớp overlay
    $('.overlay img').attr('src', imgSrc);
});

// Khi lớp overlay được nhấp chuột
$('.overlay').click(function() {
    $(this).fadeOut(); // Ẩn lớp overlay khi nhấp chuột vào nó
});
