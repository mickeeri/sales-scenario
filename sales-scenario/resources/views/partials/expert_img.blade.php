@if (!empty($src))
    <div class="profile-image {{ $class }}" style="background-image: url('/expert_photo/{{ $src }}');"></div>
@else
    <div class="profile-image {{ $class }}" style="background-image: url('/expert_photo/blank-profile-picture.png');"></div>
@endif