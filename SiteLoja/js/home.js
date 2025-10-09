jQuery(document).ready(function () {

  jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 100) {
      jQuery('a[href="#top"]').fadeIn();
    } else {
      jQuery('a[href="#top"]').fadeOut();
    }
  });

  jQuery('a[href="#top"]').click(function () {
    jQuery('html, body').animate({ scrollTop: 0 }, 800);
    return false;
  });

});


document.querySelectorAll('.camisa').forEach(img => {
  img.addEventListener('click', () => {
    const id = img.getAttribute('data-id');
    window.location.href = `/SiteLoja/pages/compra.html?id=${id}`;
  });
});


function clickMenu() {
            const menuList = document.getElementById("menu-list");
            if (menuList.style.display === "flex") {
                menuList.style.display = "none";
            } else {
                menuList.style.display = "flex";
            }
        }

