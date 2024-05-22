document.addEventListener("DOMContentLoaded",async () => {
    const checkURL = new URLSearchParams(window.location.search);

    function removeURLParameter(paramKey) {
        let url = new URL(window.location.href);
        let params = new URLSearchParams(url.search);
        params.delete(paramKey);
        window.history.replaceState({}, '', `${url.pathname}?${params.toString()}`);
    }

    if(checkURL.has('id') && checkURL.has('status')){
        let change = "http://localhost:8080/FinalWeb/api/AccountManagement/change-lock-status.php?id=" + checkURL.get('id') + "&status=" + checkURL.get('status');
        await fetch(change);
        fetchEmployeeDataAndUpdateHTML();
    }
    else if(checkURL.has('search')){
        let searchApi = "http://localhost:8080/FinalWeb/api/AccountManagement/get-salesperson-search.php?search=" + checkURL.get('search');
        fetchEmployeeDataAndUpdateHTML(searchApi);

    }
    else {
        fetchEmployeeDataAndUpdateHTML();
    }

    async function fetchEmployeeDataAndUpdateHTML(api = "http://localhost:8080/FinalWeb/api/AccountManagement/get-salesperson.php") {
        try {
            const res = await fetch(api);
            const data = await res.json();
            const arr = data.data;

    
            const tableBody = document.querySelector(".main .content .body .body-content .second table tbody");
    
            // Render ra danh sách nhân viên, nếu nhân viên có SalesPersonLockAccount = 0 tức nghĩa là tài khoản không bị khóa, nếu nhân viên có SalesPersonInactivate = 0 tức nghĩa là tài khoản đã kích hoạt , vô hiệu hóa nút resend
            arr.forEach(item => {
                const temp = `
                <tr>
                    <td>
                        ${item.SalesPersonID}
                    </td>
                    <td>
                        <div class="employee">
                            <img src=${item.SalesPersonAvatar} alt="">
                            <div class="name">
                                ${item.SalesPersonFullName}
                            </div>
                        </div>
                    </td>
                    <td>
                        <button class="status ${item.SalesPersonInactivate == 0 ? "" : "active"}" status-id=${item.SalesPersonID}>
                            ${item.SalesPersonInactivate == 0 ? "Active" : "Inactive"}
                        </button>
                    </td>
                    <td>
                        <button class="manage ${item.SalesPersonLockAccount == 0 ? "" : "active"}" lock-id=${item.SalesPersonID}>
                            ${item.SalesPersonLockAccount == 0 ? "Lock" : "Unlock"}
                        </button>
                    </td>
                    <td>
                        <button class="resend ${item.SalesPersonInactivate == 0 ? "disable" : ""}" resend-id=${item.SalesPersonEmailAddress} ${item.SalesPersonInactivate == 0 ? "disabled" : ""}>
                            Resend
                        </button>
                    </td>
                    <td>
                        <div class="action">
                            <div class="view-employee" view-id=${item.SalesPersonID}>
                                <i class="fa-regular fa-eye"></i>
                            </div>
                            <div class="update-employee" update-id=${item.SalesPersonID}>
                                <i class="fa-solid fa-pen"></i>
                            </div>
                        </div>
                    </td>
                </tr>`;
        
                tableBody.insertAdjacentHTML("beforeend", temp);
            });

    // Add Employee
    const add = document.querySelector(".main .content .body .body-content .first .add-account");
    add.addEventListener("click",() => {
        window.location.href = "http://localhost:8080/FinalWeb/AddEmployee.php";
    });
    // End Add Employee

    // View Employee
    const viewIcon = document.querySelectorAll(".main .content .body .body-content .second table tr td .action .view-employee");
    viewIcon.forEach(item => {
        item.addEventListener("click",() => {
            const att = item.getAttribute("view-id");
            const link = local + "ViewEmployee.php?id=" + att;
            window.location.href = link;
        });
    });
    // End View Employee

    // Update Employee
    const updateIcon = document.querySelectorAll(".main .content .body .body-content .second table tr td .action .update-employee");
    if(updateIcon.length > 0) {
        updateIcon.forEach(item => {
            item.addEventListener("click",() => {
                const att = item.getAttribute("update-id");
                const link = local + "UpdateEmployeeInfo.php?id=" + att;
                window.location.href = link;
            });
        });
    }
    // End Update Employee

    // Resend Employee
    const resendMailButton = document.querySelectorAll(".main .content .body .body-content .second table tr td .resend");
    if(resendMailButton.length > 0){
        resendMailButton.forEach(item => {
            item.addEventListener("click", async () => {
                const email = item.getAttribute("resend-id");
                let formData = new FormData();
                formData.append("email",email);
                try {
                    let response = await fetch('http://localhost:8080/FinalWeb/api/AccountManagement/resend-mail.php', {
                        method: 'POST',
                        body: formData
                    });
                    let data = await response.json();
                    
                    if(data) {
                        alert("Gửi mail thành công !");
                    }
                } catch (error) {
                    
                }
            });
        });
    }
    // End Resend Employee

    // Lock/Unlock Employee
    const manageButton = document.querySelectorAll(".main .content .body .body-content .second table tr td .manage");
    if(manageButton.length > 0) {
        manageButton.forEach(item => {
            item.addEventListener("click", () => {
                const att = item.getAttribute("lock-id");
                let lockStatus = item.innerHTML.toLowerCase().toString().trim();

                if(lockStatus == "lock"){
                    lockStatus = "unlock";
                }
                else {
                    lockStatus = "lock";
                }

                const urlParams = new URLSearchParams(window.location.search);
                
                if(urlParams.has('id') && urlParams.has('status')){
                    urlParams.set('id', att);
                    urlParams.set('status', lockStatus);
                    let newUrl = window.location.pathname + '?' + urlParams.toString();
                    window.history.replaceState({}, '', newUrl);
                    window.location.href = newUrl;
                }
                else {
                    const listLink = window.location.href + "?id=" + att + "&status=" + lockStatus;
                    window.location.href = listLink;
                }     
            });
        });
    }
    // End Lock/Unlock Employee

    // Search Employee
    const searchButton = document.querySelector(".main .content .body .body-content .first .search-input .form .search-button");
    searchButton.addEventListener("click",() => {
        const searchValue = document.querySelector(".main .content .body .body-content .first .search-input input[name='search']").value;
        if(searchValue == ""){
            window.location.href = "http://localhost:8080/FinalWeb/EmployeesList.php";
        }
        else {
            const tempLink = "http://localhost:8080/FinalWeb/EmployeesList.php?search=" + searchValue;
            window.location.href = tempLink;
        }
    });
    // End Search Employee

        } catch (error) {
            console.error("Lỗi khi fetch dữ liệu nhân viên từ API:", error);
        }
    }
});