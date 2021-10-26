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
var requiredCourses = {};
var completedCourses = {};
var completedCoursesUrl = "../LMS/backend/getCompletedCourses.php";
var engineerRequiredCourseUrl = "../LMS/backend/getEngineersAndRequiredCourses.php";
var courseUrl = "../LMS/backend/getClasses.php";
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
console.log(courses)
function retrieveEngineerRequiredCourses(res) {
    var userRequiredCourses = res[user_name]["courses"];
    var requiredCoursesHtml = document.getElementById("coursesAvailable");
    var numRequiredCourses = userRequiredCourses.length;
    if (userRequiredCourses) {
        for (var x=0; x< numRequiredCourses ;x++) {
            var changeHTML =    `
            <div class="col-sm-6 col-md-4">
                <div class="card" style="width: 20rem;">
                <a href="#"><img src="assets/placeholder_img.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title text-center">${userRequiredCourses[x].course_name}<br>(Required)</h5>
                        <p class="card-text">Class size: <span>${courses[userRequiredCourses[x].course_name]["slots_available"]}</span></p>
                        <p class="card-text">Duration: <span>${courses[userRequiredCourses[x].course_name].start_date} - ${courses[userRequiredCourses[x].course_name].end_date}</span></p>
                        <a href="enrol.html?courseId=${userRequiredCourses[x].course_id}" class="btn btn-outline-success" id="enrol ${userRequiredCourses[x].course_name}">Enrol</a>
                    </div>
                </div>
            </div> `;
                                
            requiredCoursesHtml.innerHTML += changeHTML;
        }
    }
}

function retrieveAllCompleted(res) {
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
        }
    }
    console.log(completedCourses)
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

callToDb(engineerRequiredCourseUrl, retrieveEngineerRequiredCourses);
callToDb(courseUrl, retrieveAllCourses);

