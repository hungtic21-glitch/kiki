let cart = JSON.parse(localStorage.getItem("cart")) || [];

// THÊM GIỎ HÀNG

function addToCart(name, price, image){

    let existing = cart.find(item => item.name === name);

    if(existing){

        existing.quantity++;

    }else{

        cart.push({
            name:name,
            price:price,
            image:image,
            quantity:1
        });
    }

    localStorage.setItem("cart", JSON.stringify(cart));

    updateCartCount();

    alert("Đã thêm vào giỏ hàng");
}

// HIỂN THỊ GIỎ

function displayCart(){

    let cartItems = document.getElementById("cart-items");

    if(!cartItems) return;

    cartItems.innerHTML = "";

    let total = 0;

    cart.forEach((item,index)=>{

        let itemTotal = item.price * item.quantity;

        total += itemTotal;

        cartItems.innerHTML += `

        <tr>

            <td>
                <img src="${item.image}">
            </td>

            <td>${item.name}</td>

            <td>${item.price.toLocaleString()}đ</td>

            <td>

                <button class="minus"
                onclick="decreaseQuantity(${index})">
                -
                </button>

                ${item.quantity}

                <button class="plus"
                onclick="increaseQuantity(${index})">
                +
                </button>

            </td>

            <td>
                ${itemTotal.toLocaleString()}đ
            </td>

            <td>

                <button class="delete"
                onclick="removeItem(${index})">
                X
                </button>

            </td>

        </tr>

        `;
    });

    document.getElementById("total-price").innerText =
    total.toLocaleString() + "đ";
}

// TĂNG

function increaseQuantity(index){

    cart[index].quantity++;

    localStorage.setItem("cart", JSON.stringify(cart));

    displayCart();
}

// GIẢM

function decreaseQuantity(index){

    if(cart[index].quantity > 1){

        cart[index].quantity--;

    }else{

        cart.splice(index,1);
    }

    localStorage.setItem("cart", JSON.stringify(cart));

    displayCart();
}

// XÓA

function removeItem(index){

    cart.splice(index,1);

    localStorage.setItem("cart", JSON.stringify(cart));

    displayCart();
}

// CART COUNT

function updateCartCount(){

    let count = 0;

    cart.forEach(item=>{
        count += item.quantity;
    });

    let cartCount = document.getElementById("cart-count");

    if(cartCount){

        cartCount.innerText = count;
    }
}

displayCart();

updateCartCount();
        // Hàm cập nhật lại tổng tiền của từng hàng và toàn bộ giỏ hàng
        function updateCartTotal() {
            let totalAll = 0;
            const rows = document.querySelectorAll(".cart-table tbody tr");

            rows.forEach(row => {
                // Lấy giá sản phẩm (xóa chữ 'đ' và dấu '.' để chuyển thành số)
                const priceText = row.querySelector(".product-price").textContent;
                const price = parseInt(priceText.replace(/\./g, "").replace("đ", ""));
                
                // Lấy số lượng hiện tại
                const quantity = parseInt(row.querySelector(".quantity-input").value);
                
                // Tính tổng từng hàng
                const rowTotal = price * quantity;
                
                // Cập nhật text hiển thị tổng của hàng đó (cột thứ 5)
                const totalCell = row.querySelectorAll(".product-price")[1]; 
                if(totalCell) {
                    totalCell.textContent = rowTotal.toLocaleString('vi-VN') + "đ";
                }

                totalAll += rowTotal;
            });

            // Cập nhật tổng tiền cuối cùng của giỏ hàng
            document.getElementById("total-amount").textContent = totalAll.toLocaleString('vi-VN') + "đ";
        }