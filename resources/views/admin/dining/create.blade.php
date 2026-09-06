@extends('layouts.app')
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0; padding: 0; background: #f9f9f9; color: #333;
    }
    header {
      background: #28a745; color: white; padding: 15px 20px;
      display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;
    }
    header h1 { margin: 0; font-size: 20px; }
    .customer-select label, select { font-size: 16px; }

    .container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      padding: 20px;
      justify-content: center;
    }

    .food-list {
      background: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      flex: 1;
      max-width: 100%;
      padding: 20px;
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 15px;
      overflow-y: auto;
    }

    .food-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      padding: 10px;
      cursor: pointer;
      border: 1px solid #eee;
      border-radius: 8px;
      transition: background 0.2s;
    }

    .food-item:hover {
      background: #e6f4ea;
    }

    .food-item.selected {
      background: #c6ebca;
    }

    .food-item img {
      width: 100px;
      height: 100px;
      border-radius: 8px;
      object-fit: cover;
      user-select: none;
    }

    .food-item span {
      font-weight: 600;
      text-align: center;
      font-size: 14px;
      user-select: none;
    }

    .cart {
      background: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      flex: 1;
      max-width: 500px;
      min-width: 300px;
      display: flex;
      flex-direction: column;
      max-height: 70vh;
      overflow-y: auto;
      padding: 20px;
    }

    .cart h2 {
      margin: 0 0 20px 0;
      text-align: center;
    }

    .cart-items {
      flex-grow: 1;
      overflow-y: auto;
    }

    .cart-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eee;
    }

    .cart-item-name {
      font-weight: 600;
      flex: 1;
      user-select: none;
    }

    .cart-item-controls {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .cart-item-controls input[type="number"] {
      width: 60px;
      padding: 5px;
      font-size: 16px;
      border-radius: 6px;
      border: 1px solid #ccc;
      text-align: center;
    }

    .cart-item-price {
      min-width: 70px;
      text-align: right;
      font-weight: 600;
      user-select: none;
    }

    .total {
      margin-top: 20px;
      font-size: 22px;
      font-weight: bold;
      text-align: right;
      color: #28a745;
      user-select: none;
    }

    @media (max-width: 1200px) {
      .food-list {
        grid-template-columns: repeat(4, 1fr); /* 4 items per row on medium screens */
      }
    }

    @media (max-width: 992px) {
      .food-list {
        grid-template-columns: repeat(3, 1fr); /* 3 items per row on smaller screens */
      }
    }

    @media (max-width: 768px) {
      .food-list {
        grid-template-columns: repeat(2, 1fr); /* 2 items per row on mobile screens */
      }
    }

    @media (max-width: 480px) {
      .food-list {
        grid-template-columns: 1fr; /* 1 item per row on very small screens */
      }
    }
  </style>
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="#">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Food Management</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Dining</a>
                </li>
                <li class="nav-item">
                  <a href="#">Add</a>
                </li>
              </ul>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Add Dining Order</h4>
                        </div>
                        <div class="card-body">
                            <!-- <form method="POST" action="{{ route('admin.food-management.dining.store') }}" enctype="multipart/form-data"> -->
                            @csrf

                            <h1>Food Cart</h1>
                            <div class="customer-select">
                                <label for="customer">Select Customer:</label>
                                <select id="customer" class="form-control">
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->invoice }}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="row">
                            <div class="col-md-6">
                                <!-- <h2>Food Menu</h2> -->
                                <div class="food-list" id="food-list">
                                
                                @foreach($foods as $food)
                                <div class="food-item" 
                                    data-id="{{ $food->id }}" 
                                    data-name="{{ $food->name }}" 
                                    data-price="{{ $food->price }}">
                                    <img src="{{ asset('/') }}{{ $food->image }}" alt="{{ $food->name }}" />
                                    <span>{{ $food->name }}</span>
                                </div>
                                @endforeach
                                </div>
                            </div>
                                <div class="col-md-6">
                                <div class="cart">
                                    <h2>Cart for <span id="customer-name">{{ $customers->first()->name }}</span></h2>
                                    <div class="cart-items" id="cart-items"></div>
                                    <div class="total">Total: $<span id="cart-total">0.00</span></div>
                                    <button id="save-cart" style="margin-top: 20px; padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                    Submit
                                    </button>
                                </div>
                                </div>
                            </div>
                            <!-- </form> -->
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
  const customerSelect = document.getElementById('customer');
  const customerName = document.getElementById('customer-name');
  const foodList = document.getElementById('food-list');
  const cartItemsContainer = document.getElementById('cart-items');
  const cartTotalDisplay = document.getElementById('cart-total');

  // Initialize carts object for customers
  let carts = {};
  [...customerSelect.options].forEach(opt => carts[opt.value] = {});

  let currentCustomer = customerSelect.value;

  function renderCart() {
    const cart = carts[currentCustomer];
    cartItemsContainer.innerHTML = '';
    let total = 0;

    Object.values(cart).forEach(item => {
      const subtotal = item.price * item.qty;
      total += subtotal;

      const cartItem = document.createElement('div');
      cartItem.className = 'cart-item';
      cartItem.innerHTML = `
        <div class="cart-item-name">${item.name}</div>
        <div class="cart-item-controls">
          <input type="number" min="1" value="${item.qty}" data-id="${item.id}" />
        </div>
        <div class="cart-item-price">$${subtotal.toFixed(2)}</div>
      `;
      cartItemsContainer.appendChild(cartItem);

      // Add qty change listener
      cartItem.querySelector('input').addEventListener('input', e => {
        let val = parseInt(e.target.value);
        if (isNaN(val) || val < 1) {
          val = 1;
          e.target.value = val;
        }
        carts[currentCustomer][item.id].qty = val;
        renderCart();
      });
    });

    cartTotalDisplay.textContent = total.toFixed(2);
  }

  function updateFoodSelectionUI() {
    const cart = carts[currentCustomer];
    [...foodList.children].forEach(foodEl => {
      if (!foodEl.classList) return; // skip header h2

      const foodId = foodEl.dataset.id;
      if (cart[foodId]) {
        foodEl.classList.add('selected');
      } else {
        foodEl.classList.remove('selected');
      }
    });
  }

  // Food item click toggles selection
  foodList.addEventListener('click', e => {
    const foodEl = e.target.closest('.food-item');
    if (!foodEl) return;

    const id = foodEl.dataset.id;
    const name = foodEl.dataset.name;
    const price = parseFloat(foodEl.dataset.price);

    const cart = carts[currentCustomer];
    if (cart[id]) {
      // Remove from cart
      delete cart[id];
    } else {
      // Add to cart with qty 1
      cart[id] = { id, name, price, qty: 1 };
    }
    updateFoodSelectionUI();
    renderCart();
  });

  // Customer change handler
  customerSelect.addEventListener('change', () => {
    currentCustomer = customerSelect.value;
    customerName.textContent = customerSelect.options[customerSelect.selectedIndex].text;
    updateFoodSelectionUI();
    renderCart();
  });

  // Initial UI render
  updateFoodSelectionUI();
  renderCart();
</script>
<!-- SweetAlert2 CSS (optional, for better styling) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.getElementById('save-cart').addEventListener('click', () => {
    const cart = carts[currentCustomer];
    const payload = {
      customer_id: currentCustomer,
      cart: Object.values(cart)
    };

    fetch('{{ route("admin.food-management.dining.store") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify(payload)
    })
    .then(response => response.json())
    .then(data => { 
        //   alert(data.message || 'Cart saved!');
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: data.message || 'Dining Food Cart submit success!',
        }).then(() => {
            // 1. Clear the cart for current customer
            carts[currentCustomer] = {};

            // 2. Reset UI
            updateFoodSelectionUI();
            renderCart();

            // 3. (Optional) Reset customer dropdown to first one
            // customerSelect.selectedIndex = 0;
            // currentCustomer = customerSelect.value;
            // customerName.textContent = customerSelect.options[0].text;
        });
    })
    .catch(error => {
        //   alert('Failed to save cart.');
        Swal.fire({
            icon: 'failed',
            title: 'Failed',
            text: 'Dining Food Cart submit failed!',
        });
       console.error(error);
    });
  });
</script>

@endsection
