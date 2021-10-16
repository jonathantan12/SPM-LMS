var request = new XMLHttpRequest()

var url = "../LMS/backend/getCourses.php"

request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        var enrolledCoursesHtml = document.getElementById("coursesEnrolled");
        var completedCoursesHtml = document.getElementById("completedCourses");
        var enrolledDropdown = document.getElementById("currentlyEnrolled");
        var completedDropdown = document.getElementById("completed");
        var numCourses = response.length;
        var courses = {};
        for (var i=0; i< numCourses ;i++) {
            courses[response[i].course_name] = {
                "class_name": response[i].class_name,
                "course_desc": response[i].course_desc,
                "course_id": response[i].course_id,
                "end_date": response[i].end_date,
                "start_date": response[i].start_date
            }
        }
        var enrolledCourseUrl = "../LMS/backend/retrieveEnrolledCourses.php";
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var enrolledCourses = JSON.parse(this.responseText);
                var numEnrolledCourses = enrolledCourses.length;
                if (enrolledCourses) {
                    for (var i=0; i< numEnrolledCourses ;i++) {
                        var changeHTML =    `
                        <div class="col-sm-6 col-md-4">
                            <div class="card" style="width: 20rem;">
                            <a href="#"><img src="assets/placeholder_img.png" class="card-img-top" alt="..."></a>
                                <div class="card-body">
                                    <h5 class="card-title">${enrolledCourses[i].course_name}</h5>
                                    <p class="card-text">Duration: <span>${courses[enrolledCourses[i].course_name].start_date} - ${courses[enrolledCourses[i].course_name].end_date}</span></p>
                                    <p class="card-text">Materials completion progress: <span>5/10</span></p>
                                    <p class="card-text">Quiz completion progress: <span>5/10</span></p>
                                </div>
                            </div>
                        </div> 
                        `;
                        enrolledCoursesHtml.innerHTML += changeHTML;
                        var changeDropdownItem = `<a class="dropdown-item" href="#">${enrolledCourses[i].course_name}</a>`;
                        enrolledDropdown.innerHTML += changeDropdownItem;
                    }
                }
                var completedCourseUrl = "../LMS/backend/getCompletedCourses.php";
                request.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var completedCourses = JSON.parse(this.responseText);
                        var numCompletedCourses = completedCourses.length;
                        
                        if (completedCourses) {
                            for (var i=0; i< numCompletedCourses ;i++) {
                                var changeHTML =    `
                                <div class="col-sm-6 col-md-4">
                                    <div class="card" style="width: 20rem;">
                                    <a href="#"><img src="assets/placeholder_img.png" class="card-img-top" alt="..."></a>
                                        <div class="card-body">
                                            <h5 class="card-title">${completedCourses[i].course_name}</h5>
                                            <p class="card-text">Duration: <span>${courses[completedCourses[i].course_name].start_date} - ${courses[completedCourses[i].course_name].end_date}</span></p>
                                            <p class="card-text">Materials completion progress: <span>5/10</span></p>
                                            <p class="card-text">Quiz completion progress: <span>5/10</span></p>
                                        </div>
                                    </div>
                                </div> 
                                `;
                                completedCoursesHtml.innerHTML += changeHTML;
                                var changeDropdownItem = `<a class="dropdown-item" href="#">${completedCourses[i].course_name}</a>`;
                                completedDropdown.innerHTML += changeDropdownItem;
                            }
                        }
                    }

                }
                request.open("GET", completedCourseUrl, true)
                request.send()

            }

        }
        request.open("GET", enrolledCourseUrl, true)
        request.send()

        
    }
    
}

request.open("GET", url, true)
request.send()
