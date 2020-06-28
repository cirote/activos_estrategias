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
							<th rowspan="2" style="width: 30px">Mes</th>
							<th rowspan="2" style="width: 30px">Ano</th>
							<th colspan="5">Subyacente</th>
							<th colspan="4">Calls bajos</th>
							<th colspan="4">Calls altos</th>
							<th colspan="4">Puts bajos</th>
							<th colspan="4">Puts altos</th>
							<th colspan="4">Spreads</th>
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
							<th>Bull</th>
							<th>Bear</th>
							<th>Último</th>
							<th>Spread</th>
						</tr>
						@foreach($bases as $base)
						<tr>
							<td>{{ $bases->firstItem() + $loop->index }}.</td>
							<td align="right">{{ number_format($base->strike_bajo, 2, ',', '.') }}</td>
							<td align="right">{{ number_format($base->strike_alto, 2, ',', '.') }}</td>
							<td></td>
							<td></td>

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
							@include('estrategias::estrategias.bases.compra-venta')

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
@endsection
