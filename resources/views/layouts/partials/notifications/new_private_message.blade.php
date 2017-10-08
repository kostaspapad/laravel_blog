{{--  If user opens the dropdown, mark notifications as read.  --}}
{{Auth::user()->unreadNotifications->markAsRead()}}
<div class="row">
    <a href="/messages/{{$notification->data['message']['id']}}">
        <div class="col-md-3">
            <span class="label label-warning">Msg</span> 
        </div>
        <div class="col-md-6">
            {{$notification->data['message']['title']}}
        </div>
    </a>
    {{--  @if($notification->data['message'][''])  --}}
    <div class="col-md-3">
        <span class="hasbeenread glyphicon glyphicon-eye-open"></span>
    </div>
</div>

{{--  {
  "repliedTime": {
    "date": "2017-10-07 18:49:25.000000",
    "timezone_type": 3,
    "timezone": "UTC"
  },
  "message": {
    "title": "Adwdawadw",
    "body": "Awdadwaw",
    "user_sender_id": "1",
    "user_receiver_id": "2",
    "updated_at": "2017-10-07 18:49:25",
    "created_at": "2017-10-07 18:49:25",
    "id": 104
  }
}  --}}