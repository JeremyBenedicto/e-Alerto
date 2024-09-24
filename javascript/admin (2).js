
    document.getElementById('popperBtn3').addEventListener('click', function () {
        togglePopper('popperContent3');
    });

    document.getElementById('popperBtn4').addEventListener('click', function () {
        togglePopper('popperContent4');
    });

    function togglePopper(popperId) {
        var popperContent = document.getElementById(popperId);
        if (popperContent.classList.contains('popper-show')) {
            popperContent.classList.remove('popper-show');
        } else {
            popperContent.classList.add('popper-show');
            var button = document.getElementById(popperId.replace('popperContent', 'popperBtn'));
            var buttonRect = button.getBoundingClientRect();
            var popperWidth = popperContent.offsetWidth;
            var popperHeight = popperContent.offsetHeight;
            popperContent.style.left = (buttonRect.left - popperWidth) + 'px';
            popperContent.style.top = (buttonRect.top + buttonRect.height / 2 - popperHeight / 2) + 'px';
        }
    }

      document.getElementById('nav1').addEventListener('click', function() {
        var miniCard = document.getElementById('miniCard');
        miniCard.style.display = (miniCard.style.display === 'none') ? 'block' : 'none';
     });

     document.getElementById('closeBtn').addEventListener('click', function() {
        var miniCard = document.getElementById('miniCard');
        miniCard.style.display = 'none';
     });

     

     document.getElementById('vsd').addEventListener('click', function() {
        var miniCard = document.getElementById('minCard');
        miniCard.style.display = (miniCard.style.display === 'none') ? 'block' : 'none';
     });
     document.getElementById('close-Btn').addEventListener('click', function() {
        var miniCard = document.getElementById('minCard');
        miniCard.style.display = 'none';
     });


     const searchBar = document.querySelector(".search input"),
searchIcon = document.querySelector(".search button"),
usersList = document.querySelector(".users-list");

searchIcon.onclick = ()=>{
  searchBar.classList.toggle("show");
  searchIcon.classList.toggle("active");
  searchBar.focus();
  if(searchBar.classList.contains("active")){
    searchBar.value = "";
    searchBar.classList.remove("active");
  }
}

searchBar.onkeyup = ()=>{
  let searchTerm = searchBar.value;
  if(searchTerm != ""){
    searchBar.classList.add("active");
  }else{
    searchBar.classList.remove("active");
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/search.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          usersList.innerHTML = data;
        }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);
}

setInterval(() =>{
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php/users.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          if(!searchBar.classList.contains("active")){
            usersList.innerHTML = data;
          }
        }
    }
  }
  xhr.send();
}, 500);


var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    slides[slideIndex-1].style.display = "block";  
    setTimeout(showSlides, 5000);
}

function plusSlides(n) {
    showSlides(slideIndex += n);
}
