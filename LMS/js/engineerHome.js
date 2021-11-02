sessionStorage.setItem("user_id","1");
sessionStorage.setItem("user_name","Jonathan")

var url1 = "../LMS/backend/getClasses.php";
var url2 = "../LMS/backend/retrieveEnrolledCourses.php";
var url3 = "../LMS/backend/getCompletedCourses.php";
var quizUrl = "";


var courses = {};
var enrolled = {};
var completed = {};
var quizzes = {};
var quizProgress = {};
function retrieveAllCourses(res) {
    var response = res;
    var numCourses = response.length;
    for (var i=0; i< numCourses ;i++) {
        courses[response[i].course_name] = {
            "class_name": response[i].class_name,
            "course_id": response[i].course_id,
            "end_date": response[i].end_date,
            "start_date": response[i].start_date
        }
    }
}

function retrieveAllEnrolled(res) {
    var enrolledCoursesHtml = document.getElementById("coursesEnrolled");
    var enrolledDropdown = document.getElementById("currentlyEnrolled");
    var enrolledCourses = res;
    var numEnrolledCourses = enrolledCourses.length;
    if (enrolledCourses) {
        for (var i=0; i< numEnrolledCourses ;i++) {
            enrolled[enrolledCourses[i].course_name] = {
                "course_id": enrolledCourses[i].course_id,
                "enrolled_course_id": enrolledCourses[i].enrolled_course_id,
                "user_id": enrolledCourses[i].user_id,
                "user_name": enrolledCourses[i].user_name
            }
            var changeHTML =    `
            <div class="col-sm-6 col-md-4">
                <div class="card" style="width: 20rem;">
                <a href="course.html?courseId=${enrolledCourses[i].course_id}"><img src="assets/placeholder_img.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">${enrolledCourses[i].course_name}</h5>
                        <p class="card-text">Duration: <span>${courses[enrolledCourses[i].course_name].start_date} - ${courses[enrolledCourses[i].course_name].end_date}</span></p>
                        <p class="card-text">Sections progress: <span>5/10</span></p>
                    </div>
                </div>
            </div> 
            `;
            enrolledCoursesHtml.innerHTML += changeHTML;
            var changeDropdownItem = `<li><a class="dropdown-item" href="#">${enrolledCourses[i].course_name}</a></li>`;
            enrolledDropdown.innerHTML += changeDropdownItem;
        }
    }
}
function retrieveAllCompleted(res) {
    var completedCoursesHtml = document.getElementById("completedCourses");
    var completedDropdown = document.getElementById("completed");
    var numCompletedCourses = res.length;
    if (completedCourses) {
        for (var i=0; i< numCompletedCourses ;i++) {
            completed[res[i].course_name] = {
                "completed_course_id": res[i].completed_course_id,
                "course_id": res[i].course_id,
                "course_name": res[i].course_name,
                "user_id": res[i].user_id,
                "user_name": res[i].user_name
            }
            var changeHTML =    `
            <div class="col-sm-6 col-md-4">
                <div class="card" style="width: 20rem;">
                <a href="course.html?courseId=${res[i].course_id}"><img src="assets/placeholder_img.png" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">${res[i].course_name}</h5>
                        <p class="card-text">Duration: <span>${courses[res[i].course_name].start_date} - ${courses[res[i].course_name].end_date}</span></p>
                        <p class="card-text">Sections progress: <span>5/10</span></p>
                    </div>
                </div>
            </div> 
            `;
            completedCoursesHtml.innerHTML += changeHTML;
            var changeDropdownItem = `<a class="dropdown-item" href="#">${res[i].course_name}</a>`;
            completedDropdown.innerHTML += changeDropdownItem;
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

callToDb(url1, retrieveAllCourses);
callToDb(url2, retrieveAllEnrolled);
callToDb(url3, retrieveAllCompleted);