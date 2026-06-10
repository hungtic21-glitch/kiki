// Lấy các thành phần giao diện
const menuToggleBtn = document.getElementById('menu-toggle-btn');
const sidebarNavigation = document.getElementById('sidebar-navigation');
const menuOverlayBg = document.getElementById('menu-overlay-bg');

// Chỉ cần 1 sự kiện duy nhất cho nút 3 gạch
menuToggleBtn.addEventListener('click', () => {
    // Tự động bật/tắt (Toggle) các class tương ứng
    menuToggleBtn.classList.toggle('open');          /* Biến đổi 3 gạch thành X và ngược lại */
    sidebarNavigation.classList.toggle('active');   /* Trượt menu ra/vào */
    menuOverlayBg.classList.toggle('active');       /* Hiện/ẩn lớp nền tối mờ */
});

// Nếu khách bấm ra vùng ngoài menu (lớp nền overlay) thì tự động thu menu vào
menuOverlayBg.addEventListener('click', () => {
    menuToggleBtn.classList.remove('open');
    sidebarNavigation.classList.remove('active');
    menuOverlayBg.classList.remove('active');
});
fetch('/nhom_11/api/api_forgot_password.php')