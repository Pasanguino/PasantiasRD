<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    public function getProfileData()
    {
        $profile = UserProfile::all();

        return response()->json($profile);
    }
    
    public function getProfileDataById($id)
    {
        $profile = UserProfile::find($id);

        return response()->json($profile);
    }

    public function postProfileData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'description' => 'required|string',
            'age' => 'required|integer',
            'photo_path' => 'required|string',
            'identification_path' => 'required|string',
            'cv_path' => 'required|string',
            'profession_id' => 'required|integer',
            'type_user_id' => 'required|integer',
            'province_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $profile = UserProfile::create($request->all());

        if (!$profile) {
            $data = [
                'message' => 'Error al guardar los datos',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'data' => $profile,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function updatePartialProfile(Request $request, $id)
    {
        $profile = UserProfile::find($id);

        if (!$profile) {
            $data = [
                'message' => 'Perfil no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|required|string',
            'last_name' => 'sometimes|required|string',
            'email' => 'sometimes|required|string|email',
            'phone' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'age' => 'sometimes|required|integer',
            'photo_path' => 'sometimes|required|string',
            'identification_path' => 'sometimes|required|string',
            'cv_path' => 'sometimes|required|string',
            'profession_id' => 'sometimes|required|integer',
            'type_user_id' => 'sometimes|required|integer',
            'province_id' => 'sometimes|required|integer',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('first_name')) {
            $profile->first_name = $request->first_name;
        }

        if ($request->has('last_name')) {
            $profile->last_name = $request->last_name;
        }

        if ($request->has('email')) {
            $profile->email = $request->email;
        }

        if ($request->has('phone')) {
            $profile->phone = $request->phone;
        }

        if ($request->has('description')) {
            $profile->description = $request->description;
        }

        if ($request->has('age')) {
            $profile->age = $request->age;
        }

        if ($request->has('photo_path')) {
            $profile->photo_path = $request->photo_path;
        }

        if ($request->has('identification_path')) {
            $profile->identification_path = $request->identification_path;
        }

        if ($request->has('cv_path')) {
            $profile->cv_path = $request->cv_path;
        }

        if ($request->has('profession_id')) {
            $profile->profession_id = $request->profession_id;
        }

        if ($request->has('type_user_id')) {
            $profile->type_user_id = $request->type_user_id;
        }

        if ($request->has('province_id')) {
            $profile->province_id = $request->province_id;
        }

        $profile->save();

        $data = [
            'message' => 'Perfil actualizado',
            'data' => $profile,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

}
