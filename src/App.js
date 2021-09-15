
export var App = function(){

    //principal, login, register, activity


     function getCodeFromPage(url, div){

         
          fetch(url)

          .then(response => {

              if(!response.ok){

                 throw('An ocurred an error');
              
              }else{

                 return response.text();
              }

          }).then(text => $(div).append(text))

          .catch(function(e){console.log(e)});


       
     }//end function getCodeFromPage

     

     function addStyle(){

          const head = document.querySelectorAll('head')[0];

          const style = document.createElement('link');

          style.rel = 'stylesheet';

          style.href = './src/App.css';

          style.type = 'text/css';

          head.appendChild(style);
     }



     function pagePrincipal(){

        
        
          getCodeFromPage("./src/principal/index.html?1", '#root');

    
        
    }



     function main(){

          //add style
          addStyle();

          //add principal page

          pagePrincipal();
     }
     



     return {

         getCodeFromPage,
         main
     }
}