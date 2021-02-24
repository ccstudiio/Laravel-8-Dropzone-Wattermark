@extends('layout.master')

@section('content')

    <div class="container">
        <div class="col-sm-12 col-sm-offset-1 clearfix">

            {{--WATERMARK-LOGO--}}
            <div class="col-md-3">
                @foreach ($watermark as $water)
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img src="{{url('images')}}/{{ $water->watermark }}" width="100px">
                    </a>
                @endforeach
            </div>

            {{--DROPZONE--}}

            @foreach ($watermark as $water)
                <h3 class="jumbotron">Adicione sua imagens aqui!</h3>
            @if($water->active == 1)
            <form method="post" action="{{url('image/upload/store')}}" enctype="multipart/form-data"
                  class="dropzone" id="dropzone">
                @csrf
            </form>
            @endif
            @endforeach


            {{--MESSAGES--}}
            <div class="mb-3">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    <img src="{{url('images')}}/{{ Session::get('image') }}">
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Existe um erro no envio.
                        <ul>
                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

               {{--WATERMARK--}}

                @if($watermark->isEmpty() )
                        Por favor Envie sua Marca D'Agua.
                <form action="{{ url('image-upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success">enviar</button>
                        </div>
                    </div>
                </form>
                    @endif


            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mude a Marca d'agua</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row my-10">
                            <form action="{{ url('image-upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success">enviar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
