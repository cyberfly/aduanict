@if (count($errors) > 0)
    <div class="alert alert-danger">
        <h4>Validation Error!</h4>
        Maaf, sila pastikan maklumat di isi dengan betul sebelum borang di hantar.
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- paparkan FLASH message --}}

@include('flash::message')