<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;

class DisciplinaController extends Controller
{

    public function index()
    {
        $disciplina = new Disciplina();
		$disciplinas = Disciplina::All();
		return view("disciplina.index", [
			"disciplina" => $disciplina,
			"disciplinas" => $disciplinas
		]);
    }

    public function store(Request $request)
    {
        if ($request->get("id") != "") {
			$disciplina = Disciplina::Find($request->get("id"));
		} else {
			$disciplina = new Disciplina();
			$disciplina->total_faltas = 0;
		}
		$disciplina->nome = $request->get("nome");
		$disciplina->maximo_faltas = $request->get("maximo_faltas");
		$disciplina->save();
		$request->session()->flash("salvar", "Salvo com sucesso!");
		return redirect("/disciplina");
    }
	
    public function edit($id)
    {
        $disciplina = Disciplina::Find($id);
		$disciplinas = Disciplina::All();
		return view("disciplina.index", [
			"disciplina" => $disciplina,
			"disciplinas" => $disciplinas
		]);
    }
	
	public function update(Request $request, $id)
    {
		$disciplina = Disciplina::Find($id);
		$disciplina->total_faltas += 1;
		$disciplina->save();
        $request->session()->flash("excluir", "Faltou com sucesso!");
		return redirect("/disciplina");
    }

    public function destroy(Request $request, $id)
    {
        Disciplina::Destroy($id);
		$request->session()->flash("excluir", "Excluído com sucesso!");
		return redirect("/disciplina");
    }
}
