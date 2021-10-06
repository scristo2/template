
export var App = function(){

    //principal, login, register, activity


     function getCodeFromPage(url){

         
         return new Promise(function(resolve, reject){

            $('#root').append("<div class='App-loading'><img id='loadingGif'  src='./src/images/loading.gif'></div>");

            fetch(url)
            .then(response => {

                 if(!response.ok){

                     setTimeout(() => {
                         reject('<h1>An ocurred an error :(</h1>');
                     }, 2000);

                 }else{

                     setTimeout(() => {
                         resolve(response.text());
                     }, 2000);
                 }
            }).catch(function(e){alert(e)});
         });
          

       
     }//end function getCodeFromPage

     

     function addStyle(){

          const head = document.querySelectorAll('head')[0];

          const style = document.createElement('link');

          style.rel = 'stylesheet';

          style.href = './src/App.css';

          style.type = 'text/css';

          head.appendChild(style);
     }



     async function pagePrincipal(){

          
        
          var result = await getCodeFromPage("./src/principal/index.html?=1");

          return result;  
        
    }



     function main(){

          //add style
          addStyle();

          //add principal page

          pagePrincipal().then(function(resolve){
              
                $('.App-loading').remove();
                $('#root').append(resolve);

          }, function(reject){
               $('#loadingGif').remove(); 
               $('.App-loading').append(reject);
               $('.App-loading').append("<input type='button' value='retry' id='retryLoad'>");
               $('#retryLoad').on('click', function(){
                    window.location.reload();
               });
          });
     }
     


     return {

         main
     }
}