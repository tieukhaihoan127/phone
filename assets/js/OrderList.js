document.addEventListener("DOMContentLoaded",async () => {
    
    fetchEmployeeDataAndUpdateHTML();


    async function fetchEmployeeDataAndUpdateHTML() {
        try {
            const checkURL = new URLSearchParams(window.location.search);
            let api = "http://localhost:8080/FinalWeb/api/CustomerManagement/get-customer-purchase.php?id=" + checkURL.get('id');
            const res = await fetch(api);
            const data = await res.json();
    
            const tableBody = document.querySelector(".main .content .body .order-list table tbody");
            const name = document.querySelector(".main .content .body .order-list-view .customer-info .name .content");
            const phone = document.querySelector(".main .content .body .order-list-view .customer-info .phone .content");
            const address = document.querySelector(".main .content .body .order-list-view .customer-info .address .content");

            name.innerHTML = data.CustomerName;
            phone.innerHTML = data.CustomerPhone;
            address.innerHTML = data.CustomerAddress;

            const arr = data.OrderList;
            
            if(arr.length > 1) {
                arr.forEach(item => {
                    const temp = `<tr>
                                        <td>
                                            <div class="order-id">
                                                ${item.OrderID}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="total-amount">
                                            ${parseInt(item.OrderCustomerGivenMoney) - parseInt(item.OrderCustomerPaidBack)} VND
                                            </div>
                                        </td>
                                        <td>
                                            <div class="given-money">
                                            ${item.OrderCustomerGivenMoney}  VND
                                            </div>
                                        </td>
                                        <td>
                                            <div class="paid-back">
                                            ${item.OrderCustomerPaidBack} VND
                                            </div>
                                        </td>
                                        <td>
                                            <div class="date">
                                                ${item.OrderDateTime}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="quantities">
                                                ${item.OrderQuantities}
                                            </div>
                                        </td>
                                        <td>
                                            <button class="view-detail" view-id="${item.OrderID}">
                                                View
                                            </button>
                                        </td>
                                    </tr>`;

                    tableBody.insertAdjacentHTML("beforeend", temp);
                });
            }
    
        const viewButton = document.querySelectorAll(".main .content .body .order-list table tr td .view-detail");

        if(viewButton.length > 0) {
            viewButton.forEach(item => {
                item.addEventListener("click",() => {
                    const orderID = item.getAttribute("view-id");
                    let link = local + "OrderDetail.php?id=" + orderID;
                    window.location.href = link;
                });
            });
        }


        } catch (error) {
            console.error("Lỗi khi fetch dữ liệu nhân viên từ API:", error);
        }
    }
});