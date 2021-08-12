export class App{


    constructor(){

        this.createStyle();
        this.createApp();
    }


    createStyle(){


        const head = document.getElementsByTagName('head')[0];
        
        const style = document.createElement('link');

        style.rel = 'stylesheet';

        style.href = 'template/src/App.css'; //change url

        style.type = 'text/css';

        head.appendChild(style);
    }


    createApp(){

        $('#root').append("<div class='App'></div>");

        $('.App').append("<header class='App-header'></header>");
    }
}