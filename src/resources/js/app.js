import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();


addEventListener('DOMContentLoaded', () => {
    const btnAddProduct = document.querySelector('#btnAddProduct');

    btnAddProduct?.addEventListener('click', () => {
        const selectedProduct = document.querySelector('#productSelect');
        const selectedProductId = selectedProduct.value;
        const selectedProductText = selectedProduct.options[selectedProductId].text;
        const orderForm = document.querySelector('#orderForm')

        if (selectedProductId == 0) {
            alert('Please select a product.');
        } else {
            if (orderForm.classList.contains('d-none')) {
                orderForm.classList.remove('d-none');
            }

            const productInfo = selectedProductText.split('-');

            const productName = productInfo[0].trim();
            const productPrice = productInfo[1].trim().split(' ')[0];

            const orderFormList = orderForm.querySelector('ol');
            const li = document.createElement('li');
            li.classList.add('list-group-item', 'd-flex', 'align-items-center');
            li.innerHTML =
            `<div class="row w-100">
                <input type="hidden" name="products[]" value="${selectedProductId}">
                <div class="col-4 ms-2 align-self-center">${productName}</div>
                <div class="col-3">
                    <input name="price[]" type="numeric" class="form-control" disabled value="${productPrice}">
                </div>
                <div class="col-3">
                    <input name="qtys[]" type="numeric" class="form-control" value="1" data-input-type=qty>
                </div>
            </div>`;

            orderFormList.appendChild(li);
            selectedProduct.selectedIndex = 0;

        }

    });
});
