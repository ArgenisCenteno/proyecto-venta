<div class="row">
    <!-- Nombre Field -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('nombre', 'Nombre:', ['class' => 'bold']) !!}
        {!! Form::text('nombre', null, ['class' => 'form-control round', 'required']) !!}
    </div>

    <!-- Descripción Field -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('descripcion', 'Descripción:', ['class' => 'bold']) !!}
        {!! Form::textarea('descripcion', null, ['class' => 'form-control round', 'rows' => 3, 'required']) !!}
    </div>

    <!-- Precio Compra Field -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('precio_compra', 'Precio Compra:', ['class' => 'bold']) !!}
        {!! Form::number('precio_compra', null, ['class' => 'form-control round', 'step' => '0.01', 'id' => 'precio_compra', 'required']) !!}
        <p id="precio_compra_error" style="color: red; display: none;">El precio de compra no puede ser negativo.</p>
    </div>

    <!-- Precio Venta Field -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('precio_venta', 'Precio Venta:', ['class' => 'bold']) !!}
        {!! Form::number('precio_venta', null, ['class' => 'form-control round', 'step' => '0.01', 'id' => 'precio_venta', 'required']) !!}
        <p id="precio_venta_error" style="color: red; display: none;">El precio de venta no puede ser negativo.</p>
    </div>

    <!-- Aplica IVA Field -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('aplica_iva', 'Aplica IVA:', ['class' => 'bold']) !!}
        {!! Form::select('aplica_iva', ['1' => 'Sí', '0' => 'No'], null, ['class' => 'form-control round', 'required']) !!}
    </div>

  
    <!-- Cantidad Field -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('cantidad', 'Cantidad:', ['class' => 'bold']) !!}
        {!! Form::number('cantidad', null, ['class' => 'form-control round', 'step' => '1', 'required']) !!}
    </div>

    <!-- Subcategoría Field -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('sub_categoria_id', 'Subcategoría:', ['class' => 'bold']) !!}
        {!! Form::select('sub_categoria_id', $subcategorias, null, ['class' => 'form-control round', 'placeholder' => 'Selecciona una subcategoría', 'required']) !!}
    </div>

    <!-- Disponible Field -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('disponible', 'Disponible:', ['class' => 'bold']) !!}
        {!! Form::select('disponible', ['1' => 'Disponible', '0' => 'No Disponible'], null, ['class' => 'form-control round', 'required']) !!}
    </div>

   

    <!-- Contenedor para previsualizar las imágenes -->
    <div class="form-group col-sm-12 col-md-6" id="imagenes-preview"></div>
</div>

<!-- Botones de acción -->
<div class="float-end">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary round', 'id' => 'submit_btn']) !!}
    <a href="{{ route('almacen') }}" class="btn btn-danger round">Cancelar</a>
</div>

<script src="{{asset('js/sweetalert2.js')}}"></script>


