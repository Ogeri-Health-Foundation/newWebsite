document.addEventListener('DOMContentLoaded', function () {
  const tenant = document.querySelector(".tenant");
  const all = document.querySelector(".all-users");
  const roleElements = document.querySelectorAll(".role"); // Select all .role elements
  const banned = document.querySelectorAll(".banned");
  const statusActive = document.querySelectorAll(".status-active");
  const statusInactive = document.querySelector(".status-inactive");
  const property = document.querySelector(".property");
  const menu = document.querySelector(".menu");
  const menuBar = document.querySelectorAll(".menu-bar");
  const close = document.querySelector(".cancel");

  if(menuBar){
    menuBar.forEach(item => {
      item.addEventListener('click', function () {
        menu.style.display = "block";
      })
    });
  }

  close.addEventListener('click', function(){
    menu.style.display = "none";
  })


  if(property){
    property.addEventListener('click', function () {
      
      roleElements.forEach(role => {
        role.style.display = "none";
    });

    banned.forEach(bannedRole => {
      bannedRole.style.color = "black";
    })


    statusActive.forEach(status =>{
       status.style.color = "black";
    })
   
    statusInactive.forEach(status =>{
       status.style.color = "black";
    })

    })
  }

  if (tenant) {
      tenant.addEventListener('click', function () {
        
          roleElements.forEach(role => {
              role.style.display = "none";
          });
          
          banned.forEach(bannedRole => {
            bannedRole.style.color = "red";
          })

  
          statusActive.forEach(status =>{
             status.style.color = "green";
          })
         
          statusInactive.forEach(status =>{
             status.style.color = "gray";
          })
      });
  }

  if (all) {
      all.addEventListener('click', function () {
         
          roleElements.forEach(role => {
              role.style.display = "table-cell";
          });
      });
  }


const userTypeTabs = {
    'all': '.all-users',
    'tenant': '.tenant',
    'owner': '.property'
};

const statusTabs = {
    'ALL': {
        tab: '.ALL',
        underline: '.underline-all'
    },
    'verified': {
        tab: '.verified',
        underline: '.underline-verified'
    },
    'pending': {
        tab: '.pending',
        underline: '.underline-pending'
    },
    'notVerified': {
        tab: '.not-verified',
        underline: '.underline-not-verified'
    }
};

// Function to handle user type tab clicks
function handleUserTypeClick(clickedId) {
    Object.keys(userTypeTabs).forEach(id => {
        const element = document.querySelector(userTypeTabs[id]);
        if (id === clickedId) {
            element.classList.add('active');
        } else {
            element.classList.remove('active');
        }
    });
}

// Function to handle status tab clicks
function handleStatusClick(clickedId) {
    Object.keys(statusTabs).forEach(id => {
        const current = statusTabs[id];
        const tab = document.querySelector(current.tab);
        const underline = document.querySelector(current.underline);
        
        if (id === clickedId) {
            tab.classList.add('all-active');
            underline.classList.add('line-active');
        } else {
            tab.classList.remove('all-active');
            underline.classList.remove('line-active');
        }
        
        // Special handling for ALL tab
        if (clickedId !== 'ALL') {
            const allTab = document.querySelector(statusTabs['ALL'].tab);
            const allUnderline = document.querySelector(statusTabs['ALL'].underline);
            allTab.classList.add('status');
            allUnderline.classList.add('line');
        }
    });
}

// Add event listeners
Object.keys(userTypeTabs).forEach(id => {
    const element = document.querySelector(userTypeTabs[id]);
    element.addEventListener('click', () => handleUserTypeClick(id));
});

Object.keys(statusTabs).forEach(id => {
    const element = document.querySelector(statusTabs[id].tab);
    element.addEventListener('click', () => handleStatusClick(id));
});





    Chart.register({
      id: 'center-text-plugin',
      beforeDraw(chart) {
        const { width } = chart;
        const { height } = chart;
        const ctx = chart.ctx;
        const datasets = chart.data.datasets[0].data;
        const total = datasets.reduce((a, b) => a + b, 0); 
  
       
        ctx.restore();
        ctx.font = 'bold 16px Arial';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillStyle = '#000'; 

        ctx.fillText(total, width / 2, height / 2);
        ctx.save();
      },
    });
  
    // Chart 1 - New Users
    const ctx1 = document.getElementById('chart1').getContext('2d');
    new Chart(ctx1, {
      type: 'doughnut',
      data: {
        labels: ['Tenants', 'Property Owners'],
        datasets: [
          {
            data: [10, 10],
            backgroundColor: ['#1abc9c', '#3498db'],
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        cutout: '70%',
        plugins: {
          legend: {
            display: false, // This removes the legend.
          },
        },
      },
    });
  
    // Chart 2 - Total Users
    const ctx2 = document.getElementById('chart2').getContext('2d');
    new Chart(ctx2, {
      type: 'doughnut',
      data: {
        labels: ['Tenants', 'Property Owners'],
        datasets: [
          {
            data: [45, 25],
            backgroundColor: ['#1abc9c', '#3498db'],
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        cutout: '70%',
        plugins: {
          legend: {
            display: false,
          },
        },
      },
    });
  
    // Chart 3 - Total Tenants
    const ctx3 = document.getElementById('chart3').getContext('2d');
    new Chart(ctx3, {
      type: 'doughnut',
      data: {
        labels: ['Screened', 'Pending'],
        datasets: [
          {
            data: [20, 25, 0],
            backgroundColor: ['#dd1c12', '#30b53d'],
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        cutout: '70%',
        plugins: {
          legend: {
            display: false,
          },
        },
      },
    });
  
    // Chart 4 - Total Property Owners
    const ctx4 = document.getElementById('chart4').getContext('2d');
    new Chart(ctx4, {
      type: 'doughnut',
      data: {
        labels: ['Verified', 'Pending'],
        datasets: [
          {
            data: [15, 5,5 ],
            backgroundColor: ['#dd1c12', '#30b53d', '#66391b'],
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        cutout: '70%',
        plugins: {
          legend: {
            display: false,
          },
        },
      },
    });
  });
  