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
    <div class="wrapper no-padding">
        <div id="explore_filter">
            <a href="#" class='explore-sort-button' type='button' id='hideshow' value='hide/show'>
                <i class="fa fa-filter white-icon-orange-bg"></i>
            </a>
            <div class="filter-popup">
                <ul id="filter-tags">
                    @foreach($tags as $tags )
                        <li>
                            <label>
                                <input type="checkbox" value="{{ $tags->name }}" checked>
                                <span></span>
                                <p class="tag-text">{{ $tags->name }}</p>
                            </label>
                        </li>
                    @endforeach
                    <li class="li-show-all">
                        <label>
                            <input type="checkbox" name="show-all" checked/>
                            <span></span>
                            <p class="tag-text show-all">Show All</p>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
        <div id="expert_list">
            <!-- List all the experts by first letter in their last name -->
            @foreach($list as $letter => $experts)
                <h2>{{ $letter }}</h2>
                <ul class="explore-list">
                    @each('partials.expert_listing', $experts, 'expert')
                </ul>
            @endforeach
        </div>
    </div>
@endsection
