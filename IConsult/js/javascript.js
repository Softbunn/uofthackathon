function hoverOverItem(id) {
    //document.getElementById("profile").innerHTML = id;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       document.getElementById("profile").innerHTML = this.responseText;
    }
   };
   xhttp.open("POST", "../templates/profile-form.php", true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
   var input = id;
   xhttp.send("id=".concat(input));
}
function showNames() {
                      var xhttp = new XMLHttpRequest();
                      xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                          document.getElementById("profile").innerHTML = this.responseText;
                        }
                      };
                      xhttp.open("POST", "search-results.php", true);
                      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                      var input = document.getElementById("search").value;
                      xhttp.send("id=".concat(input));
                      }
function inviteConsultant(id, email){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("form").innerHTML = this.responseText;
        }
   };
   xhttp.open("POST", "invite.php", true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
   var separator = "&";
   var id = "id=".concat(id);
   var email = "email=".concat(email);
   var message = "message=".concat(document.getElementById("message").value);
   var date = "date=".concat(document.getElementById("date").value);
   var statement = id.concat(separator, email, separator, message, separator, date);
   xhttp.send(statement);
}

function myFunction() {
    //myProgram();
    var x = document.getElementById("pass1").value;
    var y = document.getElementById("pass2").value;
    if(x == ""){
        document.getElementById("spanpass").innerHTML = "Please fill in the password";
        document.getElementById("submit").disabled= true;
    }
    else if(x !== y){
        document.getElementById("spanpass").innerHTML = "Passwords do not match";
        document.getElementById("submit").disabled= true;
    }
    else{
        document.getElementById("spanpass").innerHTML = "Passwords match";
        document.getElementById("submit").disabled= false;
    }
    }
function session(email){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("chat").innerHTML = this.responseText;
        }
   };
   xhttp.open("POST", "../controllers/chatReader.php", true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
   xhttp.send("email=".concat(email));
}
function call(email){
   window.location = "../templates/session.php?email=".concat(email);
}