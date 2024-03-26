   document.getElementById('popperBtn2').addEventListener('click', function () {
        togglePopper('popperContent2');
    });

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

      // JavaScript to handle button click and toggle mini card visibility
      document.getElementById('nav1').addEventListener('click', function() {
        var miniCard = document.getElementById('miniCard');
        miniCard.style.display = (miniCard.style.display === 'none') ? 'block' : 'none';
     });

     // JavaScript to handle close button click
     document.getElementById('closeBtn').addEventListener('click', function() {
        var miniCard = document.getElementById('miniCard');
        miniCard.style.display = 'none';
     });

     