function retrieveEngineers() {
    var request = new XMLHttpRequest()

    var engineers = document.getElementById("engineersList")
    var url = "backend/retrievePEngineers.php"

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


function retrieveRequiredCourses() {
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
