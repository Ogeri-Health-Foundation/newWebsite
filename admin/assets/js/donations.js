function redirect(event) {
  let hostname, path, protocol, port;
  const target = event.target
  if (target.classList.contains('add-donation-btn')) {
    hostname = window.location.hostname;
    protocol = window.location.protocol;
    port = window.location.port;
    //temp hardcoded link
    path = `${protocol}//localhost:${port}/admin/add-donation.php`;
    window.location.assign(path);
  }
}
function popUp(event) {
  const target = event.target;
  target.firstElementChild.style.display = 'block';
}

function closePopUps(event, nodes) {
  const target = event.target;
  if (
    !target.classList.contains('don-dropdown-nav') &&
    !target.classList.contains('don-dropdown-container') &&
    !target.classList.contains('don-dropdown-menu') &&
    !target.classList.contains('don-dropdown-toggle')
  ) {
    nodes.forEach((element) => {
      if (window.getComputedStyle(event.target).display === 'block') {
        element.style.display = 'none';
      }
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const popUpBtn = document.querySelectorAll('.don-dropdown-toggle');
  const popUpMenu = document.querySelectorAll('.don-dropdown-menu');
  const addDonationBtn = document.querySelector('.add-donation-btn');

  popUpBtn.forEach((element) => {
    element.addEventListener('click', (event) => popUp(event));
  });
  window.addEventListener('click', (event) => closePopUps(event, popUpMenu));
  addDonationBtn.addEventListener('click', (event) => redirect(event));
});
