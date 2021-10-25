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

var request = new XMLHttpRequest()

var url = "../LMS/backend/getEngineersAndRequiredCourses.php"

request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        var responce = JSON.parse(this.responseText);
        var userRequiredCourses = responce[user_name]["courses"];
        var requiredCoursesHtml = document.getElementById("coursesAvailable");
        var numRequiredCourses = userRequiredCourses.length;
        if (userRequiredCourses) {
            var courseUrl = "../LMS/backend/getClasses.php";
            request.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    var courses = {};
                    var numCourses = response.length;
                    for (var i=0; i< numCourses ;i++) {
                        courses[response[i].course_name] = {
                            "class_name": response[i].class_name,
                            "course_id": response[i].course_id,
                            "end_date": response[i].end_date,
                            "start_date": response[i].start_date,
                            "slots_available": response[i].slots_available
                        }
                    }
                    if(courses){
                        for (var x=0; x< numRequiredCourses ;x++) {
                            var changeHTML =    `
                            <div class="col-sm-6 col-md-4">
                                <div class="card" style="width: 20rem;">
                                <a href="#"><img src="assets/placeholder_img.png" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">${userRequiredCourses[x].course_name}<br>(Required)</h5>
                                        <p class="card-text">Class size: <span>${courses[userRequiredCourses[x].course_name].slots_available}</span></p>
                                        <p class="card-text">Duration: <span>${courses[userRequiredCourses[x].course_name].start_date} - ${courses[userRequiredCourses[x].course_name].end_date}</span></p>
                                        <a href="enrol.html?courseId=${userRequiredCourses[x].course_id}" class="btn btn-outline-success" id="enrol ${userRequiredCourses[x].course_name}">Enrol</a>
                                    </div>
                                </div>
                            </div> `;
                                                
                            requiredCoursesHtml.innerHTML += changeHTML;
                        }
                    }
                    
                }
            }
            request.open("GET", courseUrl, true)
            request.send()
        }

    }
    
}

request.open("GET", url, true)
request.send()