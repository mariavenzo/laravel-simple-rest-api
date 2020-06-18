<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Cliente_Planos;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    protected $validationRules = [
        'nome' => 'required|min:5|max:60',
        'email' => 'required|email|max:60|unique:App\Cliente,email',
        'telefone' => 'required|regex:~^\(([0-9]{2})\) ([0-9]{8,9})$~',
        'estado' => 'required|max:20',
        'cidade' => 'required|max:40',
        'nascimento' => 'required|size:10|regex:/([0-9]{4}\-[0-9]{2}\-[0-9]{2})/|date',
    ];

    public function index()
    {
        return Cliente::all();
    }

    public function view(Cliente $cliente)
    {
        return $cliente;
    }

    public function viewPlanos(Cliente $cliente)
    {
        return $cliente->planos;
    }

    public function viewPlano(Cliente $cliente, $id)
    {
        return Cliente_Planos::where([
            'cliente_id' => $cliente['id'],
            'plano_id' => $id,
        ])->get();
    }

    public function deletePlano(Cliente $cliente, $id)
    {
        Cliente_Planos::where([
            'cliente_id' => $cliente['id'],
            'plano_id' => $id,
        ])->delete();

        # @todo check if we can remove all client's plans

        return response()->json(null, 204);
    }

    public function createPlano(Request $request, Cliente $cliente, $id)
    {

        $planoCadastrado = Cliente_Planos::where([
            'cliente_id' => $cliente['id'],
            'plano_id' => $id,
        ])->count();

        if ($planoCadastrado) {
            return response()->json([
                'success' => false,
                'errors' => ['O cliente já possui este plano'],
            ]);
        }

        $plano = Cliente_Planos::create([
            'cliente_id' => $cliente['id'],
            'plano_id' => $id,
        ]);
        return response()->json([
            'success' => true,
            'data' => $plano,
        ], 201);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationRules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $cliente = Cliente::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $cliente,
        ], 201);
    }

    public function update(Request $request, Cliente $cliente)
    {
        $validationRules = $this->validationRules;
        # @todo improve this later: https://stackoverflow.com/questions/23587833/laravel-validation-unique-on-update
        $validationRules['email'] .= ", {$cliente['id']}";
        $validator = Validator::make($request->all(), $validationRules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $cliente->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $cliente,
        ], 200);
    }

    public function delete(Cliente $cliente)
    {
        $hasPlans = Cliente_Planos::where([
            'cliente_id' => $cliente['id'],
        ])->count();

        $isFree = Cliente_Planos::where([
            'cliente_id' => $cliente['id'],
            'plano_id' => 1, # Free | Improve this later
        ])->count();

        # @todo DROP CASCADE maybe??
        if ($hasPlans && !$isFree) {
            return response()->json([
                'success' => false,
                'message' => 'Cliente possui planos cadastrados.',
            ], 503);
        }

        if ($cliente['estado'] == 'São Paulo' && $isFree) { # @todo fix this POG on database layer later
            return response()->json([
                'success' => false,
                'message' => 'Clientes do plano FREE, do estado de São Paulo, não podem ser excluídos.',
            ], 503);
        }

        $cliente->delete();
        return response()->json(null, 204);
    }
}
