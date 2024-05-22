const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

const id = urlParams.get('id')
const api = "http://localhost:8080/FinalWeb/api/ProductCatalog/view-product.php?id=" + id;

document.addEventListener("DOMContentLoaded",async () => {
    const res = await fetch(api);
    const data = await res.json();
    const arr =data.data[0];


    const form = document.querySelector(".main .content .body .add-product .content form");

    const content = `
        <div class="first">
            <label for="fullname">Product Name :</label>
            <input type="text" name="fullname" id="fullname" value="${arr.ProductName}" required>
        </div>
        <div class="second">
        <div class="import-input">
            <label for="import">Import Price :</label>
            <input type="text" name="import" id="import" value=${arr.ProductImportPrice} required>
        </div>
        <div class="retail-input">
            <label for="retail">Retail Price :</label>
            <input type="text" name="retail" id="retail" value=${arr.ProductRetailPrice} required>
        </div>
        </div>
        <div class="third">
        <div class="category-input">
            <label for="category">Category :</label>
            <input type="text" name="category" id="category" value="${arr.CategoryName}" required>
        </div>
        <div class="stock-input">
            <label for="stock">Color :</label>
            <input type="text" name="stock" id="stock" value="${arr.Color}" required>
        </div>
        </div>
        <button class="submit-product" type="submit">Update</button>`
;
    form.insertAdjacentHTML("beforeend", content);

    form.action = "http://localhost:8080/FinalWeb/api/ProductCatalog/update-product.php?id=" + id;

});
