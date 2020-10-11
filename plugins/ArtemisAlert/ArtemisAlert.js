 /*  _    ____ _____ _____ __  __ ___ ____       _    _     _____ ____ _____ 
   / \  |  _ \_   _| ____|  \/  |_ _/ ___|     / \  | |   | ____|  _ \_   _|
  / _ \ | |_) || | |  _| | |\/| || |\___ \    / _ \ | |   |  _| | |_) || |  
 / ___ \|  _ < | | | |___| |  | || | ___) |  / ___ \| |___| |___|  _ < | |  
/_/   \_\_| \_\|_| |_____|_|  |_|___|____/  /_/   \_\_____|_____|_| \_\|_|  

MIT License

Copyright (c) 2020 Suvin Nimnaka, Amod Pathirana, Hasantha Pathirana and Sandarekha Dissanayaka

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

*/
                                                                           

function ArtemisAlert(){
    this.alert = function(title,message){
      document.body.innerHTML = document.body.innerHTML + '<div id="dialogoverlay"></div><div id="dialogbox" class="bounceIn"><div><div id="dialogboxhead"></div><div id="dialogboxbody"></div><div id="dialogboxfoot"></div></div></div>';
  
      let dialogoverlay = document.getElementById('dialogoverlay');
      let dialogbox = document.getElementById('dialogbox');
      
      let vh = window.innerHeight;
      dialogoverlay.style.height = vh+"px";
      
      dialogbox.style.top = "200px";
  
      dialogoverlay.style.display = "block";
      dialogbox.style.display = "block";
      
      document.getElementById('dialogboxhead').style.display = 'block';

      if(typeof title === 'undefined') {
        document.getElementById('dialogboxhead').style.display = 'none';
      } else if(title === 'error'){
        document.getElementById('dialogboxhead').innerHTML = '<img class="alert-image" src="https://t3.ftcdn.net/jpg/03/52/50/08/240_F_352500882_ynKURmVaMoOrbCc0QOs8AkEykrvpSVFG.jpg"><h2 class="title mb-1 mt-0">'+title.toUpperCase()+'!</h2> ';
      }
      else if(title === 'success'){
        document.getElementById('dialogboxhead').innerHTML = '<img class="alert-image" src="https://www.flaticon.com/svg/static/icons/svg/3582/3582820.svg"><h2 class="title mb-1 mt-0">'+title.toUpperCase()+'!</h2> ';
      }
      else if(title === 'warning'){
        document.getElementById('dialogboxhead').innerHTML = '<img class="alert-image" src="https://www.flaticon.com/svg/static/icons/svg/3582/3582820.svg"><h2 class="title mb-1 mt-0">'+title.toUpperCase()+'!</h2> ';
      }
      else{
        document.getElementById('dialogboxhead').innerHTML = '<img class="alert-image" src="https://www.flaticon.com/svg/static/icons/svg/1182/1182718.svg"><h2 class="title mb-1 mt-0">'+title.toUpperCase()+'!</h2> ';
      }
      document.getElementById('dialogboxbody').innerHTML = message;
      document.getElementById('dialogboxfoot').innerHTML = '<button class="artemis-alert-button-contained active" onclick="artemisAlert.ok()">OK</button>';
    }
    
    this.ok = function(){
      document.getElementById('dialogbox').style.display = "none";
      document.getElementById('dialogoverlay').style.display = "none";
    }
  }
  
  let artemisAlert = new ArtemisAlert();