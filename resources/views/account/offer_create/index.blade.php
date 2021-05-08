@extends('layout/offer')

@section('content-right')

<div class="panel panel-primary">
    <div class="panel-heading text-white">
      <h4><strong>Fill following details and submit</strong></h4>
    </div>
    <div class="panel-body">
        <div class="ibox ">
            <div class="ibox-content">

              <form action="/offer-actions/create" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                @include('include.flash')
                @include('include.errors')

              </form>

            </div>
        </div>
    </div>
</div>

@endsection
