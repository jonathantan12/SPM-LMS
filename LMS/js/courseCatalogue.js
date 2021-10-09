var request = new XMLHttpRequest()

var url = "../LMS/backend/courseCatalogue.php"

request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        var responce = JSON.parse(this.responseText);
        var courses = responce;
        if (courses) {
            var coursesAvailable = document.getElementById("courses_available");
            var numCourses = courses.length;
            for (var i=0; i< numCourses ;i++) {
                var changeHTML =    `
                <div class="col-sm-6 col-md-4">
                    <div class="card" style="width: 20rem;">
                    <a href="#"><img src="assets/placeholder_img.png" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h5 class="card-title text-center" >${courses[i].course_name}</h5>
                            <p class="card-text">Class size: <span>${courses[i].slots_available}</span></p>
                            <a href="enrol.html" class="btn btn-outline-success">Enrol</a>
                        </div>
                    </div>
                </div> `;
                                    
                coursesAvailable.innerHTML += changeHTML;
            }
        }

    }
    
}

request.open("GET", url, true)
request.send()