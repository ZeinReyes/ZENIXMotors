<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CMSPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CMSPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page', 'cms-pages');
        $CMSPages = CMSPage::get()->toArray();
        return view('admin.pages.cms_pages')->with(compact('CMSPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CMSPage $cMSPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id = null)
    {
        Session::put('page', 'cms-pages');
        if($id == "") {
            $title = "Add CMS Page";
            $cmspage = new CMSPage;
            $message = "CMS Page Successfully Added";
        } else{
            $title = "Edit CMS Page";
            $cmspage = CMSPage::find($id);
            $message = "CMS Page Successfully Updated";
        }

        if($request->isMethod('post')) {
            $data = $request->all();

            $rules =[
                'title' => 'required', 
                'url' => 'required',
                'description' => 'required',
            ];

            $customMessages = [
                'title.required' => 'Title is required',
                'url.required' => 'URL is required',
                'description.required' => 'description is required',
            ];
            $this->validate($request, $rules, $customMessages);

            $cmspage->title = $data['title'];
            $cmspage->url = $data['url'];
            $cmspage->description = $data['description'];
            $cmspage->meta_title = $data['meta_title'];
            $cmspage->meta_description = $data['meta_description'];
            $cmspage->meta_keywords = $data['meta_keywords'];
            $cmspage->status = 1;
            $cmspage->save();
            return redirect('admin/cms-pages')->with('success_message', $message);
        }

        return view('admin.pages.add_edit_cmspage')->with(compact('title', 'cmspage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else{
                $status = 1;
            }
            CMSPage::where('id', $data['page_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'page_id'=>$data['page_id']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        CMSPage::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'CMS Page Successfully Deleted');
    }
}
