<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use DragonCode\Contracts\Cashier\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getFavorites()
    {
        $request = Favorite::all();

        return response()->json($request);
    }

    public function ErrorValidator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'vacancy_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validationResponse = $this->ErrorValidator($request);
        if ($validationResponse) {
            return $validationResponse;
        }

        // Asume que el modelo Favorite tiene user_id y vacancy_id
        $favorite = Favorite::create([
            'user_id' => $request->input('user_id'),
            'vacancy_id' => $request->input('vacancy_id'),
        ]);

        return response()->json([
            'message' => 'Recurso creado exitosamente',
            'data' => $favorite,
            'status' => 201
        ], 201);
    }

    public function deleteFavorites($id)
    {
        // Buscar el recurso por ID
        $favorite = Favorite::find($id);
    
        // Verificar si el recurso existe
        if (!$favorite) {
            return response()->json([
                'message' => 'Recurso no encontrado',
                'status' => 404
            ], 404);
        }
    
        // Eliminar el recurso
        $favorite->delete();
    
        // Responder con éxito
        return response()->json([
            'message' => 'Recurso eliminado exitosamente',
            'status' => 200
        ], 200);
    }
}
