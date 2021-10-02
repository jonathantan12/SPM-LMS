function retrieveCourses() {
    var request = new XMLHttpRequest()

    var url = "course_catalogue.php"

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = JSON.parse(this.responseText);
            if (result) {
                console.log(result)
                // var coursesAvailable = document.getElementById("courses_available");
                // for (course in coursesAvailable) {
                //     var changeHTML =    `
                //     <div class="col-4">
                //         <div class="card" style="width: 20rem;">
                //         <a href="#"><img src="images/placeholder_img.png" class="card-img-top" alt="..."></a>
                //             <div class="card-body">
                //                 <h5 class="card-title text-center" >${}</h5>
                //                 <p class="card-text">Class size: <span>40/45</span></p>
                //                 <button type="button" class="btn btn-outline-success">Enrol</button>
                //             </div>
                //         </div>
                //     </div>   
                //     <div class='col-lg-4'>
                //                             <div class='card mb-4 shadow-sm'>
                //                                     <img src="${menutypes[menutype]}" width="225px" height="225px" background="#55595c" color="#eceeef" class="card-img-top" text="Thumbnail" >
                //                                     <div class="card-body text-center">
                //                                         <a href="${menutypes[menutype]}" class="btn btn-warning stretched-link" style="margin-top: 10px;">${menutype} Menu</a>
                //                                     </div>
                //                                 </div>
                //                         </div>`;
                                        
                //     menuCards.innerHTML += changeHTML;
                //}
            }
        }
    }

    request.open("GET", url, true)
    request.send()
}