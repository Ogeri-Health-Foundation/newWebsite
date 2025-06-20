// Wait for the DOM to be loaded
document.addEventListener('DOMContentLoaded', function() {
    // Check if Chart.js is loaded
    if (typeof Chart === 'undefined') {
        console.error('Chart.js is not loaded!');
        return;
    }

    // Initialize Donut Charts
    try {
        // Users Donut Chart
        const usersCtx = document.getElementById('usersDonutChart');
        if (usersCtx) {
            new Chart(usersCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Tenants', 'Property Owners'],
                    datasets: [{
                        data: [10, 10],
                        backgroundColor: ['#2E71EB', '#05CE49'],
                        borderWidth: 0,
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            });
        } else {
            console.error('Users donut chart canvas not found');
        }

        // Properties Donut Chart
        const propertiesCtx = document.getElementById('propertiesDonutChart');
        if (propertiesCtx) {
            new Chart(propertiesCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Bedroom', 'Mini Flat'],
                    datasets: [{
                        data: [20, 4],
                        backgroundColor: ['#2E71EB', '#05CE49'],
                        borderWidth: 0,
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            });
        } else {
            console.error('Properties donut chart canvas not found');
        }

        // Applications Line Chart
        const appCtx = document.getElementById('myChart');
        if (appCtx) {
            new Chart(appCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        data: [10, 18, 20, 22, 24, 25, 28, 30, 32, 35, 38, 40],
                        borderColor: '#EF476F',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        } else {
            console.error('Applications line chart canvas not found');
        }

        // Properties Rented Line Chart
        const rentedCtx = document.getElementById('propertiesRentedChart');
        if (rentedCtx) {
            new Chart(rentedCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                        label: 'Properties Rented',
                        data: [1, 2, 3, 2, 5, 3, 4, 3, 4, 5, 6, 7],
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        tension: 0.4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            enabled: true,
                        }
                    },
                },
            });
        } else {
            console.error('Properties rented chart canvas not found');
        }
    } catch (error) {
        console.error('Error initializing charts:', error);
    }
});
