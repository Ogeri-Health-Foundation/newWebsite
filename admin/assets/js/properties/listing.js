"use strict";


document.addEventListener("DOMContentLoaded", function () {
  const ALL = document.querySelector(".ALL"); 
  const underLineAll = document.querySelector(".underline-all");
  const verified = document.querySelector(".verified");
  const underlineVerified = document.querySelector(".underline-verified");
  const notVerified = document.querySelector(".not-verified");
  const underlineNotVerified = document.querySelector(
    ".underline-not-verified"
  );
  const pending = document.querySelector(".pending");
  const underlinePending = document.querySelector(".underline-pending");
  const menuBar = document.querySelectorAll(".menu-bar");
  const close = document.querySelector(".cancel");
  const menu = document.querySelector(".menu");
  
  const verificationStatus = document.querySelectorAll(".verification-status");
  const verification = document.querySelector(".verification");

  const filterProperty = document.querySelector(".filter-property");
  const filter = document.querySelector(".filter");
  const radioInputs = document.querySelectorAll("input[type='radio']");
  const cancel = document.querySelector(".cancell");
  console.log(cancel);

  if (filter && filterProperty) {
    filter.addEventListener("click", function () {
      filterProperty.style.transform = "translateX(0)";
    });
  }

  if (cancel) {
    cancel.addEventListener("click", function () {
      filterProperty.style.transform = "translateX(-150%)";
    });
  }

  radioInputs.forEach((radio) => {
    radio.addEventListener("click", function () {
      filterProperty.style.transform = "translateX(-150%)";
    });
  });
  

  menuBar.forEach((item) => {
    item.addEventListener("click", function () {
      menu.style.display = "block";
    });
  });

  close.addEventListener("click", function () {
    menu.style.display = "none";
  });


  verified.addEventListener("click", function () {
    verified.classList.add("all-active");
    underlineVerified.classList.add("line-active");
    ALL.classList.remove("all-active");
    ALL.classList.add("status");
    underLineAll.classList.remove("line-active");
    underLineAll.classList.add("line");
    pending.classList.remove("all-active");
    underlinePending.classList.remove("line-active");
    verification.classList.remove("d-none");

    verificationStatus.forEach((status) => {
      status.classList.remove("d-none");
      status.textContent = "Verified";
      status.style.color = "green";
    });
  });

  pending.addEventListener("click", function () {
    
    pending.classList.add("all-active");
    underlinePending.classList.add("line-active");
    ALL.classList.remove("all-active");
    ALL.classList.add("status");
    underLineAll.classList.remove("line-active");
    underLineAll.classList.add("line");
    verified.classList.remove("all-active");
    underlineVerified.classList.remove("line-active");
    notVerified.classList.remove("all-active");
    underlineNotVerified.classList.remove("line-active");

    verificationStatus.forEach((status) => {
      status.classList.remove("d-none");
      status.textContent = "Pending";
      status.style.color = "gray";
    });

    verification.classList.remove("d-none");
  });

  notVerified.addEventListener("click", function () {
   
    notVerified.classList.add("all-active");
    underlineNotVerified.classList.add("line-active");
    ALL.classList.remove("all-active");
    ALL.classList.add("status");
    underLineAll.classList.remove("line-active");
    underLineAll.classList.add("line");
    verified.classList.remove("all-active");
    underlineVerified.classList.remove("line-active");
    pending.classList.remove("all-active");
    underlinePending.classList.remove("line-active");

    verificationStatus.forEach((status) => {
      status.classList.remove("d-none");
      status.textContent = "Not Verified";
      status.style.color = "red";
    });

    verification.classList.remove("d-none");
  });

  ALL.addEventListener("click", function () {
    ALL.classList.add("all-active");
    underLineAll.classList.add("line-active");
    verified.classList.remove("all-active");
    underlineVerified.classList.remove("line-active");
    pending.classList.remove("all-active");
    underlinePending.classList.remove("line-active");
    notVerified.classList.remove("all-active");
    underlineNotVerified.classList.remove("line-active");

    verificationStatus.forEach((status) => {
      status.classList.add("d-none");
    });
    verification.classList.add("d-none");
  });

  // Chart initialization
  function calculateSum(values) {
    return values.reduce((a, b) => a + b, 0);
  }

  function createDoughnutChart(elementId, values, colors, sumId) {
    const ctx = document.getElementById(elementId);
    if (!ctx) {
      console.error(`Element with id ${elementId} not found`);
      return;
    }
    const total = calculateSum(values);
    const sumElement = document.getElementById(sumId);
    if (sumElement) {
      sumElement.textContent = total;
    } else {
      console.error(`Element with id ${sumId} not found`);
    }

    return new Chart(ctx.getContext("2d"), {
      type: "doughnut",
      data: {
        datasets: [
          {
            data: values,
            backgroundColor: colors,
            borderWidth: 0,
            cutout: "80%",
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
          tooltip: {
            enabled: false,
          },
        },
      },
    });
  }

  createDoughnutChart(
    "totalPropertiesChart",
    [45, 35, 10],
    ["#4ad795", "#62cdf3", "#444444"],
    "totalSum"
  );

  createDoughnutChart(
    "verificationChart",
    [50, 25, 15],
    ["#dd1c12", "#30b53d", "#66391b"],
    "verificationSum"
  );

  createDoughnutChart(
    "propertyTypesChart",
    [50, 25, 15],
    ["#dd1c12", "#30b53d", "#66391b"],
    "typesSum"
  );
});
