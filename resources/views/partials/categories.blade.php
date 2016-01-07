@forelse($categories as $category)
    <li><a href="{{ url('categorie', $category->id) }}">{{$category->title}}</a></li>
@empty
    Pas de categorie
@endforelse