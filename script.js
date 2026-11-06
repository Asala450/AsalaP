document.addEventListener('DOMContentLoaded', () => {
    // 1. Кіру формасын тексеру (Login)
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            let valid = true;
            const email = document.getElementById('login_email');
            const pass = document.getElementById('login_password');
            const emailErr = document.getElementById('loginEmailError');
            const passErr = document.getElementById('loginPassError');

            if (email.value.trim() === '') {
                emailErr.style.display = 'block';
                valid = false;
            } else {
                emailErr.style.display = 'none';
            }

            if (pass.value.trim() === '') {
                passErr.style.display = 'block';
                valid = false;
            } else {
                passErr.style.display = 'none';
            }

            if (!valid) {
                e.preventDefault();
            }
        });
    }

    // 2. Тіркелу формасын тексеру (Register)
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', (e) => {
            let valid = true;
            const fname = document.getElementById('firstname');
            const lname = document.getElementById('lastname');
            const email = document.getElementById('reg_email');
            const pass = document.getElementById('reg_pass');

            const fnameErr = document.getElementById('fnameError');
            const lnameErr = document.getElementById('lnameError');
            const emailErr = document.getElementById('regEmailError');
            const passErr = document.getElementById('regPassError');

            if (fname.value.trim() === '') {
                fnameErr.style.display = 'block';
                valid = false;
            } else {
                fnameErr.style.display = 'none';
            }

            if (lname.value.trim() === '') {
                lnameErr.style.display = 'block';
                valid = false;
            } else {
                lnameErr.style.display = 'none';
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value.trim())) {
                emailErr.style.display = 'block';
                valid = false;
            } else {
                emailErr.style.display = 'none';
            }

            if (pass.value.trim().length < 6) {
                passErr.style.display = 'block';
                valid = false;
            } else {
                passErr.style.display = 'none';
            }

            if (!valid) {
                e.preventDefault();
            }
        });
    }
});