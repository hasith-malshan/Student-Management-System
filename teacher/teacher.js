function addNote() {

    var note = document.getElementById("note");
    var noteName = document.getElementById("noteName");
    var noteDescription = document.getElementById("noteDescription");

    var form = new FormData();
    form.append('file', note.files[0]);
    form.append('noteName', noteName.value);
    form.append('noteDescription', noteDescription.value);

    var x = new XMLHttpRequest();

    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;

            if (text == "000") {
                noteName.value = "";
                noteDescription.value = ""
                note.value = "";

                showMsgModal("Note Uploaded SuccessFully");
            } else {
                showMsgModal(text);
            }

        }
    }
    x.open("POST", "addNoteProcess.php", true);
    x.send(form);

}

function addAssignment() {

    var assignmentName = document.getElementById("assignmentName");
    var assignmentDescription = document.getElementById("assignmentDescription");
    var assignmentDate = document.getElementById("assignmentDate");
    var assignment = document.getElementById("assignment");

    var form = new FormData();
    form.append('file', assignment.files[0]);
    form.append('assignmentName', assignmentName.value);
    form.append('assignmentDescription', assignmentDescription.value);
    form.append('assignmentDate', assignmentDate.value);

    var x = new XMLHttpRequest();

    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;
            alert(text);
            if (text == "000") {
                assignmentDate.value = "";
                assignmentName.value = ""
                assignment.value = "";
                assignmentDescription.value = "";

                showMsgModal("Assignment Uploaded SuccessFully");
            } else {
                showMsgModal(text);
            }

        }
    }
    x.open("POST", "addAssignmentProcess.php", true);
    x.send(form);

}

function showMsgModal(msg) {

    var dm = document.getElementById("modal");
    msgModalAction = new bootstrap.Modal(dm);
    document.getElementById("msgModelBody").innerHTML = msg;
    msgModalAction.show();

}

function addMarks(s_id, a_id) {

    var mark = document.getElementById("mark" + s_id);

    var form = new FormData();
    form.append('s_id', s_id);
    form.append('a_id', a_id);
    form.append('mark', mark.value);

    var x = new XMLHttpRequest();

    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;
            alert(text);

        }
    }
    x.open("POST", "addAssignmentMarks.php", true);
    x.send(form);

}

function publish(id) {

    var form = new FormData();
    form.append('id', id);

    var x = new XMLHttpRequest();

    x.onreadystatechange = function() {
        if (x.readyState == 4) {
            var text = x.responseText;
            alert(text);

        }
    }
    x.open("POST", "../publish.php", true);
    x.send(form);

}