@extends("template.app")

@section("nome_tela", "Disciplina")

@section("cadastro")
	<form action="/disciplina" method="POST" class="row">
		<div class="form-group col-6">
			<label>Nome:</label>
			<input type="text" name="nome" value="{{ $disciplina->nome }}" class="form-control" required />
		</div>
		<div class="form-group col-3">
			<label>Máximo de Faltas:</label>
			<input type="number" name="maximo_faltas" value="{{ $disciplina->maximo_faltas }}" class="form-control" required />
		</div>
		<div class="form-group col-3">
			@csrf
			<input type="hidden" name="id" value="{{ $disciplina->id }}" />
			<button class="btn btn-success bottom" type="submit">
				<i class="fa fa-save"></i> Salvar
			</button>
			<a href="/disciplina" class="btn btn-primary bottom">
				<i class="fa fa-plus"></i> Novo
			</a>
		</div>
	</form>
@endsection

@section("listagem")
	<table class="table table-striped">
		<colgroup>
			<col width="200">
			<col width="50">
			<col width="50">
			<col width="100">
			<col width="100">
			<col width="100">
		</colgroup>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Máximo de Faltas</th>
				<th>Qtd. de Faltas</th>
				<th>Faltar</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($disciplinas as $disciplina)
				<tr>
					<td>
						{{ $disciplina->nome }}
						
						<div class="progress">
							<div class="progress-bar" role="progressbar" style="width: {{ intval(($disciplina->total_faltas / $disciplina->maximo_faltas) * 100) }}%;" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						
					</td>
					<td>{{ $disciplina->maximo_faltas }}</td>
					<td>{{ $disciplina->total_faltas }}</td>
					<td>
						@if ($disciplina->total_faltas >= $disciplina->maximo_faltas)
							Vá pra aula!
						@else
							<form action="/disciplina/{{ $disciplina->id }}" method="POST">
								@csrf
								<input type="hidden" name="_method" value="put" />
								<button class="btn btn-primary" type="submit" onclick="return confirm('Deseja realmente faltar?');">
									<i class="fa fa-graduation-cap"></i> Faltar
								</button>
							</form>
						@endif
					</td>
					<td>
						<a href="/disciplina/{{ $disciplina->id }}/edit" class="btn btn-warning">
							<i class="fa fa-edit"></i> Editar
						</a>
					</td>
					<td>
						<form action="/disciplina/{{ $disciplina->id }}" method="POST">
							@csrf
							<input type="hidden" name="_method" value="delete" />
							<button class="btn btn-danger" type="submit" onclick="return confirm('Deseja realmente excluir?');">
								<i class="fa fa-trash"></i> Excluir
							</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection