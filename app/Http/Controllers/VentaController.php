<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\DetalleVenta;
use App\Models\Pago;
use App\Models\Producto;
use App\Models\Recibo;
use App\Models\Tasa;
use App\Models\Transaccion;
use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Alert;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Venta::with(['user', 'vendedor', 'pago'])->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function($row) {
                    return $row->user->name;
                })
                ->addColumn('vendedor', function($row) {
                    return $row->vendedor->name ?? 'S/D';
                })
                ->addColumn('monto_neto', function($row) {
                    return number_format($row->pago->monto_neto, 2);
                })
                ->addColumn('monto_total', function($row) {
                    return number_format($row->pago->monto_total, 2);
                })
                ->addColumn('fecha', function($row) {
                    return $row->created_at->format('Y-m-d'); // Ajusta el formato de fecha aquí
                })
                ->addColumn('status', function($row) {
                    $status = $row->pago->status;
                    $class = $status == 'Pagado' ? 'success' : 'danger'; // Clase basada en el estado
                    return '<span class="badge bg-' . $class . '">' . $status . '</span>';
                })
                ->addColumn('actions', function($row) {
                    $viewUrl = route('ventas.show', $row->id);
                    $deleteUrl = route('ventas.destroy', $row->id);
                    $pdfUrl = route('ventas.pdf', $row->id); // Asegúrate de que la ruta esté correcta
                    return '
                            <a href="'.$pdfUrl.'" class="btn btn-success btn-sm" target="_blank">Recibo</a>
                           <form action="'.$deleteUrl.'"  method="POST" style="display:inline; " class="btn-delete">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-danger btn-sm " >Eliminar</button>
                        </form>';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }
    
        return view('ventas.index');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
  
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

   

    public function vender(Request $request)
    {
        //$caja = Caja::where('activa', '1')->first();
        $dollar = Tasa::where('name', 'Dollar')->where('status', 'Activo')->first();
        $users = User::pluck('name', 'id');

        return view('ventas.vender')->with('dollar', $dollar)->with('users', $users);
    }

    public function datatableProductoVenta(Request $request)
    {
        if ($request->ajax()) {
            $productos = Producto::with('subCategoria', 'imagenes')->get(); // Cargar la relación subCategoria

            return DataTables::of($productos)
                ->addColumn('fecha_vencimiento', function ($producto) {
                    $date = Carbon::now();
                    if ($producto->fecha_vencimiento <= $date) {
                        return '<span class="badge bg-danger">Vencido</span>';
                    } else {
                        return $producto->fecha_vencimiento;
                    }
                })
                ->editColumn('created_at', function ($producto) {
                    return $producto->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('subCategoria', function ($producto) {
                    return $producto->subCategoria ? $producto->subCategoria->nombre : '';
                })
                ->addColumn('actions', function ($producto) {
                    return '<button type="button" id="agregarCarrito" class="btn btn-info"><span class="material-icons">shopping_cart</span></button>';
                })
                ->rawColumns(['fecha_vencimiento', 'actions']) // Especifica las columnas que contienen HTML sin escape
                ->make(true);
        }
    }


    public function obtenerProducto(Request $request, $id)
    {
        if ($request->ajax()) {
            $producto = Producto::with('subCategoria')->find($id);


            if (!$producto) {
                return response()->json(['success' => false, 'message' => 'Producto no encontrado'], 404);
            }

            return response()->json(['success' => true, 'producto' => $producto]);
        } else {
            return response()->json(['success' => false, 'message' => 'Solicitud no válida'], 400);
        }
    }

    public function generarVenta(Request $request)
    {

        if ($request->producto == [] || $request->producto == null) {
            Alert::error('¡Error!', 'Para realizar una venta es necesario agregar productos')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        }
        //obtener datos
        $productos = json_decode($request->productos, true);
        $metodos = json_decode($request->metodos_pago, true);


        //calcular el monto total, monto neto e impuestos

        $totalNeto = 0;
        $montoTotal = 0;
        $impuestosTotal = 0;

        foreach ($productos as $producto) {
            $totalNeto += $producto['precio'] * $producto['cantidad'];

            if ($producto['aplicaIva'] == 1) {
                $montoTotal += $producto['cantidad'] * $producto['precio'] * 1.16;
                $impuestosTotal += ($producto['precio'] * 0.16) * $producto['cantidad'];
            } else {
                $montoTotal += $producto['precio'] * $producto['cantidad'];
            }
        }


        $userId = Auth::id();

        //registrar pago

        $pago = new Pago();
        $pago->status = 'Pagado';
        $pago->tipo = 'Venta';
        $pago->forma_pago = $request->metodoPago;
        $pago->monto_total = $montoTotal;
        $pago->monto_neto = $totalNeto;
        $pago->tasa_dolar = $request->tasa;
        $pago->creado_id = $userId;
        $pago->fecha_pago = Carbon::now()->format('Y-m-d');
        $pago->impuestos = $impuestosTotal;
        $pago->save();

        //registrar venta
        $venta = new Venta();
        $venta->user_id = $request->user_id;
        $venta->vendedor_id = $userId;
        $venta->monto_total = $montoTotal;
        $venta->status = 'Pagado';
        $venta->pago_id = $pago->id; 
        $venta->save();

        // Registrar detalles ventas
        foreach ($productos as $producto) {



            $detalleVenta = new DetalleVenta();
            $detalleVenta->id_producto = $producto['id'];
            $detalleVenta->precio_producto = $producto['precio'];
            $detalleVenta->cantidad = $producto['cantidad'];
            $detalleVenta->neto = $producto['precio'] * $producto['cantidad'];
            $detalleVenta->impuesto = ($producto['aplicaIva'] == 1) ? ($producto['precio'] * 0.16) * $producto['cantidad'] : 0;
            $detalleVenta->id_venta = $venta->id;
            $detalleVenta->save();

            // Actualizar stock
            $productoModel = Producto::find($producto['id']);
            if ($productoModel) {

                if( $productoModel->cantidad < $producto['cantidad']){
                    Alert::error('¡Error!', 'Sin suficiente stock para vender')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
                    return redirect()->back();
                  
                }
                $productoModel->cantidad -= $producto['cantidad'];
             

                $productoModel->save();
            }
        }

        $recibo = new Recibo();
        $recibo->tipo = 'Venta';
        $recibo->monto = $montoTotal;
        $recibo->estatus = 'Pagado';
        $recibo->pago_id = $pago->id;
        $recibo->user_id = $request->user_id;
        $recibo->activo = 1;
        $recibo->creado_id = $userId;
        $recibo->descuento = $request->descuento;
        $recibo->save();

        //caja

       

        Alert::success('¡Exito!', 'Venta generada exitosamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        return redirect()->back();
    }

    public function destroy($id)
    {
        // Encuentra la venta por su ID
        $venta = Venta::find($id);
        
        if (!$venta) {
            Alert::error('¡Error!', 'Venta no encontrada')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
            return redirect()->route('ventas');
        }
    
        // Elimina los detalles de la venta
        $venta->detalleVentas()->delete();
    
        // Elimina el pago asociado a la venta
        if ($venta->pago) {
            $venta->pago->delete();
        }
    
        // Elimina la venta
        $venta->delete();
    
        Alert::success('¡Éxito!', 'Venta y pago eliminados exitosamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        return redirect()->route('ventas.index');
    }
    

    public function show($id)
    {
        $venta = Venta::with(['user', 'vendedor', 'pago', 'detalleVentas'])->find($id);
        return view('ventas.show', compact('venta'));
    }
}
