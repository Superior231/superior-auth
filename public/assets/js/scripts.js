// Dark Mode
const darkModeToggle = document.querySelector('.dark-mode-toggle');
const darkModeIcon = darkModeToggle.querySelector('i');

// Cek localStorage untuk status mode gelap
if (localStorage.getItem('dark-mode') === 'enabled') {
    document.body.classList.add('dark');
    darkModeIcon.className = 'bx bx-moon';
}

darkModeToggle.addEventListener('click', () => {
    document.body.classList.toggle('dark');

    if (document.body.classList.contains('dark')) {
        // Simpan status ke localStorage
        localStorage.setItem('dark-mode', 'enabled');
        darkModeIcon.className = 'bx bx-moon';
    } else {
        // Hapus status dari localStorage
        localStorage.setItem('dark-mode', 'disabled');
        darkModeIcon.className = 'bx bx-sun';
    }
});
// Dark Mode End



// Navbar
try {
    const navbar = document.querySelector(".navbar");
    const classList = ["shadow-sm", "border-bottom", "border-secondary", "bg-navbar"];

    if (navbar) {
        const handleScroll = () => {
            const action = window.pageYOffset > 0.1 ? 'add' : 'remove';
            if (navbar) navbar.classList[action](...classList);
        };

        window.addEventListener("scroll", handleScroll);
    }
} catch (error) {
    console.log("Navbar feature not found!");
}
// Navbar End



// Image Preview
const previewAvatar = document.getElementById('img-avatar');
const previewAvatar2 = document.getElementById('img-avatar-tambah');
const inputAvatar = document.getElementById('upload-foto');
const inputAvatar2 = document.getElementById('upload-foto-tambah');

try {
    if (previewAvatar || previewAvatar2) {
        inputAvatar.onchange = (e) => {
            if (inputAvatar.files && inputAvatar.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewAvatar.src = e.target.result;
                };
                reader.readAsDataURL(inputAvatar.files[0]);
            }
        };

        inputAvatar2.onchange = (e) => {
            if (inputAvatar2.files && inputAvatar2.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewAvatar2.src = e.target.result;
                };
                reader.readAsDataURL(inputAvatar2.files[0]);
            }
        };
    }
} catch (error) {
    console.log('Image preview not found!');
}
// Image Preview End



// Validasi Input
const editUsernameInput = document.getElementById('edit-username');
const simpanButton = document.getElementById('save-edit-profile-btn');
const errorMessage = document.getElementById('edit-profile-error-message-username');

try {
    editUsernameInput.addEventListener('input', function() {
        if (editUsernameInput.value.length > 30) {
            editUsernameInput.classList.add('is-invalid');
            simpanButton.classList.add('disabled');
            errorMessage.style.display = 'block';
            errorMessage.innerText = "too long! max 20 characters";
        } else {
            editUsernameInput.classList.remove('is-invalid');
            simpanButton.classList.remove('disabled');
            errorMessage.style.display = 'none';
        }
    });
} catch (error) {
    console.log("Username edit validation not found!");
}
// Validasi Input End