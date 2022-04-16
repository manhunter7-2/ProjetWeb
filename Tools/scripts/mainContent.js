document.addEventListener('DOMContentLoaded',function (){
    let movAll = document.getElementById("mov-all");
    let method = "GET";
    let url = "../Tools/movieCardDisplay.php?q=";
    let artMov = document.getElementsByClassName("art-mov");

    for (let i=0; i<artMov.length; i++){
        artMov[i].addEventListener('click', function (){
            let name = "";
            name = artMov[i].id+'\t';
            let urlTtl = url + name;
            let httprequest = new XMLHttpRequest();
            httprequest.onreadystatechange = function (){
                if (httprequest.readyState === XMLHttpRequest.DONE){
                    if (httprequest.status === 200){
                        movAll.innerHTML = httprequest.response;
                    }else{
                        alert("ERREUR REQUETE" + httprequest.status)
                    }
                }
            }
            httprequest.open(method, urlTtl);
            httprequest.send();
        })
    }
})