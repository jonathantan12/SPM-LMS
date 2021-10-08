

//try changing the attribute for id="createOptions"
var quizIdArray=[];

var z=0
function createQuestionCard(){
    z++
    quizIdArray.push(z);
    var divTag=document.createElement('div');
    var t = "questionCard"+z;
    divTag.setAttribute("id",t);
    var form= document.createElement('form')
    divTag.appendChild(form)

    var div1= document.createElement('div')
    div1.className ="form-group row"
    form.appendChild(div1)

    var label= document.createElement('label')
    label.className="col-sm-2 col-form-label"
    var content1 =document.createTextNode("Question")
    label.appendChild(content1)
    div1.appendChild(label)

    var div2=document.createElement("div")
    div2.className="col-sm-8"
    div2.style="padding-right:0px"
    div1.appendChild(div2)

    var input1= document.createElement("input")
    input1.type="text"
    input1.className="form-control"
    input1.name="questions[]"
    input1.id="question"+z
    input1.placeholder="Question"
    div2.appendChild(input1)

    var select= document.createElement("select")
    select.className="col-sm-2"
    select.id="options"+z
    select.style="border:2px solid grey"
    div1.appendChild(select)

    var option =document.createElement("option")
    option.value=""
    var option1 =document.createElement("option")
    option1.value="2"
    var option1_2 =document.createTextNode("2")
    option1.appendChild(option1_2)
    var option2=document.createElement("option")
    option2.value="4"
    var option2_4 =document.createTextNode("4")
    option2.appendChild(option2_4)
    select.appendChild(option)
    select.appendChild(option1)
    select.appendChild(option2)

    document.getElementById("questionCard").appendChild(divTag)

    select.onchange = function(){addDiv(z);};
    

}
//create a div under question to put options
//put options under the created div
function addDiv(z){
    var z =z;
    var optionsCard= document.createElement("div")
    var ele="optionCard"+z
    optionsCard.id=ele
    theId="questionCard"+z
    document.getElementById(theId).appendChild(optionsCard)
    //console.log(theId)
    create(z)
}


function create(z){
    var selectedValue="options"+z
    var select = document.getElementById(selectedValue).value; //this is the number of options the user click
    var a= "optionCard"+z
    var co = document.getElementById(a)
    var str = '';
    for(var i = 0; i < select; i++) {

        str += `
        <div class="input-group mb-3" style="margin-top :2px">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="radio" name="answer`+z+`" aria-label="Radio for following text input">
                </div>
            </div>
            <input type="text" name="options[]" class="form-control" aria-label="Text input with radio">
        </div>
        `
    }
    co.innerHTML=str;
}



var questions=[];
function quizArray(){
    var questionArray=[];
    var optionsArray=[];
    var answerArray=[];
    var inputQuestion = document.getElementsByName('questions[]');
    for (var i = 0; i < inputQuestion.length; i++) {
        var a = inputQuestion[i];
        questionArray.push(a.value);
    };
    questions=questionArray;
    //console.log(questions);
    var inputOptions = document.getElementsByName('options[]');
    for (var i = 0; i < inputOptions.length; i++) {
        var b =inputOptions[i];
        optionsArray.push(b.value);
    }
    var inputAnswer = document.getElementsByName('answer'+z);
    for (var i = 0; i < inputAnswer.length; i++) {
        var c =inputAnswer[i];
        answerArray.push(c.value);
    }
    // console.log(questionArray);
    // console.log(optionsArray);
    // console.log(answerArray);
    addQuiz()

}




function addQuiz(){
    var arr=[];
    var q={};
    // var u={};
    q.quiz_id="1";
    q.section_id="1";
    q.question ="this is for section 1 quiz 1 question 1";
    q.question_type="tf";
    q.number_of_options= "2";
    q.correct_answer="True";
    arr.push(q);
    

    // u.quiz_id="question2,";
    // u.section_id="2";
    // u.question ="this is for section 2 quiz 2 question 1";
    // u.question_type="tf";
    // u.number_of_options= "2";
    // u.correct_answer="True";
    // arr.push(u);

    //console.log(arr);

    $.ajax({
        url:"backend/addQuiz.php",
        method:"post",
        data: {arr:JSON.stringify(arr)},
        success: function(res){
            console.log(res);
        }

    })

   
}




src="https://code.jquery.com/jquery-3.1.1.min.js"; 