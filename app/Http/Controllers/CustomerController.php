<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Question;
use App\Models\Results;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers');
    }

    public function table()
    {
        return DataTables::of(Customer::all())->setTransformer(function ($value) {

            return [
                'id'         => $value->id,
                'name'       => $value->name,
                'created_at' => Carbon::parse($value->created_at)->format('F j, Y'),
                'edit_link'  => route('customers.show',['customer' => $value->id]),
            ];
        })->make(true);
    }

    public function form()
    {
        $questions = Question::query()
            ->get()
            ->transform(function ($value) {
                $value->choice = false;
                return $value;
            });

        return view('asses-form', compact('questions'));
    }

    public function submit(Request $request)
    {
        $customer = Customer::create([
            "name"      => $request->overview['name'],
            "address"   => $request->overview['address'],
            "birthdate" => $request->overview['birthdate'],
            "temp"      => $request->overview['temp'],
            "gender"    => $request->overview['gender'],
            "phone"     => $request->overview['phone'],
        ]);

        foreach($request->questions as $value) {
            Results::create([
                'customer_id' => $customer->id,
                'question_id' => $value['id'],
                'question' => $value['question'],
                'choice' => $value['choice']
            ]);
        }

        return ['success' => true];
    }

    public function show($id)
    {
        $details = Customer::query()->where('id', $id)->get()[0];
        $results = Results::query()->where('customer_id', $id)->get();

        return view('customers-result', compact('details', 'results'));
    }
}
