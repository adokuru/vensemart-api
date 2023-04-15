<?php

namespace App\Http\Controllers\API;

use App\Models\BankDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class BankDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_banks()
    {
        $banks = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY')
        ])->get('https://api.paystack.co/bank?currency=NGN');
        $data = $banks->json();
        if ($data['status'] == false) {
            return response()->json([
                'success' => false,
                'message' => $data['message'],
                'data' => null
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Bank List',
            'data' => $data['data']
        ]);
    }

    public function getBankAccountName(Request $request)
    {
        $request->validate([
            'bank_code' => 'required',
            'account_number' => 'required'
        ]);

        $bank = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY')
        ])->get(
            'https://api.paystack.co/bank/resolve?account_number=' . $request->account_number . '&bank_code=' . $request->bank_code,
        );

        $data = $bank->json();


        if ($data['status'] == false) {
            return response()->json([
                'success' => false,
                'message' => $data['message'],
                'data' => null
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Bank Account Name',
            'data' => $data['data']
        ]);
    }

    public function addBankDetails(Request $request)
    {
        $request->validate([
            'account_name' => 'required',
            'account_number' => 'required',
            'bank_code' => 'required',
        ]);

        if (BankDetails::where('account_number', $request->account_number)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Bank Details Already Exists',
                'data' => null
            ]);
        }

        //    get bank name from paystack
        $banks = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY')
        ])->get('https://api.paystack.co/bank?currency=NGN');
        $data = $banks->json();

        $bank_name = '';

        foreach ($data['data'] as $bank) {
            if ($bank['code'] == $request->bank_code) {
                $bank_name = $bank['name'];
            }
        }

        if ($bank_name == '') {
            return response()->json([
                'hasError' => true,
                'message' => 'Invalid Bank Code',
                'data' => null
            ]);
        }



        $request->merge([
            'bank_name' => $bank_name
        ]);


        $bank = BankDetails::create([
            'bank' => $request->bank_name,
            'account_holder_name' => $request->account_name,
            'account_number' => $request->account_number,
            'user_id' => auth()->user()->id,
            'micro_code' => $request->bank_code
        ]);

        if ($bank) {
            return response()->json([
                'success' => true,
                'message' => 'Bank Details Added Successfully',
                'data' => $bank
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Error Adding Bank Details',
            'data' => null
        ]);
    }

    public function getBankDetails()
    {

        $user_id = auth()->user()->id;

        $bank = BankDetails::where('user_id', $user_id)->get();

        if ($bank) {
            return response()->json([
                'hasError' => false,
                'message' => 'Bank Details',
                'data' => $bank
            ]);
        }
        return response()->json([
            'hasError' => true,
            'message' => 'No Bank Details Found',
            'data' => null
        ]);
    }

    public function updateBankDetails(Request $request, $id)
    {
        $request->validate([
            'bank_name' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
            'user_id' => 'required',
            'bank_code' => 'required'
        ]);

        $bank = BankDetails::where('user_id', $request->user_id)->update([
            'bank_name' => $request->bank_name,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'bank_code' => $request->bank_code
        ]);

        if ($bank) {
            return response()->json([
                'hasError' => false,
                'message' => 'Bank Details Updated Successfully',
                'data' => $bank
            ]);
        }
        return response()->json([
            'hasError' => true,
            'message' => 'Error Updating Bank Details',
            'data' => null
        ]);
    }

    public function deleteBankDetails(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $id = $request->id;
        $bank = BankDetails::where('id', $id)->delete();

        if ($bank) {
            return response()->json([
                'hasError' => false,
                'message' => 'Bank Details Deleted Successfully',
                'data' => $bank
            ]);
        }
        return response()->json([
            'hasError' => true,
            'message' => 'Error Deleting Bank Details',
            'data' => null
        ]);
    }
}