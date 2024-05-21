const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

document.addEventListener("DOMContentLoaded",async () => {
    console.log(urlParams.get('id'));
    let api = "http://localhost:8080/FinalWeb/api/AccountManagement/view-salesperson-id.php?id=" + urlParams.get('id');
    const res = await fetch(api);
    const data = await res.json();

    const arr = data.data[0];

    const form = document.querySelector(".main .content .body .add-product .content form");

    const content = `
    <div class="fifth">
        <div class="date-input">
            <label for="stock">Full Name</label>
            <input type="text" name="fullname" id="fullname" value="${arr.SalesPersonFullName}" required>
        </div>
        <div class="barcode-input">
            <label for="barcode">Email</label>
            <input type="email" name="email" id="email" value="${arr.SalesPersonEmailAddress}" required>
        </div>
    </div>
    <div class="third">
        <div class="left-input">
            <div class="dob">
                <label for="stock">Date of Birth</label>
                <input type="date" name="dob" id="dob" value=${arr.SalesPersonDateOfBirth} required>
            </div>
            <div class="gender" value=${arr.SalesPersonGender}>
                <label for="gender">Gender</label>
                <select name="gender" id="gender" required>
                    <option value="male">Nam</option>
                    <option value="female">Nữ</option>
                </select>
            </div>
        </div>
        <div class="email-input">
            <label for="email">Phone</label>
            <input type="text" name="phone" id="phone" value="0123456789" required>
        </div>
    </div>
    <div class="first">
        <div class="address-input">
            <label for="retail">Address</label>
            <input type="text" name="address" id="address" value="${arr.SalesPersonAddress}" required>
        </div>
    </div>
    <div class="fourth">
        <div class="picture">
            <label for="choose=pic">Picture :</label>
        </div>
        <div class="image">
        <input name="avatar" type="file" class="custom-file-input" id="customFile" accept="image/gif, image/jpeg, image/png, image/bmp">
            <img id="ava_preview" src="${arr.SalesPersonAvatar}" alt="">
        </div>
    </div>
    <button class="submit-product" type="submit">Done</button>`
;
    form.insertAdjacentHTML("beforeend", content);

    // Image Change
    const fileInput = document.getElementById('customFile');
    const imagePreview = document.querySelector('#ava_preview');

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    // End Image Change

    // Submit Content
    const submitButton = document.querySelector(".main .content .body .add-product .content form .submit-product");
    submitButton.addEventListener("click",() => {
        const form = document.querySelector(".main .content .body .add-product .content form");
        form.action = `http://localhost:8080/FinalWeb/update-salesperson-info.php?id=${urlParams.get('id')}`;
    });
    // End Submit Content
});