window.addEventListener('load', () => {
    registerServiceWorker();
});

async function registerServiceWorker(){
    if('serviceWorker' in navigator){
        try{
            await navigator.serviceWorker.register('serviceWorker.js');
        }catch(e){
            console.log("Service Worker Registration Failed");
        }
    }
};


let deferredPrompt; // Allows to show the install prompt
const installButton = document.getElementById("install_button");

window.addEventListener("beforeinstallprompt", (e) => {
  //TODO
  console.log("beforeinstallprompt fired");
  e.preventDefault();
  deferredPrompt = e;
  installButton.hidden = false;
  installButton.addEventListener("click", installApp);
});

function installApp() {
    deferredPrompt.prompt();
    installButton.disabled = true;
    deferredPrompt.userChoice.then(choiceResult => {
      if (choiceResult.outcome === "accepted") {
        console.log("PWA setup accepted");
        installButton.hidden = true;
      } else {
        console.log("PWA setup rejected");
      }
      installButton.disabled = false;
      deferredPrompt = null;
    });
  }
  