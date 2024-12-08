<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Motorcycle;
use Illuminate\Support\Facades\Session;

class MotorcyclesController extends Controller
{
    public function motorcycles() {
        Session::put('page', 'motorcycles');
        $motorcycles = Motorcycle::get()->toArray();
        return view('admin.motorcycles.motorcycles')->with(compact('motorcycles'));
    }

    public function updateMotorcyclesStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else{
                $status = 1;
            }
            Motorcycle::where('id', $data['id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['id']]);
        }
    }

    public function addEditMotorcycles(Request $request, $id = null) {
        if($id=="") {
            $title = "Add Motorcycle";
            $motorcycles = new Motorcycle;
            $message = "Motorcycle added successfully";
        } else {
            $title = "Edit Motorcycle";
            $motorcycles = Motorcycle::find($id);
            $message = "Motorcycle updated successfully";
        }

        if($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'name' => 'required',
            ];

            $this->validate($request, $rules);

            if($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'frontend/images/motorcycles/' . $imageName;
                    $image_tmp->move(public_path('frontend/images/motorcycles'), $imageName);
    
                    if(!empty($motorcycles->image) && file_exists(public_path('frontend/images/motorcycles/' . $motorcycles->image))) {
                        unlink(public_path('frontend/images/motorcycles/' . $motorcycles->image));
                    }
    
                    $motorcycles->image = $imageName;
                }
            }

            $motorcycles->name = $data['name'];
            $motorcycles->price = $data['price'];
            $motorcycles->description = $data['description'];
            $motorcycles->engine_type = $data['engine_type'];
            $motorcycles->displacement = $data['displacement'];
            $motorcycles->top_speed = $data['top_speed'];
            $motorcycles->fuel_capacity = $data['fuel_capacity'];
            $motorcycles->status = 1;
            $motorcycles->save();
            return redirect('admin/motorcycles')->with('success_message', $message);
        }

        return view('admin.motorcycles.add_edit_motorcycles')->with(compact('title', 'motorcycles'));
    }

    public function deleteMotorcycle($id) {
        Motorcycle::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Motorcycle Successfully Deleted');
    }
}
