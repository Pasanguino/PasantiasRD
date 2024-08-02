<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use DragonCode\Contracts\Cashier\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getFavorites()
    {
        // Obtener el ID del usuario autenticado
        $userId = auth()->id();

        // Obtener todos los favoritos del usuario autenticado con los datos de la vacante y del usuario
        $favorites = Favorite::where('user_id', $userId)->with(['vacancy', 'user'])->get();

        // Transformar los datos para devolver la vacante y el usuario en lugar de vacancy_id y user_id
        $favorites = $favorites->map(function ($favorite) {
            return [
                'id' => $favorite->id,
                'user' => $favorite->user, // Incluir los datos completos del usuario
                'vacancy' => $favorite->vacancy, // Incluir los datos completos de la vacante
                'created_at' => $favorite->created_at,
                'updated_at' => $favorite->updated_at,
            ];
        });

        // return response()->json($favorites);
        return Inertia::render('Favorite', [
            'applications' => $favorites,
        ]);
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
     */ public function create(Request $request)
    {
        $validationResponse = $this->ErrorValidator($request);
        if ($validationResponse) {
            return $validationResponse;
        }

        // Verifica si ya existe un favorito con los mismos user_id y vacancy_id
        $existingFavorite = Favorite::where('user_id', $request->input('user_id'))
            ->where('vacancy_id', $request->input('vacancy_id'))
            ->first();

        if ($existingFavorite) {
            return response()->json([
                'message' => 'Este favorito ya existe.',
                'status' => 409 // Conflict
            ], 409);
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
        return redirect()->route('Favorite')->with('status', 'Recurso eliminado exitosamente');

    }
}
