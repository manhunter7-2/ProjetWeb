var name;

document.addEventListener('DOMContentLoaded', function(){
    let artMov = document.getElementsByClassName('art-mov');
    let method = "GET";
    let url = "../Tools/movEditor.php?q=";

    let btn = document.getElementsByClassName('edit');
    for (let i=0; i<btn.length; i++){
        btn[i].addEventListener('click', function (){
            let movName = btn[i].id;
            name = movName;
            let urlTtl = url.concat('', movName);
            let httprequest = new XMLHttpRequest();
            httprequest.onreadystatechange = function (){
                if(httprequest.readyState === XMLHttpRequest.DONE){
                    if(httprequest.status === 200){
                        window.location.href="editMovie.php";
                    }
                }
            }
            httprequest.open(method, urlTtl);
            httprequest.send();
        })
    }
    if(!(window.location.toString().includes(name)) && (window.location.toString().includes("editMovie"))){
        let url2 = new URLSearchParams(window.location.href);
        url2.delete('q')
        window.location.href += "?q=" + name;
    }
})