let clicks = getFromStorage("clicks");
let clicksTotal = getFromStorage("clicksTotal");
let blocks = 0;
let blocksTotal = getFromStorage("blocksTotal");
let bonus = getFromStorage("bonus");
let bonusclicks = 0;
let clicksAdd = getFromStorage("clicksAdd");

bonusimg();

document.getElementById('clics').addEventListener('click',clics);
document.getElementById('bonus1').addEventListener('click',bonus1);
document.getElementById('bonus2').addEventListener('click',bonus2);
document.getElementById('bonus3').addEventListener('click',bonus3);
document.getElementById('ResetLocalStorage').addEventListener('click',ResetLocalStorage);


document.getElementById('clicks').innerHTML = "Nombre de clics : " + clicks;
document.getElementById('clicksTotal').innerHTML = "Nombre de clics au total : " + clicksTotal;
document.getElementById('blocksTotal').innerHTML = "Nombre de blocks detruits : " + blocksTotal;
document.getElementById('bonus').innerHTML = "Pts disponible : " + bonus;
document.getElementById('clicksAdd').innerHTML = "Bonus actuel : +" + clicksAdd;


function clics() {
    clicksTotal +=1;
    document.getElementById('clicksTotal').innerHTML = "Nombre de clics au total : " + clicksTotal;
        clicks = clicks+=1 + clicksAdd;
        document.getElementById('clicks').innerHTML = "Nombre de clics : " + clicks;
            
        if (clicks >= 32) 
        {
        let images = ['styles/dirt.png', 'styles/stone.png', 'styles/sandstone.png', 'styles/stonebricks.png', 'styles/deepslate_diamond.png'];
        let img = document.querySelector("main");
        let counter = 0;
            counter ++;
            blocksTotal += 1;
            blocks += 1;
            clicks = 0;
                document.getElementById('blocksTotal').innerHTML = "Nombre de blocks detruits : " + blocksTotal;
                document.getElementById("clics").src=images[counter %5];
        }

        if (blocks >= 5) {
            bonus +=1;
                document.getElementById('bonus').innerHTML = "Pts disponible :  " + bonus;
            blocks -=5;
        }
        
        if (bonusclicks >=1) {
            clicks += bonusclicks;
        }
        saveStorage();
        bonusimg();
}
    
function bonusimg(){
        if (bonus >=2) {
            let img = document.createElement("img");
                img.src = "styles/Enchanted_Diamond_Pickaxe.gif";
            let div = document.getElementById("bonus1");
            div.replaceChildren(img);
            } else {
                let img = document.createElement("img");
                img.src = "styles/BarrierNew.png";
                let div = document.getElementById("bonus1");
                div.replaceChildren(img);
            }
    
        if (bonus >=5) {
            let img = document.createElement("img");
                img.src = "styles/wither.png";
            let div = document.getElementById("bonus2");
            div.replaceChildren(img);
            } else {
                let img = document.createElement("img");
                img.src = "styles/BarrierNew.png";
                let div = document.getElementById("bonus2");
                div.replaceChildren(img);
            }
        if (bonus >=10) {
            let img = document.createElement("img");
                img.src = "styles/herobrine.png";
            let div = document.getElementById("bonus3");
            div.replaceChildren(img);
            } else {
                let img = document.createElement("img");
                img.src = "styles/BarrierNew.png";
                let div = document.getElementById("bonus3");
                div.replaceChildren(img);
            } 
}


function bonus1() {
let audio1 = new Audio('styles/anvil.mp3'); 
    if (bonus >=2) {
            if (clicksAdd >= 9){
                alert("Tu es au maximum des ameliorations !");
                
            } else {
                audio1.play();
                    bonus -=2;
                    clicksAdd +=1;
                        document.getElementById('bonus').innerHTML = "Pts disponible :  " + bonus;
                        document.getElementById('clicksAdd').innerHTML = "Bonus actuel : +" + clicksAdd;
                        saveStorage();              
            }     
                  
        } else {
            alert("Tu n'as pas assez de points bonus !");
    }
    bonusimg();
}

function bonus2() {
let audio2 = new Audio('styles/tnt_explosion.mp3');
    if (bonus >=5) {
        audio2.play();
            bonus -=5;
            blocksTotal +=1000;
                document.getElementById('bonus').innerHTML = "Pts disponible :  " + bonus;
                document.getElementById('blocksTotal').innerHTML = "Nombre de blocks detruits : " + blocksTotal;
                saveStorage();
                bonusimg();
    } else {
        alert("Tu n'as pas assez de points bonus !");
    }
}

function bonus3() {
let audio3 = new Audio('styles/big_tnt_explosion.mp3');
    if (bonus >=10) {
        audio3.play();
            bonus -=10;
            blocksTotal +=10000;
                document.getElementById('bonus').innerHTML = "Pts disponible :  " + bonus;
                document.getElementById('blocksTotal').innerHTML = "Nombre de blocks detruits : " + blocksTotal;
                saveStorage();
                bonusimg();
    } else {
        alert("Tu n'as pas assez de points bonus !");
    }
}


function getFromStorage(name){
    if (localStorage.getItem(name) === null){
        return 0;
    } else {
        return Number(localStorage.getItem(name));
    }
}

function ResetLocalStorage() {
let audio4 = new Audio('styles/lava_destroy.mp3');
    localStorage.clear();
    audio4.play();
        setTimeout(function(){
            window.location.reload();
        }, 1900);  
}

function saveStorage(){
    localStorage.setItem('clicks',clicks);
    localStorage.setItem('clicksTotal',clicksTotal);
    localStorage.setItem('blocksTotal',blocksTotal);
    localStorage.setItem('bonus',bonus);
    localStorage.setItem('clicksAdd',clicksAdd);
}

// Variable Alert-Box
let ALERT_TITLE = "Oops!";
let ALERT_BUTTON_TEXT = "Ok";

if(document.getElementById) {
    window.alert = function(txt) {
        createCustomAlert(txt);
    }
}
// change Alert Box
function createCustomAlert(txt) {
    d = document;

    if(d.getElementById("modalContainer")) return;

    mObj = d.getElementsByTagName("body")[0].appendChild(d.createElement("div"));
    mObj.id = "modalContainer";
    mObj.style.height = d.documentElement.scrollHeight + "px";

    alertObj = mObj.appendChild(d.createElement("div"));
    alertObj.id = "alertBox";
    if(d.all && !window.chrome) alertObj.style.top = document.documentElement.scrollTop + "px";
    alertObj.style.left = (d.documentElement.scrollWidth - alertObj.offsetWidth)/2 + "px";
    alertObj.style.visiblity="visible";

    h1 = alertObj.appendChild(d.createElement("h1"));
    h1.appendChild(d.createTextNode(ALERT_TITLE));

    msg = alertObj.appendChild(d.createElement("p"));
    msg.innerHTML = txt;

        btn = alertObj.appendChild(d.createElement("a"));
        btn.id = "closeBtn";
        btn.appendChild(d.createTextNode(ALERT_BUTTON_TEXT));
        btn.href = "#";
        btn.focus();
        btn.onclick = function() { removeCustomAlert();return false; }

    alertObj.style.display = "block";
}
function removeCustomAlert() {
    document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalContainer"));
}
