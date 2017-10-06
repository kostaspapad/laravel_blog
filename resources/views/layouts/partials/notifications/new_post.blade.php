{{Log::info(print_r($notification->data['user'], true))}}

<a >
    {{$notification->data['user']['name']}} created a post: <strong>{{$notification->data['post']['title']}}</strong>
</a>

