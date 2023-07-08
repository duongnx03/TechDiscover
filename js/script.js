//------------------------------menu-header------------------------------------
const header = document.querySelector("header")
window.addEventListener("scroll", function(){
    x = window.pageYOffset
    if(x>0){
        header.classList.add("sticky")
    }else{
        header.classList.remove("sticky")
    }
})

//------------------------------menu-category-left------------------------------------
const itemsliderbar = document.querySelectorAll(".category-left-li")

itemsliderbar.forEach(function(menu,index){
    menu.addEventListener("click", function(event){
        event.preventDefault();
        menu.classList.toggle("block")
    })
})

//----------------------------------product-details--------------------------------
//img
const bigImg = document.querySelector(".product-content-left-big-img img")
const smallImg = document.querySelectorAll(".product-content-left-small-img img")

smallImg.forEach(function(imgItem,X){
    imgItem.addEventListener("click", function(){
        bigImg.src = imgItem.src
    })
})

//detail
const introduce = document.querySelector(".introduce")
const detail = document.querySelector(".detail")
const accessory = document.querySelector(".accessory")
const guarantee = document.querySelector(".guarantee")

if(introduce){
    introduce.addEventListener("click", function(){
        document.querySelector(".product-content-right-bottom-content-introduce").style.display = "block"
        document.querySelector(".product-content-right-bottom-content-detail").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-accessory").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-guarantee").style.display = "none"
    })
}
if(detail){
    detail.addEventListener("click", function(){
        document.querySelector(".product-content-right-bottom-content-introduce").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-detail").style.display = "block"
        document.querySelector(".product-content-right-bottom-content-accessory").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-guarantee").style.display = "none"
    })
}
if(accessory){
    accessory.addEventListener("click", function(){
        document.querySelector(".product-content-right-bottom-content-introduce").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-detail").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-accessory").style.display = "block"
        document.querySelector(".product-content-right-bottom-content-guarantee").style.display = "none"
    })
}
if(guarantee){
    guarantee.addEventListener("click", function(){
        document.querySelector(".product-content-right-bottom-content-introduce").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-detail").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-accessory").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-guarantee").style.display = "block"
    })
}




//display none
const buttonDetail = document.querySelector(".product-content-right-bottom-top")
if(buttonDetail){
    buttonDetail.addEventListener("click", function(){
        document.querySelector(".product-content-right-bottom-content-big").classList.toggle("activeB")
    })
}

