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

function addAdmin(){
	validateInputs();
	 if (check==1) {
     var email = document.getElementById('email').value;
      var password = document.getElementById('password').value;

	  console.log("Even check");
      var adminDetails = {
        email: email,
        password: password,
		accountLevel:"admin"
      };
       if(sessionStorage.getItem(email)!=null){
	  window.alert("Account already exists with this email"); }
	  else {
		  if(sessionStorage.getItem("AList")==null){
			  let adminList=[email];
	  sessionStorage.setItem("AList",adminList);
			   
	  
			  
		  }
		  else{
			  let x=sessionStorage.getItem("AList").split(",");
			  x.push(email);
			  console.log(x);
			  sessionStorage.setItem("AList",x);
		  }
      sessionStorage.setItem(email, JSON.stringify(adminDetails));
      window.alert("Admin Registered Successfully");
	  }
	   
    }
	
}
document.getElementById('adminForm').addEventListener('submit', function (event) {
  event.preventDefault();
  console.log("Activated");
  addAdmin();
});

 function listAdmin(){
  let list=sessionStorage.getItem("AList").split(",");
  console.log(list);
  for(let i=0;i<list.length;i++){
  let j=i+1;
    document.getElementById("a"+j).innerHTML="<li>"+ list[i]+ "</li>";
  }
  
  }
  
   function delAdmin(){
   let email=document.getElementById("delEmail").value;
      let password=document.getElementById("delPass").value;
	  let account=JSON.parse(sessionStorage.getItem(email));
	  if(account==null){
	  alert("No such account exists");}
	  else if(account.password!=password){
	  alert("Wrong account info combination");
	  }
	  else if(account.password==password){
	  let x=confirm("Are you sure you want to remove this account? ");
	  if(x){
	  let array=sessionStorage.getItem("AList").split(",");
	 for (let i=0;i<array.length;i++){
	 console.log(array[x]);
	 if(array[i]==email){
	 delete array[i];
	 console.log("Deleted");
	 }
	 }
	 sessionStorage.setItem("AList",array);
	  sessionStorage.removeItem(email);
	  alert("Account deleted");
	  }
	  else{
	  alert("Deletion cancelled");
	  }
	  
	  }
   }