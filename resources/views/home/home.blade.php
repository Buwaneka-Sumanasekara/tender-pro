@extends('layout/main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="slider_my">
            @foreach ($categorries as $category)
                 <div class="widget lazur-bg mx-2 no-padding">
                        <div class="row p-2">
                            <div class="col-2">
                                <i class="{{$category->icon }} fa-3x"></i>
                            </div>
                            <div class="col-10 text-right">
                                <span>{{ $category->name }}</span>
                                <h2 class="font-bold">{{ count($category->tenders()->get()) }}</h2>
                            </div>
                        </div>
                </div>
            @endforeach

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="table-responsive" >

                <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                        <tr>
                            <th>Tender ID</th>
                            <th></th>

                            <th>Title</th>
                            <th>End Date</th>
                            <th>Remain Days</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($tenders as $tender)
                        <tr>

                            <td>{{ $tender->id }} {{ $tender->hasPDF()}}</td>
                            <td class="text-center "><i class="text-navy {{ $tender->category->icon }}"></i></td>

                           <td>{{ $tender->title }}</td>
                           <td>{{ \Carbon\Carbon::parse($tender->end_date)->format('j F, Y') }}</td>
                           <td>{{ $tender->daysRemain() }}</td>
                           <td><a href="">View</a></td>
                        </tr>

                      @endforeach
                    </tbody>
                </table>
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

    function createDataTable(){
        $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true
        });
    }

    createSlick();
    createDataTable();

//Now it will not throw error
$(window).on( 'resize', createSlick);




});


</script>
@endsection
