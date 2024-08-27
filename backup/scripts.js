document.addEventListener('DOMContentLoaded', () => {
    const cartItems = document.getElementById('cart-items');
    const checkoutBtn = document.getElementById('checkout-btn');
    const removeAllBtn = document.getElementById('remove-all-btn');
    const toast = new bootstrap.Toast(document.getElementById('toast'));

    const loadCart = () => {
        const storedItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        storedItems.forEach((item, index) => addToCartDOM(item.name, item.image, index));
    };

    const addToCartDOM = (name, image, index) => {
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item cart-item d-flex align-items-center justify-content-between';
        listItem.innerHTML = `
            <div class="d-flex align-items-center">
                <img src="${image}" class="img-fluid" style="height: 50px; width: auto; margin-right: 10px;" alt="${name}">
                <span>${name}</span>
            </div>
            <button class="btn btn-danger btn-sm remove-item" onclick="removeFromCart(${index})">Remove</button>
        `;
        cartItems.appendChild(listItem);
    };

    window.addToCart = (name, image) => {
        const storedItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        const index = storedItems.length;
        storedItems.push({ name, image });
        localStorage.setItem('cartItems', JSON.stringify(storedItems));
        addToCartDOM(name, image, index);
        toast.show();
    };

    window.removeFromCart = (index) => {
        let storedItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        storedItems.splice(index, 1);
        localStorage.setItem('cartItems', JSON.stringify(storedItems));
        updateCartDOM();
    };

    const updateCartDOM = () => {
        cartItems.innerHTML = '';
        loadCart();
    };

    checkoutBtn.addEventListener('click', () => {
        const items = JSON.parse(localStorage.getItem('cartItems')) || [];
        if (items.length > 0) {
            fetch('process_transaction.php', {
                method: 'POST',
                body: JSON.stringify({ products: items.map(item => item.name) }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert('Transaction failed: ' + data.error);
                } else {
                    alert('Checkout successful! Your transaction number is ' + data.transaction_number);
                    localStorage.removeItem('cartItems');
                    cartItems.innerHTML = '';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        } else {
            alert('Cart is empty!');
        }
    });

    removeAllBtn.addEventListener('click', () => {
        localStorage.removeItem('cartItems');
        cartItems.innerHTML = '';
    });

    loadCart();
});
