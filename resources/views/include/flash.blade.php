@if($flash = session('message'))

    <div class="alert {{ session('flash_message_type') }}" role="alert">

        {{$flash}}

    </div>
@endif