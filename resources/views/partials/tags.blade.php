@forelse($tags as $tag)
    <li><a href="{{ url('tag', $tag->id) }}">{{$tag->name}}</a></li>
@empty
    <li>No tags</li>
@endforelse