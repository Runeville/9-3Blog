"use strict";

let burger = false;

function useMenu(){
    let getToggleMenu = document.querySelector('.toggle-menu');
    let getToggleMenuLinks = document.querySelectorAll('.toggle-menu a');

    getToggleMenu.addEventListener('on');

    if(burger === false){
        getToggleMenu.style.height = "90px";

        for (let i = 0; i < getToggleMenuLinks.length; i++){
            getToggleMenuLinks[i].style.visibility = "visible";
            getToggleMenuLinks[i].style.opacity = "1";
        }

        burger = true;
    } else {
        getToggleMenu.style.height = "0";

        for (let i = 0; i < getToggleMenuLinks.length; i++){
            getToggleMenuLinks[i].style.visibility = "hidden";
            getToggleMenuLinks[i].style.opacity = "0";
        }

        burger = false;
    }
}