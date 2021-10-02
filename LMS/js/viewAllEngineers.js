function retrieveEngineers() {
    var request = new XMLHttpRequest()

    var engineers = document.getElementById("viewAllEngineersTable")
    var url = "backend/retrieveEngineers.php"

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = JSON.parse(this.responseText)
            if (result) {
                //convert this into html code to display in table (assign to engineers)
                toPrint = ""
                for (const [key, value] of Object.entries(result)) {
                    user_id = value['user_id']

                    toPrint = toPrint + '<tr><td>' + key
                             + '</td><td><div class="dropdown"><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton'
                             + user_id + '" data-bs-toggle="dropdown" aria-expanded="false"> View All </button>'
                             + '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' + user_id + '">'
                             + '<div class="form-group m-2"><li><button type="button" class="btn btn-primary btn-sm" onclick="selectAll()" id="' + user_id + '">Select All</button></li>&nbsp;'

                    for (const course of value['courses']) {
                        course_id = course['course_id']
                        course_name = course['course_name']
                        toPrint = toPrint + '<li><input class="form-check-input m-1" type="checkbox" name="' + user_id + 'RequiredCourses[]" value="" id="' + user_id + '_' + course_id + '">'
                                 + '<label class="form-check-label" for="' + user_id + '_' + course_id + '">' + course_name + '</li>'
                    }

                    toPrint = toPrint + '&nbsp<li><button type="button" class="btn btn-success btn-sm" onclick="enrol()" id="' + user_id + 'Enrol">Enrol</button></li></div></ul></div></td></tr>'
                }
                engineers.innerHTML = toPrint  

            }
        }
    }

    request.open("GET", url, true)
    request.send()
}


function selectAll() {
    var request = new XMLHttpRequest()

    var role = document.getElementById("UserRole")
    var engineers = document.getElementById("engineersList")
    var url = "backend/retrievePEngineers.php?userRole=role"

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = this.responseText
            if (result) {
                //convert this into html code to display in table (assign to engineers)
            }
        }
    }

    request.open("GET", url, true)
    request.send()
}


function enrol() {
    var request = new XMLHttpRequest()

    var role = document.getElementById("UserRole")
    var engineers = document.getElementById("engineersList")
    var url = "backend/retrievePEngineers.php?userRole=role"

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = this.responseText
            if (result) {
                //convert this into html code to display in table (assign to engineers)
            }
        }
    }

    request.open("GET", url, true)
    request.send()
}
