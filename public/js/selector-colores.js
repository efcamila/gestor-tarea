window.addEventListener("load", () => {
    const colorItems = document.querySelectorAll('.color-item');
    colorItems.forEach(item =>{
        item.addEventListener('click', function(){
            const idSelected = this.id;
            console.log(idSelected);
            document.getElementById('div-color').className = idSelected;
            document.getElementById('color').setAttribute('value',idSelected);
            
       }) 
    })
})