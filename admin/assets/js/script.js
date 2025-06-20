document.addEventListener("DOMContentLoaded", function () {
  // Blog Chart
  const ctx = document.getElementById("engagementChart");
  if (ctx) {
    const context = ctx.getContext("2d");
    const gradient = context.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, "rgba(255, 110, 59, 0.6)");
    gradient.addColorStop(1, "rgba(255, 110, 59, 0)");

    new Chart(context, {
      type: "line",
      data: {
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
        datasets: [
          {
            label: "Posts Per Month",
            data: [5, 8, 6, 10, 7, 12, 15, 9, 11, 14, 10, 13],
            backgroundColor: gradient,
            borderColor: "#ff6e3b",
            borderWidth: 3,
            pointBackgroundColor: "#fff",
            pointBorderColor: "#ff6e3b",
            pointRadius: 6,
            pointHoverRadius: 8,
            fill: true,
            tension: 0.4,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: true,
            position: "top",
          },
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 2,
            },
            grid: {
              borderDash: [5, 5],
              color: "rgba(0, 0, 0, 0.1)",
            },
          },
          x: {
            grid: {
              display: false,
            },
          },
        },
      },
    });
  }

  // Ticket Chart
  
});
