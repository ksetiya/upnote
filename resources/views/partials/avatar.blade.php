<a href="{{ url('users/'.$user->name.'/posts') }}">
    <img class="comment-avatar {!! $class or '' !!}" src="{!! $user->avatar !!}" alt="{!! $user->name !!}">
</a>