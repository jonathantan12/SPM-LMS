const queryString = location.search.substring(1);
const urlParams = new URLSearchParams(queryString);
const courseId = urlParams.get('courseId')
if(sessionStorage.getItem("user_id")){
    let user_id = sessionStorage.getItem("user_id");
}
else{
    sessionStorage.setItem("user_id","1");
}
if(sessionStorage.getItem("user_name")){
    let user_name = sessionStorage.getItem("user_name");
}
else{
    sessionStorage.setItem("user_name","Jonathan");
}

var request = new XMLHttpRequest()

var url = "../LMS/backend/getCourses.php"

request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        var courses = JSON.parse(this.responseText);
        var numCourses = courses.length;
        if (courses) {
            for (var i =0; i<numCourses;i++){
                if(courses[i].course_id == courseId){
                    var course = courses[i]
                }
            }
        }
        var courseNameHtml = document.getElementById("courseName");
        var courseDesceHtml = document.getElementById("courseDesc");
        courseNameHtml.innerText = course.course_name;
        if (course.course_desc) {
            courseDesceHtml.innerText = course.course_desc;
        }
        else {
            courseDesceHtml.innerText = "There is currently no course description. Please keep a look out for future update on the course details!";
        }
        
    }
    
}

request.open("GET", url, true)
request.send()