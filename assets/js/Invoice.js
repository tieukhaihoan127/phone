
document.addEventListener("DOMContentLoaded", async () => {
  
    fetchEmployeeDataAndUpdateHTML();

    async function fetchEmployeeDataAndUpdateHTML(api = "http://localhost:8080/FinalWeb/api/TransactionProcessing/get-invoice.php") {
        try {
            const res = await fetch(api);
            const data = await res.json();

            const customerName = document.querySelector(".main .content .body .invoice-content .second .left .name");
            const customerAddress = document.querySelector(".main .content .body .invoice-content .second .left .address");
            const customerPhone = document.querySelector(".main .content .body .invoice-content .second .left .phone");
            const invoiceID = document.querySelector(".main .content .body .invoice-content .second .right .id");
            const employeeName = document.querySelector(".main .content .body .invoice-content .second .right .e-name");
            const date = document.querySelector(".main .content .body .invoice-content .second .right .date");
            const totalMoney = document.querySelector(".main .content .body .invoice-content .total-amount .price");

            customerName.innerHTML = data.CustomerName;
            customerAddress.innerHTML = data.CustomerAddress;
            customerPhone.innerHTML = data.CustomerPhone;
            invoiceID.innerHTML = data.InvoiceID;
            employeeName.innerHTML = data.EmployeeName;
            date.innerHTML = data.InvoiceDateTime;
            totalMoney.innerHTML = data.TotalSum + " VND";

            const productDetail = document.querySelector(".main .content .body .invoice-content .invoice-table table tbody");
            const arr = data.CheckoutDetail;

            arr.forEach((item,index) => {
                let temp = `<tr>
                                <th>
                                    <div class="num">
                                        ${index+1}
                                    </div>
                                </th>
                                <td>
                                    <div class="product">
                                        <div class="product-name">
                                            ${item.ProductName}
                                        </div>
                                        <div class="color">
                                            Color: ${item.ProductColor}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="price">
                                        ${item.ProductUnitPrice} VND
                                    </div>
                                </td>
                                <td>
                                    <div class="quantity">
                                        ${item.ProductQuantities}
                                    </div>
                                </td>
                                <td>
                                    <div class="total">
                                        ${item.ProductTotal} VND
                                    </div>
                                </td>
                            </tr>`;
                productDetail.insertAdjacentHTML("beforeend",temp);
            });

            // Print Invoice
            // window.onload = function() {
            //     const invoice = document.querySelector("#invoice");
            //     if (invoice) {
            //         const newWindow = window.open("", "_blank");
            //         if (newWindow) {

            //             const cssFiles = [
            //                 "./assets/css/base.css",
            //                 "./assets/css/Invoice.css",
            //                 "./assets/css/AdminDashboard.css"
            //             ];
            
            //             // Thêm các tệp CSS vào cửa sổ mới
            //             cssFiles.forEach(function(cssFile) {
            //                 const link = document.createElement('link');
            //                 link.rel = 'stylesheet';
            //                 link.href = cssFile;
            //                 newWindow.document.head.appendChild(link);
            //             });

            //             // Ghi nội dung HTML vào cửa sổ mới
            //             newWindow.document.documentElement.innerHTML = invoice.outerHTML;
            
            //             newWindow.print();
            //             newWindow.close();
            //         } else {
            //             alert("Your browser blocked the popup window. Please allow popups to print.");
            //         }
            //     } else {
            //         console.error("Element with id 'invoice' not found.");
            //     }
            // };


        } catch (error) {
            console.error("Lỗi khi fetch dữ liệu nhân viên từ API:", error);
        }
    }
});


