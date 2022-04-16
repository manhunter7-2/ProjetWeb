document.addEventListener('DOMContentLoaded',function (){
    let movPoster = document.getElementById("mov-all");
    let artMov = document.getElementsByClassName("art-mov");
    for (let cpt=0; cpt<artMov.length; cpt++){
        artMov[cpt].addEventListener('click', function (){
            let name = this.value;
            let request = new XMLHttpRequest();
            request.onreadystatechange = function (){
                if (this.status === 200){
                    movPoster.innerHTML = this.responseText;
                }
            }
            request.open("GET", "movieCardDisplay.php?q="+name, true);
            request.send();
        })
    }
})