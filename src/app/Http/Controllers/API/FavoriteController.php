<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Favorite;
use App\Http\Resources\Favorite as FavoriteResource;

class FavoriteController extends BaseController
{

    public function index()
    {
        $favorites = Favorite::all();
        return $this->sendResponse(FavoriteResource::collection($favorites), 'Favorites fetched.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'userId' => 'required',
            'propertiesId' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $favorite = Favorite::create($input);
        return $this->sendResponse(new FavoriteResource($favorite), 'Favorite created.');
    }


    public function show($id)
    {
        $favorite = Favorite::find($id);
        if (is_null($favorite)) {
            return $this->sendError('Favorite does not exist.');
        }
        return $this->sendResponse(new FavoriteResource($favorite), 'Favorite fetched.');
    }


    public function update(Request $request, Favorite $favorite)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'userId' => 'required',
            'propertiesId' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $favorite->title = $input['userId'];
        $favorite->description = $input['propertiesId'];
        $favorite->save();

        return $this->sendResponse(new FavoriteResource($favorite), 'Favorite updated.');
    }

    public function destroy(Favorite $favorite)
    {
        $favorite->delete();
        return $this->sendResponse([], 'Favorite deleted.');
    }
}
