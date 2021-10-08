function retrieveEngineers() {
    var request = new XMLHttpRequest()

    var engineers = document.getElementById("viewAllEngineersTable")
    var url = "backend/getEngineersAndRequiredCourses.php"

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = JSON.parse(this.responseText)
            if (result) {
                //convert this into html code to display in table (assign to engineers)
                toPrint = ""
                for (const [key, value] of Object.entries(result)) {
                    user_id = value['user_id'].toString()

                    toPrint = toPrint + '<tr><td>' + key
                             + '</td><td><div class="dropdown"><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonU'
                             + user_id + '" data-bs-toggle="dropdown" aria-expanded="false"> View All </button>'
                             + '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonU' + user_id + '">'
                             + '<div class="form-group m-2"><li><button type="button" class="btn btn-primary btn-sm" onclick="selectAll(this.id)" id="U' + user_id + '">Select All</button></li>&nbsp;'

                    for (const course of value['courses']) {
                        course_id = course['course_id'].toString()
                        course_name = course['course_name']
                        toPrint = toPrint + '<li><input class="form-check-input m-1" type="checkbox" name="' + user_id + 'requiredCourses[]" value="" id="U' + user_id + '_C' + course_id + '">'
                                 + '<label class="form-check-label" for="U' + user_id + '_C' + course_id + '">' + course_name + '</li>'
                    }

                    toPrint = toPrint + '&nbsp<li><button type="button" class="btn btn-success btn-sm" onclick="enrol(this.id)" id="U' + user_id + '">Enrol</button></li></div></ul></div></td></tr>'
                }
                engineers.innerHTML = toPrint  

            }
        }
    }

    request.open("GET", url, true)
    request.send()
}


function retrieveCourses() {
    var request = new XMLHttpRequest()

    var courses = document.getElementById("viewAllCoursesTable")
    var url = "backend/getCoursesAndEligibleLearners.php"

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = JSON.parse(this.responseText)
            if (result) {
                //convert this into html code to display in table (assign to engineers)
                toPrint = ""
                for (const [key, value] of Object.entries(result)) {
                    course_id = value['course_id'].toString()

                    toPrint = toPrint + '<tr><td>' + key
                             + '</td><td><div class="dropdown"><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonC'
                             + course_id + '" data-bs-toggle="dropdown" aria-expanded="false"> View All </button>'
                             + '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonC' + course_id + '">'
                             + '<div class="form-group m-2"><li><button type="button" class="btn btn-primary btn-sm" onclick="selectAll(this.id)" id="C' + course_id + '">Select All</button></li>&nbsp;'

                    for (const learner of value['learners']) {
                        user_id = learner['user_id'].toString()
                        user_name = learner['user_name']
                        toPrint = toPrint + '<li><input class="form-check-input m-1" type="checkbox" name="' + course_id + 'eligibleLearners[]" value="" id="C' + course_id + '_U' + user_id + '">'
                                 + '<label class="form-check-label" for="C' + course_id + '_U' + user_id + '">' + user_name + '</li>'
                    }

                    toPrint = toPrint + '&nbsp<li><button type="button" class="btn btn-success btn-sm" onclick="enrol(this.id)" id="C' + course_id + '">Enrol</button></li></div></ul></div></td></tr>'
                }
                courses.innerHTML = toPrint  

            }
        }
    }

    request.open("GET", url, true)
    request.send()
}


function selectAll(id) {

    if(id[0] == "C") {
        var checkbox_name = id.toString().substring(1, id.toString().length) + "eligibleLearners[]"
    } else{
        var checkbox_name = id.toString().substring(1, id.toString().length) + "requiredCourses[]"
    }

    var checkboxes = document.getElementsByName(checkbox_name)

    for (const checkbox of checkboxes){
        checkbox.checked = true
    }

    //this prevents dropdown from closing upon button clicked inside
    event.stopPropagation()
    
}


function enrol(id) {

    if(id[0] == "C") {
        var checkbox_name = id.toString().substring(1, id.toString().length) + "eligibleLearners[]"
    } else{
        var checkbox_name = id.toString().substring(1, id.toString().length) + "requiredCourses[]"
    }

    var checkboxes = document.getElementsByName(checkbox_name)
    
    for (const checkbox of checkboxes){
        if(checkbox.checked == true) {

            var arr = checkbox.id.split("_")
            if(id[0] == "C"){
                var user_id = arr[1].substring(1, arr[1].length)
                var course_id = arr[0].substring(1, arr[1].length)
            } else{
                var user_id = arr[0].substring(1, arr[1].length)
                var course_id = arr[1].substring(1, arr[1].length)
            }

            deleteCourse(user_id, course_id)
        }
        
    }

        //this refreshes the list shown
        retrieveEngineers()
        retrieveCourses()

        //alert("Enrolment successful")
}

function deleteCourse(user_id, course_id) {
    var request = new XMLHttpRequest()

    var details = "userId=" + user_id + "&courseId=" + course_id
    var url = "backend/deleteRequiredCourses.php?" 

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = this.responseText
            console.log(result)
        }
    }

    request.open("GET", url, true)
    request.send()
}

