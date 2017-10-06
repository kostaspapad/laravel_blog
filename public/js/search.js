$(document).ready(function(){
    
        // Send request to
        var url = "/search";
    
        // When user press enter
        $("input[name=searchBox]").keypress(function(e) {
            if(e.which == 13) {
                
                // Use this else 419 error status code
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                e.preventDefault(); 
        
                // Get the user search string
                var formData = {
                    searchTerm: $("input[name=searchBox]").val(),
                }

                console.log(formData);
        
                // Execute ajax request
                $.ajax({
                    type: 'POST',
                    url: 'search',
                    data: formData,
                    dataType: 'json',
                    
                    // If request is successfull
                    success: function (data) {
                        console.log(data);
                        
                        // Iterate on results
                        $.each(data, function() {
                            $.each(this, function(i, j) {
                                // Look for notification id, if found hold it, else append data to div
                                if(i == 'notification_id'){
                                    notifId = j;
                                }else{
                                    $("#ajaxSearchResponse").append("<div>" + i + ": " + j + "<br>"); 
                                }
                            });
                            
                            // Create show button
                            $("#ajaxSearchResponse").append("<a class='btn btn-primary'>Show</a><hr>");

                            // Append notification id to href of show button
                            $('a').attr('href', '/usernotifications/' + notifId); 
                        });
                        
                    },

                    // If request was not successfull
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });
    });
    