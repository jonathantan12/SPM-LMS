const queryString = location.search.substring(1);
const urlParams = new URLSearchParams(queryString);
const courseId = urlParams.get('courseId');
if (urlParams.get('courseClassId')) {
    sessionStorage.setItem("retrievedCourseClassId",urlParams.get('courseClassId'));
    var courseClassId = sessionStorage.getItem("retrievedCourseClassId");
}

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

var homeNavHtml = document.getElementById('individualCourseHome');
var curriculumHtml = document.getElementById('courseMaterial');
curriculumHtml.getAttributeNode('href').value += `?courseId=${courseId}`;
homeNavHtml.getAttributeNode('href').value += `?courseId=${courseId}`;
var sectionsUrl = "../LMS/backend/getSections.php?courseId=" + courseId;

function retrieveAllSections(res) {
    var numSections = res.length;
    var sideNavHtml = document.getElementById('sideNav');
    var courseTabHtml = document.getElementsByTagName('title');
    var courseTitleHtml = document.getElementById("courseName");
    var materialHtml = document.getElementById("material");
    for (var i=0; i< numSections ;i++) {
        if (res[i].class_name[1] == setCourseClassId) {
            if(res[i].course_section_number == 1){
                var changeHtml = `
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle"
                        data-toggle="collapse" data-target="#sectionMaterials${res[i].course_section_number}" type="button" id="dropdownMenuButton"  aria-controls="sectionMaterials${res[i].course_section_number}" aria-expanded="false"  style="width:100%">Chapter ${res[i].course_section_number}
                        </button>
                        <div class="collapse" id="sectionMaterials${res[i].course_section_number}"  style="width:100%">
                            <a href="courseMaterial.html?courseId=${courseId}&courseClassId=${setCourseClassId}" class="text-white">Lesson ${res[i].course_section_number}</a>
                            <a href="engineerQuiz.html" class="text-white">Quiz ${res[i].course_section_number}</a>
                        </div>
                    </div>
                `;
            } else {
                if(materials[res[i].course_section_number].completion_status == "Completed" && quizProgress[res[i].course_section_number].completion_status == "Completed") {
                    var changeHtml = `
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle"
                            data-toggle="collapse" data-target="#sectionMaterials${res[i].course_section_number}" type="button" id="dropdownMenuButton"  aria-controls="sectionMaterials${res[i].course_section_number}" aria-expanded="false"  style="width:100%">Chapter ${res[i].course_section_number}
                            </button>
                            <div class="collapse" id="sectionMaterials${res[i].course_section_number}"  style="width:100%">
                                <a href="courseMaterial.html?courseId=${courseId}&courseClassId=${setCourseClassId}" class="text-white">Lesson ${res[i].course_section_number}</a>
                                <a href="engineerQuiz.html" class="text-white">Quiz ${res[i].course_section_number}</a>
                            </div>
                        </div>
                    `;
                } else {
                    var changeHtml = `
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle disabled"
                            data-toggle="collapse" data-target="#sectionMaterials${res[i].course_section_number}" type="button" id="dropdownMenuButton"  aria-controls="sectionMaterials${res[i].course_section_number}" aria-expanded="false"  style="width:100%">Chapter ${res[i].course_section_number}
                            </button>
                            <div class="collapse" id="sectionMaterials${res[i].course_section_number}"  style="width:100%">
                                <a href="courseMaterial.html?courseId=${courseId}&courseClassId=${setCourseClassId}" class="text-white">Lesson ${res[i].course_section_number}</a>
                                <a href="engineerQuiz.html" class="text-white">Quiz ${res[i].course_section_number}</a>
                            </div>
                        </div>
                    `;
                }
            }
            
            
            sideNavHtml.innerHTML += changeHtml;
            if (sessionStorage.getItem("retrievedCourseClassId") && res[i].course_section_number == sessionStorage.getItem("retrievedCourseClassId")){
                materialHtml.innerHTML += `
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2">Chapter ${res[i].course_section_number}: ${res[i].section_name}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>${materials[courseClassId].material_name}</td>
                                <td><a href="${materials[courseClassId].material_url}">URl</a></td>
                            </tr>
                        </tbody>
                    </table>
                `;
            }
            courseTabHtml[0].innerText = res[i].course_name;
            courseTitleHtml.innerText = res[i].course_name;
            

        }

    }
}


var enrolledUrl = "../LMS/backend/getEnrolledCourses.php?courseId" + courseId; 
var enrolled = {};
function retrieveAllEnrolled(res) {
    var numenrolledCourses = res.length;
    if (res) {
        for (var i=0; i< numenrolledCourses ;i++) {
            if (res[i].course_id == courseId) {
                enrolled[res[i].course_name] = {
                    "enrolled_course_id": res[i].completed_course_id,
                    "user_id": res[i].user_id,
                    "user_name": res[i].user_name,
                    "course_id": res[i].course_id,
                    "course_name": res[i].course_name,
                    "class_name": res[i].class_name
                }
                sessionStorage.setItem("setCourseClassId",res[i].class_name[1]);
                
            }
        }
    }
}
var setCourseClassId = sessionStorage.getItem('setCourseClassId');
var materialUrl = "../LMS/backend/getMaterials.php?courseId="+ courseId + "&courseClassId=" + setCourseClassId;
var materials = {};
function retrieveAllMaterials(res) {
    var numMaterials = res.length;
    if (res) {
        for (var i=0; i< numMaterials ;i++) {
            materials[res[i].section_id] = {
                "completion_status": res[i].completion_status,
                "course_class_id": res[i].course_class_id,
                "course_id": res[i].course_id,
                "material_name": res[i].material_name,
                "material_url": res[i].material_url
            }
        }
    }
}
var quizzesProgressUrl = "../LMS/backend/getQuizProgress.php?userId=" + userId + "&courseId="+ courseId + "&courseClassId=" + setCourseClassId + "&sectionId=1";
var quizProgress = {};

function retrieveQuizProgress(res) {
    var numQuizProgress = res.length;
    if (res) {
        for (var i=0; i< numQuizProgress ;i++) {
            quizProgress[res[i].section_id] = {
                "completion_status": res[i].completion_status,
                "course_class_id": res[i].course_class_id,
                "course_id": res[i].course_id,
                "section_id": res[i].section_id,
                "user_id": res[i].user_id
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

callToDb(sectionsUrl, retrieveAllSections)
callToDb(enrolledUrl, retrieveAllEnrolled)
callToDb(materialUrl, retrieveAllMaterials)
callToDb(quizzesProgressUrl, retrieveQuizProgress)
