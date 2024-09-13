//Pour la barre de menu responsive
let sidemenu = document.getElementById("sidemenu");
function openmenu(){
    sidemenu.style.right = "0";
}
function closemenu(){
    sidemenu.style.right = "-100%";
}


//Les volets dans la présentation
function opentab(tabname){
    let tablinks = document.getElementsByClassName("tab-links");
    let tabcontents = document.getElementsByClassName("tab-contents");
        
    for(tablink of tablinks){
            tablink.classList.remove("active-link");
        }
        for(tabcontent of tabcontents){
            tabcontent.classList.remove("active-tab");
        }
        event.currentTarget.classList.add("active-link");
        document.getElementById(tabname).classList.add("active-tab");
}


// Animation d'écriture de texte
var typed = new Typed('.auto-type', {
    strings: ['Bienvenue sur mon <span id="texte">profil</span>.^3000', 'Descends pour en savoir <span id="texte">plus</span>.'],
    typeSpeed: 50,
    backSpeed: 100,
});