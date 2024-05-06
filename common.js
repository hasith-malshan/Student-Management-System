function manageTeacher(id) {

    var status = document.getElementById(id + "status");
    var grade = document.getElementById(id + "grade");
    var subject = document.getElementById(id + "subject");

    var form = new FormData();
    form.append("id", id);
    form.append("type", "teacher");
    form.append("status", status.value);
    form.append("grade", grade.value);
    form.append("subject", subject.value);


    var x = new XMLHttpRequest();
    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;

            alert(text);

            if (text == "000") {
                window.location = "manageTeachers.php";
            }
        }


    }
    x.open("POST", "managinProcess.php", true);
    x.send(form);
}

function manageStudent(id) {
    alert();

    var status = document.getElementById(id + "status");
    var grade = document.getElementById(id + "grade");

    var form = new FormData();
    form.append("id", id);
    form.append("type", "student");
    form.append("status", status.value);
    form.append("grade", grade.value);

    var x = new XMLHttpRequest();
    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;

            alert(text);

            if (text == "000") {
                window.location = "manageStudents.php";
            }
        }


    }
    x.open("POST", "managinProcess.php", true);
    x.send(form);
}

function manageOfficer(id) {

    var status = document.getElementById(id + "status");

    var form = new FormData();
    form.append("id", id);
    form.append("type", "officer");
    form.append("status", status.value);

    var x = new XMLHttpRequest();
    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;

            alert(text);

            if (text == "000") {
                window.location = "manageOfficers.php";
            }
        }


    }
    x.open("POST", "managinProcess.php", true);
    x.send(form);
}


function manageAdmin(id) {

    var status = document.getElementById(id + "status");

    var form = new FormData();
    form.append("id", id);
    form.append("type", "admin");
    form.append("status", status.value);

    var x = new XMLHttpRequest();
    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;

            alert(text);

            if (text == "000") {
                window.location = "manageAdmin.php";
            }
        }


    }
    x.open("POST", "managinProcess.php", true);
    x.send(form);
}