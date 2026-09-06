<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        $allData = Enquiry::with('roomType')->latest()->get();

        return view('admin.enquiries.index', compact('allData'));
    }

    public function show($id)
    {
        $data = Enquiry::with('roomType')->findOrFail($id);
        $data->update(['status' => $data->status === 'new' ? 'responded' : $data->status]);

        return view('admin.enquiries.show', compact('data'));
    }

    public function destroy($id)
    {
        $data = Enquiry::find($id);
        $data->delete();

        if ($data) {
            return redirect()->route('admin.enquiries.index')->with('danger', 'Data Deleted Successful.');
        } else {
            return redirect()->route('admin.enquiries.index')->with('error', 'Data Delete Failed.');
        }
    }
}
