document.addEventListener('DOMContentLoaded', () => {
    const searchName = document.querySelector(".main .content .body .list .search-content .search-name .form .search-button");
    const searchBarcode = document.querySelector(".main .content .body .list .search-content .search-barcode .form .search-button");
    const refreshButton = document.querySelector(".main .content .body .list .num-desc .refresh");
    let search = "";
    let oldProducts = [];

    // Nút làm mới trạng thái 
    refreshButton.addEventListener("click",() => {
        location.reload();
    });

    // Tìm kiếm theo tên
    searchName.addEventListener("click", async () => {
        search = document.getElementById("search").value;
        let api = "http://localhost:8080/FinalWeb/api/TransactionProcessing/get-product-by-name.php?search=" + search;
        document.getElementById("search").value = "";
        const response = await fetch(api);
        const data = await response.json();
        if(data.data.length  > 0) {
            displayProducts(data.data);
        }
        else {
            alert("Sản phẩm không tồn tại !");
        }
    });

    // Tìm kiếm theo barcode
    searchBarcode.addEventListener("click", async () => {
        const search = document.getElementById("barcode").value;
        let api = "http://localhost:8080/FinalWeb/api/TransactionProcessing/get-product-by-name.php?barcode=" + search;
        document.getElementById("barcode").value = "";
        const response = await fetch(api);
        const data = await response.json();
        if(data.data.length  > 0) {
            displayProducts(data.data);
        }
        else {
            alert("Sản phẩm không tồn tại !");
        }
    });

    // Render sản phẩm 
    function displayProducts(products) {
        const tableBody = document.querySelector(".main .content .body .list .order-list table tbody");
        products.forEach(product => {
            oldProducts.push(product);
            if (oldProducts[oldProducts.length-1].ProductQuantities === undefined) {
                oldProducts[oldProducts.length-1].ProductQuantities = 1;
            }

            if (oldProducts[oldProducts.length-1].ProductTotal === undefined) {
                oldProducts[oldProducts.length-1].ProductTotal = oldProducts[oldProducts.length-1].ProductRetailPrice;
            }
        });

        renderTable();
    }

    // Đổ api vào khung html 
    function renderTable() {
        const tableBody = document.querySelector(".main .content .body .list .order-list table tbody");
        tableBody.innerHTML = "";
        let index = 0;
        let totalItems = 0;

        oldProducts.forEach((product, productIndex) => {
            index += parseInt(product.ProductQuantities);
            const row = `<tr>
                            <td>
                                <div class="product-name">
                                    <div class="product-info">
                                        <div class="name">
                                            ${product.ProductName}
                                        </div>
                                        <div class="color">
                                            Color: ${product.Color}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="num">
                                    <input type="number" name="quantity" min="1" value=${product.ProductQuantities} data-index=${productIndex}>
                                </div>
                            </td>
                            <td>
                                <div class="price">
                                    ${product.ProductRetailPrice}
                                </div>
                            </td>
                            <td>
                                <div class="total">
                                    ${parseInt(product.ProductRetailPrice) * parseInt(product.ProductQuantities)}
                                </div>
                            </td>
                            <td>
                                <div class="icon">
                                    <i class="fa-solid fa-trash" data-index=${productIndex}></i>
                                </div>
                            </td>
                        </tr>`;
            tableBody.insertAdjacentHTML("beforeend", row);
        });

        const totalItem = document.querySelector(".main .content .body .list .num-desc .num");
        totalItem.innerHTML = "Sản phẩm hiện tại: " + index.toString();

        attachEventListeners();
    }

    // Xử lý sự kiện
    function attachEventListeners() {

        // Delete Items
        const deleteIcons = document.querySelectorAll(".main .content .body .list .order-list table tr td .icon i");
        deleteIcons.forEach(item => {
            item.addEventListener("click", () => {
                const deleteIndex = item.getAttribute("data-index");
                const confirmDelete = confirm("Bạn có chắc muốn xóa sản phẩm này?");
                if (confirmDelete) {
                    oldProducts.splice(Number(deleteIndex), 1);
                    renderTable();
                }
            });
        });
        // End Delete Items

        // Update Exist Items
        const lastTR = document.querySelectorAll(".main .content .body .list .order-list table tbody tr:last-child td .product-name .product-info .name");
        if(lastTR.length > 0) {
            const lastValue = lastTR[0].innerText;
            const tableItems = document.querySelectorAll(".main .content .body .list .order-list table tbody tr td .product-name .product-info .name");

            if(tableItems.length > 0) {
                let check = 0;
                let arr = [];
                tableItems.forEach(tr => {
                    arr.push(tr.innerHTML.trim());
                    if(tr.innerHTML.trim() == lastValue){
                        check++;
                        if(check == 2) {
                            const indexes = arr.indexOf(tr.innerHTML.trim());
                            const updateValue = document.querySelector(`.main .content .body .list .order-list table tbody tr:nth-child(${indexes+1})`);
                            let num = Number(updateValue.querySelector("td:nth-child(2) .num input").value);
                            num++;
                            updateValue.querySelector("td:nth-child(2) .num input").value = num;
                            const unit = updateValue.querySelector("td:nth-child(3) .price").innerHTML;
                            let newAmount = Number(unit) * Number(num);
                            oldProducts[indexes].ProductQuantities = parseInt(num);
                            oldProducts[indexes].ProductTotal = newAmount;
                            updateValue.querySelector(`td:nth-child(4) .total`).innerHTML = newAmount.toString();  
                            const deleteValue = document.querySelector(".main .content .body .list .order-list table tbody tr:last-child");
                            deleteValue.remove();
                            oldProducts.pop();
                            alert(`Sản phẩm ${lastValue} đã tồn tại trong giỏ hàng ! Cập nhật số lượng sản phẩm ${lastValue}`);
                            renderTable();
                        }
                    }
                });
            }
        }
        // End Update Exist Items

        // Update Quantites
        const quantities = document.querySelectorAll(".main .content .body .list .order-list table tr td .num input[name='quantity']");
        quantities.forEach(item => {
            item.addEventListener("change", () => {
                const productIndex = item.getAttribute("data-index");
                const unitPrice = oldProducts[productIndex].ProductRetailPrice;
                let newTotal = Number(unitPrice) * Number(item.value);
                oldProducts[productIndex].ProductQuantities = parseInt(item.value);
                oldProducts[productIndex].ProductTotal = newTotal;
                renderTable();
            });
        });
        // End Update Quantites
    }

    // Checkout Button

    // Post dữ liệu và lưu vào session 
    async function postData(url, data) {
        const responsePost = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: data
        });
        const result = await responsePost.json();
        return result;
    }

    const checkoutButton = document.querySelector(".main .content .body .list .button .checkout");
    if (checkoutButton) {
        checkoutButton.addEventListener("click",async () => {
            const haveColumn = document.querySelectorAll(".main .content .body .list .order-list table tr");
            if(haveColumn.length > 1) {
                console.log(haveColumn);
                let sendData = JSON.stringify(oldProducts);
                await postData("http://localhost:8080/FinalWeb/api/TransactionProcessing/post-invoice.php",sendData);
                window.location.href = "http://localhost:8080/FinalWeb/CheckoutInformation.php";
            }
            else {
                alert("Vui lòng thêm sản phẩm cần thanh toán");
                return;
            }
        });
    }
    // End Checkout Button
});
