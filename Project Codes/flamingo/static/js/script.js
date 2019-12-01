

window.addEventListener('scroll', stick_nav_bar);

let nav_bar = document.querySelector('#navigation_bar');
let stuck = false;
function stick_nav_bar() {
  if (!stuck && window.scrollY > 50) {
    nav_bar.classList.add('stick_nav_bar');
    stuck = true;
  } else if (stuck && window.scrollY < 50){
    nav_bar.classList.remove('stick_nav_bar');
    stuck = false;
  }
}

// to auto stick navbar after reload
stick_nav_bar();