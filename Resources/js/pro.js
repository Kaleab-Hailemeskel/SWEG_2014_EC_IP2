const setError = (element, message) => {
  const inputwrap = element.parentElement;
  const errorDisplay = inputwrap.querySelector('.error');

  errorDisplay.innerText = message;
  inputwrap.classList.add('error');
  inputwrap.classList.remove('success');
  check=0;
};

const setSuccess = element => {
  const inputwrap = element.parentElement;
  const errorDisplay = inputwrap.querySelector('.error');
  errorDisplay.innerText = null;
  inputwrap.classList.add('success');
  inputwrap.classList.remove('error');
  check=1;
};

const isValidEmail = email => {
  const emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return emailRegex.test(String(email).toLowerCase());
};

const validateInputs = () => {
  const emailInput = document.getElementById('email');
  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('password2');

  const emailValue = emailInput.value.trim();
  const passwordValue = passwordInput.value.trim();
  const confirmPasswordValue = confirmPasswordInput.value.trim();

  if (emailValue === '') {
    setError(emailInput, 'Email is required');
  } else if (!isValidEmail(emailValue)) {
    setError(emailInput, 'Provide a valid email address');
  } else {
    setSuccess(emailInput);
  }

  if (passwordValue === '') {
    setError(passwordInput, 'Password is required');
    return false;
  } else if (!/\d/.test(passwordValue) || !/[a-zA-Z]/.test(passwordValue)) {
    setError(passwordInput, 'Password must contain both alphabets and numbers');
    return false;
  } else {
    setSuccess(passwordInput);
  }

  if (confirmPasswordValue === '') {
    setError(confirmPasswordInput, 'Please confirm your password');
  } else if (confirmPasswordValue !== passwordValue) {
    setError(confirmPasswordInput, "Passwords don't match");
  } else {
    setSuccess(confirmPasswordInput);
  }
  
};

function update(){
	validateInputs();
	 if (check==1) {
      var email = document.getElementById('email').value;
      var password = document.getElementById('password').value;
      var educationLevel = document.getElementById('school-level').value;
	  let acc= JSON.parse(sessionStorage.getItem(sessionStorage.getItem("AccUpdated")));
	  acc.email=email;
	  acc.password=password;
	  acc.educationLevel=educationLevel;
		  sessionStorage.setItem(email, JSON.stringify(acc));
		  sessionStorage.setItem("CurrentAccount",acc.email);
      window.alert("Successfully updated");
	  window.location="user.html";
	   
    }
	
}
document.getElementById('updateForm').addEventListener('submit', function (event) {
  event.preventDefault();
  update();
});