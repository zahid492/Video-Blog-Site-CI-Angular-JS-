app.service('BlogService', function ($http, domain) {
    //Create new record
  


    this.put = function (postInformations) {
        var request = $http({
            method: "put",
            url: domain +"/blogpostapi/blogpost/",
            data: postInformations
        });
        return request;
    }



    //Get Single Records
    this.getallpost = function (Id) {
        return $http.get(domain + "/blogpostapi/blogpost/");
    }


    


 


});


app.service('CommentService', function ($http, domain) {
    //Create new record
  

    this.getallcomment = function (Id) {
        return $http.get(domain + "/blogcommentapi/blogcomment");
    }

   this.put = function (commentInformations,postid) {
        var request = $http({
            method: "put",
            url: domain +"/blogcommentapi/blogcomment/"+postid,
            data: commentInformations
        });
        return request;
    }

});
