if(sessionStorage.getItem("user_id")){
    var user_id = sessionStorage.getItem("user_id");
}
else{
    sessionStorage.setItem("user_id","1");
}
if(sessionStorage.getItem("user_name")){
    var user_name = sessionStorage.getItem("user_name");
}
else{
    sessionStorage.setItem("user_name","Jonathan");
}


var courses = {};
var coursesWithImage = {};
var requiredCourses = {};
var completedCourses = {};
var preRequisiteCourse = {};
var completedCoursesUrl = "../LMS/backend/getCompletedCourses.php";
var engineerRequiredCourseUrl = "../LMS/backend/getEngineersAndRequiredCourses.php";
var courseUrl = "../LMS/backend/getClasses.php";
var enrolledCourseUrl = "../LMS/backend/retrieveEnrolledCourses.php";
var coursesUrl = "../LMS/backend/getCourses.php";
function retrieveAllcoursesWithImage(res) {
    var response = res;
    var numCourses = response.length;
    for (var i=0; i< numCourses ;i++) {
        coursesWithImage[response[i].course_name] = {
            "course_id": response[i].course_id,
            "course_name": response[i].course_name,
            "course_desc": response[i].course_desc,
            "image": response[i].image
        }
    }
}
function retrieveAllCourses(res) {
    var numCourses = res.length;
    for (var i=0; i< numCourses ;i++) {
        courses[res[i].course_name] = {
            "class_name": res[i].class_name,
            "course_id": res[i].course_id,
            "end_date": res[i].end_date,
            "start_date": res[i].start_date,
            "slots_available": res[i].slots_available
        }
    }
}

function retrieveAllEnrolled(res) {
    var enrolledDropdown = document.getElementById("currentlyEnrolled");
    var enrolledCourses = res;
    var numEnrolledCourses = enrolledCourses.length;
    if (enrolledCourses) {
        for (var i=0; i< numEnrolledCourses ;i++) {
            var changeDropdownItem = `<li><a class="dropdown-item" href="engineerCoursePage.html?courseId=${enrolledCourses[i].course_id}">${enrolledCourses[i].course_name}</a></li>`;
            enrolledDropdown.innerHTML += changeDropdownItem;
        }
    }
}

function retrieveAllCompleted(res) {
    var completedDropdown = document.getElementById("completed")
    var completed = res;
    var numCompletedCourses = res.length;
    if (completed) {
        for (var i=0; i< numCompletedCourses ;i++) {
            completedCourses[res[i].course_name] = {
                "completed_course_id": res[i].completed_course_id,
                "course_id": res[i].course_id,
                "course_name": res[i].course_name,
                "user_id": res[i].user_id,
                "user_name": res[i].user_name
            }
            var changeDropdownItem = `<a class="dropdown-item" href="engineerCoursePage.html?courseId=${res[i].course_id}">${res[i].course_name}</a>`;
            completedDropdown.innerHTML += changeDropdownItem;
        }
    }
}

function retrieveAllCoursesPrerequisites(res) {
    var preReqCourses = res.length;
    for (var i=0; i< preReqCourses ;i++) {
        preRequisiteCourse[res[i].course_name] = {
            "course_id": res[i].course_id,
            "end_date": res[i].end_date,
            "prerequisite_course_id": res[i].prerequisite_course_id,
            "prerequisite_course_name": res[i].prerequisite_course_name
        }
    }
}

function retrieveEngineerRequiredCourses(res) {
    var userRequiredCourses = res[user_name]["courses"];
    var requiredCoursesHtml = document.getElementById("coursesAvailable");
    var numRequiredCourses = userRequiredCourses.length;
    if (userRequiredCourses) {
        var x;
        for (x=0; x< numRequiredCourses ;x++) {
            var url = "../LMS/backend/getCoursePrerequisites.php?course_id=" + userRequiredCourses[x]["course_id"];
            var request = new XMLHttpRequest();
            var completePreReq = false;
            request.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    var numPreReqCourses = response.length;
                    for (var i=0; i< numPreReqCourses ;i++) {
                        if (response[i]["prerequisite_course_name"] in completedCourses){
                            completePreReq = true;
                        } else {
                            completePreReq = false;
                            break
                        }
                    }
                    if (completePreReq){
                        var changeHTML =    `
                            <div class="col-sm-6 col-md-4">
                                <div class="card" style="width: 20rem;">
                                    <img src="${coursesWithImage[response[0].course_name].image}" class="card-img-top" alt="${response[0].course_name} Image" style="height: 10rem;" >
                                    <div class="card-body">
                                        <h5 class="card-title text-center">${response[0].course_name}<br>(Required)</h5>
                                        <p class="card-text">Class size: <span>${courses[response[0].course_name]["slots_available"]}</span></p>
                                        <p class="card-text">Duration: <span>${courses[response[0].course_name].start_date} - ${courses[response[0].course_name].end_date}</span></p>
                                        <a href="enrol.html?courseId=${response[0].course_id}" class="stretched-link" id="enrol ${response[0].course_name}"></a>
                                    </div>
                                </div>
                            </div> `;
                                            
                        requiredCoursesHtml.innerHTML += changeHTML;
                    } else {
                        var changeHTML =    `
                            <h1>You are currently not eligible for ${userRequiredCourses[x].course_name}. Please ensure that you have completed the following pre-requisite courses:</h1>
                            <ul>`;
                        for (var i=0; i< numPreReqCourses ;i++) {
                            changeHTML += `<li>${response[i]["prerequisite_course_name"]}</li>`;
                        }
                                
                        changeHTML += `</ul>`;
                                                
                        requiredCoursesHtml.innerHTML += changeHTML;
                    }
                }
            }
            request.open("GET", url, true)
            request.send()
        }
    }
}

function callToDb(url, cFunction) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            cFunction(JSON.parse(this.responseText));
        }
    }
    request.open("GET", url, true)
    request.send()
}

callToDb(coursesUrl, retrieveAllcoursesWithImage)
callToDb(engineerRequiredCourseUrl, retrieveEngineerRequiredCourses);
callToDb(courseUrl, retrieveAllCourses);
callToDb(completedCoursesUrl, retrieveAllCompleted);
callToDb(enrolledCourseUrl, retrieveAllEnrolled)
