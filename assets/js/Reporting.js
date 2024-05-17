document.addEventListener("DOMContentLoaded", async () => {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('status')) {
        let link = "http://localhost:8080/FinalWeb/api/ReportingAndAnalytics/get-reports.php?status=" + urlParams.get('status');
        fetchEmployeeDataAndUpdateHTML(link);
        const selectedBox = document.querySelector(".main .content .body .body-content .reporting-content .search-time select");
        const options = document.querySelectorAll(".main .content .body .body-content .reporting-content .search-time select option");
        let index = 0;
        options.forEach(item => {
            if (item.value == urlParams.get('status')) {
                selectedBox.selectedIndex = index;
            }
            index++;
        });
    }
    else if(urlParams.has('first') && urlParams.has('second')){
        let newLink = "http://localhost:8080/FinalWeb/api/ReportingAndAnalytics/get-reports.php?first=" + urlParams.get('first') + "&second=" + urlParams.get('second');
        const input = document.querySelectorAll(".main .content .body .body-content .reporting-content .specific-time input");
        input[0].value = urlParams.get('first');
        input[1].value = urlParams.get('second');
        fetchEmployeeDataAndUpdateHTML(newLink);
    }
    else {
        fetchEmployeeDataAndUpdateHTML();
    }

    async function fetchEmployeeDataAndUpdateHTML(api = "http://localhost:8080/FinalWeb/api/ReportingAndAnalytics/get-reports.php") {
        try {
            const res = await fetch(api);
            const data = await res.json();
            const arr = data.data;
            let totalMoney = 0;
            let numOrders = 0;
            let numProducts = 0;

            const tableBody = document.querySelector(".main .content .body .body-content .order-list table tbody");

            arr.forEach(item => {
                let first = parseInt(item.AmountMoneyCustomerGiven);
                let second = parseInt(item.AmountMoneyBackCustomer);
                const quantities = item.InvoiceQuantites;
                let total = first + second;
                totalMoney += total;
                numOrders++;
                numProducts += Number(quantities);
                let temp = `
                <tr>
                    <td>
                    <div class="order-id">
                        ${item.InvoiceID}
                    </div>
                </td>
                <td>
                    <div class="customer-name">
                        ${item.CustomerName}
                    </div>
                </td>
                <td>
                    <div class="total-amount">
                        ${total} VND
                    </div>
                </td>
                <td>
                    <div class="date">
                        ${item.InvoiceDateTime}
                    </div>
                </td>
                <td>
                    <div class="quantities">
                        ${item.InvoiceQuantites}
                    </div>
                </td>
                <td>
                    <button class="view-detail" view-id=${item.InvoiceID}>
                        View
                    </button>
                </td>
            </tr>`;

                tableBody.insertAdjacentHTML("beforeend", temp);
            });

            if (totalMoney && numOrders && numProducts) {
                const reportingCurrent = document.querySelector(".main .content .body .body-content .reporting-current .report-current-content");
                let valueTotal = `
                <div class="total">
                    Total amount received : ${totalMoney.toString()} VND
                </div>
                <div class="number-orders">
                    Number of orders : ${numOrders.toString()}
                </div>
                <div class="number-products">
                    Number of products : ${numProducts.toString()}
                </div>`;

                reportingCurrent.insertAdjacentHTML("beforeend", valueTotal);
            }

            // Select Current Time Status
            const comboBox = document.querySelector(".main .content .body .body-content .reporting-content .search-time select");
            if (comboBox) {
                comboBox.addEventListener("change", () => {
                    let url = new URL(window.location.href);
                    let searchParams = url.searchParams;
                    searchParams.delete('first');
                    searchParams.delete('second');
                    window.history.replaceState(null, null, url.toString());
                    let currentStatus = comboBox.value;
                    const checkURL = new URLSearchParams(window.location.search);
                    if (checkURL.has('status')) {
                        checkURL.set('status', currentStatus);
                        let newUrl = window.location.pathname + '?' + checkURL.toString();
                        window.history.replaceState({}, '', newUrl);
                        window.location.href = newUrl;
                    }
                    else {
                        checkURL.append('status', currentStatus);
                        let link = window.location.href + "?" + checkURL.toString();
                        window.location.href = link;
                    }

                });
            }
            // End Select Current Time Status

            // Filter Time
            const filterTime = document.querySelector(".main .content .body .body-content .reporting-content .specific-time button");
            if(filterTime) {
                filterTime.addEventListener("click", () => {
                    const input = document.querySelectorAll(".main .content .body .body-content .reporting-content .specific-time input");
                    let url = new URL(window.location.href);
                    let searchParams = url.searchParams;
                    searchParams.delete('status');
                    window.history.replaceState(null, null, url.toString());
                    if(input[0].value == "" || input[1].value == "") {
                        alert("Bạn phải điền đầy đủ thời gian cần tìm kiếm !");
                    }
                    else if(input[0].value >= input[1].value){
                        alert("Thời gian cần tìm kiếm không hợp lệ !");
                    }
                    else {
                        const link = local + "Reporting.php?first=" + input[0].value + "&second=" + input[1].value;
                        window.location.href = link;
                    }

                });
            }
            // End Filter Time

            // View Detail Order
            const viewButton = document.querySelectorAll(".main .content .body .body-content .order-list table tr td .view-detail");
            if(viewButton.length > 0){
                viewButton.forEach(item => {
                    item.addEventListener("click",() => {
                        const att = item.getAttribute("view-id");
                        let link = local + "OrderDetail.php?id=" + att;
                        window.location.href = link;
                    });
                });
            }
            // End View Detail Order


        } catch (error) {
            console.error("Lỗi khi fetch dữ liệu nhân viên từ API:", error);
        }
    }
});