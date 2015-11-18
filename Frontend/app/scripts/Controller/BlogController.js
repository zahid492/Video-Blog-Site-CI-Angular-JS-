app.controller('BlogController', ['$scope', 'BlogService','CommentService','$routeParams', '$location','$sce', function ($scope, BlogService,CommentService, $routeParams, $location,$sce) {


 //////////////SAVE POST INTO DB//////////////////////////////

    $scope.save = function() {

    $scope.loading=true;
    var myArray = ['Zahid Rahman','Partha Chaqraborti','Shuvro Devntah'];

     $scope.dummyname = myArray[Math.floor(Math.random() * myArray.length)];
    
    if($scope.dummyname=='Zahid Rahman'){
        $scope.dummyimage='images/5(3).png';

    }
    else
    {
        if($scope.dummyname=='Partha Chaqraborti'){
            $scope.dummyimage='images/5(4).png'
        }

    else{
        $scope.dummyimage='images/5(5).png';
    }
}
        
        var postInformations = {
            id: "",
            dummyname: $scope.dummyname,
            dummyimage: $scope.dummyimage,
            message_about: $scope.message_about,
            message_type:'Plain_Text',
            create_date:'2015-11-15 06:47:24'
        };
            var promisePost = BlogService.put(postInformations);
            //console.log(postInformations);
            promisePost.then(function(response) {
                $scope.message = response.data.message;

                $scope.loading = false;
               // console.log(response.data);
                $scope.message_about=null;
                $scope.getallpost();

                $scope.getallcomment();
            }, function(err) {

                 $scope.loading=false;
                //console.log($scope.ErrorMessage);
                console.log(err);
                //console.log(err.data['odata.error'].innererror.message['basic_Information.Phone']);
            });
        }


 //////////////SAVE Comment INTO DB//////////////////////////////
$scope.commentsaveintodb = function($comment,$id) {
    
$scope.loading_comment=true;
$scope.comment_about=$comment;
$scope.postid=$id;
    var myArray = ['Zahid Rahman','Partha Chaqraborti','Shuvro Devntah'];

     $scope.dummyname = myArray[Math.floor(Math.random() * myArray.length)];
    
    if($scope.dummyname=='Zahid Rahman'){
        $scope.dummyimage='images/5(3).png';

    }
    else
    {
        if($scope.dummyname=='Partha Chaqraborti'){
            $scope.dummyimage='images/5(4).png'
        }

    else{
        $scope.dummyimage='images/5(5).png';
    }
}

        
        var commentInformations = {
            id: "",
            post_id:$scope.postid,
            dummyname: $scope.dummyname,
            dummyimage: $scope.dummyimage,
            comment_about: $scope.comment_about,
            comment_type:'Plain_Text',
            create_date:'2015-11-15 06:47:24'
        };

        //console.log(commentInformations);
            var promisePost = CommentService.put(commentInformations,$scope.postid);
            //console.log(commentInformations);
            promisePost.then(function(response) {
                $scope.message = response.data.message;
               // console.log(response.data);
                $scope.comment_about=null;
                $scope.loading_comment=false;
                

                $scope.getallcomment();
            }, function(err) {

               $scope.loading_comment=false;
              //  console.log($scope.ErrorMessage);
                console.log(err);
                //console.log(err.data['odata.error'].innererror.message['basic_Information.Phone']);
            });
}






////////////////////////GET ALL POST IN DB////////////////////



    $scope.getallpost = function () {

            var promiseGetSingle = BlogService.getallpost();
        promiseGetSingle.then(function (response) {
            var responseData = response.data;
             //console.log(responseData);
             $scope.blogpost=responseData.message;
             $scope.totalpost=responseData.count[0].blogpost_total;
          
              //console.log($scope.totalpost);
             // console.log($scope.blogpost);



        },
            function (error) {
                console.log('Failure loading Information', error);
            });


    }

    $scope.getallpost();


    /////////////////////GET ALL COMMENT INTO DB////////////
    
    $scope.getallcomment = function () {
        var promiseGetSingle = CommentService.getallcomment();
        promiseGetSingle.then(function (response) {
            var responseData = response.data;
             $scope.blogcomment=responseData.message;
              //console.log($scope.blogcomment);



        },
            function (error) {
                //console.log('Failure loading Information', error);
            });
    }

    $scope.getallcomment();

}]);







