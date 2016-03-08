<ul class="tag-list explore-list">
    @foreach($tags as $tag)
        <li><a href="/explore/{{ $tag->id }}"><span>{{ $tag->name }}</span></a></li>
    @endforeach
</ul>