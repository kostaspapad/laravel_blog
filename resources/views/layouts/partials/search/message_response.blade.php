@foreach($result as $r)
<div class="well">
    <div class="row">
        <span class="label label-info">Title:</span>
        {{$r['message_title']}}
    </div>
    <div class="row">
        <span class="label label-info">Body:</span>
        {{$r['message_body']}}
    </div>
    <div class="row">
        <span class="label label-info">Message ID:</span>
        {{$r['message_id']}}
    </div>
    <div class="row">
        <span class="label label-info">Sender ID:</span>
        {{$r['message_sender']['message_user_sender_id']}}
    </div>
    <div class="row">
        <span class="label label-info">Receiver ID:</span>
        {{$r['message_receiver']['message_user_receiver_id']}}
    </div>
    <div class="row">
        <span class="label label-info">Notification ID:</span>
        {{$r['message_notification_id']}}
    </div>
    <div class="row">
        <span class="label label-info">Sender Username:</span>
        {{$r['message_sender']['message_username_sender']}}
    </div>
    <div class="row">
        <span class="label label-info">Receiver Username:</span>
        {{$r['message_receiver']['message_username_receiver']}}
    </div>
    <div class="row">
        <span class="label label-info">Sender Email:</span>
        {{$r['message_sender']['message_email_sender']}}
    </div>
    <div class="row">
        <span class="label label-info">Receiver Email:</span>
        {{$r['message_receiver']['message_email_receiver']}}
    </div>
    
    <div class="btn-group btn-group-xs" role="group" aria-label="...">
        <a href="/messages/{{$r['message_id']}}" class="btn btn-default">Message</a>
        <a href="/usernotifications/{{$r['message_notification_id']}}" class="btn btn-default">Notification</a>
    </div>
</div>
@endforeach