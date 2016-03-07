@extends('layouts.app')

@section('content')
    <div class="wrapper no-padding">
        <div id="explore_filter">
            <a href="#" class='explore-sort-button' type='button' id='hideshow' value='hide/show'>
                <i class="fa fa-filter white-icon-orange-bg"></i>
            </a>
            <div id="explore-white-space"></div>
            <!-- Hyperlinks -->
            <div id="explore-container-hyperlinks">
                @foreach($list as $letter => $experts)
                    <a class="a-letter" href="#{{ $letter }}">{{ $letter }}</a>
                @endforeach
            </div>
            <div class="filter-popup" data-selected="{{ $tag }}">
                <ul id="filter_tags">
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
                            <input type="checkbox" id="check_all" name="show-all" checked/>
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
                <h2 id="{{ $letter }}">{{ $letter }}</h2>
                <ul class="explore-list">
                    @each('partials.expert_listing', $experts, 'expert')
                </ul>
            @endforeach
        </div>
    </div>
@endsection
