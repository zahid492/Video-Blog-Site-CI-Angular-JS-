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