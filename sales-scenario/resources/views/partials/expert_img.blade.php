@if (!empty($src))
    <img class="{{ $class }}" src="/expert_photo/{{ $src}}" alt="Profile image of {{ $first }} {{ $last }}"/>
@else
    <img class="{{ $class }}" src="/expert_photo/blank-profile-picture.png" alt="Profile image not available"/>
@endif