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
        <ul id="filter-tags">
            <li><input type="checkbox" value="Sales Strategy" checked/> Sales Strategy</li>
            <li><input type="checkbox" value="Sales Tactics" checked/> Sales Tactics</li>
            <li><input type="checkbox" value="Sales Process" checked/> Sales Process</li>
            <li><input type="checkbox" value="Big Deals Management" checked/> Big Deals Management</li>
            <li><input type="checkbox" value="Selling To Small & Medium Businesses" checked/> Selling To Small & Medium Businesses</li>
            <li><input type="checkbox" value="Sales Team Coaching" checked/> Sales Team Coaching</li>
            <li><input type="checkbox" value="Sales Hiring" checked/> Sales Hiring</li>
            <li><input type="checkbox" value="Social Selling" checked/> Social Selling</li>
            <li><input type="checkbox" value="Sales KPIs" checked/> Sales KPIs</li>
            <li><input type="checkbox" value="Old School Sales" checked/> Old School Sales</li>
            <li><input type="checkbox" value="Show All" id="check_all" checked/> Show All</li>
        </ul>


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
