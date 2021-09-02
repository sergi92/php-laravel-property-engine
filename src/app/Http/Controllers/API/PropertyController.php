<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Property;
use App\Http\Resources\Property as PropertyResource;

class PropertyController extends BaseController
{

    public function index()
    {
        $properties = Property::all();
        return $this->sendResponse(PropertyResource::collection($properties), 'Property fetched.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $property = Property::create($input);
        return $this->sendResponse(new PropertyResource($property), 'Property created.');
    }


    public function show($id)
    {
        $property = Property::find($id);
        if (is_null($property)) {
            return $this->sendError('Property does not exist.');
        }
        return $this->sendResponse(new PropertyResource($property), 'Property fetched.');
    }


    public function update(Request $request, Property $property)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $property->title = $input['title'];
        $property->description = $input['description'];
        $property->save();

        return $this->sendResponse(new PropertyResource($property), 'Property updated.');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return $this->sendResponse([], 'Property deleted.');
    }
}
