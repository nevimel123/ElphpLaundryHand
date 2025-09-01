document.getElementById("loginBtn").addEventListener("click", function () {
    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="password"]');
    const errorMessage = document.getElementById("errorMessage");

    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    errorMessage.textContent = "";

    let error = "";

    if (email === "" || password === "") {
      error = "Both email and password are required.";
    } else if (!emailPattern.test(email)) {
      error = "Please enter a valid email address.";
    }

    if (error) {
      errorMessage.textContent = error;
    } else {
      window.location.href = "dashboard.html";
    }
  });