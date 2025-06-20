// create the chart
//test data
const blogs = [
  {
    title: "Understanding Inventory Management in Pharmacies",
    category: "Pharmacy Operations",
    dateCreated: "2025-03-10",
    datePublished: "2025-03-12",
    status: "Published"
  },
  {
    title: "Getting Started with Redux Toolkit",
    category: "Web Development",
    dateCreated: "2025-03-08",
    datePublished: null,
    status: "Draft"
  },
  {
    title: "How to Optimize Procurement in Community Pharmacies",
    category: "Pharmacy Business",
    dateCreated: "2025-03-05",
    datePublished: "2025-03-11",
    status: "Published"
  },
  {
    title: "React Testing Library Best Practices",
    category: "Web Development",
    dateCreated: "2025-03-06",
    datePublished: null,
    status: "Draft"
  },
  {
    title: "Starting a Locum Job Site: Key Considerations",
    category: "Healthcare Business",
    dateCreated: "2025-03-09",
    datePublished: "2025-03-13",
    status: "Published"
  }
];
const healthcareWorkers = [
  {
    id: 1,
    name: 'Dr. John Doe',
    specialty: 'Cardiologist',
    rating: 4.8,
    about:
      'Experienced cardiologist specializing in heart diseases and preventive care.',
    certification: 'Board Certified in Cardiology',
    address: '123 Heart Lane, Lagos, Nigeria',
    telephone: '+234 800 123 4567',
    img: 'https://example.com/dr-john-doe.jpg',
    email: 'johndoe@example.com',
  },
  {
    id: 2,
    name: 'Dr. Aisha Bello',
    specialty: 'Pediatrician',
    rating: 4.9,
    about:
      'Compassionate pediatrician with over 10 years of experience in child healthcare.',
    certification: 'Board Certified in Pediatrics',
    address: '45 Kids Avenue, Abuja, Nigeria',
    telephone: '+234 700 987 6543',
    img: 'https://example.com/dr-aisha-bello.jpg',
    email: 'aishabello@example.com',
  },
  {
    id: 3,
    name: 'Nurse Grace Eze',
    specialty: 'Registered Nurse',
    rating: 4.7,
    about:
      'Dedicated registered nurse with experience in emergency care and patient support.',
    certification: 'RN, BSc Nursing',
    address: '78 Health Street, Lagos, Nigeria',
    telephone: '+234 803 456 7890',
    img: 'https://example.com/nurse-grace-eze.jpg',
    email: 'graceeze@example.com',
  },
  {
    id: 4,
    name: 'Dr. Michael Chukwuma',
    specialty: 'Orthopedic Surgeon',
    rating: 4.6,
    about:
      'Expert orthopedic surgeon specializing in joint replacements and sports injuries.',
    certification: 'Board Certified in Orthopedic Surgery',
    address: '55 Bone Care Road, Port Harcourt, Nigeria',
    telephone: '+234 810 654 3210',
    img: 'https://example.com/dr-michael-chukwuma.jpg',
    email: 'michaelchukwuma@example.com',
  },
  {
    id: 5,
    name: 'Nurse Fatima Suleiman',
    specialty: 'Midwife',
    rating: 4.9,
    about:
      'Passionate midwife dedicated to ensuring safe deliveries and maternal care.',
    certification: 'Certified Midwife, BSc Nursing',
    address: '22 Maternity Crescent, Kano, Nigeria',
    telephone: '+234 802 765 4321',
    img: 'https://example.com/nurse-fatima-suleiman.jpg',
    email: 'fatimasuleiman@example.com',
  },
];
//end test data

// modal handlers
// function modalHandler() {

// }

//TODO: Need to have a single modal management function or merge the closing modal logic
function toggleSideMenu(event) {
  const clickedElem = event.target.nextElementSibling;
  clickedElem.style.display = 'block';
}
function toggleTables() {
  //if the blogs data and doctors data are empty hide those tables
  const blogsCount = blogs.length;
  const hcWorkersCount = healthcareWorkers.length;
  if (blogsCount === 0) {
    //hide the filled table
    const target = document.querySelector('.filled-blog-table');
    if (target) {
      target.style.display = 'none';
    }

  } else {
    //hide the empty table
    const target = document.querySelector('.empty-blog-table');
    if (target) {
      target.style.display = 'none'
    }
  }
  if (hcWorkersCount === 0) {
    //hide the filled table
    const target = document.querySelector('.filled-doctors-table');
    if (target) {
      target.style.display = 'none';
    }

  } else {
    //hide the empty table
    const target = document.querySelectorAll('.empty-doctors-table');
    if (target) {
      target.forEach(elem => {
        elem.style.display = 'none';
      })
    }
  }
}
// document.addEventListener('DOMContentLoaded', () => {
//   const dotBtn = document.querySelectorAll('.dot-btn');
//   const blogModals = document.querySelectorAll('.modal-box-blog');
//   const doctorsModal = document.querySelectorAll('.modal-box-doctor');

//   toggleTables();
//   dotBtn.forEach((node) => {
//     node.addEventListener('click', (event) => {
//       toggleSideMenu(event);
//     });
//   });
//   drawChart();
//   window.onclick = function (event) {
//     //close modal when user click away
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
//   };
// });
