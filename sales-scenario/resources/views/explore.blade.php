@extends('layouts.app')

        <!-- Only run js if tag value is present -->
@if ($tag)
@section('js')
    <script>
        $(function () {
            // Get the tag id.
            var tag = {{ $tag }} -1;
            // Get the value from input
            var value = $("ul#filter-tags input:nth(" + tag + ")").val();
            // Remove all tags except the one with present id
            contain = $('#filter-tags').map(function () {
                return ':contains("' + value + '")';
            }).get();
            $('#expert-list .expert:not(' + contain + ')').hide();
            // Uncheck checkboxes except the present one
            $(':checkbox').attr('checked', false)[tag].checked = true;
        });

        //$('#filter-tags').toggle();

        //TODO Just to test toogle sort list...
        $(function(){
            $('#hideshow').on('click', function(event) {
                $('#filter-tags').toggle('show');
            });
        });


    </script>
@endsection
@endif

@section('content')
    @if (session('status'))
        <div class="alert">
            {{ session('status') }}
        </div>
    @endif

            <!--Popup list-->
        <a href="#" class='explore-sort-button'type='button' id='hideshow' value='hide/show'>Sort</a>

        <div class="filter-popup">
            <ul id="filter-tags">
                @foreach($tags as $tags )
                    <li>
                        <input id="{{ $tags->name }}" type="checkbox" value="{{ $tags->name }}" checked>
                        <label for="{{ $tags->name }}">{{ $tags->name }}<span></span></label>
                    </li>
                @endforeach
                <li><input type="checkbox" value="Show All" id="check_all" checked/> Show All</li>
            </ul>
        </div>

        <div id="expert-list">
            <!-- List all the experts by first letter in their last name -->
            @foreach($list as $letter => $experts)
                <h2>{{ $letter }}</h2>
                <ul class="expert-list explore-list">
                    @each('partials.expert_listing', $experts, 'expert')
                </ul>
            @endforeach
        </div>

@endsection
