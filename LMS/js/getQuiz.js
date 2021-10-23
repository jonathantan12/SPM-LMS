var quizType = "";
function getQuiz(cid,ccid,sid,quizId){
    var arr =[];
    arr.push(cid, ccid, sid, quizId);
    $.ajax({
        url:"backend/getQuizzes.php",
        method:"post",
        data: {arr:JSON.stringify(arr)},
        success: function(res){
            var arrayQuiz = JSON.parse(res);
            numberOfQuestions = arrayQuiz.length
            for(var i = 0; i < numberOfQuestions; i++) {
                var quizDict = arrayQuiz[i]
                var quizTitle = quizDict["quiz_title"]
                quizType = quizDict["quiz_type"]
                document.getElementById("quizType").innerHTML = "<p><h2>"+quizTitle+"</h2></p>This is a "+quizType+" quiz. <p>Please re-Attempt the quiz till you pass.</p>"
               
            }
        }
    })
}

var answers=[];
var addArr =[];
function getQuestions(cid,ccid,sid,quizId){
    var arr=[];
    arr.push(cid, ccid, sid, quizId);
    addArr.push(cid, ccid, sid, quizId)
    $.ajax({
        url:"backend/getQuizzes.php",
        method:"post",
        data: {arr:JSON.stringify(arr)},
        success: function(res){
            var arrayQuiz = JSON.parse(res);
            numberOfQuestions = arrayQuiz.length
            for(var i = 0; i < numberOfQuestions; i++) {
                var quizDict = arrayQuiz[i]
                quizType = quizDict["quiz_type"]
                var ques = quizDict["question"]
                var numberOfOptions = quizDict["number_of_options"]
                var optionsContent = quizDict["options_content"]
                optionsContent = optionsContent.slice(1, -2);
                optionsContent = optionsContent.replace(/['"]+/g, '');
                optionsContent = optionsContent.split(",");
                var correctAnswer = quizDict["correct_answer"]
                answers.push(correctAnswer)
                var caPos = optionsContent.indexOf(correctAnswer)

                var div1 = document.createElement("h5")
                div1.id = "Question "+(i+1)
                div1.style = "padding-left: 20px"
                var content1 = document.createTextNode(div1.id)
                div1.appendChild(content1)
                document.getElementById("quizQuestions").appendChild(div1)

                var div2 = document.createElement("form")
                div2.id = "quizForm"+(i+1)
                var p1 = document.createElement("p")
                var content2 = document.createTextNode(ques)
                p1.style = "font-family: Arial, Helvetica, sans-serif; color: blue;"
                p1.appendChild(content2)
                div2.appendChild(p1)
                div1.appendChild(div2)
                for (var y =0; y<numberOfOptions; y++){
                    var input = document.createElement("input")
                    input.type = "radio"
                    input.name = "option"+(i+1)
                    input.value = optionsContent[y]
                    div1.appendChild(input)
                    var lab = document.createElement("label")
                    lab.for = optionsContent[y]
                    var content3 = document.createTextNode(optionsContent[y])
                    lab.appendChild(content3)
                    div1.appendChild(lab)
                    var br = document.createElement("br")
                    div1.appendChild(br)
                }


            }
            var sub = document.createElement("button")
            sub.id = "resButton"
            sub.style = "margin-left: 20px"
            sub.className="btn btn-primary"
            var subContent =document.createTextNode("Submit")
            sub.appendChild(subContent)
            document.getElementById("quizQuestions").appendChild(sub)
            sub.dataset.toggle = "modal";
            sub.dataset.target = "#result";
            sub.onclick = function(){checkAns(); stopTimer();};
        }
    })
}


function checkAns(){
    var inputAns = [];
    var score = 0;
    var res = "";
    for (var a=0; a < answers.length; a++){
        var ans = document.getElementsByName('option'+(a+1));
        for (var b=0; b<ans.length; b++) {
            if (ans[b].checked == true) {
                inputAns.push(ans[b].getAttribute('value') )
            }
        }
    }
    var score = 0;
    var res = "";
    
    for (var c=0; c < inputAns.length; c++){
        console.log(inputAns[c]);
        console.log(answers[c]);
        if (inputAns[c] == answers[c]){
            score+=1
        }
    }
    if (score/answers.length >= 0.8){
        res = "Passed";
        if (quizType == "graded"){
            passTest()
        };

    }else{
        res ="Failed";
    }
    document.getElementById("score").innerHTML = "Your score is <b>"+score+"/"+answers.length+"</b> .<br> You have <b>"+res+"</b> the test."
}


function retry(){
    location.reload();
}

function passTest(){
    console.log("I will add this to database")
    

}
var myTime = null;
function myTimer(){
    myTime = setTimeout(timer, 5000);
}

function stopTimer(){
    clearTimeout(myTime)
}
function timer(){
    alert ("time is up") ;
    document.getElementById("resButton").click();
    
}