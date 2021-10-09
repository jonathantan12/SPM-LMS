var request = new XMLHttpRequest()

var url = "../LMS/backend/retrieveEnrolledCourses.php"

request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        var responce = JSON.parse(this.responseText);
        var enrolledCourses = responce;
        if (enrolledCourses) {
            var enrolledCoursesHtml = document.getElementById("coursesEnrolled");
            var numEnrolledCourses = enrolledCourses.length;
            var new_url = "../LMS/backend/getCourses.php"
            request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
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
                    if(courses){
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
                        }
                    }
                }
            }
            request.open("GET", new_url, true)
            request.send()
        }

    }
    
}

request.open("GET", url, true)
request.send()