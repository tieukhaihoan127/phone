document.addEventListener("DOMContentLoaded",async () => {
    fetchEmployeeDataAndUpdateHTML();

    async function fetchEmployeeDataAndUpdateHTML() {
        try {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            let api = "http://localhost:8080/FinalWeb/api/ProductCatalog/view-product.php?id=" + urlParams.get('id');
            const res = await fetch(api);
            const data = await res.json();
            console.log(data);
            const arr = data.data[0];
    
            const form = document.querySelector(".main .content .body .add-product .content form");

            const content = `<div class="fifth">
                                <div class="barcode-input">
                                    <label for="barcode">Barcode :</label>
                                    <input type="text" name="barcode" id="barcode" value="${arr.ProductBarcode}" disabled>
                                </div>
                                <div class="date-input">
                                    <label for="stock">Creation Date :</label>
                                    <input type="text" name="date" id="date" value="${arr.ProductCreatedDate}" disabled>
                                </div>
                            </div>
                            <div class="second">
                                <div class="import-input">
                                    <label for="import">Product Name :</label>
                                    <input type="text" name="import" id="import" value="${arr.ProductName}" disabled>
                                </div>
                                <div class="retail-input">
                                    <label for="retail">Retail Price :</label>
                                    <input type="text" name="retail" id="retail" value="${arr.ProductRetailPrice}" disabled>
                                </div>
                            </div>
                            <div class="third">
                                <div class="category-input">
                                    <label for="category">Category :</label>
                                    <input type="text" name="category" id="category" value="${arr.CategoryName}" disabled>
                                </div>
                                <div class="stock-input">
                                    <label for="stock">Color :</label>
                                    <input type="text" name="stock" id="stock" value="${arr.Color}" disabled>
                                </div>
                            </div>
                            <div class="submit-product" type="submit">Done</div>`;

        form.insertAdjacentHTML("beforeend",content);

        const doneButton = document.querySelector(".main .content .body .add-product .content form .submit-product");
        doneButton.addEventListener("click",() => {
            window.location.href = "http://localhost:8080/FinalWeb/ProductsList.php";
        });
        
        } catch (error) {
            console.error("Lỗi khi fetch dữ liệu nhân viên từ API:", error);
        }
    }
});