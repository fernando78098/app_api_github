@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1><strong>Usuarios</strong></h1>
        </div>
        <div class="col-sm-6">
        </div>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Usuarios</h3>
                        </div>
                        <div class="card-body">
                            @if (isset($data) && $data->isNotEmpty())
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Login</th>
                                        <th>Foto</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $item)
                                        <tr>
                                            <th>{{ $item->id }}</th>
                                            <th>{{ $item->login }}</th>
                                            <td>
                                                <img style="max-width: 50px" src="{{ $item->avatar_url }}" alt="">
                                            </td>
                                            <td>
                                                <form action="{{ route('user.store') }}" method="POST" style="display: inline" >
                                                    @csrf
                                                    <input type="hidden" name="login" value="{{ $item->login }}">
                                                    <button class="btn btn-primary">
                                                        Salvar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div>
                                    <h5>Não existe Usuarios</h5>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('footer')
    <div class="float-right d-none d-sm-block">
      <b>Versão</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2020-2030 <a href="#">App GitHub</a>.</strong> Todos os direitos
    reservado.
@endsection

@section('js')
    <script>
        function openModal(id_element){
            document.getElementById('id_element').value = id_element;
        }
        function reloadPage(){
            setTimeout(function(){
                window.location.reload()
            },1000);
        }
    </script>
  @endsection

