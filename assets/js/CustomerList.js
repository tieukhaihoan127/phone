document.addEventListener("DOMContentLoaded",async () => {
    const checkURL = new URLSearchParams(window.location.search);

    fetchEmployeeDataAndUpdateHTML();


    async function fetchEmployeeDataAndUpdateHTML() {
        try {
            let api = "http://localhost:8080/FinalWeb/api/CustomerManagement/get-customer.php";
            const res = await fetch(api);
            const data = await res.json();
            const arr = data.data;
    
            const tableBody = document.querySelector(".main .content .body .customer-list table tbody");
    
            arr.forEach(item => {
                const temp = `<tr>
                                <td>
                                    <div class="customer">
                                        <div class="name">
                                            ${item.CustomerName}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="phone">
                                        ${item.CustomerNumberphone}
                                    </div>
                                </td>
                                <td>
                                    <div class="address">
                                        ${item.CustomerAddress}
                                    </div>
                                </td>
                                <td>
                                    <button class="purchase-history" view-id=${item.CustomerNumberphone}>
                                        View
                                    </button>
                                </td>
                                <td>
                                    <div class="action">
                                        <div class="view-customer">
                                            <i class="fa-regular fa-eye" customer-id=${item.CustomerNumberphone}></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>`;
        
                tableBody.insertAdjacentHTML("beforeend", temp);
            });

            // View Customer Purchase History
            const viewPurchase = document.querySelectorAll(".main .content .body .customer-list table tr td .purchase-history");
            if(viewPurchase.length > 0) {
                viewPurchase.forEach(item => {
                    item.addEventListener("click",() => {
                        const att = item.getAttribute("view-id");
                        const link = local + "OrderList.php?id=" + att;
                        window.location.href = link;
                    });
                });
            }
            // End View Customer Purchase History

            const viewIcon = document.querySelectorAll(".main .content .body .customer-list table tr td .action .view-customer i");
            if(viewIcon.length > 0) {
                viewIcon.forEach(item => {
                    item.addEventListener("click",() => {
                        const id = item.getAttribute("customer-id");
                        window.location.href = `http://localhost:8080/FinalWeb/CustomerDetail.php?id=${id}`;
                    });
                });
            }
            

        } catch (error) {
            console.error("Lỗi khi fetch dữ liệu nhân viên từ API:", error);
        }
    }
});