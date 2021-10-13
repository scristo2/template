export class App{

    constructor(){
          
         this.addStyle();
         this.insertPrincipalCode();
        
    }


    addStyle(){


        var head = document.querySelectorAll('head')[0];
        var createLink = document.createElement('link');
        createLink.rel = 'stylesheet';
        createLink.type = 'text/css';
        createLink.href = 'src/index.css?/cache=78';
        head.appendChild(createLink);

    }

    

    getPagesCode(url, timeout, timeoutError){

        return new Promise(function(resolve, reject){


              var xhr = new XMLHttpRequest();
              xhr.open('GET',url,true);
              xhr.onload = function(){

                  if(xhr.readyState == 4 && xhr.status == 200){

                          setTimeout(() => {
                              resolve(xhr.responseText);
                          }, timeout);      

                  }else{

                     setTimeout(() => {
                         reject({statusError : this.status, readyStateError : this.readyState});
                     }, timeout);
                  }
              }
              xhr.ontimeout = function(){

                 setTimeout(() => {
                    reject({statusError : this.status, readyStateError : this.readyState});
                 }, timeoutError);
              }
              xhr.onerror = function(){

                 setTimeout(() => {
                    reject({statusError : this.status, readyStateError : this.readyState});
                 }, timeoutError);
              }
              xhr.send(null);
        });
    }


    


    async afterGetPrincipalCode(){

        $('#root').append("<div class='App-loading'><img class='imgLoading' src='/src/images/loading.gif' alt='image'><p>Developed by Sergio Cristobal</p></div>");

        var resultPrincipalPage = await this.getPagesCode('./src/principal/index.html', 10, 10);//principal
        var resultPrincipalMenu = await this.getPagesCode('./src/principal//menu/index.html', 10, 10);//menu hidden
        return {getResultPrincipalPage : resultPrincipalPage, getResultPrincipalMenu : resultPrincipalMenu};
    }



    insertPrincipalCode(){


         this.afterGetPrincipalCode().then(function(resolve){ 
               
               $('.App-loading').remove();
               $('#root').append(resolve['getResultPrincipalPage']);
               $('.App-menu').append(resolve['getResultPrincipalMenu']);
               
            }, 
             function(reject){

                 document.write('status is ' + reject['statusError'] + " and readyState is " +  reject['readyStateError']);
                
        });
    }

    

}