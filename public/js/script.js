$(document).ready(function () {

    
    $("input[name=searchBoxPosts]").keypress(function (e) {

        // Save search container initial state. 
        var searchContainerHtml = $('#searchContainer').html();
        
        // User pressed enter
        if (e.which == 13) {
            
            // Get the user search string
            var formData = {
                searchTerm: $("input[name=searchBoxPosts]").val(),
            }

            // Remove old results
            $("#searchContainer").empty();

            // Use this else the server responds with error status code 419
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();

            // Execute ajax request
            $.ajax({
                type: 'POST',
                url: 'searchposts',
                data: formData,
                dataType: 'html',

                // If request is successfull
                success: function (data) {

                    // Check if controller returned no data
                    if (data != 0) {
                        // Insert rendered data to div component
                        $("#searchContainer").html(data);

                    } else {
                        $("#searchContainer").append("No results");
                    }
                },

                // If request was not successfull
                error: function (data) {
                    console.log(data);
                }
            });
        } // User pressed enter
    });

    // When user press enter
    $("input[name=searchBoxMessages]").keypress(function (e) {
        
        // Save search container initial state. 
        var searchContainerHtml = $('#searchContainer').html();
        
        // User pressed enter
        if (e.which == 13) {
            
            // Get the user search string
            var formData = {
                searchTerm: $("input[name=searchBoxMessages]").val(),
            }

            // User did not type anything
            if (formData['searchTerm'] !== ""){
            
                // Remove old results
                $("#searchResponse").empty();

                // Show hidden panel
                $('#searchContainer').show();

                // Use this else 419 error status code
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                e.preventDefault();

                // Execute ajax request
                $.ajax({
                    type: 'POST',
                    url: 'searchmessages',
                    data: formData,
                    dataType: 'html',

                    // If request is successfull
                    success: function (data) {

                        // Check if controller returned no data
                        if (data != 0) {
                            // Insert rendered data to div component
                            $("#searchResponse").html(data);

                        } else {
                            $("#searchResponse").append("No results");
                        }
                    },

                    // If request was not successfull
                    error: function (data) {
                        console.log(data);
                    }
                });
            } else { //formData is empty("")
                
                // Use saved html to reverse to initial state of view
                $('#searchContainer').html(searchContainerHtml);
                
            }
        }
    });
});

/*
 * postID: ID of post
 * userID: ID of user
 * task: Upvote or Downvote
 */
function upvote(postID, userID, task){
    console.log('task: ' + task);

    var formData = {
        postID: postID,
        userID: userID,
        task: 'upvote'
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    // Execute ajax request
    $.ajax({
        type: 'POST',
        url: 'votes',
        data: formData,
        dataType: 'json',
        
        // If request is successfull
        success: function (data) {
            // Check if controller returned no data
            if (data == 'hasupvoted'){
                console.log('hasupvoted')
            } else if (data == 'hasdownvoted'){
                console.log('hasdownvoted')
            } else if (data == 'error'){
                console.log('error');
            } else {
                console.log('Success');
                console.log(data);
                // Increment number of votes
                $("#post-votes-" + postID).html(data);
                
                // Get number of votes for post
                var counter = parseInt($("#post-votes-" + postID).text(), 10);

                // Adjust class names for coloring
                votesColor(postID, counter);
            }
        },

        // If request was not successfull
        error: function (data) {
            console.log(data);
        }
    });
}

/*
 * postID: ID of post
 * userID: ID of user
 * task: Upvote or Downvote
 */
function downvote(postID, userID){
    
    
    var formData = {
        postID: postID,
        userID: userID,
        task: 'downvote'
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Execute ajax request
    $.ajax({
        type: 'POST',
        url: 'votes',
        data: formData,
        dataType: 'json',
        
        // If request is successfull
        success: function (data) {
            // Check if controller returned no data
            if (data == 'hasupvoted'){
                console.log('hasupvoted')
            } else if (data == 'hasdownvoted'){
                console.log('hasdownvoted')
            } else if (data == 'error'){
                console.log('error');
            } else {
                console.log('Success');
                console.log(data);
                // Increment number of votes
                $("#post-votes-" + postID).html(data);
                
                // Get number of votes for post
                var counter = parseInt($("#post-votes-" + postID).text(), 10);

                // Adjust class names for coloring
                votesColor(postID, counter);
            }
        },

        // If request was not successfull
        error: function (data) {
            console.log(data);
        }
    });
}

function votesColor(postID, counter){
    console.log("postID:" + postID);
    console.log("counter:" + counter);
    var postVotesContainer = $("#post-votes-" + postID)
    
    if(counter > 0 && postVotesContainer.hasClass('text-danger')){
        postVotesContainer.removeClass('text-danger').addClass('text-primary');
    }
    if(counter > 0 && postVotesContainer.hasClass('text-default')){
        postVotesContainer.removeClass('text-default').addClass('text-primary');
    }

    if(counter == 0 && postVotesContainer.hasClass('text-primary')){
        postVotesContainer.removeClass('text-primary').addClass('text-default');
    }
    if(counter == 0 && postVotesContainer.hasClass('text-danger')){
        postVotesContainer.removeClass('text-danger').addClass('text-default');
    }


    if(counter < 0 && postVotesContainer.hasClass('text-primary')){
        postVotesContainer.removeClass('text-primary').addClass('text-danger');
    }
    if(counter < 0 && postVotesContainer.hasClass('text-default')){
        postVotesContainer.removeClass('text-default').addClass('text-danger');
    }

    // The votes are positive 
    // if(counter > 0){
    //     // Check if class is default or danger and change to primary    
    //     if(postVotesContainer.hasClass("text-default")){
    //         $("#post-votes-" + postID).removeClass('text-default').addClass('text-primary');
    //     } else {
    //         $("#post-votes-" + postID).removeClass('text-danger').addClass('text-primary');
    //     }
    // // The votes are negative
    // }else if(counter < 0){
    //     // Check if class is default or primary and change to danger
    //     if(postVotesContainer.hasClass("text-default")){
    //         $("#post-votes-" + postID).removeClass('text-default').addClass('text-danger');
    //     } else {
    //         $("#post-votes-" + postID).removeClass('text-primary').addClass('text-danger');
    //     }
    // // The votes are zero
    // }else{
    //     // Check if class is primary or danger and change to default
    //     if(postVotesContainer.hasClass("text-primary")){
    //         $("#post-votes-" + postID).removeClass('text-primary').addClass('text-default');
    //     } else {
    //         $("#post-votes-" + postID).removeClass('text-danger').addClass('text-default');
    //     }
    // }
}