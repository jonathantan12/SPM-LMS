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
            var numberOfQuestions = arrayQuiz.length
            for(var i = 0; i < numberOfQuestions; i++) {
                var quizDict = arrayQuiz[i]
                var quizTitle = quizDict["quiz_title"]
                quizType = quizDict["quiz_type"]
                console.log(quizType);
                document.getElementById("quizType").innerHTML = "<p><h2>"+quizTitle+"</h2></p>This is a "+quizType+" quiz. <p>Please re-Attempt the quiz till you pass.</p>"
               
            }
        }
    })
}


var answers={};
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
            var numberOfQuestions = arrayQuiz.length
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
                answers[i+1]=correctAnswer
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

            myTimer(numberOfQuestions);
        }
    })
}


function checkAns(){
    //console.log(answers);
    var inputAns = {};
    var score = 0;
    var res = "";
    for (var a=0; a < Object.keys(answers).length; a++){
        var ans = document.getElementsByName('option'+(a+1));
        //console.log(ans);
        for (var b=0; b<ans.length; b++) {
            if (ans[b].checked == true) {
                inputAns[a+1]=ans[b].getAttribute('value') ;
            }
        }
    }
    var score = 0;
    var res = "";
    for (var c=0; c < Object.keys(answers).length; c++){
        if (typeof(inputAns[c+1]) == "undefined"){
            inputAns[c+1] = "undefinedAnswer"
        }
        if (inputAns[c+1] == answers[c+1]){
            score+=1
        }
    }
    if (score/Object.keys(answers).length >= 0.8){
        res = "Passed";
        passTest()

    }else{
        res ="Failed";
        if (quizType == "ungraded"){
            passTest()
        };
    }
    
    document.getElementById("score").innerHTML = "Your score is <b>"+score+"/"+Object.keys(answers).length+"</b> .<br> You have <b>"+res+"</b> the test."
}


function retry(){
    location.reload();
}

function passTest(){
    addArr.pop();
    var userId = "1";
    addArr.splice(0, 0, userId);
    var completionStatus ="Completed";
    addArr.push(completionStatus);
    //console.log(addArr);

    $.ajax({
        url:"backend/updateQuizProgress.php",
        method:"post",
        data: {arr:JSON.stringify(addArr)},
        success: function(res){
            //console.log(res);
        }
    });

}


var myTime = null;
function myTimer(q){
    myTime = setTimeout(timer, 5000*q);
    var current = new Date().getTime();
    var countDownDate = new Date(current + q*5000);
    // Update the count down every 1 second
    var x = setInterval(function() {
        var now = new Date().getTime();
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // Output the result in an element with id="demo"
        document.getElementById("countdown").innerHTML = hours + "h "
        + minutes + "m " + seconds + "s ";
            
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "Time's Up";
        }
    }, 1000);

    
}

function stopTimer(){
    clearTimeout(myTime)
}
function timer(){
    alert ("time is up") ;
    document.getElementById("resButton").click();
    
}