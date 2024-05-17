document.addEventListener("DOMContentLoaded",async () => {
    
    fetchEmployeeDataAndUpdateHTML();


    async function fetchEmployeeDataAndUpdateHTML() {
        try {
            const checkURL = new URLSearchParams(window.location.search);

            let api = "http://localhost:8080/FinalWeb/api/CustomerManagement/get-customer-order-detail.php?id=" + checkURL.get('id');
            const res = await fetch(api);
            const data = await res.json();

            console.log(data);
    
            const tableBody = document.querySelector(".main .content .body .order-detail .order-desc .order-detail-items .order-table table tbody");
            const id = document.querySelector(".main .content .body .order-detail .order-first .order-info .detail-table table tr td .content");
            const name = document.querySelector(".main .content .body .order-detail .order-first .order-info .detail-table table tr td .name");
            const date = document.querySelector(".main .content .body .order-detail .order-first .order-info .detail-table table tr td .date");
            const total = document.querySelector(".main .content .body .order-detail .order-first .order-detail-info .detail-table table tr:nth-child(1) td .price");
            const given = document.querySelector(".main .content .body .order-detail .order-first .order-detail-info .detail-table table tr:nth-child(2) td .price");
            const paid = document.querySelector(".main .content .body .order-detail .order-first .order-detail-info .detail-table table tr:last-child td .price");

            id.innerHTML = data.InvoiceID;
            name.innerHTML = data.CustomerName;
            date.innerHTML = data.InvoiceDateTime;
            total.innerHTML = data.TotalSum + " VND";
            given.innerHTML = data.GivenMoney + " VND";
            paid.innerHTML = data.PaidBack + " VND";

            const arr = data.CheckoutDetail;
            
                arr.forEach(item => {
                    const temp = `<tr>
                                    <td>
                                        <div class="item">
                                            ${item.ProductName}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="item">
                                            ${item.ProductColor}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="quantity">
                                            ${item.ProductQuantities}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="price">
                                            ${item.ProductUnitPrice} VND
                                        </div>
                                    </td>
                                    <td>
                                        <div class="total">
                                            ${item.ProductTotal} VND
                                        </div>
                                    </td>
                                </tr>`;

                    tableBody.insertAdjacentHTML("beforeend", temp);
                });
    
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