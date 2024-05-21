
document.addEventListener("DOMContentLoaded", async () => {

    // Thêm mới hóa đơn 
    async function updatedData(updateData) {
        try {
    
            const response = await fetch('http://localhost:8080/FinalWeb/api/TransactionProcessing/update-info.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: updateData
            });
    
            return response.json();
        } catch (error) {
            console.error('There was a problem with the fetch operation:', error);
        }
    }

    let isNewUser = false; // Kiểm tra phải người dùng mới 

    fetchEmployeeDataAndUpdateHTML();

    async function fetchEmployeeDataAndUpdateHTML(api = "http://localhost:8080/FinalWeb/api/TransactionProcessing/get-invoice-detail.php") {
        try {
            const res = await fetch(api);
            const data = await res.json();

            const orderInformation = document.querySelector(".main .content .body .order-detail .order-first .order-info .detail-table table tbody");
            const orderSummary = document.querySelector(".main .content .body .order-detail .order-first .order-detail-info .detail-table table tbody");

            let orderInformationContent = `<tr>
                                                <td>
                                                    <div class="desc">
                                                        Order Id :
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="content">
                                                        ${data.InvoiceID}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="desc">
                                                        Date Of Purchase :
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="date">
                                                        ${data.InvoiceDateTime}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="desc">
                                                        Employee Name :
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="name">
                                                        ${data.EmployeeName}
                                                    </div>
                                                </td>
                                            </tr>`;
            
            orderInformation.insertAdjacentHTML("beforeend", orderInformationContent);
            
            let orderSummaryContent = `<tr>
                                            <td>
                                                <div class="desc">
                                                    Total Amount:
                                                </div>
                                            </td>
                                            <td>
                                                <div class="price">
                                                    ${data.TotalSum} VND
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="desc">
                                                    Given Money :
                                                </div>
                                            </td>
                                            <td>
                                                <div class="price">
                                                    <input type="text" name="given-price"> VND
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="desc">
                                                    Paid Back :
                                                </div>
                                            </td>
                                            <td>
                                                <div class="price">
                                                    ${0 - parseInt(data.TotalSum)} VND
                                                </div>
                                            </td>
                                        </tr>`;

            orderSummary.insertAdjacentHTML("beforeend", orderSummaryContent);

            // Check Customer
            const checkButton = document.querySelector(".main .content .body .order-detail .order-second .order-customer-info .detail-customer .first .phone-input .phone .check");
            let phone = document.querySelector(".main .content .body .order-detail .order-second .order-customer-info .detail-customer .first .phone-input input[name='phone']");
            let name = document.querySelector(".main .content .body .order-detail .order-second .order-customer-info .detail-customer .first .fullname-input input[name='fullname']");
            let address = document.querySelector(".main .content .body .order-detail .order-second .order-customer-info .detail-customer .second input[name='address']");

            if(checkButton) {
                checkButton.addEventListener("click", async () => {
                    const inputValue = phone.value;
                    const checkLink = "http://localhost:8080/FinalWeb/api/CustomerManagement/get-customer-by-phone.php?phone=" + inputValue; 
                    const re = await fetch(checkLink);

                    const existPhone = await re.json();
                    if(existPhone.length == undefined) {
                        name.value = existPhone.CustomerName;
                        address.value = existPhone.CustomerAddress;
                    }
                    else {
                        isNewUser = true;
                        name.value = "";
                        address.value = "";
                        alert("Tài khoản khách hàng chưa tồn tại !");
                    }
;                });
            }
            // End Check Customer

            // Customer Given Money
            const givenInput = document.querySelector(".main .content .body .order-detail .order-first .order-detail-info .detail-table table tr td .price input[name='given-price']");
            let totalPrice = document.querySelector(".main .content .body .order-detail .order-first .order-detail-info .detail-table table tr:last-child td .price");
            if(givenInput) {
                givenInput.addEventListener("blur", () => {
                    if(givenInput.value == "") {
                        totalPrice.innerHTML = "-" + data.TotalSum.toString() + " VND";
                    }
                    else {
                        const totalAmount = parseInt(data.TotalSum);
                        let newTotal = parseInt(givenInput.value) - totalAmount;
                        totalPrice.innerHTML = newTotal.toString() + " VND";
                    }
                });
            }
            // End Customer Given Money

            // Confirm Checkout Information
            const confirmButton = document.querySelector(".main .content .body .order-detail .order-second .order-function .button .confirm");
            if(confirmButton) {
                confirmButton.addEventListener("click",async () => {
                    if(phone.value == "" || name.value == "" || address.value == ""){
                        alert("Vui lòng điền đầy đủ thông tin khách hàng !");
                        return;
                    }

                    let paidBack = parseInt(totalPrice.innerHTML.trim().split(" ")[0]);
                    if(paidBack < 0) {
                        alert("Khách hàng chưa trả đủ tiền !");
                        return;
                    }

                    const updateData = {
                        CustomerPhoneNumber: phone.value,
                        CustomerGivenMoney: parseInt(givenInput.value),
                        CustomerPaidBack: paidBack
                    };

                    if(isNewUser == true) {
                        updateData.CustomerName = name.value;
                        updateData.CustomerAddress = address.value;
                    }

                    let sendData = JSON.stringify(updateData);
                    await updatedData(sendData)                    
                    window.location.href = "http://localhost:8080/FinalWeb/Invoice.php";
        
                });
            }
            // End Confirm Checkout Information

            // Back Information
            const back = document.querySelector(".main .content .body .order-detail .order-second .order-function .button .back");
            if(back) {
                back.addEventListener("click",() => {
                    window.location.href = "http://localhost:8080/FinalWeb/CheckoutOrderList.php";
                });
            }
            // End Back Information


        } catch (error) {
            console.error("Lỗi khi fetch dữ liệu nhân viên từ API:", error);
        }
    }
});


