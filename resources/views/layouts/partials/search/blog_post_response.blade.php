@foreach($posts as $post)
    {{--  For administrator show all posts (active/in-active) and option to toggle active state  --}}
    @if(Entrust::hasRole('admin'))
        <div class="well">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img style="width:30%" src="/storage/cover_images/{{$post['cover_image']}}">
                </div>
                <div class="col-md-8 col-sm-8">
                    <h3><a href="/posts/{{$post['id']}}">{{$post->title}}</a></h3>
                    <hr>
                    {{--  <small>Written on {{$post['created_at']}} by {{$post->user->name}}</small>  --}}
                </div>
            </div>
            @if($post['active'])
                <a class="btn btn-xs btn-warning" href="{{ URL::to('toggle/' . $post['id'] ) }}">De-activate</a>
            @else
                <a class="btn btn-xs btn-info" href="{{ URL::to('toggle/' . $post['id'] ) }}">Activate</a>
            @endif
        </div>
    @else
        {{--  For user show only active posts  --}}
        @if($post['active'])
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:30%" src="/storage/cover_images/{{$post['cover_image']}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post['id']}}">{{$post['title']}}</a></h3>
                        <hr>
                        {{--  <small>Written on {{$post['created_at']}} by {{$post->user->name}}</small>  --}}
                    </div>
                </div>
            </div>
        @endif 
    @endif
@endforeach