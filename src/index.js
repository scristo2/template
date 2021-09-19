import {App} from "../src/App.js?34"

$(document).ready(function(){
     
      const headIndex = document.querySelectorAll('head')[0];

      const styleIndex = document.createElement('link');

      styleIndex.href = './src/index.css?=7';

      styleIndex.rel = 'stylesheet';

      styleIndex.type = 'text/css';

      headIndex.appendChild(styleIndex);
      
      App().main();
      
});