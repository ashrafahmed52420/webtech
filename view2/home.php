<!DOCTYPE html>
<html>
<head>
  <title>Resume Builder</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-section">
  <h2>Personal Information</h2>
  <!-- run js before submit, send next page -->
  <form onsubmit="return validateForm()" action="submitted.html" method="post">
    <table id="personal-info">
      <tr>
        <td>Full Name:</td>
        <td>
          <input type="text" id="fullname" placeholder="John Doe">
          <div class="error" id="nameError"></div>
        </td>
      </tr>
      <tr>
        <td>Email:</td>
        <td>
          <input type="text" id="email" placeholder="email@gmail.com">
          <div class="error" id="emailError"></div>
        </td>
      </tr>
      <tr>
        <td>Phone:</td>
        <td>
          <input type="text" id="phone" placeholder="01234567890">
          <div class="error" id="phoneError"></div>
        </td>
      </tr>
      <tr>
        <td>Date of Birth:</td>
        <td>
          <input type="date" id="dob">
          <div class="error" id="dobError"></div>
        </td>
      </tr>
      <tr>
        <td>Gender:</td>
        <td>
          <input type="radio" name="gender" value="Male"> Male
          <input type="radio" name="gender" value="Female"> Female
          <div class="error" id="genderError"></div>
        </td>
      </tr>
      <tr>
        <td>Address:</td>
        <td><input type="text" placeholder="123 Main St"></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: center;">
          <input type="submit" value="Submit">
        </td>
      </tr>
    </table>
  </form>
</div>

<script src="validation.js"></script>
</body>
</html>
