<div class="slider-item slider-content-wrapper">
    @include('partials.expert_img', array('src' =>$podcast->expert->photo, 'class' =>'slider-profile-image'))
    <div class="slider-info">
        <p class="upper">{{ $podcast->title }}</p>
        <p class="upper smaller margin-left">By {{ $podcast->expert->first_name }} {{ $podcast->expert->last_name }}</p>
        <a class="slider-button button upper" href="/player/{{ $podcast->expert->slug }}/{{ $podcast->slug }}"> Play</a>
    </div>
</div>