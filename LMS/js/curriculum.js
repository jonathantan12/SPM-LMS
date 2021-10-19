

var quizTitle = "";
var quizType = "";
var cid = "2"; //hard code, this is course id, if you want to change the id , just change here
var ccid = "1";// this is the class number for each course
var sid = "1"; //hard code
var qid = "1"; //quiz_id for now is always 1,hard code
var qno = [];//question_no in arr
var que = {};// {1:"this i question 1", 2: "this is question 2"}
var numOp = {}; //{1:"2",2:"4"}
var optionContent = {} //{1:[a,b],2:[a,b,c,d]}
var answerArray = {}; // gives the position of the correct answer, so for example in question 1 there is 2 options, if second option is correct, it will return 1


var originalState = $("#quizForm").html();

var z = 0
function createQuestionCard(){
    z++
    qno.push(z);
    // console.log(qno);
    var divTag=document.createElement('div');
    var t = "questionCard"+z;
    divTag.setAttribute("id",t);
    var form = document.createElement('form')
    form.id = "questionForm"+z
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
    input1.id = "question"+z
    input1.placeholder = "Question"
    div2.appendChild(input1)

    var select= document.createElement("select")
    select.className = "col-sm-2"
    select.id = "options"+z
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

    document.getElementById("questionCard").appendChild(divTag)

    select.onchange = function(){addDiv(z);};
    

}
//create a div under question to put options
//put options under the created div
function addDiv(z){
    var optionsCard = document.createElement("div")
    var ele = "optionCard"+z
    optionsCard.id=ele
    theId = "questionCard"+z
    //console.log(optionsCard);
    document.getElementById(theId).appendChild(optionsCard)
    create(z)
}


function create(z){
    var selectedValue = "options"+z
    var select = document.getElementById(selectedValue).value; //this is the number of options the user click
    numOp[z] = select;
    // console.log(numOp);
    var a = "optionCard"+z
    var co = document.getElementById(a)
    var str = '';
    for(var i = 0; i < select; i++) {
        str += `
        <div class="input-group mb-3" style="margin-top :2px">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="radio" id="`+z+i+`" name="answer`+z+`" value ="` +i+ `"aria-label="Radio for following text input">
                </div>
            </div>
            <input type="text" name="options[]" class="form-control" aria-label="Text input with radio">
        </div>
        `
    }
    co.innerHTML = str;
}


function quizArray(){
    quizTitle = document.getElementById("quizTitle").value;
    var type = document.getElementsByName("quizType");
    for(i = 0; i < type.length; i++) {
        if(type[i].checked){
            quizType = type[i].value;
        }
    }
    
    var optionsArray = [];
    var inputOptions = document.getElementsByName('options[]');
    for (var i = 0; i < inputOptions.length; i++) {
        var b = inputOptions[i];
        optionsArray.push(b.value);
    }
    // console.log(optionsArray);


    for (var i = 1; i < z+1; i++){ // go to each question
        var questionContentId = "question"+i;
        que[i] = document.getElementById(questionContentId).value; //need create dict
        var o = numOp[i]; //number of options for each question 
        optionContent[i] = optionsArray.splice(0,o);
        
    }
    
    for (var i = 1; i < z+1; i++){
        var a = i;
        aStr = a.toString();
        for (var x  =0; x < numOp[i] ;x++){
            var b = x;
            var bStr = b.toString();
            var zi = aStr+bStr;
            // console.log(zi);
            if (document.getElementById(zi).checked){
                answerArray[i] = x;
            }
        }
        
    }
   
    document.getElementById("quizForm").reset();
    $("#quizForm").html(originalState);
    addQuiz();
}




function addQuiz(){
    var arr = [];
    for (i = 0; i < qno.length; i++){
        var q = {};
        q.course_id = cid;
        q.course_class_id = ccid;
        q.section_id = sid;
        q.quiz_id = qid;
        q.quiz_title = quizTitle;
        q.quiz_type = quizType;
        var question_number = qno[i];
        q.question_no = question_number;
        q.question = que[question_number];
        q.number_of_options = numOp[question_number];
        q.options_content = optionContent[question_number];
        var posAns = answerArray[question_number];
        q.correct_answer = optionContent[question_number][posAns];
        arr.push(q);
    }
    //console.log(arr);

    $.ajax({
        url:"backend/addQuiz.php",
        method:"post",
        data: {arr:JSON.stringify(arr)},
        success: function(res){
            console.log(res);
            if (res.slice(-1) == 1){
                alert("Your Quiz has been saved!");
                var quizHere= document.getElementById("quizHere");
                var div1 = document.createElement("div");
                div1.className = "card";
                div1.style = "width:full; padding-left: 5px;";
                div1.id = "qid"+qid;
                quizHere.appendChild(div1);

                var div2 = document.createElement("div");
                var bold = document.createElement("b");
                var qTitle = document.createTextNode("Quiz: "+quizTitle);
                bold.appendChild(qTitle);
                div2.appendChild(bold);
                div1.appendChild(div2);

                var button1 = document.createElement("button");
                button1.type = "button";
                button1.className = "btn btn-danger btn-small";
                button1.style = "float: right"
                var content1 = document.createTextNode("Delete")
                button1.appendChild(content1);
                div2.appendChild(button1);

                var button2 = document.createElement("button");
                button2.type = "button";
                button2.className = "btn btn-primary btn-small";
                button2.style = "float: right"
                button2.id = "button"+qid;
                console.log(button2.id);
                button2.dataset.toggle = "modal";
                button2.dataset.target = "#editQuiz";
                var content2 = document.createTextNode("Edit")
                button2.appendChild(content2);
                div2.appendChild(button2);
                
                button2.onclick = function(){retrieveQuiz(qid-1);};
                //still need to do window storage...
                // var modalDiv= document.createElement("div");
                // modalDiv.id = "editQuiz"+qid;
                // modalDiv.className = "modal fade";
                // modalDiv.tabIndex = "-1";
                // modalDiv.role = "dialog";
                // document.body.appendChild(modalDiv)

                // var modalDiv2 = document.createElement("div");
                // modalDiv2.className = "modal-dialog";
                // modalDiv2.role = "document"
                // modalDiv.appendChild(modalDiv2);
                // document.body.appendChild(modalDiv)

                // var modalDiv3 = document.createElement("div");
                // modalDiv3.className = "modal-content";
                // modalDiv.appendChild(modalDiv3)

                // var modalDiv4 = document.createElement("div");
                // modalDiv4.className("modal-header");
                // modalDiv3.appendChild(modalDiv4);

                // var modalDiv5 = document.createElement("h5");
                // modalDiv5.className = "modal-title"
                // var modalContent1 = document.createTextNode("Edit Quiz");
                // modalDiv5.appendChild(modalContent1);
                // modalDiv3.appendChild(modalDiv5);

                // var modalButton1 = document.createElement("button");
                // modalButton1.className ="close";
                // modalButton1.dataset.dismiss = "modal";
                // modalDiv3.appendChild(modalButton1);

                // var modalDiv6 = document.createElement("span");
                // modalDiv6.ariaHidden = "true";
                // var modalContent2 = document.createTextNode("&times;");
                // modalDiv6.appendChild(modalContent2)
                // modalButton1.appendChild(modalDiv6);

                // var modalDiv7 = 

                
            
                
            } else{
                alert("You have not entered the required fields correctly");
            }

            quizTitle = "";
            quizType = "";
            cid = "2"; //hard code, this is course id, if you want to change the id , just change here
            ccid = "1";// this is the class number for each course
            sid = "1"; //hard code
            qid = parseInt(qid)+1 //quiz_id for now is always 1,hard code
            qid = qid.toString();
            qno = [];//question_no in arr
            que = {};// {1:"this i question 1", 2: "this is question 2"}
            numOp = {}; //{1:"2",2:"4"}
            optionContent = {} //{1:[a,b],2:[a,b,c,d]}
            answerArray = {};
            z=0;
        }

    })

   
}








src="https://code.jquery.com/jquery-3.1.1.min.js"; 