@extends('layouts.app')

@section('js')
    <script>
        if ({{ $tag }}) { <!-- Only run js if tag value is present -->
            $(function () {
                var tag = {{ $tag }} -1;  // Get the tag id.
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
        }
    </script>
    <script type="text/javascript" src="/js/tags.toggle.js"></script>
@endsection


@section('content')
    @if (session('status'))
        <div class="alert">
            {{ session('status') }}
        </div>
        @endif

                <!--Popup list-->
        <a href="#" class='explore-sort-button' type='button' id='hideshow' value='hide/show'>
            <img src="/img/sort.btn.png">
        </a>

        <div class="filter-popup">
            <ul id="filter-tags">
                @foreach($tags as $tags )
                    <li>
                        <input id="{{ $tags->id }}" type="checkbox" value="{{ $tags->name }}" checked>
                        <label for="{{ $tags->id }}"><span></span>{{ $tags->name }}</label>
                    </li>
                @endforeach
                <li>
                    <input type="checkbox" name="show-all" id="check_all" checked/> Show All
                    <label for="check_all"><span></span></label>
                </li>
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
