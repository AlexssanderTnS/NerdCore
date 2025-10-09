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


// function clickMenu() {
//             const menuList = document.getElementById("menu-list");
//             if (menuList.style.display === "flex") {
//                 menuList.style.display = "flex";
//             } else {
//                 menuList.style.display = "flex";
//             }
//         }


function menuToggle() {
  const menuList = document.getElementById("menu-list");
  if (menuList.style.display === "flex") {
    menuList.style.display = "none";
  } else {
    menuList.style.display = "flex";
  }
}

function dropdownToggle() {
  const dropdownContent = document.querySelector(".dropdown-content");
  if (dropdownContent.style.display === "block") {
    dropdownContent.style.display = "none";
  } else {
    dropdownContent.style.display = "block";
  
  }
}

// Fechar o dropdown quando clicar fora dele
window.onclick = function(event) {
  if (!event.target.matches('.dropdown')) {
    const dropdowns = document.getElementsByClassName("dropdown-content");
    for (let i = 0; i < dropdowns.length; i++) {
      const openDropdown = dropdowns[i];
      if (openDropdown.style.display === "block") {
        openDropdown.style.display = "none";
      }
    }
  }
} 
