const searchName = document.querySelector(".main .content .body .list .search-content .search-name .form .search-button");
const searchBarcode = document.querySelector(".main .content .body .list .search-content .search-barcode .form .search-button");
const refreshButton = document.querySelector(".main .content .body .list .num-desc .refresh");
let search = "";
let oldProducts = [];


refreshButton.addEventListener("click",() => {
    location.reload();
});

searchName.addEventListener("click", async () => {
    search = document.getElementById("search").value;
    let api = "http://localhost:8080/FinalWeb/api/TransactionProcessing/get-product-by-name.php?search=" + search;
    document.getElementById("search").value = "";
    const response = await fetch(api);
    const data = await response.json();
    displayProducts(data.data);
});

searchBarcode.addEventListener("click", async () => {
    const search = document.getElementById("barcode").value;
    let api = "http://localhost:8080/FinalWeb/api/TransactionProcessing/get-product-by-name.php?barcode=" + search;
    document.getElementById("barcode").value = "";
    const response = await fetch(api);
    const data = await response.json();
    displayProducts(data.data);
});

function displayProducts(products) {
    const tableBody = document.querySelector(".main .content .body .list .order-list table tbody");
    products.forEach(product => {
        oldProducts.push(product);
        if(oldProducts[oldProducts.length-1].ProductQuantities == undefined ) {
            oldProducts[oldProducts.length-1].ProductQuantities = 1;
        }

        if(oldProducts[oldProducts.length-1].ProductTotal == undefined ) {
            oldProducts[oldProducts.length-1].ProductTotal = oldProducts[oldProducts.length-1].ProductRetailPrice;
        }
    });
    tableBody.innerHTML = "";
    let index = 0;

    oldProducts.forEach(product => {
        index++;
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
                                <input type="number" name="quantity" min="1" value=${product.ProductQuantities} currentIndex=${index}>
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
                                <i class="fa-solid fa-trash" delete-id=${index}></i>
                            </div>
                        </td>
                    </tr>`;
        tableBody.insertAdjacentHTML("beforeend", row);
    });

    const deleteIcon = document.querySelectorAll(".main .content .body .list .order-list table tr td .icon i");
    if(deleteIcon.length > 0) {
        deleteIcon.forEach(item => {
            item.addEventListener("click", () => {
                const deleteID = item.getAttribute("delete-id");
                const removeTR = document.querySelector(`.main .content .body .list .order-list table tbody tr:nth-child(${Number(deleteID)})`);
                const deletedMessage = confirm("Bạn có chắc muốn xóa sản phẩm này ?");
                if(deletedMessage == true) {
                    removeTR.remove();
                    oldProducts.splice(Number(deleteID)-1,1);
                }
            });
        });
    }

    const lastValue = document.querySelectorAll(".main .content .body .list .order-list table tbody tr:last-child td .product-name .product-info .name")[0].innerText;
    const tableItems = document.querySelectorAll(".main .content .body .list .order-list table tbody tr td .product-name .product-info .name");

    if(tableItems.length > 0) {
        let check = 0;
        let arr = [];
        tableItems.forEach(tr => {
            arr.push(tr.innerHTML.trim());
            if(tr.innerHTML.trim() == lastValue){
                check++;
                if(check == 2) {
                    const index = arr.indexOf(tr.innerHTML.trim());
                    const updateValue = document.querySelector(`.main .content .body .list .order-list table tbody tr:nth-child(${index+1})`);
                    let num = Number(updateValue.querySelector("td:nth-child(2) .num input").value);
                    num++;
                    updateValue.querySelector("td:nth-child(2) .num input").value = num;
                    const unit = updateValue.querySelector("td:nth-child(3) .price").innerHTML;
                    let newAmount = Number(unit) * Number(num);
                    oldProducts[index].ProductQuantities = parseInt(num);
                    oldProducts[index].ProductTotal = newAmount;
                    updateValue.querySelector(`td:nth-child(4) .total`).innerHTML = newAmount.toString();

                    
                    const deleteValue = document.querySelector(".main .content .body .list .order-list table tbody tr:last-child");
                    deleteValue.remove();
                    oldProducts.pop();
                    alert(`Sản phẩm ${lastValue} đã tồn tại trong giỏ hàng ! Cập nhật số lượng sản phẩm ${lastValue}`);
                }
            }
        });
    }


    const quantites = document.querySelectorAll(".main .content .body .list .order-list table tr td .num input[name='quantity']");
    if(quantites) {
        quantites.forEach(item => {
            item.addEventListener("change",() => {
                const currentIndexValue = item.getAttribute("currentIndex");
                const unitPrice = document.querySelector(`.main .content .body .list .order-list table tbody tr:nth-child(${currentIndexValue}) td:nth-child(3) .price`).innerHTML;
                let newTotal = Number(unitPrice) * Number(item.value);
                document.querySelector(`.main .content .body .list .order-list table tbody tr:nth-child(${currentIndexValue}) td:nth-child(4) .total`).innerHTML = newTotal.toString();
                oldProducts[currentIndexValue-1].ProductQuantities = parseInt(item.value);
                oldProducts[currentIndexValue-1].ProductTotal = newTotal;
                
            });
        });
    }
    const totalItem = document.querySelector(".main .content .body .list .num-desc .num");
    let newTitle = "Sản phẩm hiện tại : " + index.toString();
    totalItem.innerHTML = newTitle;

}

// Checkout Button
async function postData(url = '', data = {}) {
    const responsePost = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: data
    });
    return responsePost.json();
}

const checkoutButton = document.querySelector(".main .content .body .list .button .checkout");
if(checkoutButton) {
    checkoutButton.addEventListener("click",() => {

        let sendData = JSON.stringify(oldProducts);
        postData("http://localhost:8080/FinalWeb/api/TransactionProcessing/post-save-product.php",sendData);
        
        window.location.href = "http://localhost:8080/FinalWeb/CheckoutInformation.php";

    });
}
// End Checkout Button