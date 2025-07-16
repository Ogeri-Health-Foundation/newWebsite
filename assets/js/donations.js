// For testimonials slider functionality
const container = document.querySelector(".testimonials-container");
const dotsWrapper = document.querySelector(".pagination-dots");
const cards = document.querySelectorAll(".testimonial-card");

let currentSlide = 0;
let cardsPerSlide = getCardsPerSlide(); // Based on screen size
let cardWidth = cards[0].offsetWidth + 30; // 30px is the gap
let totalSlides = getTotalSlides();

// To dynamically create dots based on totalSlides
function renderDots() {
  dotsWrapper.innerHTML = "";
  for (let i = 0; i < totalSlides; i++) {
    const dot = document.createElement("span");
    dot.classList.add("dot");
    if (i === 0) dot.classList.add("active");
    dot.addEventListener("click", () => {
      goToSlide(i);
      resetAutoSlide();
    });
    dotsWrapper.appendChild(dot);
  }
}

// To detect screen size to determine cardsPerSlide
function getCardsPerSlide() {
  if (window.innerWidth <= 768) return 1; // Mobile
  if (window.innerWidth <= 1024) return 2; // Tablet
  return 3; // Desktop
}

// To calculate how many slides are needed
function getTotalSlides() {
  return Math.ceil(cards.length / cardsPerSlide);
}

function goToSlide(index) {
  currentSlide = index;

  // To prevent scrolling past the last full set of cards
  const maxOffset = (cards.length - cardsPerSlide) * cardWidth;
  const offset = Math.min(index * cardWidth, maxOffset);

  container.style.transform = `translateX(-${offset}px)`;

  document.querySelectorAll(".dot").forEach((dot, i) => {
    dot.classList.toggle("active", i === index);
  });
}

// To handle window resizing
function handleResize() {
  cardsPerSlide = getCardsPerSlide();
  cardWidth = cards[0].offsetWidth + 30;
  totalSlides = getTotalSlides();
  if (currentSlide > totalSlides - 1) {
    currentSlide = totalSlides - 1;
  }
  renderDots();
  goToSlide(currentSlide);
}

let autoSlideInterval = setInterval(() => {
  currentSlide = (currentSlide + 1) % totalSlides;
  goToSlide(currentSlide);
}, 6000);

function resetAutoSlide() {
  clearInterval(autoSlideInterval);
  autoSlideInterval = setInterval(() => {
    currentSlide = (currentSlide + 1) % totalSlides;
    goToSlide(currentSlide);
  }, 6000);
}

window.addEventListener("resize", handleResize);

// To initialize on load
handleResize();
goToSlide(0);

// For the donation amount selection
document.addEventListener("DOMContentLoaded", () => {
  const amountButtons = document.querySelectorAll(".amount-option-btn");
  const customAmountInput = document.getElementById("donation_amount");
  const currencySelect = document.getElementById("currency");

  const currencySymbols = {
    NGN: "₦",
    USD: "$",
    EUR: "€",
  };

  const amountValues = [100000, 50000, 20000, 10000, 5000];
  let selectedCurrency = currencySelect.value;

  // Format amount with currency symbol
  function formatAmount(amount, currency) {
    return currencySymbols[currency] + amount.toLocaleString();
  }

  // Update amount buttons and custom input placeholder/value
  function updateAmounts() {
    selectedCurrency = currencySelect.value;

    amountButtons.forEach((btn, i) => {
      btn.textContent = formatAmount(amountValues[i], selectedCurrency);
    });

    const selectedBtn = document.querySelector(".amount-option-btn.selected");
    if (selectedBtn) {
      customAmountInput.value = selectedBtn.textContent;
      customAmountInput.placeholder = selectedBtn.textContent;
    }
  }

  // Amount button click handler
  amountButtons.forEach((button) => {
    button.addEventListener("click", () => {
      amountButtons.forEach((btn) => btn.classList.remove("selected"));
      button.classList.add("selected");
      customAmountInput.value = button.textContent;
    });
  });

  // Currency change handler
  currencySelect.addEventListener("change", () => {
    updateAmounts();
  });

  // Initialize default values
  updateAmounts();
});
