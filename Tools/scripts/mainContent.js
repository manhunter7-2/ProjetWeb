document.addEventListener('DOMContentLoaded', function(){
    console.log("mainContent.js -- chargé")
    let head = document.getElementById("main-menu");
    let login = document.getElementById("head-login-btn");

    head.addEventListener("click", function (){
        window.location.href = "mainPage.php";
    })

    login.addEventListener("click", function (){
        window.location.href = "login.php";
    })
})