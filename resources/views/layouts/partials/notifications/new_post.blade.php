{{--  If user opens the dropdown, mark notifications as read.  --}}
{{Auth::user()->unreadNotifications->markAsRead()}}
<div class="row">
    <a href="/posts/{{$notification->data['post']['id']}}">
        <div class="col-md-3">
            <span class="label label-success"> Post</span>
        </div>
        <div class="col-md-8">
            {{$notification->data['post']['title']}}
        </div>
    </a>
    {{--  @if($notification->data['message'][''])  --}}
    <div class="col-md-3">
        {{--  <span class="hasbeenread glyphicon glyphicon-eye-open"></span>  --}}
        
    </div>
</div>