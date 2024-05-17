const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
let api = "";
if(urlParams.has('id')) {
    const id = urlParams.get('id');
    api = "http://localhost:8080/api-phone-system-mangement/AccountManagement/view-salesperson-id.php?id=" + id;
}



document.addEventListener("DOMContentLoaded",async () => {
    const res = await fetch(api);
    const data = await res.json();
    const arr = data.data[0];

    const form = document.querySelector(".main .content .body .add-product .content form");

    const content = `
    <div class="fifth">
        <div class="date-input">
            <label for="stock">Email</label>
            <input type="text" name="email" id="email" value="${arr.SalesPersonEmailAddress}" disabled>
        </div>
        <div class="barcode-input">
            <label for="barcode">Full Name</label>
            <input type="email" name="fullname" id="fullname" value="${arr.SalesPersonFullName}" disabled>
        </div>
    </div>
    <div class="third">
        <div class="left-input">
            <div class="dob">
                <label for="stock">Date of Birth</label>
                <input type="date" name="dob" id="dob" value=${arr.SalesPersonDateOfBirth} disabled>
            </div>
            <div class="gender" value="${arr.SalesPersonGender}">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" disabled>
                    <option value="male">Nam</option>
                    <option value="female">Nữ</option>
                </select>
            </div>
        </div>
        <div class="email-input">
            <label for="email">Phone</label>
            <input type="text" name="phone" id="phone" value="0123456789" disabled>
        </div>
    </div>
    <div class="first">
        <div class="address-input">
            <label for="retail">Address</label>
            <input type="text" name="address" id="address" value="${arr.SalesPersonAddress}" disabled>
        </div>
    </div>
    <div class="fourth">
        <div class="picture">
            <label for="choose=pic">Picture :</label>
        </div>
        <div class="image">
            <img src="${arr.SalesPersonAvatar}" alt="">
        </div>
    </div>
    <div class="submit-product" type="submit">Done</div>`
;
    form.insertAdjacentHTML("beforeend", content);

    const doneButton = document.querySelector(".main .content .body .add-product .content form .submit-product");
    if(doneButton) {
        doneButton.addEventListener("click", () => {
            const listLink = local + "EmployeesList.php";
            window.location.href = listLink;
        });
    }
});