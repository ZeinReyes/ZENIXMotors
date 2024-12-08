<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accessory;
use Illuminate\Support\Facades\Session;

class AccessoriesController extends Controller
{
    public function accessories() {
        Session::put('page', 'accessories');
        $accessories = Accessory::get()->toArray();
        return view('admin.accessories.accessories')->with(compact('accessories'));
    }

    public function updateAccessoriesStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else{
                $status = 1;
            }
            Accessory::where('id', $data['id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['id']]);
        }
    }

    public function addEditAccessories(Request $request, $id = null) {
        if($id == "") {
            $title = "Add Accessories";
            $accessories = new Accessory;
            $message = "Accessory added successfully";
        } else {
            $title = "Edit Accessories";
            $accessories = Accessory::find($id);
            $message = "Accessory updated successfully";
        }
    
        if($request->isMethod('post')) {
            $data = $request->all();
    
            $rules = [
                'name' => 'required',
                'price' => 'required|numeric',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ];
    
            $this->validate($request, $rules);

            if($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'frontend/images/accessories/' . $imageName;
                    $image_tmp->move(public_path('frontend/images/accessories'), $imageName);
    
                    // Delete the old image if editing
                    if(!empty($accessories->image) && file_exists(public_path('frontend/images/accessories/' . $accessories->image))) {
                        unlink(public_path('frontend/images/accessories/' . $accessories->image));
                    }
    
                    $accessories->image = $imageName;
                }
            }
    
            $accessories->name = $data['name'];
            $accessories->price = $data['price'];
            $accessories->description = $data['description'];
            $accessories->status = 1;
            $accessories->save();
            return redirect('admin/accessories')->with('success_message', $message);
        }
    
        return view('admin.accessories.add_edit_accessories')->with(compact('title', 'accessories'));
    }
    

    public function deleteAccessory($id) {
        Accessory::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Accessory Successfully Deleted');
    }

    // Add to Cart Functionality
    public function addToCart(Request $request) {
        $accessory = Accessory::findOrFail($request->accessory_id);

        // Get the cart from the session or create a new one
        $cart = session()->get('cart', []);

        // Check if the accessory is already in the cart
        if (isset($cart[$accessory->id])) {
            $cart[$accessory->id]['quantity'] += $request->quantity; // Increase the quantity
        } else {
            // Add new accessory to the cart
            $cart[$accessory->id] = [
                'name' => $accessory->name,
                'description' => $accessory->description,
                'price' => $accessory->price,
                'quantity' => $request->quantity,
                'image' => $accessory->image
            ];
        }

        // Save the cart back to the session
        session()->put('cart', $cart);

        // Return a response
        return redirect()->route('cart.index')->with('success_message', 'Accessory added to cart');
    }
}
