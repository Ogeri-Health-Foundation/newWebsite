document.addEventListener('DOMContentLoaded', () => {
    const profileInputFile = document.getElementById('profilePicture');
    const resumeInputFile = document.getElementById('resume');
    const profileCustomBtn = document.getElementById('profileCustomBtn');
    const resumeCustomBtn = document.getElementById('resumeCustomBtn');
    const profileWrapper = document.querySelector('.profileWrapper')
    const resumeWrapper = document.querySelector('.resumeWrapper')
    profileCustomBtn.addEventListener('click', () => {
        profileInputFile.click();
    });
    resumeCustomBtn.addEventListener('click', () => {
        resumeInputFile.click();
    });

    // When a file is chosen in the actual file input, update the display
    profileInputFile.addEventListener('change', () => {
        if (profileInputFile.files.length > 0) {
            profileInputFile.hidden = false;
            profileWrapper.classList.remove('file-input-wrapper');
            profileCustomBtn.style.display = 'none';
        }
    });

    resumeInputFile.addEventListener('change', () => {
        if (profileInputFile.files.length > 0) {
            resumeInputFile.hidden = false;
            resumeWrapper.classList.remove('file-input-wrapper');
            resumeCustomBtn.style.display = 'none';
        }
    });
});