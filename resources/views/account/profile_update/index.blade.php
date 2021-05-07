@extends('layout/main')

@section('content')
<form class="m-t"  action="user-actions/profile/update" method="POST">
    {{ csrf_field() }}
    @include('include.flash')
    @include('include.errors')
    <div class="row m-t">
        <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading ">
                      <h4><strong>Personal Information</strong></h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group row "><label class="col-2 col-form-label"><strong>First Name <span class="text-danger">*</span> &nbsp; :</strong></label>
                            <div class="col-6">
                                <input type="text" name="firstname" value="{{ $userData->firstname }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row "><label class="col-2 col-form-label"><strong>Last Name &nbsp; :</strong></label>
                            <div class="col-6">
                                <input type="text" name="lastname" value="{{ $userData->lastname }}" class="form-control">
                            </div>
                        </div>

                    </div>

                </div>

        </div>
    </div>
    @if($userData->um_user_role_id == 1)
    <div class="row m-t">
        <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading ">
                      <h4><strong>Company Information</strong></h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group row "><label class="col-2 col-form-label"><strong>Company Name &nbsp; :</strong></label>
                            <div class="col-6">
                                <input type="text" name="company_name" value="{{ $userData->vendor->company_name }}" class="form-control ">
                            </div>
                        </div>
                        <div class="form-group row "><label class="col-2 col-form-label"><strong>Address &nbsp; :</strong></label>
                            <div class="col-6">
                                <input type="text" name="company_address" value="{{ $userData->vendor->address }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row "><label class="col-2 col-form-label"><strong>Email <span class="text-danger">*</span> &nbsp; :</strong></label>
                            <div class="col-6">
                                <input type="email" name="company_email" value="{{ $userData->vendor->contact_email }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row "><label class="col-2 col-form-label"><strong>Contact (Mobile) <span class="text-danger">*</span> &nbsp; :</strong></label>
                            <div class="col-6">
                                <input type="text" name="company_contact_mobile" value="{{ $userData->vendor->contact_mobile }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row "><label class="col-2 col-form-label"><strong>Contact (Office) &nbsp; :</strong></label>
                            <div class="col-6">
                                <input type="text" name="company_contact_office" value="{{ $userData->vendor->contact_office }}" class="form-control">
                            </div>
                        </div>

                    </div>

                </div>

        </div>
    </div>
    @endif
    <div class="row m-t">
        <div class="col-md-12">
            <button class="btn btn-sm btn-success float-right m-r" type="submit">Update</button>

        </div>
    </div>
</form>








<script>



</script>
@endsection
