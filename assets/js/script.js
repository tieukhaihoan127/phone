// Admin Info
const adminInfo = document.querySelector(".content .header .information .admin");
const adminMenuInfo = document.querySelector(".content .header .information .admin-menu");

adminInfo.addEventListener("mouseenter",() => {
    const infoChangeName = adminInfo.querySelector(".admin-info .admin-name");
    const infoChangeRole = adminInfo.querySelector(".admin-info .role");
    infoChangeName.classList.add("active");
    infoChangeRole.classList.add("active");
});


adminInfo.addEventListener("mouseleave",() => {
    const infoChangeName = adminInfo.querySelector(".admin-info .admin-name");
    const infoChangeRole = adminInfo.querySelector(".admin-info .role");
    infoChangeName.classList.remove("active");
    infoChangeRole.classList.remove("active");
});

adminInfo.addEventListener("click", () => {
    if(adminMenuInfo.classList.contains("show") == false){
        adminMenuInfo.classList.add("show");
    }
    else{
        adminMenuInfo.classList.remove("show");
    }
});

adminMenuInfo.addEventListener("mouseleave",() => {
    adminMenuInfo.classList.remove("show");
});
// End Admin Info
const siderInfoBar = document.querySelector(".content .header .header-content .current-content-smaller .web-info .navbar");
const siderInfo = document.querySelector(".content .header .header-content .current-content-smaller .sider-info");

siderInfoBar.addEventListener("click", () => {
    if(siderInfo.classList.contains("show") == false){
        siderInfo.classList.add("show");
    }
    else {
        siderInfo.classList.remove("show");
    }
});
// Sider Info

// End Sider Info

// Change Background Color
const bgIcon = document.querySelector(".content .header .header-content .menu-content .menu .icon-bg");
const header = document.querySelector(".content .header");
const icons = header.querySelectorAll(".header-content .menu-content .menu span");
const menuAdminInfo = adminMenuInfo.querySelectorAll(".menu-info ul li .menu-item");
const body = document.querySelector("body");
const content = document.querySelector(".content .body .body-content");
const title = document.querySelector(".content .header .header-content .current-content");
const emFunction = document.querySelectorAll(".content .body .body-content .second table tr td .action div");
const orderInfo = document.querySelector(".content .body .order-detail .order-first .order-info");
const orderDetailInfo = document.querySelector(".content .body .order-detail .order-first .order-detail-info");
const orderDesc = document.querySelector(".content .body .order-detail .order-desc .order-detail-items");
const headerOrderInfo = document.querySelectorAll(".main .content .body .order-detail .order-first .order-info .detail-table table tr th");
const headerOrderDetailInfo = document.querySelectorAll(".main .content .body .order-detail .order-first .order-detail-info .detail-table table tr th");
const headerOrderDesc = document.querySelectorAll(".main .content .body .order-detail .order-desc .order-detail-items .order-table table tr th");
const firstOrderDetail = document.querySelectorAll(".main .content .body .order-detail .order-first .order-info .detail-table table tr td:nth-child(1) .desc");
const firstOrderDetailInfo = document.querySelectorAll(".main .content .body .order-detail .order-first .order-detail-info .detail-table table tr td:nth-child(1) .desc");

bgIcon.addEventListener("click",() => {
    const icon = bgIcon.querySelector("i").className;
    if(icon.includes("fa-moon")){
        bgIcon.innerHTML = `<i class="fa-regular fa-sun"></i>`;
        header.classList.add("dark");
        adminInfo.classList.add("dark");
        icons.forEach(icon => {
            icon.classList.add("dark");
        });
        adminMenuInfo.classList.add("dark");
        menuAdminInfo.forEach(menu => {
            menu.classList.add("dark");
        });
        body.classList.add("dark");

        if(content){
            content.classList.add("dark");
        }

        title.classList.add("dark");
        emFunction.forEach(f => {
            f.classList.add("dark");
        });

        if(orderInfo){
            orderInfo.classList.add("dark");
        }

        if(orderDetailInfo){
            orderDetailInfo.classList.add("dark");
        }

        if(orderDesc){
            orderDesc.classList.add("dark");
        }

        if(headerOrderInfo) {
            headerOrderInfo.forEach(f => {
                f.classList.add("dark");
            });
        }

        if(headerOrderDetailInfo) {
            headerOrderDetailInfo.forEach(f => {
                f.classList.add("dark");
            });
        }

        if(headerOrderDesc) {
            headerOrderDesc.forEach(f => {
                f.classList.add("dark");
            });
        }

        if(firstOrderDetail) {
            firstOrderDetail.forEach(f => {
                f.classList.add("dark");
            });
        }

        if(firstOrderDetailInfo) {
            firstOrderDetailInfo.forEach(f => {
                f.classList.add("dark");
            });
        }

    }
    else {
        bgIcon.innerHTML = `<i class="fa-solid fa-moon"></i>`;
        header.classList.remove("dark");
        adminInfo.classList.remove("dark");
        
        icons.forEach(icon => {
            icon.classList.remove("dark");
        });

        adminMenuInfo.classList.remove("dark");
        menuAdminInfo.forEach(menu => {
            menu.classList.remove("dark");
        });

        body.classList.remove("dark");

        if(content){
            content.classList.remove("dark");
        }

        title.classList.remove("dark");

        emFunction.forEach(f => {
            f.classList.remove("dark");
        });

        if(orderInfo){
            orderInfo.classList.remove("dark");
        }

        if(orderDetailInfo){
            orderDetailInfo.classList.remove("dark");
        }

        if(orderDesc){
            orderDesc.classList.remove("dark");
        }

        if(headerOrderInfo) {
            headerOrderInfo.forEach(f => {
                f.classList.remove("dark");
            });
        }

        if(headerOrderDetailInfo) {
            headerOrderDetailInfo.forEach(f => {
                f.classList.remove("dark");
            });
        }

        if(headerOrderDesc) {
            headerOrderDesc.forEach(f => {
                f.classList.remove("dark");
            });
        }

        if(firstOrderDetail) {
            firstOrderDetail.forEach(f => {
                f.classList.remove("dark");
            });
        }

        if(firstOrderDetailInfo) {
            firstOrderDetailInfo.forEach(f => {
                f.classList.remove("dark");
            });
        }
    }
});
// End Change Background Color

const checkOK = window.location.search;
const urlParamsCheckOK = new URLSearchParams(checkOK);

function removeURLParameter(paramKey) {
    let url = new URL(window.location.href);
    let params = new URLSearchParams(url.search);
    params.delete(paramKey);
    window.history.replaceState({}, '', `${url.pathname}?${params.toString()}`);
}

if(urlParamsCheckOK.has('successMessage')) {
    alert('Đổi mật khẩu thành công !');
    removeURLParameter('successMessage');

}

// Personal Information
const dataCheckAcc = async () => {
    const checkType = await fetch("http://localhost:8080/FinalWeb/api/AccountManagement/get-account-by-username.php");
    const dataCheck = await checkType.json();
    return dataCheck;
}

dataCheckAcc().then(data => {
    const personalName = document.querySelector(".main .content .header .header-content .information .admin .admin-info .admin-name");
    const personalRole = document.querySelector(".main .content .header .header-content .information .admin .admin-info .role");
    const personalPicture = document.querySelector(".main .content .header .header-content .information .admin .image img");
    personalName.innerHTML = data.Name;
    personalRole.innerHTML = data.Role;
    personalPicture.src = data.Avatar;
});
// End Personal Information

// Redirect 
const local = "http://localhost:8080/FinalWeb/";

const dataCheck = async () => {
    const checkType = await fetch("http://localhost:8080/FinalWeb/api/AccountManagement/get-account-type.php");
    const dataCheck = await checkType.json();
    return dataCheck;
}

dataCheck().then(data => {
    const type = parseInt(data.data[0].AccountType);
    const sidebarMenu = document.querySelector(".main .sider .menu ul");
    const sidebarMenuSmall = document.querySelector(".main .content .header .header-content .current-content-smaller .sider-info ul");
    let value = "";
    
    if(type == 1) {
        value = `
                <li>
                    <div class="menu-item">
                        <span class="icon-sider">
                            <i class="fa-brands fa-product-hunt"></i>
                        </span>
                        <div class="text">
                            Product Management
                        </div>
                    </div>
                </li>
                <li>
                    <div class="menu-item">
                        <span class="icon-sider">
                            <i class="fa-solid fa-circle-user"></i>
                        </span>
                        <div class="text">
                            Customer Management
                        </div>
                    </div>
                </li>
                <li>
                    <div class="menu-item">
                        <span class="icon-sider">
                            <i class="fa-solid fa-coins"></i>
                        </span>
                        <div class="text">
                            Transaction Processing
                        </div>
                    </div>
                </li>`;
        sidebarMenu.insertAdjacentHTML("beforeend", value);
        sidebarMenuSmall.insertAdjacentHTML("beforeend", value);

        const siderMenu = document.querySelectorAll(".main .sider .menu ul li");
        siderMenu[0].addEventListener("click", async () => {
            window.location.href = "http://localhost:8080/FinalWeb/ProductsList.php";
        });

        siderMenu[1].addEventListener("click", () => {
            window.location.href = "http://localhost:8080/FinalWeb/CustomerList.php";
        });

        siderMenu[2].addEventListener("click", () => {
            window.location.href = "http://localhost:8080/FinalWeb/CheckoutOrderList.php";
        });

        const siderMenuSmall = document.querySelectorAll(".main .content .header .header-content .current-content-smaller .sider-info ul li");
        siderMenuSmall[0].addEventListener("click", async () => {
            window.location.href = "http://localhost:8080/FinalWeb/ProductsList.php";
        });

        siderMenuSmall[1].addEventListener("click", () => {
            window.location.href = "http://localhost:8080/FinalWeb/CustomerList.php";
        });

        siderMenuSmall[2].addEventListener("click", () => {
            window.location.href = "http://localhost:8080/FinalWeb/CheckoutOrderList.php";
        });
    }
    else {
        value = `<li>
                    <div class="menu-item">
                        <span class="icon-sider">
                            <i class="fa-solid fa-users"></i>
                        </span>
                        <div class="text">
                            Account Management
                        </div>
                    </div>
                </li>
                <li>
                    <div class="menu-item">
                        <span class="icon-sider">
                            <i class="fa-brands fa-product-hunt"></i>
                        </span>
                        <div class="text">
                            Product Management
                        </div>
                    </div>
                </li>
                <li>
                    <div class="menu-item">
                        <span class="icon-sider">
                            <i class="fa-solid fa-circle-user"></i>
                        </span>
                        <div class="text">
                            Customer Management
                        </div>
                    </div>
                </li>
                <li>
                    <div class="menu-item">
                        <span class="icon-sider">
                            <i class="fa-solid fa-coins"></i>
                        </span>
                        <div class="text">
                            Transaction Processing
                        </div>
                    </div>
                </li>
                <li>
                    <div class="menu-item">
                        <span class="icon-sider">
                            <i class="fa-solid fa-chart-simple"></i>
                        </span>
                        <div class="text">
                            Reporting and Analytics
                        </div>
                    </div>
                </li>`;
        sidebarMenu.insertAdjacentHTML("beforeend", value);
        sidebarMenuSmall.insertAdjacentHTML("beforeend", value);

        const siderMenu = document.querySelectorAll(".main .sider .menu ul li");
        siderMenu[0].addEventListener("click", async () => {
            window.location.href = "http://localhost:8080/FinalWeb/EmployeesList.php";
        });

        siderMenu[1].addEventListener("click", () => {
            window.location.href = "http://localhost:8080/FinalWeb/ProductsList.php";
        });

        siderMenu[2].addEventListener("click", () => {
            window.location.href = "http://localhost:8080/FinalWeb/CustomerList.php";
        });

        siderMenu[3].addEventListener("click", () => {
            window.location.href = "http://localhost:8080/FinalWeb/CheckoutOrderList.php"
        });

        siderMenu[4].addEventListener("click", () => {
            window.location.href = "http://localhost:8080/FinalWeb/Reporting.php";
        });

        const siderMenuSmall = document.querySelectorAll(".main .content .header .header-content .current-content-smaller .sider-info ul li");
        siderMenuSmall[0].addEventListener("click", async () => {
            window.location.href = "http://localhost:8080/FinalWeb/EmployeesList.php";
        });

        siderMenuSmall[1].addEventListener("click", () => {
            window.location.href = "http://localhost:8080/FinalWeb/ProductsList.php";
        });

        siderMenuSmall[2].addEventListener("click", () => {
            window.location.href = "http://localhost:8080/FinalWeb/CustomerList.php";
        });

        siderMenuSmall[3].addEventListener("click", () => {
            window.location.href = "http://localhost:8080/FinalWeb/CheckoutOrderList.php"
        });

        siderMenuSmall[4].addEventListener("click", () => {
            window.location.href = "http://localhost:8080/FinalWeb/Reporting.php";
        });
    }
});

// End Redirect

// Change Password
const changePassword = document.querySelector(".main .content .header .information .admin-menu .menu-info ul li:nth-child(2) .menu-item");
if(changePassword) {
    changePassword.addEventListener("click", () => {
        window.location.href = local + "ChangePassword.php";
    });
}
// End Change Password

// View Personal Information
const viewElement = document.querySelector(".main .content .header .information .admin-menu .menu-info ul li .menu-item");
if(viewElement) {
    viewElement.addEventListener("click", () => {
        const viewLink = local + "UpdateEmployee.php"; 
        window.location.href = viewLink;
    });
}
// End View Personal Information

// Logout
const logout = document.querySelector(".main .content .header .information .admin-menu .menu-info ul li:nth-child(3) .menu-item");
if(logout) {
    logout.addEventListener("click",() => {
        window.location.href = "http://localhost:8080/FinalWeb/api/logout.php";
    });
}
// End Logout
