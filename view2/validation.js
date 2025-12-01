function validateForm() {
  let isValid = true;/* if any validation false than it will set to false*/

 /* document.getElementById("nameError").innerHTML = "";
  document.getElementById("emailError").innerHTML = "";
  document.getElementById("phoneError").innerHTML = "";
  document.getElementById("dobError").innerHTML = "";
  document.getElementById("genderError").innerHTML = "";*/

  const name = document.getElementById("fullname").value.trim();
  const email = document.getElementById("email").value.trim();
  const phone = document.getElementById("phone").value.trim();
  const dob = document.getElementById("dob").value;
  const genders = document.getElementsByName("gender");

  if (name === "") {
    document.getElementById("nameError").innerHTML = "Full Name is required.";
    isValid = false;
  }

  if (email === "" || !email.includes("@") || !email.includes(".")) {
    document.getElementById("emailError").innerHTML = "Enter a valid email.";
    isValid = false;
  }

  /*const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
  if (!email.match(emailPattern)) {
  document.getElementById("emailError").innerHTML = "Enter a valid email.";
  isValid = false;
  }*/
  
  /*(^ start of input ) (&end of input)*/
  const phonePattern = /^[0-9]{11}$/;
  if (!phone.match(phonePattern)) {
    document.getElementById("phoneError").innerHTML = "Phone must be 10 digits.";
    isValid = false;
  }

  if (dob === "") {
    document.getElementById("dobError").innerHTML = "Please select your date of birth.";
    isValid = false;
  }

  let genderSelected = false;
  for (let i = 0; i < genders.length; i++) {
    if (genders[i].checked) {
      genderSelected = true;
      break;
    }
  }
  if (!genderSelected) {
    document.getElementById("genderError").innerHTML = "Please select a gender.";
    isValid = false;
  }

  return isValid;
}
