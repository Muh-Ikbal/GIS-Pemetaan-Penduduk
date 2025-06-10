const iconSideNav =  document.getElementById('iconNavbarSidenav')

iconSideNav.addEventListener('click',function(){
    console.log('Icon clicked');
    document.getElementById('sidenav-main').classList.toggle('bg-white')
    // get body element
    document.body.classList.toggle('g-sidenav-pinned')
})


// navlink active control base on url param
// get all nav links
document.addEventListener('DOMContentLoaded', () => {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
  
    for (const link of navLinks) {
      const linkPath = new URL(link.href).pathname;
      link.classList.toggle('active', linkPath === currentPath);
    }
  });
  