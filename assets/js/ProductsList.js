document.addEventListener("DOMContentLoaded",async () => {
    const checkURL = new URLSearchParams(window.location.search);

    function removeURLParameter(paramKey) {
        let url = new URL(window.location.href);
        let params = new URLSearchParams(url.search);
        params.delete(paramKey);
        window.history.replaceState({}, '', `${url.pathname}?${params.toString()}`);
    }

    if(checkURL.has('errorMessage')){
        alert("Sản phẩm đã được thanh toán. Không thể thực hiện thao tác xóa !");
        removeURLParameter('errorMessage');
    }

    fetchEmployeeDataAndUpdateHTML();

    async function fetchEmployeeDataAndUpdateHTML() {
        try {
            let api = "http://localhost:8080/FinalWeb/api/ProductCatalog/get-products.php";
            const res = await fetch(api);
            const data = await res.json();
            const arr = data.data;
            let header = "";
    
            const tableBody = document.querySelector(".main .content .body .body-content .second table tbody");
            const tableHead = document.querySelector(".main .content .body .body-content .second table thead");

            if(arr[0].ProductImportPrice != undefined){
                header = `
                    <tr>
                        <th>Barcode</th>
                        <th>Product Name</th>
                        <th>Import Price</th>
                        <th>Retail Price</th>
                        <th>Category</th>
                        <th>Creation Date</th>
                        <th>Action</th>
                    </tr>`;             
            }
            else {
                header = `
                    <tr>
                        <th>Barcode</th>
                        <th>Product Name</th>
                        <th>Retail Price</th>
                        <th>Category</th>
                        <th>Creation Date</th>
                        <th>Action</th>
                    </tr>`;
            }

            tableHead.insertAdjacentHTML("beforeend", header);
    
            arr.forEach(item => {
                let temp = "";
                if(item.ProductImportPrice != undefined) {
                    temp = `
                        <tr>
                            <td>
                            <div class="barcode">
                                ${item.ProductBarcode}
                            </div>
                            </td>
                            <td>
                                <div class="product-name">
                                    <div class="product-info">
                                        <div class="name">
                                            ${item.ProductName}
                                        </div>
                                        <div class="stock">
                                            Color: ${item.Color}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="import-price">
                                    ${item.ProductImportPrice} VND
                                </div>
                            </td>
                            <td>
                                <div class="retail-price">
                                    ${item.ProductRetailPrice} VND
                                </div>
                            </td>
                            <td>
                                <div class="category">
                                    ${item.CategoryName} 
                                </div>
                            </td>
                            <td>
                                <div class="creation-date">
                                    ${item.ProductCreatedDate}
                                </div>
                            </td>
                            <td>
                                <div class="action">
                                    <div class="view-product" view-id=${item.ProductBarcode}>
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                    <div class="update-product" update-id=${item.ProductBarcode}>
                                        <i class="fa-solid fa-pen"></i>
                                    </div>
                                    <div class="delete-product" delete-id=${item.ProductBarcode}>
                                        <i class="fa-solid fa-trash"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
                }
                else {        
                    temp = `
                        <tr>
                            <td>
                            <div class="barcode">
                                ${item.ProductBarcode}
                            </div>
                            </td>
                            <td>
                                <div class="product-name">
                                    <div class="product-info">
                                        <div class="name">
                                            ${item.ProductName}
                                        </div>
                                        <div class="stock">
                                            Color: ${item.Color}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="retail-price">
                                    ${item.ProductRetailPrice} VND
                                </div>
                            </td>
                            <td>
                                <div class="category">
                                    ${item.CategoryName} 
                                </div>
                            </td>
                            <td>
                                <div class="creation-date">
                                    ${item.ProductCreatedDate}
                                </div>
                            </td>
                            <td>
                                <div class="action">
                                    <div class="view-product" view-id=${item.ProductBarcode}>
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
                }
                tableBody.insertAdjacentHTML("beforeend", temp);
            });

    // View Employee
    const viewIcon = document.querySelectorAll(".main .content .body .body-content .second table tr td .action .view-product");
    viewIcon.forEach(item => {
        item.addEventListener("click",() => {
            const att = item.getAttribute("view-id");
            const link = local + "ViewProduct.php?id=" + att;
            window.location.href = link;
        });
    });
    // End View Employee

    // Update Employee
    const updateIcon = document.querySelectorAll(".main .content .body .body-content .second table tr td .action .update-product");
    if(updateIcon.length > 0) {
        updateIcon.forEach(item => {
            item.addEventListener("click",() => {
                const att = item.getAttribute("update-id");
                const link = local + "UpdateProduct.php?id=" + att;
                window.location.href = link;
            });
        });
    }
    // End Update Employee

    // Add Products
    const addButton = document.querySelector(".main .content .body .body-content .first .add-account");
    if(addButton) {
        addButton.addEventListener("click", () => {
            const addLink = local + "AddProduct.php";
            window.location.href = addLink;
        });
    }
    // End Add Products

    // Delete Products
    const deleteIcon = document.querySelectorAll(".main .content .body .body-content .second table tr td .action .delete-product");
    if(deleteIcon.length > 0) {
        deleteIcon.forEach(item => {
            item.addEventListener("click",() => {
                const att = item.getAttribute("delete-id");
                const message = confirm("Bạn có chắc muốn xóa sản phẩm này ?");

                if(message){
                    const link = "http://localhost:8080/FinalWeb/api/ProductCatalog/delete-product.php?id=" + att;
                    window.location.href = link;
                }
            
            });
        });
    }
    // End Delete Products

    // View Products
    const dataCheckType = async () => {
        const checkType = await fetch("http://localhost:8080/FinalWeb/api/AccountManagement/get-account-type.php");
        const dataCheck = await checkType.json();
        return dataCheck;
    }
    
    dataCheckType().then(data => {
        const type = parseInt(data.data[0].AccountType);
        const viewIcon = document.querySelector(".main .content .body .body-content .second table tr td .action .view-product");
        const proID = viewIcon.getAttribute("view-id");

        viewIcon.addEventListener("click",() => {
            if(type == 1) {
                window.location.href = "http://localhost:8080/FinalWeb/ViewProductEmployee.php?id=" + proID;
            }
            else {
                window.location.href = "http://localhost:8080/FinalWeb/ViewProduct.php?id=" + proID;
            }
        });
    });
    // End View Products

        } catch (error) {
            console.error("Lỗi khi fetch dữ liệu nhân viên từ API:", error);
        }
    }
});