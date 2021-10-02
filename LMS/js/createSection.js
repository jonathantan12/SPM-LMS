function orderExist() {
    var request = new XMLHttpRequest()

    var order = document.getElementById("order").value
    var ret = document.getElementById("course_id").value
    var details =  "course_id=" + course_id + ",order=" + order 
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

