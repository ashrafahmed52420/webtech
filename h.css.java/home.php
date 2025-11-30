<!DOCTYPE html>
<html>
<head>
  <title>Calculator</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container"> 
    <div class="calculator">
      <form id="calcForm">
        <div class="display">
          <input type="text" id="display" readonly>
        </div>

        <!-- Keep buttons in rows using divs -->
        <div class="button-row">
          <input type="button" value="AC">
          <input type="button" value="DE">
          <input type="button" value=".">
          <input type="button" value="/">
        </div>
        <div class="button-row">
          <input type="button" value="7">
          <input type="button" value="8">
          <input type="button" value="9">
          <input type="button" value="*">
        </div>
        <div class="button-row">
          <input type="button" value="4">
          <input type="button" value="5">
          <input type="button" value="6">
          <input type="button" value="-">
        </div>
        <div class="button-row">
          <input type="button" value="1">
          <input type="button" value="2">
          <input type="button" value="3">
          <input type="button" value="+">
        </div>
        <div class="button-row">
          <input type="button" value="00">
          <input type="button" value="0">
          <input type="button" value="=" class="equal">
        </div>
      </form>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
