@foreach($result as $r)
<div class="well">
    <div class="row">
        <span class="label label-info">Title:</span>
        {{$r['title']}}
    </div>
    <div class="row">
        <span class="label label-info">Body:</span>
        {{$r['body']}}
    </div>
    <div class="row">
        <span class="label label-info">Message ID:</span>
        {{$r['message_id']}}
    </div>
    <div class="row">
        <span class="label label-info">Sender ID:</span>
        {{$r['user_sender_id']}}
    </div>
    <div class="row">
        <span class="label label-info">Receiver ID:</span>
        {{$r['user_receiver_id']}}
    </div>
    <div class="row">
        <span class="label label-info">Notification ID:</span>
        {{$r['notification_id']}}
    </div>
    <div class="row">
        <span class="label label-info">Sender Username:</span>
        {{$r['username_sender']}}
    </div>
    <div class="row">
        <span class="label label-info">Receiver Username:</span>
        {{$r['username_receiver']}}
    </div>
    <div class="row">
        <span class="label label-info">Sender Email:</span>
        {{$r['email_sender']}}
    </div>
    <div class="row">
        <span class="label label-info">Receiver Email:</span>
        {{$r['email_receiver']}}
    </div>
    
    <div class="btn-group btn-group-xs" role="group" aria-label="...">
        <a href="/messages/{{$r['message_id']}}" class="btn btn-default">Message</a>
        <a href="/usernotifications/{{$r['notification_id']}}" class="btn btn-default">Notification</a>
    </div>
</div>
@endforeach