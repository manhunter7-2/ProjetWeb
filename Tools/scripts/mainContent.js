document.addEventListener('DOMContentLoaded',function (){
    let movAll = document.getElementById("mov-all");
    let method = "GET";
    let url = "../Tools/movieCardDisplay.php?q=";
    let artMov = document.getElementsByClassName("art-mov");

    for (let i=0; i<artMov.length; i++){
        artMov[i].addEventListener('click', function (){
            let name = "";
            name = artMov[i].id;
            let urlTtl = url + name;
            let httprequest = new XMLHttpRequest();
            httprequest.onreadystatechange = function (){
                if (httprequest.readyState === XMLHttpRequest.DONE){
                    if (httprequest.status === 200){
                        movAll.innerHTML = httprequest.response;

                        let fullMovButton = document.getElementsByClassName("checkMov");
                        for (let i=0; i<fullMovButton.length; i++){
                            fullMovButton[i].addEventListener('click', function (){
                                window.location.href="fullPage.php";


                            })
                        }
                    }else{
                        alert("ERREUR REQUETE" + httprequest.status)
                    }
                }
            }
            httprequest.open(method, urlTtl);
            httprequest.send();
        })
    }
    if (window.location.href.indexOf('full') > -1){
        alert("test passed")
        let test = document.getElementById("full-page-test");
        if (test){
            test.innerText += "Test 1"
        }
        test.innerText += "bite";
    }else{
        alert("test failed")
    }
})