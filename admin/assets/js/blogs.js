// //test data
// const healthcareWorkers = [
//   {
//     id: 1,
//     name: 'Dr. John Doe',
//     specialty: 'Cardiologist',
//     rating: 4.8,
//     about:
//       'Experienced cardiologist specializing in heart diseases and preventive care.',
//     certification: 'Board Certified in Cardiology',
//     address: '123 Heart Lane, Lagos, Nigeria',
//     telephone: '+234 800 123 4567',
//     img: 'https://example.com/dr-john-doe.jpg',
//     email: 'johndoe@example.com',
//   },
//   {
//     id: 2,
//     name: 'Dr. Aisha Bello',
//     specialty: 'Pediatrician',
//     rating: 4.9,
//     about:
//       'Compassionate pediatrician with over 10 years of experience in child healthcare.',
//     certification: 'Board Certified in Pediatrics',
//     address: '45 Kids Avenue, Abuja, Nigeria',
//     telephone: '+234 700 987 6543',
//     img: 'https://example.com/dr-aisha-bello.jpg',
//     email: 'aishabello@example.com',
//   },
//   {
//     id: 3,
//     name: 'Nurse Grace Eze',
//     specialty: 'Registered Nurse',
//     rating: 4.7,
//     about:
//       'Dedicated registered nurse with experience in emergency care and patient support.',
//     certification: 'RN, BSc Nursing',
//     address: '78 Health Street, Lagos, Nigeria',
//     telephone: '+234 803 456 7890',
//     img: 'https://example.com/nurse-grace-eze.jpg',
//     email: 'graceeze@example.com',
//   },
//   {
//     id: 4,
//     name: 'Dr. Michael Chukwuma',
//     specialty: 'Orthopedic Surgeon',
//     rating: 4.6,
//     about:
//       'Expert orthopedic surgeon specializing in joint replacements and sports injuries.',
//     certification: 'Board Certified in Orthopedic Surgery',
//     address: '55 Bone Care Road, Port Harcourt, Nigeria',
//     telephone: '+234 810 654 3210',
//     img: 'https://example.com/dr-michael-chukwuma.jpg',
//     email: 'michaelchukwuma@example.com',
//   },
//   {
//     id: 5,
//     name: 'Nurse Fatima Suleiman',
//     specialty: 'Midwife',
//     rating: 4.9,
//     about:
//       'Passionate midwife dedicated to ensuring safe deliveries and maternal care.',
//     certification: 'Certified Midwife, BSc Nursing',
//     address: '22 Maternity Crescent, Kano, Nigeria',
//     telephone: '+234 802 765 4321',
//     img: 'https://example.com/nurse-fatima-suleiman.jpg',
//     email: 'fatimasuleiman@example.com',
//   },
// ];

// const closeModal = (event) => {
//   //mind the html structure here
//   event.target.parentNode.parentNode.style.display = 'none';
// };

// const handleDrModal = (event) => {
//   const target = event.target;
//   if (target.tagName === 'SPAN' && target.classList.contains('view-details')) {
//     const modal = document.querySelector('.doctors-details-modal-container');
//     modal.style.display = 'block';
//   }
// };
// const handleBlogModal = (event) => {
//   const target = event.target;
//   if (target.tagName === 'SPAN' && target.classList.contains('view-details')) {
//     const modal = document.querySelector('.blog-details-modal-container');//target.querySelector('.blog-details-modal-container');
//     modal.style.display = 'block';
//   }
// };

// function toggleSideMenu(event) {
//   const clickedElem = event.target.nextElementSibling;
//   clickedElem.style.display = 'block';
// }
// document.addEventListener('DOMContentLoaded', () => {
//   const providerName = document.querySelectorAll('.modal-box-doctor .view-details');
//   const viewBlog = document.querySelectorAll('.modal-box-blog .view-details');
//   const closeBtn = document.querySelectorAll('.close');
//   const dotBtn = document.querySelectorAll('.dot-btn');

//   dotBtn.forEach((node) => {
//     node.addEventListener('click', (event) => {
//       toggleSideMenu(event);
//     });
//   });
//   providerName.forEach((node) => {
//     node.addEventListener('click', (event) => handleDrModal(event));
//   });

//   viewBlog.forEach((node) => {
//     node.addEventListener('click', (event) => handleBlogModal(event));
//   });

//   closeBtn.forEach((node) => {
//     node.addEventListener('click', (event) => {
//       closeModal(event);
//     });
//   });

//   window.onclick = function (event) {
//     const blogModals = document.querySelectorAll('.modal-box-blog');
//     const doctorsModal = document.querySelectorAll('.modal-box-doctor');
//     const drDetailsModal = document.querySelectorAll(
//       '.doctors-details-modal-container'
//     );

//     const blogDetailsModal = document.querySelectorAll(
//       '.blog-details-modal-container'
//     );

//     drDetailsModal.forEach((modal) => {
//       // If the modal is visible and the click target is not inside the modal and not the provider name
//       if (
//         modal.style.display === 'block' &&
//         !modal.contains(event.target) &&
//         !event.target.classList.contains('view-details')
//       ) {
//         modal.style.display = 'none';
//       }
//     });

//     blogDetailsModal.forEach((modal) => {
//       // If the modal is visible and the click target is not inside the modal and not the provider-name
//       if (
//         modal.style.display === 'block' &&
//         !modal.contains(event.target) &&
//         !event.target.classList.contains('view-details')
//       ) {
//         modal.style.display = 'none';
//       }
//     });

//     blogModals.forEach((modal) => {
//       if (
//         modal.style.display === 'block' &&
//         !modal.contains(event.target) &&
//         !event.target.classList.contains('dot-btn')
//       ) {
//         modal.style.display = 'none';
//       }
//     });
//     doctorsModal.forEach((modal) => {
//       if (
//         modal.style.display === 'block' &&
//         !modal.contains(event.target) &&
//         !event.target.classList.contains('dot-btn')
//       ) {
//         modal.style.display = 'none';
//       }
//     });
//   }; //end of window event
// });
