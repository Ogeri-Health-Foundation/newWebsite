document.addEventListener("DOMContentLoaded", async function () {
  await fetchVolunteers(); // Fetch data first
  init(); // Then initialize
});
 document.addEventListener('DOMContentLoaded', function() {
  setupActionMenu();
  handleUpdateFormSubmission();
});

// Fetch volunteers data from PHP
async function fetchVolunteers() {
  try {
    const response = await fetch("../api/v1/add_events.php"); // Fetch data from PHP
    const data = await response.json();

    if (!Array.isArray(data)) {
      console.error("Invalid data format", data);
      return;
    }
    originalVolunteers  = data;
    volunteers = data; 
    ;
  } catch (error) {
    console.error("Error fetching volunteers:", error);
  }
}

// State variables
let volunteers = []; // Initialize an empty array
let selectedVolunteer = null;
let volunteerToDelete = null;

// Initialize the application
function init() {
  const volunteersTableBody = document.getElementById("volunteers-table-body");

  if (!volunteersTableBody) {
    console.error('Error: Could not find element with ID "volunteers-table-body"');
    return;
  }

  ; // Ensure data is rendered correctly
  setupEventListeners();
  setupPagination();
  setupExportAndFilter();
}

// Render volunteers table
function renderVolunteers(volunteersToRender = volunteers) {
  const volunteersTableBody = document.getElementById("volunteers-table-body");
  if (!volunteersTableBody) return;

  volunteersTableBody.innerHTML = "";

  if (!volunteersToRender.length) {
    const emptyRow = document.createElement("tr");
    emptyRow.innerHTML = `
      <td colspan="7" style="text-align: center; padding: 2rem; ">
        <div style="  text-align: center; ">
          <p style="margin-bottom: 1rem;">No events have been uploaded yet.</p>
          <button 
            style="background-color: #ff6b35; color: #fff; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer;" 
            onclick="openAddVolunteerModal()"
          >
            Upload Event
          </button>
        </div>
      </td>
    `;
    volunteersTableBody.appendChild(emptyRow);
    return;
  }

  volunteersToRender.forEach((volunteer) => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${volunteer.id}</td>
      <td class="text-center text-nowrap">${volunteer.title}</td>
      <td class="text-center text-nowrap">${volunteer.date}</td>
      <td class="text-center text-nowrap">${formatTime(volunteer.time)}</td>
      <td class="text-center text-nowrap">${volunteer.description}</td>
      <td>
        <span class="d-flex align-items-center status-${volunteer.status.toLowerCase()} status-badge">
          ${volunteer.status}
        </span>
      </td>
      <td>
        <button class="action-button" data-volunteer-id="${volunteer.id}">
          <i class="fa-ellipsis-v fas"></i>
        </button>
      </td>
    `;
    volunteersTableBody.appendChild(row);
  });
}
function openAddVolunteerModal() {
  resetAddForm(); // Reuse your existing reset function
  new bootstrap.Modal(document.getElementById("addVolunteerModal")).show();
}

function formatTime(timeString) {
  if (!timeString || timeString === "00:00:00.000000") return "N/A";
  
  // Extract HH:mm from timeString (e.g., "09:00:00.000000" → "09:00")
  return timeString.split(".")[0].slice(0, 5);
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

  exportBtn.addEventListener("click", () => {
    if (!Array.isArray(volunteers) || volunteers.length === 0) {
      showToast("No data available to export", "error");
      return;
    }

    const headers = ["Id", "Title", "Date", "Time", "Description", "Location", "Status"];
    const csvRows = [headers.join(",")];

    volunteers.forEach(volunteer => {
      const row = [
        volunteer.id,
        volunteer.title,
        `\t${volunteer.date}`, // force Excel to treat as text
        volunteer.time,
        volunteer.description,
        volunteer.location,
        volunteer.status
      ].map(field => `"${(field || "").toString().replace(/"/g, '""')}"`);

      csvRows.push(row.join(","));
    });

    const csvContent = "\uFEFF" + csvRows.join("\n"); // Add UTF-8 BOM

    const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    const url = URL.createObjectURL(blob);

    const a = document.createElement("a");
    a.href = url;
    a.download = "events.csv";
    a.style.display = "none";
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);

    showToast("Export completed successfully", "success");
  });

  // Filter functionality
  filterBtn.addEventListener("click", () => {
    const filterOptions = {
      status: ["All", "completed", "upcoming"],
      
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
          <h2>Filter events</h2>
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

  let filteredVolunteers = [...originalVolunteers];

  if (statusFilter !== "All") {
    filteredVolunteers = filteredVolunteers.filter(
      (v) => v.status === statusFilter
    );
  }

  volunteers = filteredVolunteers; 

  renderVolunteers(volunteers);
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
  document
    .querySelectorAll(".cancel-btn, .close-details-btn")
    .forEach((button) => {
      button.addEventListener("click", () => {
        document.querySelectorAll(".modal").forEach((modal) => {
          new bootstrap.Modal(modal).hide();
        });
      });
    });

  // Add volunteer form submission
  const addVolunteerForm = document.getElementById("addVolunteerForm");
  if (addVolunteerForm) {
    addVolunteerForm.addEventListener("submit", handleAddVolunteer);
  }

  // Profile image upload
  const profileUploadContainer = document.getElementById(
    "profile-upload-container"
  );
  const profileUpload = document.getElementById("profile-upload");
  const profilePreview = document.getElementById("profile-preview");
  const uploadPlaceholder = document.querySelector(".upload-placeholder");
  const uploadPreview = document.querySelector(".upload-preview");
  const removeProfileImage = document.getElementById("remove-profile-image");

  if (
    profileUploadContainer &&
    profileUpload &&
    profilePreview &&
    uploadPlaceholder &&
    uploadPreview
  ) {
    profileUploadContainer.addEventListener("click", () => {
      profileUpload.click();
    });

    profileUpload.addEventListener("change", (e) => {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          profilePreview.src = e.target.result;
          uploadPlaceholder.style.display = "none";
          uploadPreview.style.display = "block";
        };
        reader.readAsDataURL(file);
      }
    });

    if (removeProfileImage) {
      removeProfileImage.addEventListener("click", (e) => {
        e.stopPropagation();
        profileUpload.value = "";
        profilePreview.src = "/placeholder.svg"; // Ensure a default placeholder is set
        uploadPlaceholder.style.display = "flex";
        uploadPreview.style.display = "none";
      });
    }
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
      const volunteerId = Number(actionButton.dataset.volunteerId); // Ensure it's a number
      selectedVolunteer = volunteers.find((v) => v.id === volunteerId);

      if (selectedVolunteer) {
        console.log("Volunteer selected:", selectedVolunteer);

        // Ensure action menu exists
        setupActionMenu(); // Define this function to create the menu if necessary

        // Get button position
        const rect = actionButton.getBoundingClientRect();
        showActionMenu();
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
      actionMenu.style.left = "50px";
      actionMenu.innerHTML = `
        <div class="action-item view-details-btn">View Event</div>
        <div class="action-item update-details-btn">Update Event</div>
        <div class="action-item edit-volunteer-btn"><i class="fa-edit fas"></i> Edit Event</div>
        <div class="action-item delete-volunteer-btn">Delete Event</div>
      `;
      document.body.appendChild(actionMenu);
     
      console.log("Action menu created:", actionMenu);
    }
    
    // Attach event listeners for menu items
    const viewDetailsBtn = actionMenu.querySelector(".view-details-btn");
    const editBtn = actionMenu.querySelector(".edit-volunteer-btn");
    const deleteVolunteerBtn = actionMenu.querySelector(".delete-volunteer-btn");
    const UpdateBtn = actionMenu.querySelector(".update-details-btn");
    
    console.log("View Details Button:", viewDetailsBtn);
    console.log("Edit Button:", editBtn);
    console.log("Update Button:", UpdateBtn);
    console.log("Delete Button:", deleteVolunteerBtn);
    
    // Attach event listeners
    viewDetailsBtn.addEventListener("click", () => {
      if (selectedVolunteer) {
        console.log("View More clicked for:", selectedVolunteer);
        showVolunteerDetails(selectedVolunteer);
      } else {
        console.warn("No volunteer selected!");
      }
      hideActionMenu();
    });
    
    UpdateBtn.addEventListener("click", () => {
      if (selectedVolunteer) {
        console.log("Updating volunteer:", selectedVolunteer);
        
        // Get the event ID from the selected volunteer/event
        const eventId = selectedVolunteer.id || selectedVolunteer.event_id;
        
        if (eventId) {
          // Set the event_id in the hidden input field
          const eventIdInput = document.getElementById('event_id');
          if (eventIdInput) {
            eventIdInput.value = eventId;
            console.log("Event ID set to:", eventId);
          }
          
          // Show the modal
          const updateModal = new bootstrap.Modal(document.getElementById('volunteerUpdateModal'));
          updateModal.show();
          
          // Optional: Pre-populate form with existing data
          populateUpdateForm(selectedVolunteer);
        } else {
          console.error("Event ID not found in selected volunteer data");
          alert("Error: Event ID not found. Please try again.");
        }
      } else {
        console.warn("No volunteer selected!");
      }
      hideActionMenu();
    });
}

// Function to populate the update form with existing data (optional)
function populateUpdateForm(eventData) {
  // Pre-fill existing data if available
  const fields = [
    'total_attendees',
    'bp_screened', 
    'high_bp_detected',
    'repeat_attendees',
    'counselled',
    'medications_dispensed',
    'referrals',
    'average_age',
    'gender_male',
    'gender_female',
    'villages_served'
  ];
  
  fields.forEach(field => {
    const input = document.getElementById(field);
    if (input && eventData[field] !== undefined && eventData[field] !== null) {
      input.value = eventData[field];
    }
  });
}

// Function to handle form submission
function handleUpdateFormSubmission() {
  const form = document.getElementById('image-form');
  
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(this);
      const eventId = document.getElementById('event_id').value;
      
      if (!eventId) {
        alert('Error: Event ID is missing. Please try again.');
        return;
      }
      
      // Show loading state
      const submitBtn = form.querySelector('button[type="submit"]');
      const originalText = submitBtn.textContent;
      submitBtn.textContent = 'Uploading...';
      submitBtn.disabled = true;
      
      fetch('update_event.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Event updated successfully!');
          
          // Close modal
          const modal = bootstrap.Modal.getInstance(document.getElementById('volunteerUpdateModal'));
          if (modal) {
            modal.hide();
          }
          
          // Reset form
          form.reset();
          
          // Refresh the events list/table if needed
          if (typeof refreshEventsList === 'function') {
            refreshEventsList();
          }
        } else {
          alert('Error: ' + data.message);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the event. Please try again.');
      })
      .finally(() => {
        // Restore button state
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
      });
    });
  }
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

  function showVolunteerDetails(volunteer) {
    const modalElement = document.getElementById("volunteerDetailsModal");
    if (!modalElement) return;

    const setValue = (id, value) => {
      const element = document.getElementById(id);
      if (element) element.innerHTML = value || "N/A";
    };



    document.getElementById("detailsImage").src = `../uploads/${volunteer.banner_image}` || "../assets/images/includes/user1.svg";
      setValue("detailsImage", volunteer.banner_image);
    setValue("detailsTitle", volunteer.title);
    setValue("detailsDate", volunteer.date);
    setValue("detailsTime", formatTime(volunteer.time));
    setValue("detailsLocation", volunteer.location);
    setValue("detailsDescription", volunteer.description);
    // setValue("detailsComment", volunteer.eventComments);
    // setValue("detailsReason", volunteer.reasonForVolunteering);

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

    const modal = new bootstrap.Modal(modalElement);
    modal.show();
  }

  // Function to show the action menu at the correct position
  function showActionMenu(x, y) {
    const actionMenu = document.getElementById("action-menu");
    if (actionMenu) {
      // If x and y are not provided, default to right-middle of the screen
      if (x === undefined || y === undefined) {
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;
  
        x = viewportWidth - actionMenu.offsetWidth - 250; // 20px padding from right
        y = (viewportHeight - actionMenu.offsetHeight) / 2; // Center vertically
      }
  
      actionMenu.style.left = `${x}px`;
      actionMenu.style.top = `${y}px`;
      actionMenu.classList.remove("hidden");
      actionMenu.style.display = "block"; // Ensure it is visible
      console.log(`Showing action menu at: ${x}px, ${y}px`);
    }
  }
  

  function hideActionMenu() {
    const actionMenu = document.getElementById("action-menu");
    if (actionMenu) {
      actionMenu.classList.add("hidden");
      actionMenu.style.display = "none"; 
    }
  }

  // function showDeleteConfirmation(volunteer) {
  //   volunteerToDelete = volunteer;
  //   const deleteModal = document.getElementById("delete-modal");
  //   const deleteVolunteerName = document.getElementById(
  //     "delete-volunteer-name"
  //   );

  //   if (deleteVolunteerName) {
  //     deleteVolunteerName.textContent = `Delete ${volunteer.name}`;
  //   }

  //   if (deleteModal) {
  //     openModal(deleteModal);
  //   }
  // }

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

function handleEditVolunteer(volunteer) {
  const addVolunteerModal = document.getElementById("add-volunteer-modal");
  const modalTitle = addVolunteerModal.querySelector("h2");
  const form = document.getElementById("add-volunteer-form");
  const submitBtn = form.querySelector('button[type="submit"]');

  if (!addVolunteerModal || !form || !submitBtn || !modalTitle) {
    console.error("Edit volunteer elements not found");
    return;
  }

  modalTitle.textContent = "Edit Volunteer";

  form.querySelector("#volunteer-title").value = volunteer.title || "";
  form.querySelector("#volunteer-location").value = volunteer.location || "";
  form.querySelector("#volunteer-time").value = formatTime(volunteer.time) || "";
  form.querySelector("#volunteer-date").value = volunteer.date || "";
  form.querySelector("#volunteer-description").value = volunteer.description || "";
  form.querySelector("#volunteer-body").value = volunteer.body || "";
  form.querySelector("#volunteer-status").value = volunteer.status || "";

  const profilePreview = document.getElementById("profile-preview");
  profilePreview.style.display = "block";
  profilePreview.src = volunteer.banner_image ? `../uploads/${volunteer.banner_image}` : "assets/images/upload-placeholder.svg";

  submitBtn.textContent = "Update Volunteer";
  submitBtn.classList.add("update-btn");
  form.dataset.editMode = "true";
  form.dataset.editId = volunteer.id;

  openModal(addVolunteerModal);

  form.onsubmit = (e) => {
    e.preventDefault();
    const editId = form.dataset.editId;
    let formData = new FormData(form);
    formData.append("edit_id", editId);
    let isValid = true;

    for (let [key, value] of formData.entries()) {
      if (typeof value === "string" && value.trim() === "") {
        isValid = false;
        showBadToast(`${key} cannot be empty or only spaces.`);
        return;
      }
    }

    if (!isValid) return;

    submitVolunteerData(formData);
  };
}

function submitVolunteerData(formData) {
  fetch("https://ogerihealth.org/api/v1/update_event.php", {
    method: "POST",
    body: formData,
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showSuccessToast(data.message);
        document.getElementById("add-volunteer-form").reset();
        document.getElementById("profile-preview").src = "assets/images/upload-placeholder.svg";
      } else {
        showBadToast(data.message || "An error occurred while submitting.");
      }
    })
    .catch(error => {
      console.error("Error:", error);
      showBadToast("Something went wrong.");
    });
}

function showBadToast(message) {
  const BadToast = document.getElementById("bad-toast");
  const BadToastMessage = document.getElementById("bad-toast-message");
  BadToast.classList.add("show");
  BadToastMessage.textContent = message;
  setTimeout(() => BadToast.classList.remove("show"), 5000);
}

function showSuccessToast(message) {
  const toast = document.getElementById("toast-success");
  const toastMessage = document.getElementById("toast-message");
  toast.classList.add("show");
  toastMessage.textContent = message;
  setTimeout(() => toast.classList.remove("show"), 5000);
}



function handleAddVolunteer(e) {
 

  
  setupPagination();
  closeAllModals();
  resetAddForm();
}

// Reset add/edit form
function resetAddForm() {
  const addVolunteerForm = document.getElementById("addVolunteerForm");
  const modalTitle = document.querySelector("#addVolunteerModal h2");
  const submitBtn = addVolunteerForm.querySelector('button[type="submit"]');

  if (addVolunteerForm) {
    addVolunteerForm.reset();

    addVolunteerForm.dataset.editMode = "false";
    addVolunteerForm.dataset.editId = "";

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
  const deleteModal = document.getElementById("deleteModal");
  const deleteVolunteerName = document.getElementById("deleteVolunteerName");
  const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
  const cancelBtn = document.getElementById("cancelBtn");
  const cancelIconBtn = document.getElementById("cancelIcon");

  if (deleteVolunteerName) {
    deleteVolunteerName.textContent = `Delete ${volunteer.title}`;
  }

  if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener("click", function () {
      fetch("https://ogerihealth.org/api/v1/delete_event.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ eventId: volunteer.event_id }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            showSuccessToast(data.message);
            closeAllModals();
            // location.reload();
          } else {
            showErrorToast(data.message || "An error occurred.");
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          showErrorToast("Failed to delete event.");
        });
    });
  }

  if(cancelBtn){
    cancelBtn.addEventListener("click", () => {
      closeAllModals();
    });
  }

  if(cancelIconBtn){
    cancelIconBtn.addEventListener("click", () => {
      closeAllModals();
    });
  }

  if (deleteModal) {
    openModal(deleteModal);
  }
}

// Utility function to show success toast
function showSuccessToast(message) {
  const toast = document.getElementById("toast-success");
  const toastMessage = document.getElementById("toast-message");
  if (toast && toastMessage) {
    toast.classList.add("show");
    toastMessage.textContent = message;
    setTimeout(() => toast.classList.remove("show"), 5000);
  }
}

// Utility function to show error toast
function showErrorToast(message) {
  const badToast = document.getElementById("bad-toast");
  const badToastMessage = document.getElementById("bad-toast-message");
  if (badToast && badToastMessage) {
    badToast.classList.add("show");
    badToastMessage.textContent = message;
    setTimeout(() => badToast.classList.remove("show"), 5000);
  }
}


// function UpdateVolunteer(volunteer) {
//   console.log(volunteer);
//   const volunteerUpdateModal = document.getElementById("volunteerUpdateModal");
//   const eventId = volunteer.event_id

//   if (volunteerUpdateModal) {
//       const Form = document.getElementById("image-form");

//       Form.addEventListener("submit", function (e) {
//           e.preventDefault(); 


//           let formDataa = new FormData(Form);
//           formDataa.append("event_id", eventId);

//           fetch("https://ogerihealth.org/api/v1/add_images.php", {
//               method: "POST",
//               body: formDataa
//           })
//           .then(response => response.json())
//           .then(data => {
//               if (data.success === true) {
//                   const toast = document.getElementById('toast-success');
//                   const toastMessage = document.getElementById('toast-message'); 
//                   toast.classList.add('show');
//                   toastMessage.textContent = data.message;
//                   setTimeout(hideToast, 5000);
//                   Form.reset(); 
//                   document.getElementById('preview').src = "assets/images/upload-placeholder.svg";
                  
//                   function hideToast() {
//                     const toast = document.getElementById('toast-success');
//                     toast.classList.remove('show');
//                     }
//               } else {
//                   const BadToast = document.getElementById('bad-toast');
//                   const BadToastMessage = document.getElementById('bad-toast-message');
//                   BadToast.classList.add('show');
//                   BadToastMessage.textContent = data.message || "An error occurred."; 

//                   setTimeout(hideBadToast, 5000);

//                   function hideBadToast() {
//                     const BadToast = document.getElementById('bad-toast');
//                     BadToast.classList.remove('show');
//                     }
//               }
//           })
//           .catch(error => {
//               console.error("Error:", error);
//           });
//       });

//       openModal(volunteerUpdateModal);
//   }

 

//   setupPagination();
// }


// Delete volunteer
function deleteVolunteer(volunteerId) {
  volunteers = volunteers.filter((volunteer) => volunteer.id !== volunteerId);
  ;
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
  // hideActionMenu();
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
// Call this function when the page loads
