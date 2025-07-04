"use strict";
document.addEventListener("DOMContentLoaded", function () {
  const slidebar1 = document.querySelector(".slidebar1");
  const whiteslide1 = document.querySelector(".whiteslide1");
  const slidebar2 = document.querySelector(".slidebar2");
  const whiteslide2 = document.querySelector(".whiteslide2");
  const messageButton = document.querySelector(".message-button");
  const deleteButton = document.querySelector(".delete-button");
  const overlay = document.querySelector(".overlay");
  const overlayDelete = document.querySelector(".overlay-delete");
  const overlayDeleteSuccess = document.querySelector(".overlay-delete-success");
  const overlaySentFeedback = document.querySelector(".overlay-sent-feedback");
  const cancelButtons = document.querySelectorAll(".cancel-button");
  const confirmDelete = document.querySelector(".confirm-delete");
  const sendFeedback = document.querySelector(".send-feedback");

  slidebar1.addEventListener("click", function () {
    whiteslide1.classList.toggle("toggle");
  });

  slidebar2.addEventListener("click", function () {
    whiteslide2.classList.toggle("toggle");
  });

  messageButton.addEventListener("click", function () {
    overlay.classList.add("show");
  });

  deleteButton.addEventListener("click", function () {
    overlayDelete.classList.add("overlay-delete-show");
  });

  confirmDelete.addEventListener("click", function () {
    overlayDelete.classList.remove("overlay-delete-show");
    overlayDeleteSuccess.classList.add("overlay-delete-success-show");
  });

  sendFeedback.addEventListener("click", function (e) {
    e.preventDefault();
    overlay.classList.remove("show");
    overlaySentFeedback.classList.add("overlay-sent-feedback-show");
    
  });

  cancelButtons.forEach(button => {
    button.addEventListener("click", function () {
      overlay.classList.remove("show");
      overlayDelete.classList.remove("overlay-delete-show");
      overlayDeleteSuccess.classList.remove("overlay-delete-success-show");
      overlaySentFeedback.classList.remove("overlay-sent-feedback-show");
    });
  });
});
