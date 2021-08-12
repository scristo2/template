import {App} from "./App.js";

function insertStyle(){

    const headIndex = document.getElementsByTagName('head')[0];

    const styleIndex = document.createElement('link');

    styleIndex.rel = 'stylesheet';

    styleIndex.href = 'template/src/index.css'; //change url
    styleIndex.type = 'text/css';

    headIndex.appendChild(styleIndex);
}


$(document).ready(function(){
     
     insertStyle();
     const app  = new App();
});