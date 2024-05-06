//this method is used to invite actors
function invitation(acc) {

    var username = document.getElementById("username");
    var passward = document.getElementById("passward");
    var email = document.getElementById("email");


    var form = new FormData();
    form.append("username", username.value);
    form.append("passward", passward.value);
    form.append("email", email.value);
    form.append("type", acc);

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


// this method is to send email
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


//this method is used to generate random usenames and passwards
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

//this method is used to clear the all fields
function clearFields() {
    document.getElementById("username").value = "";
    document.getElementById("passward").value = "";
    document.getElementById("email").value = "";
}