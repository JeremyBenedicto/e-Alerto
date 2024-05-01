function showTab(tabId) {

    var tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(function (tabContent) {
        tabContent.classList.remove('active');
    });

    var selectedTabContent = document.getElementById(tabId);
    selectedTabContent.classList.add('active');
}


function toggleDarkMode() {
    const body = document.body;
    body.classList.toggle('dark-mode');
}

var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1 }
    slides[slideIndex - 1].style.display = "block";
    setTimeout(showSlides, 5000);
}

function plusSlides(n) {
    showSlides(slideIndex += n);
}

$(document).ready(function () {
    function sendMessage(message) {
        $.post('send_message.php', { message: message }, function (data) {
            console.log(data);
        });
    }

    $('#emergency_form').submit(function (e) {
        e.preventDefault();
        var message = $('#emergency_message').val();
        sendMessage(message);
        $('#emergency_message').val('');
    });

    setInterval(getMessages, 3000);
});


