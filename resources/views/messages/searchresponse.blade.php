@foreach($result as $r)
    {{$r->message_id}}
    {{$r->user_sender_id}}
    {{$r->user_receiver_id}}
    {{$r->notification_id}}
    {{$r->username_sender}}
    {{$r->username_receiver}}
    {{$r->email_sender}}
    {{$r->email_receiver}}
    {{$r->title}}
    {{$r->body}}
@endforeach