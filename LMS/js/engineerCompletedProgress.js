function engineerCourseProgress() {
    var request = new XMLHttpRequest(); // Prep to make an HTTP request

    request.onreadystatechange = function() {
        if( this.readyState == 4 && this.status == 200 ) {
            let obj = JSON.parse(this.responseText);

            getEngineerCourseProgress(obj);
        }
    }

    request.open("GET", "../LMS/backend/getCompletedCourses.php", true);
    request.send();
}

function getEngineerCourseProgress(obj) {
    completedCoursesHtml = '';
    completedCoursesCount = obj.length;

    for (i=0; i < obj.length; i++){
        // console.log(obj[i]);
        var course_name = obj[i]['course_name'];
        var completedDropdown = document.getElementById("completed")
        var image = obj[i]['image'];

        completedCoursesHtml += `
                        <div class="col-sm-6 col-md-4">
                            <div class="card" style="width: 20rem;">
                                <a href="#"><img src="assets/${image}" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                        <h5 class="card-title">${course_name}</h5>
                                        <p class="card-text">Duration Completed: <span>2021-01-01 00:00:00 - 2021-02-01 00:00:00</span></p>
                                    </div>
                            </div>
                        </div> 
                        `;
        var changeDropdownItem = `<a class="dropdown-item" href="engineerCoursePage.html?courseId=${obj[i].course_id}">${obj[i].course_name}</a>`;
        completedDropdown.innerHTML += changeDropdownItem;
    }   

    document.getElementById('completedCoursesCount').innerHTML = 'Completed Courses: ' + completedCoursesCount;
    document.getElementById('completedCourses').innerHTML = completedCoursesHtml;            

}

function engineerRequiredCourses() {
    var request = new XMLHttpRequest(); // Prep to make an HTTP request

    request.onreadystatechange = function() {
        if( this.readyState == 4 && this.status == 200 ) {
            let obj = JSON.parse(this.responseText);

            getEngineerRequiredCourses(obj);
        }
    }

    request.open("GET", "../LMS/backend/getRequiredCourses.php", true);
    request.send();
}

function getEngineerRequiredCourses(obj) {
    requiredCoursesHtml = '';
    requiredCoursesCount = obj.length;

    for (i=0; i < obj.length; i++){
        // console.log(obj[i]);
        var course_name = obj[i]['course_name'];
        var image = obj[i]['image'];
        requiredCoursesHtml += `
                        <div class="col-sm-6 col-md-4">
                            <div class="card" style="width: 20rem;">
                                <a href="#"><img src="assets/${image}" class="card-img-top"></a>
                                    <div class="card-body">
                                        <h5 class="card-title">${course_name}</h5>
                                    </div>
                            </div>
                        </div> 
                        `
    }   

    document.getElementById('requiredCoursesCount').innerHTML = 'Required Courses: ' + requiredCoursesCount;
    document.getElementById('requiredCourses').innerHTML = requiredCoursesHtml;            

}
var enrolledCourseUrl = "../LMS/backend/retrieveEnrolledCourses.php";
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

callToDb(enrolledCourseUrl, retrieveAllEnrolled);