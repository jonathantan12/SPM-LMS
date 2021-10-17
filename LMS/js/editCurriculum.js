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
            console.log(res);
            
              }
        
    })
    
}