<ul class="tag-list explore-list">
    @foreach($randomizedTags as $tag)
        <li><a href="/explore/{{ $tag->slug }}"><span>{{ $tag->name }}</span></a></li>
    @endforeach
</ul>