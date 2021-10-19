// var numberOfQuestions = "";
// var quizTitle = "";
// var quizType ="";
// var ques = {};
// var numberOfOptions ={};
// var optionsContent ={};
// var correctAnswer ={};
function retrieveQuiz(qid){
    var arr = [];
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
                    input1.name = "questions[]"
                    input1.id = "question"+questionNo
                    input1.placeholder = "Question"
                    input1.value = ques
                    div2.appendChild(input1)

                    var select= document.createElement("select")
                    select.className = "col-sm-2"
                    select.id = "options"+questionNo
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
                        optionsCard.id = "optionCard"+questionNo
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
                        opInput.id ="editOpInput"+questionNo;
                        opInput.name = "editAnswer"+questionNo;
                        opInput.value =y;
                        opDiv3.appendChild(opInput);

                        var opInput2 = document.createElement("input");
                        opInput2.type ="text";
                        opInput2.name = "editOptions[]";
                        opInput2.className = "form-control";
                        opInput2.value = optionsContent[y];
                        opDiv1.appendChild(opInput2);
                        
                    }
                    console.log(optionsContent);
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


