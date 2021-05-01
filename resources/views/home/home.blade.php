@extends('layout/layout')

@section('content')



    <div class="row">
        <div class="col-lg-12">
            <div class="slider_my">
            @for ($i = 0; $i < 10; $i++)
                <div class="widget lazur-bg mx-2 no-padding">
                        <div class="row p-2">
                            <div class="col-4">
                                <i class="fa fa-cloud fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span>Category</span>
                                <h2 class="font-bold">15</h2>
                            </div>
                        </div>
                    
                </div>
            @endfor
            </div>
        </div>  
    </div>




<script src="js/plugins/slick/slick.min.js"></script>


<script>

$(document).ready(function(){
    function createSlick(){
        
        $('.slider_my').not('.slick-initialized').slick({
            slidesToShow: 5,
            slidesToScroll: 5,
        });
    }
      
    createSlick();

//Now it will not throw error
$(window).on( 'resize', createSlick);

});


</script>
@endsection
