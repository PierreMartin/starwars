<ul class="list-unstyled">
    Liste des tags :
    @forelse($tags as $tag)
        <li class="list_tags"><a style="color: #9f9f9f;" href="{{ url('tag', $tag->id) }}">{{$tag->name}}</a></li>
    @empty
        Pas de tags
    @endforelse
</ul>