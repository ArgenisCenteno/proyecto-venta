<td>
    {!! Form::open(['route' => ['subcategorias.destroy', $id], 'method' => 'delete', 'class' => 'btn-delete2']) !!}
    <div class='btn-group'>
        <a href="{{ route('subcategorias.edit', [$id]) }}" class='btn btn-info' data-bs-toggle="tooltip"
            data-bs-placement="top" title="Editar"><span class="material-icons">edit</span></a>
        
        {!! Form::button('<span class="material-icons">delete</span>', ['type' => 'submit', 'class' =>
        'btn btn-danger', 'data-bs-toggle' => 'tooltip', 'data-bs-placement' => 'top', 'title' => 'Eliminar']) !!}
    </div>
    {!! Form::close() !!}
</td>
<!-- SweetAlert CDN -->
 
@section('js')
@include('layout.script')
<script src="{{asset('js/sweetalert2.js')}}"></script>

<!-- ALERT DE CONFIRMACION DE ELIMINACION -->

@endsection
