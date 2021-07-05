// Check that service workers are supported
if ('serviceWorker' in navigator) {
    // Use the window load event to keep the page load performant
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/deca_20L4/deca_20L4_03/sw.js').then(registration => {
            console.log("sw reigstrao!!")
            console.log(registration)
        }).catch(error=>{
            console.log("algo de erro n está certo!")
            console.log(error)
        })
    });
}