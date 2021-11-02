const queryString = location.search.substring(1);
const urlParams = new URLSearchParams(queryString);
const courseId = urlParams.get('courseId');
if(sessionStorage.getItem("user_id")){
    var userId = sessionStorage.getItem("user_id");
}
else{
    sessionStorage.setItem("user_id","1");
}
if(sessionStorage.getItem("user_name")){
    var userName = sessionStorage.getItem("user_name");
}
else{
    sessionStorage.setItem("user_name","Jonathan");
}
var enrolledCourseUrl = "../LMS/backend/getEnrolledCourses.php";
function retrieveCourseName(res) {
    var numCourses = res.length;
    var queryString = location.search.substring(1);
    var urlParams = new URLSearchParams(queryString);
    var courseId = urlParams.get('courseId');
    var courseTabHtml = document.getElementsByTagName('title');
    var courseTitleHtml = document.getElementById("courseName");
    for (var i=0; i< numCourses ;i++) {
        if (res[i].course_id == courseId) {
            courseTabHtml[0].innerText = res[i].course_name;
            courseTitleHtml.innerText = res[i].course_name;
        }
    }
}

// var changeHTML =    `
// <div class="col-sm-6 col-md-4">
//     <div class="card" style="width: 20rem;">
//     <a href="course.html?courseId=${enrolledCourses[i].course_id}"><img src="assets/placeholder_img.png" class="card-img-top" alt="..."></a>
//         <div class="card-body">
//             <h5 class="card-title">${enrolledCourses[i].course_name}</h5>
//             <p class="card-text">Duration: <span>${courses[enrolledCourses[i].course_name].start_date} - ${courses[enrolledCourses[i].course_name].end_date}</span></p>
//             <p class="card-text">Sections progress: <span>5/10</span></p>
//         </div>
//     </div>
// </div> 
// `;
// enrolledCoursesHtml.innerHTML += changeHTML;

var url1 = "../LMS/backend/getClasses.php";
var url2 = "../LMS/backend/retrieveEnrolledCourses.php";
var url3 = "../LMS/backend/getCompletedCourses.php";


var courses = {};
var enrolled = {};
var completed = {};
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
            var changeDropdownItem = `<li><a class="dropdown-item" href="#">${enrolledCourses[i].course_name}</a></li>`;
            enrolledDropdown.innerHTML += changeDropdownItem;
        }
    }
}

function retrieveAllCompleted(res) {
    var completedDropdown = document.getElementById("completed");
    var numCompletedCourses = res.length;
    if (res) {
        for (var i=0; i< numCompletedCourses ;i++) {
            completed[res[i].course_name] = {
                "completed_course_id": res[i].completed_course_id,
                "course_id": res[i].course_id,
                "course_name": res[i].course_name,
                "user_id": res[i].user_id,
                "user_name": res[i].user_name
            }
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
callToDb(enrolledCourseUrl, retrieveCourseName);