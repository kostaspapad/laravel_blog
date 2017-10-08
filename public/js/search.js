$(document).ready(function(){    
        
        // Send request to
        var url = "/search";

        // When user press enter
        $("input[name=searchBox]").keypress(function(e) {
            if(e.which == 13) {
                
                // Remove old results
                $( "#ajaxSearchResponse" ).empty();        
                
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
                    searchTerm: $("input[name=searchBox]").val(),
                }

                console.log(formData);
        
                // Execute ajax request
                $.ajax({
                    type: 'POST',
                    url: 'searchmessages',
                    data: formData,
                    dataType: 'json',
                    
                    // If request is successfull
                    success: function (data) {
                        console.log('data1');
                        
                        if(data != 0){
                            console.log('data ss');
                            console.log(data);
                            $("#searchResponse").html(data.html);
                            
                            // // Iterate on results, show results
                            // $.each(data, function() {
                            //     msgId = null;
                            //     notifId = null;
                            //     $.each(this, function(i, j) {
                            //         console.log('----------------');
                            //         console.log('i: ' + i);
                            //         console.log('j: ' + j);
                            //         // Look for notification id, if found hold it, else append data to div
                            //         if(i == 'message_id'){
                            //             console.log('store msgId var');
                            //             msgId = j
                            //         }
                            //         if(i == 'notification_id'){
                            //             console.log('store notifId var');
                            //             notifId = j;
                            //         } 
                                
                            //         if(msgId != null && notifId != null) {
                            //             console.log('msgId not null and notifId not null');
                            //             console.log('show data for ' + i);
                            //             // Show data
                            //             $("#ajaxSearchResponse").append("<div><small>" + i + ":</small> " + j + "<br>"); 
                                    
                            //             console.log('show button for' + i);
                            //             // Create show message and show notification button
                            //             $("#ajaxSearchResponse").append("<a id='showMessageBtn" + msgId + "' class='btn btn-primary btn-xs'>"  +
                            //                                                 "Message"                                             +
                            //                                             "</a>  "                                                  +
                            //                                             "<a id='notificationBtn' class='btn btn-primary btn-xs'>" +
                            //                                                 "Notification"                                        +
                            //                                             "</a><hr>");

                            //             // Append notification id to href of notification button
                            //             $('#showMessageBtn').attr('href', '/messages/' + msgId);

                            //             // Append notification id to href of notification button
                            //             $('#notificationBtn').attr('href', '/usernotifications/' + notifId); 

                            //             msgId = null;
                            //             notifId = null;
                            //         } else {
                            //             console.log('msgId null and notifId null');
                            //             console.log('show data for ' + i);
                            //             // Show data
                            //             $("#ajaxSearchResponse").append("<div><small>" + i + ":</small> " + j + "<br>"); 
                            //         }
                            //     });
                            // });

                        } else {
                            $("#ajaxSearchResponse").append("No results");
                        }
                    },

                    // If request was not successfull
                    error: function (data) {
                        console.log(data);
                        $("#searchResponse").append(data);
                        console.log('Error:', data);
                    }
                });
            }
        });
    });
    