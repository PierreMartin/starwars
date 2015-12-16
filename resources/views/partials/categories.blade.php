@forelse($categories as $category)
    <li><a href="{{ url('categorie', $category->id) }}">{{$category->title}}</a></li>
@empty
    <li>No category</li>
@endforelse