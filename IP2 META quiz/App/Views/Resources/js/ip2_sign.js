const setError = (element, message) => {
    const inputwrap = element.closest('.input-wrap');
    const errorDisplay = inputwrap.querySelector('.error');
  
    errorDisplay.innerText = message;
    inputwrap.classList.add('error');
    inputwrap.classList.remove('success');
  };
  
  const setSuccess = element => {
    const inputwrap = element.closest('.input-wrap');
    const errorDisplay = inputwrap.querySelector('.error');
    errorDisplay.innerText = ''; // Set to an empty string instead of null
    inputwrap.classList.add('success');
    inputwrap.classList.remove('error');
  };
  
  const isValidEmail = email => {
    const emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return emailRegex.test(String(email).toLowerCase());
  };
  
  const validateInputs = () => {
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password2');
  
    const usernameValue = usernameInput.value.trim();
    const emailValue = emailInput.value.trim();
    const passwordValue = passwordInput.value.trim();
    const confirmPasswordValue = confirmPasswordInput.value.trim();
  
    let isValid = true; // Flag to track overall validity
  
    if (usernameValue === '') {
      setError(usernameInput, 'Username is required');
      isValid = false;
    } else if (usernameValue.length < 8 || usernameValue.length > 50) {
      setError(usernameInput, 'Keep username length between 8 and 50 characters');
      isValid = false;
    } else {
      setSuccess(usernameInput);
    }
  
    if (emailValue === '') {
      setError(emailInput, 'Email is required');
      isValid = false;
    } else if (!isValidEmail(emailValue)) {
      setError(emailInput, 'Provide a valid email address');
      isValid = false;
    } else {
      setSuccess(emailInput);
    }
  
    if (passwordValue === '') {
      setError(passwordInput, 'Password is required');
      isValid = false;
    } else if (!/\d/.test(passwordValue) || !/[a-zA-Z]/.test(passwordValue)) {
      setError(passwordInput, 'Password must contain both alphabets and numbers');
      isValid = false;
    } else {
      setSuccess(passwordInput);
    }
  
    if (confirmPasswordValue === '') {
      setError(confirmPasswordInput, 'Please confirm your password');
      isValid = false;
    } else if (confirmPasswordValue !== passwordValue) {
      setError(confirmPasswordInput, "Passwords don't match");
      isValid = false;
    } else {
      setSuccess(confirmPasswordInput);
    }
  
    // Prevent form submission if validation fails (isValid is false)
    return isValid;
  };
  
