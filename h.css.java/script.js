/*waits until full html is loaded*/
document.addEventListener("DOMContentLoaded", function () {
    const display = document.getElementById("display");
    /*list of the buttons */
    const buttons = document.querySelectorAll("form input[type='button']");
    /*loops all button,what happen when clicked or display value*/
    buttons.forEach(button => {
      button.addEventListener("click", function () {
        const value = button.value;
  
        if (value === "AC") {
          display.value = "";
        } else if (value === "DE") {
          display.value = display.value.slice(0, -1);
        } else if (value === "=") {
          try {
            display.value = eval(display.value);
          } catch {
            display.value = "Error";
          }
        } else {
          display.value += value;
        }
      });
    });
  });
  