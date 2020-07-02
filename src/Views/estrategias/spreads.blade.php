@extends('opciones::layouts.master')

@section('main_content')
<div class="row">
	<div class="col-md-12">
		<div class="box">

			<div class="box-header with-border">
				<h3 class="box-title">Spreads</h3>
			</div>

			<div class="box-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th rowspan="2" style="width: 10px">#</th>
							<th colspan="2" style="width: 30px">Strike</th>
							<th colspan="5">Subyacente</th>
							<th colspan="4">Calls bajos</th>
							<th colspan="4">Calls altos</th>
							<th colspan="4">Puts bajos</th>
							<th colspan="4">Puts altos</th>
							<th colspan="4">Ganancias</th>
							<th colspan="3">Resumen</th>
						</tr>
						<tr>
							<th>Bajo</th>
							<th>Alto</th>
							<th>Ticker</th>
							@include('estrategias::estrategias.bases.titulo-compra-venta')
							@include('estrategias::estrategias.bases.titulo-compra-venta')
							@include('estrategias::estrategias.bases.titulo-compra-venta')
							@include('estrategias::estrategias.bases.titulo-compra-venta')
							@include('estrategias::estrategias.bases.titulo-compra-venta')
							<th>Bull Call</th>
							<th>Bull Put</th>
							<th>Bear Call</th>
							<th>Bear Put</th>
							<th>Rango</th>
							<th>Gan</th>
							<th>%</th>
						</tr>
						@foreach($bases as $base)
						<tr>
							<td>{{ $bases->firstItem() + $loop->index }}.</td>
							<td align="right">{{ number_format($base->strike_bajo, 2, ',', '.') }}</td>
							<td align="right">{{ number_format($base->strike_alto, 2, ',', '.') }}</td>

							@php($bs = $base->subyacente)
							@if(isset($bs->simbolo))
								<td>{{ $bs->simbolo }}</td>
							@else
								<td>Desconocido</td>
							@endif
							@include('estrategias::estrategias.bases.compra-venta')

							@php($bs = $base->call_bajo)
							@include('estrategias::estrategias.bases.compra-venta')

							@php($bs = $base->call_alto)
							@include('estrategias::estrategias.bases.compra-venta')

							@php($bs = $base->put_bajo)
							@include('estrategias::estrategias.bases.compra-venta')

							@php($bs = $base->put_alto)
							@include('estrategias::estrategias.bases.compra-venta')

							@php($bs = $base)
							@if($bs)
								@if($bs->bull_call)
									<td align="right">{{ number_format($bs->bull_call->gananciaMaxima, 2, '.', ',') }}</td>	
								@else
									<td></td>
								@endif
								@if($numero = $bs->bull_put)
									<td align="right">{{ number_format($bs->bull_put->gananciaMaxima, 2, '.', ',') }}</td>	
								@else
									<td></td>
								@endif
								@if($numero = $bs->bear_call)
									<td align="right">{{ number_format($bs->bear_call->gananciaMaxima, 2, '.', ',') }}</td>	
								@else
									<td></td>
								@endif
								@if($numero = $bs->bear_put)
									<td align="right">{{ number_format($bs->bear_put->gananciaMaxima, 2, '.', ',') }}</td>	
								@else
									<td></td>
								@endif
								@if($numero = $bs->rango)
									<td align="right">{{ number_format($numero, 2, '.', ',') }}</td>	
								@else
									<td></td>
								@endif
								@if($numero = $bs->gananciaMaxima)
									<td align="right">{{ number_format($numero, 2, '.', ',') }}</td>	
								@else
									<td></td>
								@endif
								@if($numero = (($bs->gananciaMaxima / $bs->rango) - 1) * 100)
									<td align="right">{{ number_format($numero, 2, '.', ',') }}</td>	
								@else
									<td></td>
								@endif
							@else
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							@endif

						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="box-footer clearfix">
				{{ $bases->links('layouts::pagination.default') }}
			</div>

		</div>
	</div>
</div>

<script>//setTimeout('document.location.reload()',20000); </script>
@endsection
