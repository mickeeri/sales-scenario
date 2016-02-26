@extends('layouts.app')

@section('css')
        <!-- Style for popup box -->
<link type="text/css" href="/css/jquery.mobile-1.4.5.css" rel="stylesheet" />
@endsection

@section('js')
    <!-- Disable Ajax in jquery mobile -->
<script type="text/javascript">
    $(document).bind("mobileinit", function () {
        $.mobile.ajaxEnabled = false;
    });
</script>
    <!-- jquery style for popup box -->
<script src="/js/jquery.mobile-1.4.5.min.js"></script>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert">
            {{ session('status') }}
        </div>
    @endif

    <!--Sort button-->
    <div role="main" class="ui-content"> <a href="#popupBasic" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-btn-inline" data-transition="pop" data-position-to="window">Sort</a>
    <!--Popup list-->
    </div>
    <div data-role="popup" id="popupBasic">
        <div data-role="header" data-theme="a">
            <h1>Make Selections</h1>
        </div>
        <div role="main" >

            <ul data-role="listview" id="filter-tags">
                <li><label> <input type="checkbox" value="Sales Strategy" checked/> Sales Strategy </label></li>
                <li><label> <input type="checkbox" value="Sales Tactics" checked/> Sales Tactics </label></li>
                <li><label> <input type="checkbox" value="Sales Process" checked/> Sales Process </label></li>
                <li><label> <input type="checkbox" value="Big Deals Management" checked/> Big Deals Management </label></li>
                <li><label> <input type="checkbox" value="Selling To Small & Medium Businesses" checked/> Selling To Small & Medium Businesses </label></li>
                <li><label> <input type="checkbox" value="Sales Team Coaching" checked/> Sales Team Coaching </label></li>
                <li><label> <input type="checkbox" value="Sales Hiring" checked/> Sales Hiring </label></li>
                <li><label> <input type="checkbox" value="Social Selling" checked/> Social Selling </label></li>
                <li><label> <input type="checkbox" value="Sales KPIs" checked/> Sales KPIs </label></li>
                <li><label> <input type="checkbox" value="Old School Sales" checked/> Old School Sales </label></li>
                <li><label> <input type="checkbox" value="Management & Business Growth" checked/> Management & Business Growth </label></li>
            </ul>
        </div>
    </div>


    <div id="expert-list">
    <!-- List all the experts by first letter in their last name -->
    @foreach($list as $letter => $experts)
        <h2>{{ $letter }}</h2>
        <ul class="expert-list explore-list">
            @each('partials.expert_listing', $experts, 'expert')
        </ul>
        <p class="letter">{{ $letter }}</p>

        @foreach($experts as $expert)
            <div class="expert-tags">
            <a href="/expert/{{$expert->id}}">{{ $expert->first_name }} {{ $expert->last_name }}</a>
                <div class="tags">
                <!-- Fetch all experts tags and then render them with comma except for the last one -->
                    <?php $allTags = [];
                    foreach($expert->tags as $tag){
                        $allTags[] = $tag['name'];
                    } ?>

                    {{ implode(", ",$allTags) }}
                </div>
                <hr>
            </div>
        @endforeach

    @endforeach
</div>
@endsection