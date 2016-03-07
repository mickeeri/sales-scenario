<li class="expert">
    <a href="/expert/{{ $expert->slug }}">

        <span class="title">{{ $expert->first_name }} {{ $expert->last_name }}</span>
        <ul class="expert-tags">
        @foreach($expert->tags as $tag)
            <li>{{ $tag->name }}</li>
        @endforeach
        </ul>
    </a>
</li>