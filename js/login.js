   function validateForm(event) {
      event.preventDefault(); // Stop form from refreshing the page

      let user = document.getElementById("user").value.trim();
      let pass = document.getElementById("pass").value.trim();

      if (user === "") {
        alert("Username is required!");
        return false;
      }

      if (pass === "") {
        alert("Password is required!");
        return false;
      }

      if (pass.length < 6) {
        alert(" Password must be at least 6 characters long!");
        return false;
      }
      window.location.href = "../html/home.html";
      return true;
    }