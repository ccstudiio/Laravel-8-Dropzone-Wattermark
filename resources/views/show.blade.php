@extends('layout.master')

@section('content')
<div class="container">
<div class="col-sm-12 col-sm-offset-1 clearfix" >
    <p style="text-align:center;"><b>Imagens</b></p>

    <table class="table">
        <thead>
        <tr>

            <th class="text-white-50" scope="col">Imagen</th>
            <th class="text-white-50"scope="col"></th>
            <th class="text-white-50"scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($photos as $photo)
            <tr>

                <td><img src="{{url('images')}}/{{$photo->filename}}" alt="Snow" style="width:50px; height: 50px;"></td>
                <td class="text-white small">{{$photo->filename}}</td>
                <td>
                    <a href="{{url('images')}}/{{$photo->filename}}" target="_blank" class="btn btn-primary">
                        Download
                    </a>

                    <a href="{{ url('/image/delete')}}/{{ $photo->filename }}"  class="btn btn-danger delete-link"
                       data-message="Are you sure you want to delete this page?"
                       data-form="delete-form">
                        Delete
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <form id="delete-form"  action="" method="GET">
        {!! csrf_field() !!}
    </form>
</div>
</div>
@endsection
