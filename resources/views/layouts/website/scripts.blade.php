{{-- <script src="{{asset('website/assets/js/jquery.backstretch.min.js')}}"></script> --}}
<script src="{{asset('website/assets/js/wow.min.js')}}"></script>
{{-- <script src="{{asset('website/assets/js/jquery.waypoints.min.js')}}"></script> --}}
{{-- <script src="{{asset('website/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script> --}}
{{-- <script src="{{asset('website/assets/js/scripts.js')}}"></script> --}}
<!-- scripts -->
<script src="{{asset('website/js/jquery-3.4.1.js')}}"></script>
<script src="{{asset('website/js/owl.carousel.min.js')}}"></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

<script src="{{asset('website/js/popper.js')}}"></script>
<script src="{{asset('website/js/bootstrap.min.js')}}"></script>

<script src="{{asset('website/js/script.js')}}"></script>
<!-- Swiper JS -->
{{-- <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script> --}}


{{-- <script src="{{ asset('dashboard/app-assets/js/scripts/forms/select/form-select2.js')}}"></script> --}}
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>



<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js'></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>



<!--===============================================================================================-->
<script src=" {{asset('website/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('website/vendor/animsition/js/animsition.min.js ')}}"></script>
<!--===============================================================================================-->
	<script src=" {{asset('website/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('website/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('website/vendor/select2/select2.min.js')}}"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src=" {{asset('website/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('website/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src=" {{asset('website/vendor/slick/slick.min.js')}}"></script>
	<script src=" {{asset('website/js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('website/vendor/parallax100/parallax100.js ')}}"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="{{asset('website/vendor/MagnificPopup/jquery.magnific-popup.min.js ')}}"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src=" {{asset('website/vendor/isotope/isotope.pkgd.min.js')}}"></script>
<!--===============================================================================================-->
	<script src=" {{asset('website/vendor/sweetalert/sweetalert.min.js')}}"></script>
	<script>
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
		$.ajaxSetup({
		data: {
			_token: $('meta[name="csrf-token"]').attr('content')
		}
	});
	$(document).on('click', '.addToFavourte', function(e) {
		e.preventDefault();
		$(this).removeClass('text-danger');
		let company_id=$(this).data("companyid");
		let product_id=$(this).data("productid");
		$.ajax({
			type: "post",
			url: "{{route('fav.add')}}",
			data: {'company_id':company_id,'product_id':product_id},
			success: function (response) {
				$(this).removeClass('cl1');
				e.target.classList.remove('cl1');
				if(response.data==1){
					e.target.classList.add('cl1');
				}else{
					e.target.classList.remove('cl1');
				}
			},error: function (xhr) {
				if (xhr.status == 401) {
					window.location.href = '/webLogin';
				}
			}
		});
	});

	</script>
<!--===============================================================================================-->
	<script src=" {{asset('website/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('website/js/main.js ')}}"></script>
