var verifyModalAction;
var msgModalAction;


function login(acc) {

    var username = document.getElementById("username");
    var passward = document.getElementById("passward");
    var remember = document.getElementById("remember");

    var form = new FormData();
    form.append("username", username.value);
    form.append("passward", passward.value);
    form.append("remember", remember.checked);
    form.append("type", acc);

    var x = new XMLHttpRequest();

    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;
            alert(text);
            const data = JSON.parse(text);

            //alert(data.msg);

            if (data.msg == "000") {
                alert(data.type);
                if (data.type == "admin") {
                    window.location = "admin/admin.php";
                } else if (data.type == "officer") {
                    window.location = "Aofficer/officer.php";
                } else if (data.type == "teacher") {
                    window.location = "teacher/teacher.php";
                } else if (data.type == "student") {
                    window.location = "student/student.php";
                } else {
                    showMsgModal("Rederecting to the page failed");
                }
            } else if (data.msg == "00X") {
                alert();
                showMsgModal("You have to verify Your Account to get Access to the system");

            } else {
                showMsgModal("Type Not Detected. Something went wrong in Login Process");
            }

        }


    }
    x.open("POST", "loginProcess.php", true);
    x.send(form);

}

function showMsgModal(msg) {

    var dm = document.getElementById("modal");
    msgModalAction = new bootstrap.Modal(dm);
    document.getElementById("msgModelBody").innerHTML = msg;
    msgModalAction.show();

}

function showVerifyModal() {

    var verifyModal = document.getElementById("verifyModal");
    verifyModalAction = new bootstrap.Modal(verifyModal);
    verifyModalAction.show();

}

function verification(acc) {

    var code = document.getElementById("code");

    var form = new FormData();
    form.append("code", code.value);
    form.append("type", acc);

    var x = new XMLHttpRequest();
    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;

            code.value = "";
            verifyModalAction.hide();

            showMsgModal(text);
        }


    }
    x.open("POST", "verificationProcess.php", true);
    x.send(form);

}

function updateData(acc) {

    alert(acc);

    var username = document.getElementById("username");
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var c_num = document.getElementById("c_num");
    var image = document.getElementById("image");



    var form = new FormData();
    form.append("username", username.value);
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("c_num", c_num.value);
    form.append("type", acc);
    form.append('image', image.files[0]);



    var x = new XMLHttpRequest();
    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;

            alert(text);

            if (text == "admin") {
                window.location = "admin.php";
            } else if (text == "officer") {
                window.location = "teacher.php";
            } else if (text == "teacher") {
                window.location = "teacher.php";
            } else if (text == "student") {
                window.location = "teacher.php";
            } else {
                alert(text);
            }

            showMsgModal(text);
        }


    }
    x.open("POST", "../updateProfileProcess.php", true);
    x.send(form);


}