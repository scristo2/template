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
        var pathSameHiddenMenu = './src/principal/menu/'; 
        var resultPrincipalPage = await this.getPagesCode('./src/principal/index.php?cache=12', 10, 10);//principal
        var resultPrincipalMenu = await this.getPagesCode('./src/principal/menu/index.php?cache=345', 10, 10);//menu hidden
        var resultPrincipalMenuAds = await this.getPagesCode( pathSameHiddenMenu +'ads/index.php?cache=12', 10, 10);//menu hidden ads
        var resultPrincipalMenuBanned = await this.getPagesCode(pathSameHiddenMenu + 'banned/index.php?cache=13', 10, 10); //menu hidden banned
        var resultPrincipalMenuContact = await this.getPagesCode(pathSameHiddenMenu + 'contact/index.php?cache=14', 10, 10); //menu hidden contact
        var resultPrincipalMenuForum = await this.getPagesCode(pathSameHiddenMenu + '/forum/index.php?=cache=15', 10, 10);//menu hidden forum
        var resultPrincipalMenuLogIn = await this.getPagesCode('/src/principal/menu/login/index.php?cache=15', 10, 10) //menu hidden login
        var resultPrincipalMenuRegister = await this.getPagesCode(pathSameHiddenMenu + 'register/index.php?cache=230', 10, 10); //menu  hidden register
        var resultPrincipalMenuRunes = await this.getPagesCode(pathSameHiddenMenu + 'runes/index.php?cache=16', 10, 10); // menu hidden runes
        var resultPrincipalMenuSearchGame = await this.getPagesCode(pathSameHiddenMenu + 'searchGame/index.php?cache=17', 10, 10); //menu hidden searchGame
        return {
            getResultPrincipalPage : resultPrincipalPage, 
            getResultPrincipalMenu : resultPrincipalMenu,
            getResultPrincipalMenuAds : resultPrincipalMenuAds,
            getResultPrincipalMenuBanned : resultPrincipalMenuBanned,
            getResultPrincipalMenuContact : resultPrincipalMenuContact,
            getResultPrincipalMenuForum : resultPrincipalMenuForum,
            getResultPrincipalMenuLogIn : resultPrincipalMenuLogIn,
            getResultPrincipalMenuRegister : resultPrincipalMenuRegister,
            getResultPrincipalMenuRunes : resultPrincipalMenuRunes,
            getResultPrincipalMenuSearchGame : resultPrincipalMenuSearchGame
    
        };
    }



    insertPrincipalCode(){


         this.afterGetPrincipalCode().then(function(resolve){ 
               
               $('.App-loading').remove();
               $('#root').append(resolve['getResultPrincipalPage']);
               $('.App-menu').append(resolve['getResultPrincipalMenu']);
               ///app content temporal  hidden div less principal chat
               $('.App-content-temporal-chat').append("<div id='App-content-temporaL-loading'><img id='imgLoadingChat' src='/src/images/loading.gif' width='100px' height='100px' alt='image'></div>");
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuLogIn']);
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuRegister']);
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuSearchGame']);
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuBanned']);
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuRunes']);
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuForum']);
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuContact']);
               $('.App-content-temporal').append(resolve['getResultPrincipalMenuAds']);

               
            }, 
             function(reject){

                 document.write('status is ' + reject['statusError'] + " and readyState is " +  reject['readyStateError']);
                
        });
    }

    

}