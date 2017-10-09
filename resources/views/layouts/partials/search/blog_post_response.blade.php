@foreach($posts as $post)
    {{--  For administrator show all posts (active/in-active) and option to toggle active state  --}}
    @if(Entrust::hasRole('admin'))
        <div class="well">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img style="width:30%" src="/storage/cover_images/{{$post['post_cover_image']}}">
                </div>
                <div class="col-md-8 col-sm-8">
                    <h3><a href="/posts/{{$post['post_id']}}">{{$post['post_title']}}</a></h3>
                    <hr>
                    {{--  <small>Written on {{$post['created_at']}} by {{$post->user->name}}</small>  --}}
                </div>
            </div>
            @if($post['post_active'])
                <a class="btn btn-xs btn-warning" href="{{ URL::to('toggle/' . $post['post_id'] ) }}">De-activate</a>
            @else
                <a class="btn btn-xs btn-info" href="{{ URL::to('toggle/' . $post['post_id'] ) }}">Activate</a>
            @endif
        </div>
    @else
        {{--  For user show only active posts  --}}
        @if($post['post_active'])
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:30%" src="/storage/cover_images/{{$post['post_cover_image']}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post['post_id']}}">{{$post['post_title']}}</a></h3>
                        <hr>
                        {{--  <small>Written on {{$post['created_at']}} by {{$post->user->name}}</small>  --}}
                    </div>
                </div>
            </div>
        @endif 
    @endif
@endforeach