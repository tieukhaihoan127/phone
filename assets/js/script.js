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