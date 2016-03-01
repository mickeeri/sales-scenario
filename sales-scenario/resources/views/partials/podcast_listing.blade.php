<div class="slider-item slider-content-wrapper">
    <img class="float-left slider-img" src="/expert_photo/blank-profile-picture.png" alt="Profile image of {{ $podcast->expert->first_name}} {{  $podcast->expert->last_name }}"/>
    <div class="slider-info">
        <p class="upper">{{ $podcast->title }}</p>
        <p class="upper smaller margin-left">By {{ $podcast->expert->first_name }} {{ $podcast->expert->last_name }}</p>
        <a class="slider-button button upper" href="/player/{{ $podcast->expert->id }}/{{ $podcast->id }}"> Play</a>
    </div>
</div>