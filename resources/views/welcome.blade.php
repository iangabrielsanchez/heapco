@extends('layouts.app') @section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ResponsiveSlides.js/1.55/responsiveslides.css"> @endsection @section('content')
<div class="image-slider">
	<!-- Slideshow 1 -->
	<ul class="rslides" id="slider1">
		<li>
			<img src="images/slider-image1.jpg" alt="">
		</li>
		<li>
			<img src="images/slider-image2.jpg" alt="">
		</li>
		<li>
			<img src="images/slider-image1.jpg" alt="">
		</li>
	</ul>
	<!-- Slideshow 2 -->
</div>
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ResponsiveSlides.js/1.55/responsiveslides.min.js"></script>
<script>
	// You can also use "$(window).load(function() {"
        $(function () {

            // Slideshow 1
            $("#slider1").responsiveSlides({
                maxwidth: 1600,
                speed: 600
            });
        });

</script>
@endsection @endsection