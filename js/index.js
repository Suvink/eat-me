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