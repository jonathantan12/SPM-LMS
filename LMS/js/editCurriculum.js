function retrieveQuiz(qid){
    //retrieve quiz base on course_id, course_class_id, section_id,quiz_id
    //then find out how many question
    //then get by question number 
    //then insert into form values
    //then edit 
    //then save , update database, not create new
    var arr = [];
    var cid = "2"; //hard code, this is course id, if you want to change the id , just change here
    var ccid = "1";// this is the class number for each course
    var sid = "1"; //hard code
    var quizid = qid ;
    arr.push(cid, ccid, sid, quizid)

    $.ajax({
        url:"backend/getQuizzes.php",
        method:"post",
        data: {arr:JSON.stringify(arr)},
        success: function(res){
                arrayQuiz = JSON.parse(res);
                numberOfQuestions = arrayQuiz.length
                for (i = 0; i < numberOfQuestions; i++){
                    var quizDict = arrayQuiz[i]
                    var quizTitle = quizDict["quiz_title"]
                    var quizType = quizDict["quiz_type"]
                    var questionNo = quizDict["question_no"]
                    var ques = quizDict["question"]
                    var numberOfOptions = quizDict["number_of_options"]
                    var optionsContent = quizDict["options_content"]
                    var correctAnswer = quizDict["correct_answer"]

                   
                                    


                    console.log(quizTitle)
                }
                //console.log(arrayQuiz);
                //dictQuiz =arrayQuiz[0]

            
              }
        
    })
    
}

<!-- Create Quiz Edit Modal -->
        <div class="modal fade" id="editQuiz" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="addSection">Edit Quiz</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="quizForm">
                        <div class="form-group row">
                          <label for="quizTitle" class="col-sm-2 col-form-label">Title</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="quizTitle" placeholder="Quiz Title" >
                          </div>
                        </div>
                        <fieldset class="form-group">
                          <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Type</legend>
                            <div class="col-sm-10">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="quizType" id="graded" value="graded">
                                <label class="form-check-label" for="gridRadios1">
                                  Graded
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="quizType" id="ungraded" value="ungraded">
                                <label class="form-check-label" for="gridRadios2">
                                    Ungraded
                                </label>
                              </div>
                            </div>
                          </div>
                        </fieldset>
                        <div id="questionCard"></div>
                        
                        <button type="button" id="card" class="btn btn-primary btn-small" style="float: left; margin: 5px;" onclick="createQuestionCard()"> + Add New Question</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                    <button type="button" class="btn btn-primary" id="quizArray" onclick="quizArray()" data-dismiss="modal">Save</button>
                </div>
            </div>
            </div>
        </div>
