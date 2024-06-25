document.addEventListener('DOMContentLoaded', function() {
    const editButton = document.querySelector('.buttons input[value="Edit"]');
    const saveButton = document.querySelector('.buttons input[value="Save"]');
    const downloadButton = document.querySelector('.buttons .download-button');

    editButton.addEventListener('click', function() {
        const profileDetails = document.querySelectorAll('.profile-details span');
        profileDetails.forEach(span => {
            const value = span.textContent;
            span.innerHTML = `<input type="text" value="${value}">`;
        });
        editButton.style.display = 'none';
        saveButton.style.display = 'inline';
    });

    saveButton.addEventListener('click', function() {
        const inputs = document.querySelectorAll('.profile-details input');
        const data = {};
        inputs.forEach(input => {
            const label = input.previousElementSibling.textContent.trim();
            data[label] = input.value;
            input.previousElementSibling.textContent = `${label}:`;
            input.replaceWith(input.value);
        });
        // Here you would send 'data' to the server using AJAX
        saveButton.style.display = 'none';
        editButton.style.display = 'inline';
    });

    downloadButton.addEventListener('click', function() {
        const profileContent = document.documentElement.innerHTML;
        const blob = new Blob([profileContent], { type: 'text/html' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'profile.html';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    });
});