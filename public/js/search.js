
$(document).ready(function(){
        
    // Send request to
    var url = "/search";

    $("input[name=searchBoxPosts]").keypress(function(e) {

        if(e.which == 13) {
            
            // Remove old results
            $( "#searchContainer" ).empty();    
            
            // Show hidden panel
            //$('#searchContainer').show();

            // Use this else 419 error status code
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault(); 

            // Get the user search string
            var formData = {
                searchTerm: $("input[name=searchBoxPosts]").val(),
            }

            //console.log(formData);

            // Execute ajax request
            $.ajax({
                type: 'POST',
                url: 'searchposts',
                data: formData,
                dataType: 'html',
                
                // If request is successfull
                success: function (data) {
                    
                    // Check if controller returned no data
                    if(data != 0){
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
        }
    });

    // When user press enter
    $("input[name=searchBoxMessages]").keypress(function(e) {

        if(e.which == 13) {
            
            // Remove old results
            $( "#searchResponse" ).empty();    
            
            // Show hidden panel
            $('#searchContainer').show();

            // Use this else 419 error status code
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault(); 

            // Get the user search string
            var formData = {
                searchTerm: $("input[name=searchBoxMessages]").val(),
            }

            //console.log(formData);

            // Execute ajax request
            $.ajax({
                type: 'POST',
                url: 'searchmessages',
                data: formData,
                dataType: 'html',
                
                // If request is successfull
                success: function (data) {
                    
                    // Check if controller returned no data
                    if(data != 0){
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
        }
    });
});