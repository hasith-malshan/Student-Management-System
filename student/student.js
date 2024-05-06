function assignmetState() {

    alert("Assignment Stste");

}

function findAssignemt() {
    setInterval(assignmetState, 1000 * 60 * 15)
}

function uploadAssignment(id) {
    var assignment = document.getElementById("uploadAssignment" + id);
    alert(assignment.value + "---" + id);

    var form = new FormData();
    form.append('file', assignment.files[0]);
    form.append('id', id);

    var x = new XMLHttpRequest();

    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;
            alert(text);
            if (text == "000") {
                assignment.value = "";
                document.getElementById("uploadBtn").innerHTML = "ReUpload"
                showMsgModal("Assignment Uploaded SuccessFully");
            } else {
                showMsgModal(text);
            }

        }
    }
    x.open("POST", "uploadAssignmentProcess.php", true);
    x.send(form);

}