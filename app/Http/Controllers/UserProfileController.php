<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    public function getProfileData()
    {
        $profile = UserProfile::all();

        return response()->json($profile);
    }
    
    public function getProfileDataByUserId($user_id)
    {
        $profile = UserProfile::where('user_id', $user_id)->get();

        if (!$profile) {
            $data = [
                'message' => 'Perfil no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'profile' => $profile,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////
 /*
Agregar info

 1- Se recibe el request con la ruta de la nueva imagen subida
 2- Se almacen la ruta
 3- Retornamos la ruta

 */

    public function postPhoto(Request $request){
        $photo_path = $request->file('photo_path')->store('public/files/users/' . $request->user_id . '/photo/');
        return $photo_path;
    }

    public function postIdentification(Request $request){
        $identification_path = $request->file('identification_path')->store('public/files/users/' . $request->user_id  . '/identification/'); 
        return $identification_path;
    }

    public function postCV(Request $request){
        $cv_path = $request->file('cv_path')->store('public/files/users/' . $request->user_id  . '/cv/');
        return $cv_path;
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////
 /*
Actualizar info

 1- Se recibe el request con la ruta de la nueva imagen subida y la ruta de la imagen actual desde el modelo profile.
 2- Valida que el path no este vacio para proceder a eliminar el anteriormente guardado.
 3- Elimina el anterior
 4- Retorna la nueva ruta

 */

 public function updatePhoto(Request $request, $profile){ //
    if($profile->photo_path <> ''){ 
        unlink($profile->photo_path);
    }
    $photo_path = $request->file('photo')->store('public/files/users/' . $request->user_id . '/photo/');  
    return $photo_path; 
}

public function updateIdentification(Request $request, $profile){
    if($profile->identification_path <> ''){
        unlink($profile->identification_path);
    }
    $identification_path = $request->file('identification_path')->store('public/files/users/' . $request->user_id . '/identification/'); 

    return $identification_path;
}

public function updateCV(Request $request, $profile){

    if($profile->cv_path <> ''){
        unlink($profile->cv_path);
    }
    $cv_path = $request->file('cv_path')->store('public/files/users/' . $request->user_id . '/cv/'); 

    return $cv_path;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function postProfileData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'description' => 'required|string',
            'age' => 'required|integer',
            'photo_path' => 'required|file|mimes:jpg,jpeg,png,avif,webp|max:2048', // Imagenes max 2MB
            'identification_path' => 'required|file|mimes:jpg,jpeg,png,avif,webp|max:2048', // Imagenes max 2MB
            'cv_path' => 'required|file|mimes:pdf|max:2048', // Solo PDF max 2MB
            'profession_id' => 'required|integer',
            'province_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $profile = UserProfile::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description,
            'age' => $request->age,
            'photo_path' => $this->postPhoto($request),
            'identification_path' => $this->postIdentification($request),
            'cv_path' => $this->postCV($request),
            'profession_id' => $request->profession_id,
            'province_id' => $request->profession_id,
            'user_id' => $request->user_id, // Deben enviar el id del usuario logueado.
        ]);

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
            'photo_path' => 'sometimes|required|file|mimes:jpg,jpeg,png,avif,webp|max:2048', // Imagenes max 2MB
            'identification_path' => 'sometimes|required|file|mimes:jpg,jpeg,png,avif,webp|max:2048', // Imagenes max 2MB
            'cv_path' => 'sometimes|required|file|mimes:pdf|max:2048', // Solo PDF max 2MB
            'profession_id' => 'sometimes|required|integer',
            'province_id' => 'sometimes|required|integer',
            'user_id' => 'sometimes|required|integer', // Deben enviar el id del usuario logueado.
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
            $profile->photo_path = $this->updatePhoto($request, $profile->photo_path);
        }

        if ($request->has('identification_path')) {
            $profile->identification_path = $this->updateIdentification($request, $profile->identification_path);
        }

        if ($request->has('cv_path')) {
            $profile->cv_path = $this->updateCV($request, $profile->cv_path);
        }

        if ($request->has('profession_id')) {
            $profile->profession_id = $request->profession_id;
        }

        if ($request->has('province_id')) {
            $profile->province_id = $request->province_id;
        }

        if ($request->has('user_id')) {
            $profile->user_id = $request->user_id;
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

