function delet(){
    document.getElementById("back").style.display = "flex";
}

function retur(){
    document.getElementById("back").style.display = "none";
}

function menu(){
    document.getElementById("conn").style.display = "none";
    document.getElementById("mb").style.display = "none";
    document.getElementById("butmenu").style.display = "block";
}

function clo(){
    document.getElementById("butmenu").style.display = "none";
    document.getElementById("conn").style.display = "flex";
    document.getElementById("mb").style.display = "flex";
}