// var numberOfQuestions = "";
// var quizTitle = "";
// var quizType ="";
// var ques = {};
// var numberOfOptions ={};
// var optionsContent ={};
// var correctAnswer ={};
var arr = []; //cid, ccid, sid, quizid
function retrieveQuiz(qid){
    var cid = "2"; //hard code, this is course id, if you want to change the id , just change here
    var ccid = "1";// this is the class number for each course
    var sid = "1"; //hard code
    var quizid = qid ;
    arr.push(cid, ccid, sid, quizid);
    $.ajax({
        url:"backend/getQuizzes.php",
        method:"post",
        data: {arr:JSON.stringify(arr)},
        success: function(res){
                var arrayQuiz = JSON.parse(res);
                var numberOfQuestions = arrayQuiz.length
                console.log(numberOfQuestions);
                for(var i = 0; i < numberOfQuestions; i++) {
                    var quizDict = arrayQuiz[i]
                    var quizTitle = quizDict["quiz_title"]
                    var quizType = quizDict["quiz_type"]
                    var questionNo = quizDict["question_no"]
                    var ques = quizDict["question"]
                    var numberOfOptions = quizDict["number_of_options"]
                    var optionsContent = quizDict["options_content"]
                    optionsContent = optionsContent.slice(1, -2);
                    optionsContent = optionsContent.replace(/['"]+/g, '');
                    optionsContent = optionsContent.split(",");

                    var correctAnswer = quizDict["correct_answer"]
                    var caPos = optionsContent.indexOf(correctAnswer)
                   

                    document.getElementById('editQuizTitle').value = quizTitle;
                    var quizTypeEle = document.getElementsByName('editQuizType');

                    for (var x=0; x<quizTypeEle.length; x++) {
                        if (quizTypeEle[x].getAttribute('value') == quizType) {
                          quizTypeEle[x].checked = true;
                        }
                    }
                    var divTag = document.createElement('div');
                    divTag.id = "editQuestionCard"+questionNo;
                    document.getElementById("editQuestionCard").appendChild(divTag);

                    var form = document.createElement('form')
                    form.id = "questionForm"+questionNo
                    divTag.appendChild(form)

                    var div1 = document.createElement('div')
                    div1.className ="form-group row"
                    form.appendChild(div1)

                    var label = document.createElement('label')
                    label.className = "col-sm-2 col-form-label"
                    var content1 = document.createTextNode("Question")
                    label.appendChild(content1)
                    div1.appendChild(label)

                    var div2=document.createElement("div")
                    div2.className="col-sm-8"
                    div2.style = "padding-right:0px"
                    div1.appendChild(div2)

                    var input1 = document.createElement("input")
                    input1.type = "text"
                    input1.className = "form-control"
                    input1.name = "editedQuestions[]"
                    input1.id = "question"+questionNo
                    input1.placeholder = "Question"
                    input1.value = ques
                    div2.appendChild(input1)

                    var select= document.createElement("select")
                    select.className = "col-sm-2"
                    select.id = "editedOptions"+questionNo
                    select.style = "border:2px solid grey"
                    div1.appendChild(select)

                    var option = document.createElement("option")
                    option.value = ""
                    var option1 = document.createElement("option")
                    option1.value = "2"
                    var option1_2 = document.createTextNode("2")
                    option1.appendChild(option1_2)
                    var option2 = document.createElement("option")
                    option2.value = "4"
                    var option2_4 = document.createTextNode("4")
                    option2.appendChild(option2_4)
                    select.appendChild(option)
                    select.appendChild(option1)
                    select.appendChild(option2)
                    select.value = numberOfOptions
                    
                    for (var y = 0; y<numberOfOptions ;y++){
                        var optionsCard = document.createElement("div")
                        optionsCard.id = "editedOptionCard"+questionNo
                        divTag.appendChild(optionsCard);

                        var opDiv1 = document.createElement("div");
                        opDiv1.className = "input-group mb-3";
                        opDiv1.style = "margin-top :2px";
                        optionsCard.appendChild(opDiv1);

                        var opDiv2 = document.createElement("div");
                        opDiv2.className = "input-group-prepend";
                        opDiv1.appendChild(opDiv2);

                        var opDiv3 = document.createElement("div");
                        opDiv3.className = "input-group-text";
                        opDiv2.appendChild(opDiv3);

                        var opInput = document.createElement("input");
                        opInput.type = "radio";
                        opInput.id ="editOpInput"+ questionNo + y.toString();
                        opInput.name = "editAnswer"+questionNo ;
                        opInput.value =y;
                        opDiv3.appendChild(opInput);

                        var opInput2 = document.createElement("input");
                        opInput2.type ="text";
                        opInput2.name = "editedOptions[]";
                        opInput2.className = "form-control";
                        opInput2.value = optionsContent[y];
                        opDiv1.appendChild(opInput2);
                        
                    }
                    //console.log(optionsContent);
                    var opRadioEle = document.getElementsByName('editAnswer'+questionNo);
                    for (var z=0; z<opRadioEle.length; z++) {
                        if (opRadioEle[z].getAttribute('value') == caPos) {
                          opRadioEle[z].checked = true;
                        }
                    }
                    
                }
        }
    })
   
}
var editedTitle = "";
var editedQuizType = "";
var editedQuestionsArray = []; //contains all edited questions
var editedQuestionsDict = {};
var editedNumberOfOptions = {};
var editedOptionsArray = [];
var editedOptionsDict ={};
var editedCaPosDict ={};


function editQuizArray(){
    editedTitle =  document.getElementById('editQuizTitle').value;
    //console.log(editedTitle);
    var editedQuizTypeEle = document.getElementsByName('editQuizType');
    for (var x=0; x<editedQuizTypeEle.length; x++) {
        if (editedQuizTypeEle[x].checked == true) {
            editedQuizType = editedQuizTypeEle[x].getAttribute('value') 
        }
    }
    //console.log(editedQuizType);
    
    var editedQuestions = document.getElementsByName('editedQuestions[]');
    for (var i = 0; i < editedQuestions.length; i++) {
        var b = editedQuestions[i];
        editedQuestionsArray.push(b.value);
    }

    //console.log(editedQuestionsArray);

    for (var x = 0; x < editedQuestionsArray.length; x++){
        editedQuestionsDict[x+1] = editedQuestionsArray[x];
        var select = document.getElementById("editedOptions"+(x+1));
        console.log(select);
        editedNumberOfOptions[x+1] = select.options[select.selectedIndex].value;
    }
    console.log(editedNumberOfOptions);

    var editedInputOptions = document.getElementsByName('editedOptions[]');
    for (var y = 0; y < editedInputOptions.length; y++) {
        var c = editedInputOptions[y];
        editedOptionsArray.push(c.value);
    }
    console.log(editedOptionsArray);

    for (var z = 1; z < editedQuestionsArray.length +1; z++ ){
        var enoo = editedNumberOfOptions[z];
        editedOptionsDict[z] = editedOptionsArray.splice(0, enoo);
        console.log(editedOptionsDict);
        var editedOpRadioEle = document.getElementsByName('editAnswer'+z);
        for (var j=0; j<editedNumberOfOptions[z]; j++)
            if (document.getElementById("editOpInput"+z+j).checked){
                editedCaPosDict[z] = j;
            }
    }
    console.log(editedCaPosDict);
    deleteQuiz();
    addEditedQuiz();

}

function deleteQuiz(){
    $.ajax({
        url:"backend/deleteQuiz.php",
        method:"post",
        data: {arr:JSON.stringify(arr)},
        success: function(res){
            console.log(res);
        }
    })
}

var arr = []; //cid, ccid, sid, quizid
function addEditedQuiz(){
    var editedArr = [];
    for (i = 0; i < editedQuestionsArray.length; i++){
        var q = {};
        q.course_id = arr[0];
        q.course_class_id = arr[1];
        q.section_id = arr[2];
        q.quiz_id = arr[3];
        q.quiz_title = editedTitle;
        q.quiz_type = editedQuizType;
        var question_number = i+1;
        q.question_no = question_number;
        q.question = editedQuestionsDict[question_number];
        q.number_of_options = editedNumberOfOptions[question_number];
        q.options_content = editedOptionsDict[question_number];
        var posAns = editedCaPosDict[question_number];
        q.correct_answer = editedOptionsDict[question_number][posAns];
        editedArr.push(q);
    }
    //console.log(arr);

    $.ajax({
        url:"backend/addQuiz.php",
        method:"post",
        data: {arr:JSON.stringify(editedArr)},
        success: function(res){
            console.log(res);
        }
    })
}