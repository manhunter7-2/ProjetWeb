document.addEventListener('DOMContentLoaded', function(){
    let src = document.getElementsByClassName("search");
    let method = "GET";
    let url = "../Tools/moviesList.php?q=";
    let btn = document.getElementById("searchBtn");
    for (let i=0; i<src.length; i++){
        btn.addEventListener('click', function (){
            let valSrc = src[i].value;
            let urlTtl = url.concat('', valSrc)
        let httpRequestSrc = new XMLHttpRequest();
        httpRequestSrc.onreadystatechange = function () {
            if (httpRequestSrc.readyState === XMLHttpRequest.DONE) {
                if (httpRequestSrc.status === 200) {
                    alert(urlTtl);
                }
            }
        }
        httpRequestSrc.open(method, urlTtl);
        httpRequestSrc.send();
        })
    }

})