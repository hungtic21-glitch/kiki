let cart = JSON.parse(localStorage.getItem("cart")) || [];

// THÊM GIỎ HÀNG
function addToCart(name, price, image) {
    let existing = cart.find(item => item.name === name);

    if (existing) {
        existing.quantity++;
    } else {
        cart.push({
            name: name,
            price: price,
            image: image,
            quantity: 1
        });
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartCount();
    alert("Đã thêm vào giỏ hàng thành công!");
}

// HIỂN THỊ GIỎ HÀNG CHUẨN TABLE TRÙNG KHỚP CART.HTML
function displayCart() {
    let cartItems = document.getElementById("cart-items");
    if (!cartItems) return;

    cartItems.innerHTML = "";
    let total = 0;

    cart.forEach((item, index) => {
        let itemTotal = item.price * item.quantity;
        total += itemTotal;

        cartItems.innerHTML += `
        <tr>
            <td>
                <img src="${item.image}" style="width:65px; height:65px; object-fit:cover; border-radius:6px;">
            </td>
            <td>${item.name}</td>
            <td class="product-price">${item.price.toLocaleString('vi-VN')}đ</td>
            <td>
                <div style="display: flex; align-items: center; gap: 5px;">
                    <button class="minus" onclick="decreaseQuantity(${index})">-</button>
                    <input type="text" class="quantity-input" value="${item.quantity}" readonly style="width:30px; text-align:center;">
                    <button class="plus" onclick="increaseQuantity(${index})">+</button>
                </div>
            </td>
            <td class="product-price">${itemTotal.toLocaleString('vi-VN')}đ</td>
            <td>
                <button class="delete" onclick="removeFromCart(${index})">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>
        </tr>
        `;
    });

    // Cập nhật tổng tiền hiển thị lên form
    let totalAmountEl = document.getElementById("total-amount");
    if (totalAmountEl) {
        totalAmountEl.textContent = total.toLocaleString('vi-VN') + "đ";
    }
}

// TĂNG SỐ LƯỢNG
function increaseQuantity(index) {
    cart[index].quantity++;
    saveAndRefreshCart();
}

// GIẢM SỐ LƯỢNG
function decreaseQuantity(index) {
    if (cart[index].quantity > 1) {
        cart[index].quantity--;
    } else {
        if (confirm("Bro có muốn xóa sản phẩm này khỏi giỏ hàng không?")) {
            cart.splice(index, 1);
        }
    }
    saveAndRefreshCart();
}

// XÓA SẢN PHẨM KHỎI GIỎ
function removeFromCart(index) {
    if (confirm("Bro chắc chắn muốn xóa sản phẩm này?")) {
        cart.splice(index, 1);
        saveAndRefreshCart();
    }
}

// HÀM LƯU VÀ ĐỒNG BỘ LÀM MỚI DỮ LIỆU
function saveAndRefreshCart() {
    localStorage.setItem("cart", JSON.stringify(cart));
    displayCart();
    updateCartCount();
    if (typeof updateCartTotal === "function") {
        updateCartTotal();
    }
}

// CẬP NHẬT SỐ ĐẾM TRÊN NAVBAR (NẾU CÓ)
function updateCartCount() {
    let count = 0;
    cart.forEach(item => {
        count += item.quantity;
    });

    let cartCount = document.getElementById("cart-count");
    if (cartCount) {
        cartCount.innerText = count;
    }
}

// HÀM TÍNH TOÁN LẠI TỔNG TIỀN THEO ĐÚNG CẤU TRÚC GỐC CỦA BRO
function updateCartTotal() {
    let totalAll = 0;
    const rows = document.querySelectorAll(".cart-table tbody tr");

    rows.forEach(row => {
        const priceCell = row.querySelector(".product-price");
        if (!priceCell) return;
        
        const priceText = priceCell.textContent;
        const price = parseInt(priceText.replace(/\./g, "").replace("đ", ""));
        
        const qtyInput = row.querySelector(".quantity-input");
        const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
        
        totalAll += (price * quantity);
    });

    let totalAmountEl = document.getElementById("total-amount");
    if (totalAmountEl) {
        totalAmountEl.textContent = totalAll.toLocaleString('vi-VN') + "đ";
    }
}

// Tự động kích hoạt hiển thị khi nhúng file
displayCart();
updateCartCount();