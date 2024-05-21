document.addEventListener("DOMContentLoaded",async () => {
    fetchEmployeeDataAndUpdateHTML();

    async function fetchEmployeeDataAndUpdateHTML() {
        try {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            let api = "http://localhost:8080/FinalWeb/api/CustomerManagement/view-customer.php?id=" + urlParams.get('id');
            const res = await fetch(api);
            const data = await res.json();
            console.log(data);
            const arr = data.data[0];
    
            const form = document.querySelector(".main .content .body .register-customer .register-form");

            const content = `<div class="first">
                                <div class="fullname-input">
                                    <div class="fullname">
                                        Full Name
                                    </div>
                                    <input type="text" name="fullname" id="fullname" value="${arr.CustomerName}"  disabled>
                                </div>
                                <div class="phone-input">
                                    <div class="phone">
                                        Phone Number
                                    </div>
                                    <input type="text" name="phone" id="phone" value="${arr.CustomerNumberphone}"  disabled>
                                </div>
                            </div>
                            <div class="second">
                                <div class="address-input">
                                    <div class="address">
                                        Address
                                    </div>
                                    <input type="text" name="address" id="address" value="${arr.CustomerAddress}"  disabled>
                                </div>
                            </div>
                            <div class="submit-phone" type="submit">Confirm</div>`;

        form.insertAdjacentHTML("beforeend",content);

        const doneButton = document.querySelector(".main .content .body .register-customer .register-form .submit-phone");
        doneButton.addEventListener("click",() => {
            window.location.href = "http://localhost:8080/FinalWeb/CustomerList.php";
        });

        } catch (error) {
            console.error("Lỗi khi fetch dữ liệu nhân viên từ API:", error);
        }
    }
});