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
var courseName = "";
var courseUrl = "../LMS/backend/getCourses.php";
function retrieveAndPrintCourse(res) {
    var numCourses = res.length;
    var courseNameHtml = document.getElementById("courseName");
    var courseDesceHtml = document.getElementById("courseDesc");
    for (var i=0; i< numCourses ;i++) {
        if(res[i].course_id == courseId){
            if (res[i].course_desc) {
                courseDesceHtml.innerText = res[i].course_desc;
                courseNameHtml.innerText = res[i].course_name;
            }
            else {
                courseDesceHtml.innerText = "There is currently no course description. Please keep a look out for future update on the course details!";
            }
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

callToDb(courseUrl, retrieveAndPrintCourse);

var enrolBtn = document.getElementById("enrolToCourse");
enrolBtn.addEventListener("click", enrolUser);

function enrolUser(){
    var courseNameHtml = document.getElementById("courseName");
    var courseName = courseNameHtml.innerText;
    var userId = sessionStorage.getItem("user_id");
    var userName = sessionStorage.getItem("user_name");
    deleteCourse(userId, courseId)
    addCourse(userId, userName, courseId, courseName)
    alert("Enrollment successful")
}


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