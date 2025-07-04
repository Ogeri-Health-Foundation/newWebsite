document.addEventListener("DOMContentLoaded", function () {
  init();
});

// Initial volunteers data
const initialVolunteers = [
  {
    id: "1",
    name: "Anwara Callistus",
    gender: "Male",
    profession: "FullStack Developer",
    volunteerField: "Patient Clinic",
    status: "Approved",
    email: "anwara.callistus@example.com",
    age: 32,
    location: "123 Main St, City, Country",
    image: "../assets/images/includes/woman.svg",
    certification: "https://via.placeholder.com/600x300",
    reasonForVolunteering:
      "I want to contribute to the community and help those in need.",
  },
  {
    id: "2",
    name: "Joy Abel",
    gender: "Female",
    profession: "HR Lead",
    volunteerField: "Fundraising",
    status: "Pending",
    email: "joy.abel@example.com",
    age: 28,
    location: "456 Oak St, City, Country",
    image: "https://via.placeholder.com/100",
    certification: "https://via.placeholder.com/600x300",
    reasonForVolunteering:
      "I believe in the mission of the foundation and want to help.",
  },
  {
    id: "3",
    name: "Lois Sandra",
    gender: "Female",
    profession: "HR Lead",
    volunteerField: "Fundraising",
    status: "Rejected",
    email: "lois.sandra@example.com",
    age: 35,
    location: "789 Pine St, City, Country",
    image: "https://via.placeholder.com/100",
    certification: "https://via.placeholder.com/600x300",
    reasonForVolunteering:
      "I have experience in fundraising and want to contribute.",
  },
  {
    id: "4",
    name: "Badmus Segun",
    gender: "Male",
    profession: "Marketing",
    volunteerField: "Administration",
    status: "Pending",
    email: "badmus.segun@example.com",
    age: 30,
    location: "101 Elm St, City, Country",
    image: "https://via.placeholder.com/100",
    certification: "https://via.placeholder.com/600x300",
    reasonForVolunteering:
      "I want to use my marketing skills to help the foundation grow.",
  },
];

// State variables
let volunteers = [...initialVolunteers];
let selectedVolunteer = null;
let volunteerToDelete = null;

// Initialize the application
function init() {
  const volunteersTableBody = document.getElementById("volunteers-table-body");

  if (!volunteersTableBody) {
    console.error(
      'Error: Could not find element with ID "volunteers-table-body"'
    );
    return;
  }

  renderVolunteers();
  setupEventListeners();
  setupPagination();
  setupExportAndFilter();
}

// Render volunteers table
function renderVolunteers(volunteersToRender = volunteers) {
  const volunteersTableBody = document.getElementById("volunteers-table-body");
  if (!volunteersTableBody) return;

  volunteersTableBody.innerHTML = "";

  volunteersToRender.forEach((volunteer) => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${volunteer.name}</td>
      <td>${volunteer.gender}</td>
      <td>${volunteer.profession}</td>
      <td>${volunteer.volunteerField}</td>
      <td>
        <span class="status-badge status-${volunteer.status.toLowerCase()}">
          ${volunteer.status}
        </span>
      </td>
      <td>
        <button class="action-button" data-volunteer-id="${volunteer.id}">
          <i class="fas fa-ellipsis-v"></i>
        </button>
      </td>
    `;
    volunteersTableBody.appendChild(row);
  });
}

// Add pagination functionality
function setupPagination() {
  const itemsPerPage = 5;
  let currentPage = 1;
  const prevBtn = document.querySelector(".btn-prev");
  const nextBtn = document.querySelector(".btn-next");
  const paginationNumbers = document.querySelector(".page-numbers");

  if (!prevBtn || !nextBtn || !paginationNumbers) {
    console.error("Pagination elements not found");
    return;
  }

  function updatePagination() {
    const totalPages = Math.ceil(volunteers.length / itemsPerPage);
    paginationNumbers.innerHTML = "";

    // Add first page
    if (totalPages > 0) {
      const button1 = document.createElement("button");
      button1.className = `pagination-number ${
        currentPage === 1 ? "active" : ""
      }`;
      button1.textContent = 1;
      button1.addEventListener("click", () => goToPage(1));
      paginationNumbers.appendChild(button1);
    }

    // Add middle pages with ellipsis if needed
    if (totalPages > 6) {
      if (currentPage > 3) {
        const ellipsis1 = document.createElement("span");
        ellipsis1.textContent = "...";
        paginationNumbers.appendChild(ellipsis1);
      }

      const startPage = Math.max(2, currentPage - 1);
      const endPage = Math.min(totalPages - 1, currentPage + 1);

      for (let i = startPage; i <= endPage; i++) {
        const button = document.createElement("button");
        button.className = `pagination-number ${
          i === currentPage ? "active" : ""
        }`;
        button.textContent = i;
        button.addEventListener("click", () => goToPage(i));
        paginationNumbers.appendChild(button);
      }

      if (currentPage < totalPages - 2) {
        const ellipsis2 = document.createElement("span");
        ellipsis2.textContent = "...";
        paginationNumbers.appendChild(ellipsis2);
      }
    } else {
      for (let i = 2; i < totalPages; i++) {
        const button = document.createElement("button");
        button.className = `pagination-number ${
          i === currentPage ? "active" : ""
        }`;
        button.textContent = i;
        button.addEventListener("click", () => goToPage(i));
        paginationNumbers.appendChild(button);
      }
    }

    // Add last page if there's more than one page
    if (totalPages > 1) {
      const buttonLast = document.createElement("button");
      buttonLast.className = `pagination-number ${
        currentPage === totalPages ? "active" : ""
      }`;
      buttonLast.textContent = totalPages;
      buttonLast.addEventListener("click", () => goToPage(totalPages));
      paginationNumbers.appendChild(buttonLast);
    }

    // Update prev/next buttons
    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === totalPages;
  }

  function goToPage(page) {
    currentPage = page;
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedVolunteers = volunteers.slice(start, end);

    renderVolunteers(paginatedVolunteers);
    updatePagination();
  }

  // Setup pagination event listeners
  prevBtn.addEventListener("click", () => {
    if (currentPage > 1) goToPage(currentPage - 1);
  });

  nextBtn.addEventListener("click", () => {
    const totalPages = Math.ceil(volunteers.length / itemsPerPage);
    if (currentPage < totalPages) goToPage(currentPage + 1);
  });

  // Initial pagination setup
  updatePagination();
  goToPage(1);
}

// Add export and filter functionality
function setupExportAndFilter() {
  const exportBtn = document.getElementById("exportBtn");
  const filterBtn = document.getElementById("filterBtn");
  
  if (!exportBtn || !filterBtn) {
    console.error("Export or filter buttons not found");
    return;
  }

  // Export functionality
  exportBtn.addEventListener("click", () => {
    const csvContent = volunteers.map((volunteer) => {
      return [
        volunteer.name,
        volunteer.gender,
        volunteer.profession,
        volunteer.volunteerField,
        volunteer.status,
        volunteer.email,
      ].join(",");
    });

    const header = ["Name,Gender,Profession,Field,Status,Email"].join(",");
    const csv = [header, ...csvContent].join("\n");

    const blob = new Blob([csv], { type: "text/csv" });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = "volunteers.csv";
    a.click();
    window.URL.revokeObjectURL(url);

    showToast("Export completed successfully", "success");
  });

  // Filter functionality
  filterBtn.addEventListener("click", () => {
    const filterOptions = {
      status: ["All", "Approved", "Pending", "Rejected"],
      field: [
        "All",
        "Patient Clinic",
        "Fundraising",
        "Administration",
        "Marketing",
      ],
    };

    // Create and show filter modal
    const existingFilterModal = document.getElementById("filter-modal");
    if (existingFilterModal) {
      document.body.removeChild(existingFilterModal);
    }

    const filterModal = document.createElement("div");
    filterModal.className = "modal";
    filterModal.id = "filter-modal";
    filterModal.innerHTML = `
      <div class="modal-content">
        <h2>Filter Volunteers</h2>
        <div class="filter-options">
          <div class="form-group">
            <label>Status</label>
            <div class="select-container">
              <select id="status-filter">
                ${filterOptions.status
                  .map(
                    (status) => `<option value="${status}">${status}</option>`
                  )
                  .join("")}
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Field</label>
            <div class="select-container">
              <select id="field-filter">
                ${filterOptions.field
                  .map((field) => `<option value="${field}">${field}</option>`)
                  .join("")}
              </select>
            </div>
          </div>
        </div>
        <div class="form-actions">
          <button type="button" class="btn btn-outline" id="cancel-filter-btn">Cancel</button>
          <button type="button" class="btn btn-primary" id="apply-filter-btn">Apply</button>
        </div>
      </div>
    `;
    document.body.appendChild(filterModal);
    openModal(filterModal);

    // Add event listeners for filter modal buttons
    document
      .getElementById("cancel-filter-btn")
      .addEventListener("click", closeAllModals);
    document
      .getElementById("apply-filter-btn")
      .addEventListener("click", applyFilters);
  });
}

// Apply filters
function applyFilters() {
  const statusFilter = document.getElementById("status-filter").value;
  const fieldFilter = document.getElementById("field-filter").value;

  let filteredVolunteers = [...volunteers];

  if (statusFilter !== "All") {
    filteredVolunteers = filteredVolunteers.filter(
      (v) => v.status === statusFilter
    );
  }

  if (fieldFilter !== "All") {
    filteredVolunteers = filteredVolunteers.filter(
      (v) => v.volunteerField === fieldFilter
    );
  }

  renderVolunteers(filteredVolunteers);
  setupPagination(); 
  closeAllModals();
  showToast(`Filtered to show ${filteredVolunteers.length} volunteers`, "info");
}

// Setup event listeners
function setupEventListeners() {
  // Add volunteer button
  const addVolunteerBtn = document.querySelector(".btn-add");
  if (addVolunteerBtn) {
    addVolunteerBtn.addEventListener("click", () => {
      resetAddForm();
      new bootstrap.Modal(document.getElementById("addVolunteerModal")).show();
    });
  }

  // Cancel buttons
  document.querySelectorAll(".cancel-btn, .close-details-btn").forEach((button) => {
    button.addEventListener("click", () => {
      document.querySelectorAll(".modal").forEach((modal) => {
        new bootstrap.Modal(modal).hide();
      });
    });
  });

  // Add volunteer form submission
  const volunteerForm = document.getElementById("volunteerForm");
  if (volunteerForm) {
    volunteerForm.addEventListener("submit", handleAddVolunteer);
  }

  // Profile image upload

    const profileUploadContainer = document.getElementById("profile-upload-container");
    const profileUpload = document.getElementById("profile-upload");
    const profilePreview = document.getElementById("profile-preview");
    const uploadPlaceholder = document.querySelector(".upload-placeholder");
    const uploadPreview = document.querySelector(".upload-preview");
    const removeProfileImage = document.getElementById("remove-profile-image");
    const uploadArea = document.getElementById("uploadArea");
  
    if (profileUploadContainer && profileUpload && profilePreview && uploadPlaceholder && uploadPreview) {
      
      // Clicking the upload area triggers file selection
      uploadArea.addEventListener("click", () => {
        profileUpload.click();
      });
  
      profileUpload.addEventListener("change", (e) => {
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = (event) => {
            profilePreview.src = event.target.result;
            uploadPlaceholder.style.display = "none";
            uploadPreview.style.display = "block";
          };
          reader.readAsDataURL(file);
        }
      });
  
      // Remove profile image functionality
      if (removeProfileImage) {
        removeProfileImage.addEventListener("click", (e) => {
          e.stopPropagation();
          profileUpload.value = "";
          profilePreview.src = "/placeholder.svg"; // Ensure a default placeholder is set
          uploadPlaceholder.style.display = "flex";
          uploadPreview.style.display = "none";
        });
      }
    } else {
      console.error("Profile image elements not found");
    }
 
  

 // Store the selected volunteer
// Store the selected volunteer
let selectedVolunteer = null;

// Action buttons in table
const volunteersTableBody = document.getElementById("volunteers-table-body");
if (volunteersTableBody) {
  volunteersTableBody.addEventListener("click", (e) => {
    const actionButton = e.target.closest(".action-button");
    if (actionButton) {
      const volunteerId = actionButton.dataset.volunteerId;
      selectedVolunteer = volunteers.find((v) => v.id === volunteerId);

      if (selectedVolunteer) {
        console.log("Volunteer selected:", selectedVolunteer);

        // Ensure action menu exists
        setupActionMenu();

        // Get button position
        const rect = actionButton.getBoundingClientRect();
        showActionMenu(rect.right + window.scrollX, rect.bottom + window.scrollY);
      }
    }
  });
}

// Function to set up action menu (creates it if missing)
function setupActionMenu() {
  let actionMenu = document.getElementById("action-menu");

  if (!actionMenu) {
    console.warn("Action menu not found, creating one...");
    
    // Create the action menu
    actionMenu = document.createElement("div");
    actionMenu.id = "action-menu";
    actionMenu.className = "action-menu hidden";
    actionMenu.style.position = "absolute"; // Ensure it can be moved
    actionMenu.style.zIndex = "1000"; // Ensure it appears above other elements

    actionMenu.innerHTML = `
      <div class="action-item view-details-btn">View Details</div>
      <div class="action-item edit-volunteer-btn"><i class="fas fa-edit"></i> Edit</div>
      <div class="action-item delete-volunteer-btn">Delete Volunteer</div>
    `;

    document.body.appendChild(actionMenu);
    console.log("Action menu created:", actionMenu);
  }

  // Attach event listeners for menu items
  const viewDetailsBtn = actionMenu.querySelector(".view-details-btn");
  const editBtn = actionMenu.querySelector(".edit-volunteer-btn");
  const deleteVolunteerBtn = actionMenu.querySelector(".delete-volunteer-btn");
  console.log("View Details Button:", viewDetailsBtn);
  console.log("Edit Button:", editBtn);
  console.log("Delete Button:", deleteVolunteerBtn);


  // Attach event listeners
  viewDetailsBtn.addEventListener("click", () => {
    if (selectedVolunteer) {
      console.log("View More clicked for:", selectedVolunteer); // ✅ Debugging
      showVolunteerDetails(selectedVolunteer);
    } else {
      console.warn("No volunteer selected!");
    }
    hideActionMenu();
  });

  editBtn.addEventListener("click", () => {
    if (selectedVolunteer) {
      console.log("Editing volunteer:", selectedVolunteer); // ✅ Debugging
      handleEditVolunteer(selectedVolunteer);
    }
    hideActionMenu();
  });

  deleteVolunteerBtn.addEventListener("click", () => {
    if (selectedVolunteer) {
      console.log("Deleting volunteer:", selectedVolunteer); // ✅ Debugging
      showDeleteConfirmation(selectedVolunteer);
    }
    hideActionMenu();
  });
}

// Dummy function to simulate showing details
function showVolunteerDetails(volunteer) {
  const modalElement = document.getElementById("volunteerDetailsModal");
  if (!modalElement) return;

  // Ensure elements exist before updating content
  const setValue = (id, value) => {
    const element = document.getElementById(id);
    if (element) element.textContent = value || "N/A";
  };

  document.getElementById("detailsImage").src = volunteer.image || "../assets/images/includes/user1.svg";
  setValue("detailsName", volunteer.name);
  setValue("detailsLocation", volunteer.location);
  setValue("detailsGender", volunteer.gender);
  setValue("detailsAge", volunteer.age);
  setValue("detailsProfession", volunteer.profession);
  setValue("detailsField", volunteer.volunteerField);
  setValue("detailsReason", volunteer.reasonForVolunteering);

  const statusBadge = document.getElementById("detailsStatusBadge");
  if (statusBadge) {
    statusBadge.className = `status-badge status-${volunteer.status.toLowerCase()}`;
    statusBadge.textContent = volunteer.status;
  }

  const approveBtn = document.getElementById("approveBtn");
  const rejectBtn = document.getElementById("rejectBtn");

  if (approveBtn && rejectBtn) {
    if (volunteer.status === "Approved") {
      approveBtn.style.display = "none";
      rejectBtn.style.display = "block";
    } else if (volunteer.status === "Rejected") {
      approveBtn.style.display = "block";
      rejectBtn.style.display = "none";
    } else {
      approveBtn.style.display = "block";
      rejectBtn.style.display = "block";
    }
  }

  // Use Bootstrap modal API to show the modal
  const modal = new bootstrap.Modal(modalElement);
  modal.show();
}



// Function to show the action menu at the correct position
function showActionMenu(x, y) {
  const actionMenu = document.getElementById("action-menu");
  if (actionMenu) {
    actionMenu.style.left = `${x}px`;
    actionMenu.style.top = `${y}px`;
    actionMenu.classList.remove("hidden");
    actionMenu.style.display = "block"; // Ensure it is visible
    console.log(`Showing action menu at: ${x}px, ${y}px`);
  }
}

// Function to hide the action menu
function hideActionMenu() {
  const actionMenu = document.getElementById("action-menu");
  if (actionMenu) {
    actionMenu.classList.add("hidden");
    actionMenu.style.display = "none"; // Ensure it disappears
  }
}

// Show delete confirmation modal
function showDeleteConfirmation(volunteer) {
  volunteerToDelete = volunteer;
  const deleteModal = document.getElementById("delete-modal");
  const deleteVolunteerName = document.getElementById("delete-volunteer-name");

  if (deleteVolunteerName) {
    deleteVolunteerName.textContent = `Delete ${volunteer.name}`;
  }

  if (deleteModal) {
    openModal(deleteModal);
  }
}



  // Approve/Reject buttons
  const approveVolunteerBtn = document.getElementById("approveBtn");
  const rejectVolunteerBtn = document.getElementById("rejectBtn");

  if (approveVolunteerBtn) {
    approveVolunteerBtn.addEventListener("click", () => {
      if (selectedVolunteer) {
        updateVolunteerStatus(selectedVolunteer.id, "Approved");
        closeAllModals();
        showToast(
          `${selectedVolunteer.name} has been approved successfully`,
          "success"
        );
      }
    });
  }

  if (rejectVolunteerBtn) {
    rejectVolunteerBtn.addEventListener("click", () => {
      if (selectedVolunteer) {
        updateVolunteerStatus(selectedVolunteer.id, "Rejected");
        closeAllModals();
        showToast(`${selectedVolunteer.name} has been rejected`, "error");
      }
    });
  }

  // Delete confirmation
  const confirmDeleteBtn = document.querySelector(".confirm-delete-btn");
  const cancelDeleteBtn = document.querySelector(".cancel-delete-btn");

  if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener("click", () => {
      if (volunteerToDelete) {
        deleteVolunteer(volunteerToDelete.id);
        closeAllModals();
        showToast(
          `${volunteerToDelete.name} has been deleted successfully`,
          "warning"
        );
      }
    });
  }

  if (cancelDeleteBtn) {
    cancelDeleteBtn.addEventListener("click", () => {
      closeAllModals();
    });
  }

  // Close toast
  const toastCloseBtn = document.querySelector(".toast-close");
  if (toastCloseBtn) {
    toastCloseBtn.addEventListener("click", () => {
      hideToast();
    });
  }

  // Close modals when clicking outside
  window.addEventListener("click", (e) => {
    if (e.target.classList.contains("modal")) {
      closeAllModals();
    }
  });

  // Close action menu when clicking outside
  document.addEventListener("click", (e) => {
    if (
      !e.target.closest(".action-button") &&
      !e.target.closest(".action-menu")
    ) {
      hideActionMenu();
    }
  });
}

// Improved edit volunteer function
function handleEditVolunteer(volunteer) {
  const addVolunteerModal = document.getElementById("add-volunteer-modal");
  const modalTitle = addVolunteerModal.querySelector("h2");
  const form = document.getElementById("add-volunteer-form");
  const submitBtn = form.querySelector('button[type="submit"]');

  if (!addVolunteerModal || !form || !submitBtn || !modalTitle) {
    console.error("Edit volunteer elements not found");
    return;
  }

  // Update modal title
  modalTitle.textContent = "Edit Volunteer";

  // Populate form fields with volunteer data
  const nameInput = document.getElementById("volunteer-name");
  const emailInput = document.getElementById("volunteer-email");
  const roleInput = document.getElementById("volunteer-role");
  const profilePreview = document.getElementById("profile-preview");
  const uploadPlaceholder = document.querySelector(".upload-placeholder");
  const uploadPreview = document.querySelector(".upload-preview");

  if (nameInput) nameInput.value = volunteer.name;
  if (emailInput) emailInput.value = volunteer.email;
  if (roleInput) roleInput.value = volunteer.volunteerField;

  // Show profile image if exists
  if (profilePreview && uploadPlaceholder && uploadPreview && volunteer.image) {
    profilePreview.src = volunteer.image;
    uploadPlaceholder.style.display = "none";
    uploadPreview.style.display = "block";
  }

  // Change form submit button text and add edit mode flag
  submitBtn.textContent = "Update Volunteer";
  submitBtn.classList.add("update-btn");
  form.dataset.editMode = "true";
  form.dataset.editId = volunteer.id;

  openModal(addVolunteerModal);
}

// Improved handle add/edit volunteer function
function handleAddVolunteer(e) {
  e.preventDefault();
  const form = e.target;
  const isEditMode = form.dataset.editMode === "true";
  const editId = form.dataset.editId;

  const nameInput = document.getElementById("volunteerName");
  const emailInput = document.getElementById("volunteerEmail");
  const roleInput = document.getElementById("volunteerRole");
  const profilePreview = document.getElementById("profile-upload");

  if (!nameInput || !emailInput || !roleInput) {
    console.error("Form inputs not found");
    return;
  }

  // Form validation
  if (!nameInput.value.trim()) {
    showToast("Please enter volunteer name", "error");
    nameInput.focus();
    return;
  }

  if (!emailInput.value.trim()) {
    showToast("Please enter volunteer email", "error");
    emailInput.focus();
    return;
  }

  // Basic email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(emailInput.value.trim())) {
    showToast("Please enter a valid email address", "error");
    emailInput.focus();
    return;
  }

  if (!roleInput.value) {
    showToast("Please select volunteer role", "error");
    roleInput.focus();
    return;
  }

}

// Reset add/edit form
function resetAddForm() {
  const volunteerForm = document.getElementById("volunteerForm");
  const modalTitle = document.querySelector("#addVolunteerModal h2");
  const submitBtn = volunteerForm.querySelector('button[type="submit"]');

  if (volunteerForm) {
    volunteerForm.reset();

    // Reset edit mode
    volunteerForm.dataset.editMode = "false";
    volunteerForm.dataset.editId = "";

    // Reset button text and remove update class
    if (submitBtn) {
      submitBtn.textContent = "Add Volunteer";
      submitBtn.classList.remove("update-btn");
    }

    // Reset modal title
    if (modalTitle) {
      modalTitle.textContent = "Add New Volunteer";
    }
  }

  const uploadPlaceholder = document.querySelector(".upload-placeholder");
  const uploadPreview = document.querySelector(".upload-preview");
  const profilePreview = document.getElementById("profile-preview");

  if (uploadPlaceholder && uploadPreview && profilePreview) {
    profilePreview.src = "";
    uploadPlaceholder.style.display = "flex";
    uploadPreview.style.display = "none";
  }
}

// Show volunteer details
function showVolunteerDetails(volunteer) {
  const volunteerDetailsModal = document.getElementById(
    "volunteerDetailsModal"
  );
  if (!volunteerDetailsModal) return;

  const volunteerImage = document.getElementById("volunteer-image");
  const detailName = document.getElementById("detail-name");
  const detailLocation = document.getElementById("detail-location");
  const detailGender = document.getElementById("detail-gender");
  const detailAge = document.getElementById("detail-age");
  const detailProfession = document.getElementById("detail-profession");
  const detailField = document.getElementById("detail-field");
  const detailReason = document.getElementById("detail-reason");
  const certificationImage = document.getElementById("certification-image");
  const statusBadge = document.getElementById("volunteer-status-badge");

  // Set volunteer details
  if (volunteerImage) volunteerImage.src = volunteer.image;
  if (detailName) detailName.textContent = volunteer.name;
  if (detailLocation) detailLocation.textContent = volunteer.location;
  if (detailGender) detailGender.textContent = volunteer.gender;
  if (detailAge) detailAge.textContent = volunteer.age;
  if (detailProfession) detailProfession.textContent = volunteer.profession;
  if (detailField) detailField.textContent = volunteer.volunteerField;
  if (detailReason) detailReason.textContent = volunteer.reasonForVolunteering;
  if (certificationImage) certificationImage.src = volunteer.certification;

  if (statusBadge) {
    statusBadge.className = `status-badge status-${volunteer.status.toLowerCase()}`;
    statusBadge.textContent = volunteer.status;
  }

  // Show/hide approve/reject buttons based on current status
  const approveBtn = document.getElementById("approve-volunteer-btn");
  const rejectBtn = document.getElementById("reject-volunteer-btn");

  if (approveBtn && rejectBtn) {
    if (volunteer.status === "Approved") {
      approveBtn.style.display = "none";
      rejectBtn.style.display = "block";
    } else if (volunteer.status === "Rejected") {
      approveBtn.style.display = "block";
      rejectBtn.style.display = "none";
    } else {
      approveBtn.style.display = "block";
      rejectBtn.style.display = "block";
    }
  }

  openModal(volunteerDetailsModal);
}



// Show delete confirmation
function showDeleteConfirmation(volunteer) {
  volunteerToDelete = volunteer;
  const deleteModal = document.getElementById("delete-modal");
  const deleteVolunteerName = document.getElementById("delete-volunteer-name");

  if (deleteVolunteerName) {
    deleteVolunteerName.textContent = `Delete ${volunteer.name}`;
  }

  if (deleteModal) {
    openModal(deleteModal);
  }
}

// Update volunteer status
function updateVolunteerStatus(volunteerId, status) {
  volunteers = volunteers.map((volunteer) => {
    if (volunteer.id === volunteerId) {
      return { ...volunteer, status };
    }
    return volunteer;
  });
  renderVolunteers();
  setupPagination();
}

// Delete volunteer
function deleteVolunteer(volunteerId) {
  volunteers = volunteers.filter((volunteer) => volunteer.id !== volunteerId);
  renderVolunteers();
  setupPagination(); 
}

// Show action menu
// function showActionMenu(x, y) {
//   const actionMenu = document.getElementById("action-menu");
//   if (!actionMenu) return;

//   actionMenu.style.display = "block";
//   actionMenu.style.left = `${x - actionMenu.offsetWidth}px`;
//   actionMenu.style.top = `${y}px`;
//   actionMenu.classList.add("active");
// }

// // Hide action menu
// function hideActionMenu() {
//   const actionMenu = document.getElementById("action-menu");
//   if (actionMenu) {
//     actionMenu.style.display = "none";
//     actionMenu.classList.remove("active");
//   }
// }

// Open modal
function openModal(modal) {
  if (!modal) return;
  modal.style.display = "block";
  modal.classList.add("active");
}

// Close all modals
function closeAllModals() {
  const modals = document.querySelectorAll(".modal");
  modals.forEach((modal) => {
    modal.style.display = "none";
    modal.classList.remove("active");
  });
  hideActionMenu();
}

function showToast(message, type = "info", duration = 3000) {
  const toast = document.getElementById("toast");
  const toastIcon = document.getElementById("toast-icon");
  const toastMessage = document.getElementById("toast-message");

  if (!toast || !toastIcon || !toastMessage) return;

  toastMessage.textContent = message;

  if (type === "success") {
    toastIcon.className = "fas fa-check-circle";
  } else if (type === "error") {
    toastIcon.className = "fas fa-times-circle";
  } else if (type === "warning") {
    toastIcon.className = "fas fa-exclamation-triangle";
  } else if (type === "info") {
    toastIcon.className = "fas fa-info-circle";
  }

  // Show toast with animation
  toast.style.display = "flex";
  toast.classList.add("active");

  // Automatically hide toast after duration
  window.toastTimeout = setTimeout(() => {
    hideToast();
  }, duration);
}

// Improved hide toast function
function hideToast() {
  const toast = document.getElementById("toast");
  if (!toast) return;

  // Add fade-out animation before hiding
  toast.classList.add("fade-out");

  setTimeout(() => {
    toast.style.display = "none";
    toast.classList.remove("active", "fade-out");
  }, 1000); 
}
