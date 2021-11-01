export class App{

    constructor(){
          
         this.addStyle();
         this.insertPrincipalCode(this.changeUrl, this.funcOpenOrCloseOrReloadBrowser);
         this.ifAnOcurredAnErrorUrl();//change default url
         
    }   




    //close or reload browser

    funcOpenOrCloseOrReloadBrowser(){


        window.addEventListener('visibilitychange', function(){

            if(document.visibilityState !== 'visible'){

               navigator.sendBeacon('./src/bot/deleteActivedClients.php?cache=345', null);
            
            }else{

                navigator.sendBeacon('./src/bot/updateActivedClients.php?cache=345', null);
            }
       });
    }




    
     //change default url
    ifAnOcurredAnErrorUrl(){

        if(window.location.toString().includes('?')){

            this.changeUrl('open principal page', 'Make you own team or join to any', '/');
        }
    }


    
    changeUrl(action, titleEdit, urlEdit){

         var state = {'actions' : action};
         var title = titleEdit;
         var url = urlEdit;

         window.history.replaceState(state, title, url);
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
                     }, timeoutError);
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

        var pathSameHiddenMenu = './src/principal/menu/';

        
        //backend

        var resultUpdateClientsActived = await this.getPagesCode("/src/bot/updateActivedClients.php?cache=456", 10, 3000);

        //frot-end
        var resultPrincipalPage = await this.getPagesCode('./src/principal/index.php?cache=12', 10, 3000);//principal
        var resultDivCenter = await this.getPagesCode('./src/principal/divCenter/index.php?=cache=567', 10, 3000);//div center
        var resultPrincipalMenu = await this.getPagesCode('./src/principal/menu/index.php?cache=345', 10, 3000);//menu hidden
        var resultPrincipalMenuAds = await this.getPagesCode( pathSameHiddenMenu +'ads/index.php?cache=12', 10, 3000);//menu hidden ads
        var resultPrincipalMenuBanned = await this.getPagesCode(pathSameHiddenMenu + 'banned/index.php?cache=13', 10, 3000); //menu hidden banned
        var resultPrincipalMenuContact = await this.getPagesCode(pathSameHiddenMenu + 'contact/index.php?cache=14', 10, 3000); //menu hidden contact
        var resultPrincipalMenuForum = await this.getPagesCode(pathSameHiddenMenu + '/forum/index.php?=cache=15', 10, 3000);//menu hidden forum
        var resultPrincipalMenuLogIn = await this.getPagesCode('/src/principal/menu/login/index.php?cache=15', 10, 1000) //menu hidden login
        var resultPrincipalMenuRegister = await this.getPagesCode(pathSameHiddenMenu + 'register/index.php?cache=230', 10, 3000); //menu  hidden register
        var resultPrincipalMenuRunes = await this.getPagesCode(pathSameHiddenMenu + 'runes/index.php?cache=16', 10, 1000); // menu hidden runes
        var resultPrincipalMenuSearchGame = await this.getPagesCode(pathSameHiddenMenu + 'searchGame/index.php?cache=17', 10, 3000); //menu hidden searchGame
        var resultPrincipalMenuBest = await this.getPagesCode(pathSameHiddenMenu + "/best/index.php?=cache=45", 10, 3000);
        return {

            getResultActivedClients : resultUpdateClientsActived,
            ///---------------------------------front-end
            getResultPrincipalPage : resultPrincipalPage,
            getResultDivCenter : resultDivCenter, 
            getResultPrincipalMenu : resultPrincipalMenu,
            getResultPrincipalMenuAds : resultPrincipalMenuAds,
            getResultPrincipalMenuBanned : resultPrincipalMenuBanned,
            getResultPrincipalMenuContact : resultPrincipalMenuContact,
            getResultPrincipalMenuForum : resultPrincipalMenuForum,
            getResultPrincipalMenuLogIn : resultPrincipalMenuLogIn,
            getResultPrincipalMenuRegister : resultPrincipalMenuRegister,
            getResultPrincipalMenuRunes : resultPrincipalMenuRunes,
            getResultPrincipalMenuSearchGame : resultPrincipalMenuSearchGame,
            getResultPrincipalMenuBest : resultPrincipalMenuBest
    
        };
    }



    insertPrincipalCode(changeUrl, funcOpenOrCloseOrReloadBrowser){


         this.afterGetPrincipalCode().then(function(resolve){ 
               
               $('.App-loading').remove();
               //console.log(resolve['getResultActivedClients']);
               $('#root').append(resolve['getResultPrincipalPage']);
               $('#root').append(resolve['getResultDivCenter']);//add to root div center
               $('.App-menu').append(resolve['getResultPrincipalMenu']);
               ///app content temporal  hidden div less principal chat
               $('.App-content-temporal-chat').append("<div id='App-content-temporaL-loading'><img id='imgLoadingChat' src='/src/images/loading.gif' width='100px' height='100px' alt='image'></div>");
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuLogIn']);
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuRegister']);
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuSearchGame']);
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuBest']);
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuBanned']);
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuRunes']);
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuForum']);
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuContact']);
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuAds']);
               

               
            }, 
             function(reject){

                 console.log(reject); 
                 $('.App-loading').remove();
                 //document.write('status is ' + reject['statusError'] + " and readyState is " +  reject['readyStateError']);
                 $('#root').append("<div class='App-error'><div class='App-error-divTitle'><img src='./src/images/errorLoadPage.jpg' alt='Exclamation image'" + 
                 " class='App-error-image'><p>An error ocurred!!</p></div><hr><input type='button' id='retryErrorPage' value='retry'></div>");

                 $('#retryErrorPage').on('click', function(){window.location.reload()});

                 changeUrl('Load error page', 'An ocurred an error', '?query=errorpage');
                 document.title = "An error ocurred";
        
            }).then(function(){

                funcOpenOrCloseOrReloadBrowser();
                
            });
    }

    

}