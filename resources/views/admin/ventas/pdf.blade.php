<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Ventas</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h3>Reporte de Ventas</h3>

    <table>
        <thead>
            <tr>
                <th>Número de Venta</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>IVA</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                <td>{{ $venta->created_at->format('H:i:s') }}</td>
                <td>{{ $venta->producto?->nombre ?? 'Sin producto' }}</td>
                <td>{{ $venta->cantidad }}</td>
                <td>${{ number_format($venta->precio_unitario, 2) }}</td>
                <td>${{ number_format($venta->iva, 2) }}</td>
                <td>${{ number_format($venta->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
