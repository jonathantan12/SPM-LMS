function orderExist() {
    var request = new XMLHttpRequest()

    var order = document.getElementById("order").value
    var course_id = document.getElementById("course_id").value
    var ret=document.getElementById("orderExist")
    var details =  "course_id=" + course_id + "&order=" + order 
    var url = "backend/orderExist.php?" + details

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = this.responseText //string
            if (result == 'false') {
                ret.innerHTML = '*Order already exist!'
            } else(
                ret.innerHTML = ''
            )
        }
    }

    request.open("GET", url, true)
    request.send()

}

function createSection(){
    var section_title = document.getElementById("section_title").value
    var order = document.getElementById("order").value
    
}



function createQuestionCard(){
    var questionCard=document.getElementById("questionCard")
    var str=
    `
    <form>
        <div class="form-group row">
            <label for="quizTitle" class="col-sm-2 col-form-label">Question</label>
                <div class="col-sm-8" style="padding-right:0px">
                    <input type="text" class="form-control" id="Question" placeholder="Question">
                </div>
                <select class="col-sm-2" id="options" style="border: 2px solid grey; " onchange="createOptions()">
                    <option value=""></option>
                    <option value="2">2</option>
                    <option value="4">4</option>
                </select>
        </div>
    </form>
    <div id="createOptions"></div>
    `;
    questionCard.insertAdjacentHTML('afterbegin',str)

}

function createOptions(){
    var select = document.getElementById("options").value;
    var str = '';
    for(var i = 0; i < select; i++) {
    str += `
    <div class="input-group mb-3" style="margin-top :2px">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <input type="radio" name=" aria-label="Checkbox for following text input">
            </div>
        </div>
        <input type="text" class="form-control" aria-label="Text input with checkbox">
    </div>

    `
    document.getElementById("createOptions").innerHTML=str;

}
}

function store(obj){
    var courseId =obj.id;
    
}