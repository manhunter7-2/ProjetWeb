document.addEventListener('DOMContentLoaded', function(){
    let src = document.getElementsByName("search");
    let method = "GET";
    let url = "../Tools/moviesList.php?src=";
    let btn = document.getElementById("searchBtn");
    for (let i=0; i<src.length; i++){
        let valSrc = src[i].value
        let urlTtl = url + valSrc;
        btn.addEventListener('click', function (){
        let httpRequestSrc = new XMLHttpRequest();
        if (httpRequestSrc.readyState === XMLHttpRequest.DONE){
            if (httpRequestSrc.status === 200){
                console.log("Search functionnal");
            }
        }
        httpRequestSrc.open(method, urlTtl);
        httpRequestSrc.send();
        })
    }

})