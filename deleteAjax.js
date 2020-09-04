function goTo(url){
    fetch(url)
    .then(()=>{
        location.reload();
    })
    
}
