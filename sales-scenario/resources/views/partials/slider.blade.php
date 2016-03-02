@section('css')
        <!-- Styles for slider-->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.css"/>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.9/slick-theme.css"/>
@endsection

@section('js')
        <!-- Script for slider-->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js"></script>
<!--    <script type="text/javascript" src="/slick/slick.min.js"></script> -->
<script>
    $(document).ready(function(){
        $('.slider').slick({
            accessibility:true,
            autoplay: true,
            autoplaySpeed: 5000,
            dots: true,
            mobileFirst: true

        });
    });
</script>
@endsection

<div class="slider">
    @each('partials/podcast_listing', $podcasts, 'podcast')
</div>