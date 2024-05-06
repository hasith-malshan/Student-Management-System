// this method is used to invite students
function invitation(acc) {

    // getting the sername, password, and emails and store thenm in variables
    var username = document.getElementById("username");
    var passward = document.getElementById("passward");
    var email = document.getElementById("email");


    // adding the data to the form data object
    var form = new FormData();
    form.append("username", username.value);
    form.append("passward", passward.value);
    form.append("email", email.value);
    form.append("type", acc);

    // creating a xmlhttp request to send send dat to the server side
    var x = new XMLHttpRequest();

    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;

            alert(text);

            const data = JSON.parse(text);

            var email1 = data.email;
            var type1 = data.type;

            if (type1 != "") {
                clearFields();
                alert("type detected");
                invite(email1, type1);
            } else {
                alert(text)
            }



        }

    }
    x.open("POST", "../inviteProcess.php", true);
    x.send(form);

}

// this method is used to send email to the students
function invite(email, type) {

    var form = new FormData();
    form.append("email", email);
    form.append("type", type);

    var x = new XMLHttpRequest();

    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;
            alert(text);
        }

    }
    x.open("POST", "../sendmail/index.php", true);
    x.send(form);
}

// this mrhod is used to generate username passwards and passwords
function generateItems() {


    var username = document.getElementById("username");
    var passward = document.getElementById("passward");

    var x = new XMLHttpRequest();

    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;
            const data = JSON.parse(text);

            username.value = data.username;
            passward.value = data.passward;
        }

    }


    x.open("POST", "../generateItems.php", true);
    x.send();

}

//this meythod is used to clear the filds
function clearFields() {
    document.getElementById("username").value = "";
    document.getElementById("passward").value = "";
    document.getElementById("email").value = "";
}


// this method is used to publish the assinmet
function publish(id) {
    alert();

    var form = new FormData();
    form.append('id', id);

    var x = new XMLHttpRequest();

    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;
            alert(text);

        }
    }
    x.open("POST", "../publish2.php", true);
    x.send(form);

}