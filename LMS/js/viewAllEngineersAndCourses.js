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

                    toPrint = toPrint + '<tr><td>' + key + '</td>'
                    
                    if(value['courses'].length != 0) {
                        toPrint = toPrint + '<td><div class="dropdown"><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonU'
                                + user_id + '" data-bs-toggle="dropdown" aria-expanded="false"> View All </button>'
                                + '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonU' + user_id + '">'
                                + '<div class="form-group m-2"><li><button type="button" class="btn btn-primary btn-sm" onclick="selectAll(this.id)" id="U' + user_id + '">Select All</button>'
                                + '&nbsp;<button type="button" class="btn btn-primary btn-sm" onclick="clearAll(this.id)" id="U' + user_id + '">Clear All</button></li>&nbsp;'

                        for (const course of value['courses']) {
                            course_id = course['course_id'].toString()
                            course_name = course['course_name']
                            toPrint = toPrint + '<li><input class="form-check-input m-1" type="checkbox" name="' + user_id + 'requiredCourses[]" value="' + course_name + '" id="U' + user_id + '_C' + course_id + '">'
                                    + '<label class="form-check-label" for="U' + user_id + '_C' + course_id + '">' + course_name + '</li>'
                        }

                        toPrint = toPrint + '&nbsp<li><button type="button" class="btn btn-success btn-sm" onclick="enrol(this.id)" id="U' + user_id + '_' + key + '">Enrol</button></li></div></ul></div></td></tr>'
                    } else{
                        toPrint = toPrint + '<td>-</td></tr>'
                    }
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

                    toPrint = toPrint + '<tr><td>' + key + '</td>'
                    if (value['learners'].length!=0) {
                        toPrint = toPrint + '<td><div class="dropdown"><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonC'
                        + course_id + '" data-bs-toggle="dropdown" aria-expanded="false"> View All </button>'
                        + '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonC' + course_id + '">'
                        + '<div class="form-group m-2"><li><button type="button" class="btn btn-primary btn-sm" onclick="selectAll(this.id)" id="C' + course_id + '">Select All</button>'
                        + '&nbsp;<button type="button" class="btn btn-primary btn-sm" onclick="clearAll(this.id)" id="C' + course_id + '">Clear All</button></li>&nbsp;'

                        for (const learner of value['learners']) {
                            user_id = learner['user_id'].toString()
                            user_name = learner['user_name']
                            toPrint = toPrint + '<li><input class="form-check-input m-1" type="checkbox" name="' + course_id + 'eligibleLearners[]" value="' + user_name + '" id="C' + course_id + '_U' + user_id + '">'
                                    + '<label class="form-check-label" for="C' + course_id + '_U' + user_id + '">' + user_name + '</li>'
                        }

                        toPrint = toPrint + '&nbsp<li><button type="button" class="btn btn-success btn-sm" onclick="enrol(this.id)" id="C' + course_id + '_' + key + '">Enrol</button></li></div></ul></div></td></tr>'
                    } else {
                        toPrint = toPrint + '<td>-</td></tr>'
                    }
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
        var checkbox_name = id.substring(1, id.length) + "eligibleLearners[]"
    } else{
        var checkbox_name = id.substring(1, id.length) + "requiredCourses[]"
    }

    var checkboxes = document.getElementsByName(checkbox_name)

    for (const checkbox of checkboxes){
        checkbox.checked = true
    }

    //this prevents dropdown from closing upon button clicked inside
    event.stopPropagation()
    
}

function clearAll(id) {

    if(id[0] == "C") {
        var checkbox_name = id.substring(1, id.length) + "eligibleLearners[]"
    } else{
        var checkbox_name = id.substring(1, id.length) + "requiredCourses[]"
    }

    var checkboxes = document.getElementsByName(checkbox_name)

    for (const checkbox of checkboxes){
        checkbox.checked = false
    }

    //this prevents dropdown from closing upon button clicked inside
    event.stopPropagation()
    
}


function enrol(id) {

    id_num = id.split("_")[0]
    id_name = id.split("_")[1]

    if(id[0] == "C") {
        var checkbox_name = id_num.toString().substring(1, id.toString().length) + "eligibleLearners[]"
    } else{
        var checkbox_name = id_num.toString().substring(1, id.toString().length) + "requiredCourses[]"
    }

    var checkboxes = document.getElementsByName(checkbox_name)

    var results1 = []
    var results2 = []
    for (const checkbox of checkboxes){
        var result = 'false'
        if(checkbox.checked == true) {

            var arr = checkbox.id.split("_")
            if(id[0] == "C"){
                var user_id = arr[1].substring(1, arr[1].length)
                var course_id = arr[0].substring(1, arr[1].length)
                var user_name = checkbox.value
                var course_name = id_name
            } else{
                var user_id = arr[0].substring(1, arr[1].length)
                var course_id = arr[1].substring(1, arr[1].length)
                var user_name = id_name
                var course_name = checkbox.value
            }

            deleteCourse(user_id, course_id)
            addCourse(user_id, user_name, course_id, course_name)
            alert("Enrollment successful")
            retrieveCourses()
            retrieveEngineers()
            
            
        }
        
    }

        

}


//this function deletes required courses from the table
function deleteCourse(user_id, course_id) {
    var request = new XMLHttpRequest()

    var details = "userId=" + user_id + "&courseId=" + course_id
    var url = "backend/deleteRequiredCourses.php?" + details

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = this.responseText
            return result
        }
    }

    request.open("GET", url, true)
    request.send()
}

function addCourse(user_id, user_name, course_id, course_name) {
    var request = new XMLHttpRequest()

    var details = "courseId=" + course_id
    var url = "backend/getClassWithVacancy.php?" + details

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            class_name = this.responseText
            var request2 = new XMLHttpRequest()

            var details2 = "userId=" + user_id + "&userName=" + user_name + "&courseId=" + course_id + "&courseName=" + course_name + "&className=" + class_name 
            var url2 = "backend/addEnrolledCourses.php?" + details2

            request2.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var result = this.responseText
                    return result
                }
            }

            request2.open("GET", url2, true)
            request2.send()

            var request3 = new XMLHttpRequest()

            var details3 = "courseId=" + course_id + "&className=" + class_name 
            var url3 = "backend/updateClassVacancy.php?" + details3

            request3.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var result = this.responseText
                    return result
                }
            }

            request3.open("GET", url3, true)
            request3.send()
        }
    }

    request.open("GET", url, true)
    request.send()

}