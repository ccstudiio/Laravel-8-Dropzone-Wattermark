<!DOCTYPE html>
<html>
<head>
    <title>CC-STUDIO - Dropzone Images - Watermark</title>
    <meta name="_token" content="{{csrf_token()}}" />
    <!-- CSS only -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('ccstudio/css/ccstudio.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{asset('js/anime.min.js')}}"></script>
    <script src="{{asset('js/scrollreveal.min.js')}}"></script>
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/dropzone.js')}}"></script>
    <script src="{{asset('js/dropzone-config.js')}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="{{asset('js/bootstrap.bundle.min.js')}}" ></script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{asset('ccstudio/logo/logo.png')}}" alt="" style="width: 80px; height: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{url('/')}}">home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/image/upload')}}">enviar Images</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/image/show')}}">visiualizar imagens</a>
                </li>

            </ul>

        </div>
    </div>
</nav>
@yield('content')
</body>

</html>
