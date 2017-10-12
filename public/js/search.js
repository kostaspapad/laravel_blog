$(document).ready(function () {

    // Send request to
    var url = "/search";

    $("input[name=searchBoxPosts]").keypress(function (e) {

        // Save search container initial state. 
        var searchContainerHtml = $('#searchContainer').html();
        
        // User pressed enter
        if (e.which == 13) {
            
            // Get the user search string
            var formData = {
                searchTerm: $("input[name=searchBoxPosts]").val(),
            }

            // User did not type anything
            if (formData['searchTerm'] !== ""){
            
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

            } else { //formData is empty("")

                // Use saved html to reverse to initial state of view
                $('#searchContainer').html(searchContainerHtml);
                
            }
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

    
    $("#upvote-icon").click(function(){
    alert("Hi " + user.user_id);
        // // Use this else 419 error status code
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        // e.preventDefault();

        // // Execute ajax request
        // $.ajax({
        //     type: 'POST',
        //     url: 'upvotePost',
        //     data: formData,
        //     dataType: 'json',

        //     // If request is successfull
        //     success: function (data) {

        //         // Check if controller returned no data
        //         if (data != -1) {
                    
        //             // Increase vote
        //             $(".vote-counter").html(parseInt($('.changeNumber').html(), 10)+1)

        //         }
        //     },

        //     // If request was not successfull
        //     error: function (data) {
        //         console.log(data);
        //     }
        // });
    });

    $("#downvote-icon").click(function(){
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
            url: 'downvotePost',
            data: formData,
            dataType: 'json',

            // If request is successfull
            success: function (data) {

                // Check if controller returned no data
                if (data != -1) {

                    // Reduce vote
                    $("#vote-container").html(parseInt($('.changeNumber').html(), 10)-1)

                }
            },

            // If request was not successfull
            error: function (data) {
                console.log(data);
            }
        });
    });


});