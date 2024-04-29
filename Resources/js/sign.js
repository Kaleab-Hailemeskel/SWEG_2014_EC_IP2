let check=0;
let actCh=sessionStorage.getItem("CurrentAccount");

if(!(actCh=="0" || actCh===null)){
	let temp=window.confirm("An active account has been deteced. You will need to log off in order to sign up for a new account.\n Would you like to continue by logging out?");
	if(temp){
		sessionStorage.setItem("CurrentAccount",0);
	}
	else{
		window.location="index.html";
	}

};
const setError = (element, message) => {
  const inputwrap = element.closest('.input-wrap');
  const errorDisplay = inputwrap.querySelector('.error');

  errorDisplay.innerText = message;
  inputwrap.classList.add('error');
  inputwrap.classList.remove('success');
  check=0;
};

const setSuccess = element => {
  const inputwrap = element.closest('.input-wrap');
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


function handleSignUp() {
	
    validateInputs();
  
    const errorElements = document.querySelectorAll('.error');
	
    if (check==1) {
      var email = document.getElementById('email').value;
      var password = document.getElementById('password').value;
      var educationLevel = document.getElementById('school-level').value;
	  console.log("Even check");
	  let array= ["","","","",""];
      var userDetails = {
        email: email,
        password: password,
        educationLevel: educationLevel,
		accountLevel:"user",
		trustLevel:0,
		customQuizes: array,
		quizesNumber:0,
      };
       if(sessionStorage.getItem(email)!=null){
	  window.alert("Account already exists with this email"); }
	  else {
		  if(sessionStorage.getItem("AllUsers")==null){
			  let x=[email];
			  sessionStorage.setItem("AllUsers",x);
		  }
		  else{
			  let x=sessionStorage.getItem("AllUsers").split(" ");
			  x.push(email);
			  console.log(x);
			  sessionStorage.setItem("AllUsers",x);
		  }
      sessionStorage.setItem(email, JSON.stringify(userDetails));
      window.alert("Successfully registered");
	  window.location="log_in.html";}
	   
    }
  
}

document.getElementById('signupForm').addEventListener('submit', function (event) {
  event.preventDefault();
  handleSignUp();
});

