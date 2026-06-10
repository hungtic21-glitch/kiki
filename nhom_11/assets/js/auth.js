// auth.js - Xử lý đăng nhập/đăng xuất cho toàn bộ trang

function updateAuthUI() {
    const authSection = document.getElementById('auth-section');
    if (!authSection) return;
    
    const userData = localStorage.getItem('user');
    
    if (userData) {
        try {
            const user = JSON.parse(userData);
            if (user.logged_in === true || user.is_guest === true) {
                authSection.innerHTML = `
                    <div class="user-info">
                        <span class="user-name">
                            <i class="fa-regular fa-user"></i> ${user.full_name}
                        </span>
                        <button class="logout-btn" onclick="handleLogout()">
                            <i class="fa-solid fa-sign-out-alt"></i> Đăng Xuất
                        </button>
                    </div>
                `;
                return;
            }
        } catch(e) {
            console.error('Lỗi parse user:', e);
        }
    }
    
    authSection.innerHTML = '<a href="login.html" class="auth-link">Đăng Nhập</a>';
}

function handleLogout() {
    localStorage.removeItem('user');
    alert('👋 Bạn đã đăng xuất thành công!');
    window.location.href = 'index.html';
}

// Tự động chạy khi trang load
document.addEventListener('DOMContentLoaded', function() {
    updateAuthUI();
});