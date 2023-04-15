<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\SendContactEmail;
use App\Models\User;
use App\Models\UserVerifiedInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class NewRoutesController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Hello from new routes'
        ]);
    }

    public function VerifyNumber(Request $request)
    {
        try {
            $request->validate([
                'number' => 'required|numeric'
            ]);


            return $this->validateNumber($request->number);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function service_online_status(Request $request)
    {
        try {
            $request->validate([
                'number' => 'required|numeric',
            ]);

            $users = User::where('mobile', $request->number)->first();

            if ($users) {
                $users->is_online = 1;
                $users->status = 1;
                $users->save();
                return $this->sendResponse('User online status updated successfully', 200);
            } else {
                return $this->sendError('User not found', 404);
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function service_offline_status(Request $request)
    {
        try {
            $request->validate([
                'number' => 'required|numeric',
            ]);

            $users = User::where('mobile', $request->number)->first();

            if ($users) {
                $users->is_online = 0;
                $users->save();
                return $this->sendResponse('User offline status updated successfully');
            } else {
                return $this->sendError('User not found', 404);
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function send_support_message(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required'
            ]);

            $data = [
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message
            ];

            Mail::to('info@vensemart.com')->send(new SendContactEmail($data));

            return $this->sendResponse('Email sent successfully', $data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }


    public function test_notification(Request $request)
    {
        try {
            $request->validate([
                'number' => 'required|numeric',
                'message' => 'required',
                'title' => 'required'
            ]);

            $users = User::where('mobile', $request->number)->first();

            if ($users) {
                $this->sendNotification($users->id, $request->title, $request->message);
                return $this->sendResponse('Notification sent successfully');
            } else {
                return $this->sendError('User not found', 404);
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }


    public function bvn_verification(Request $request)
    {
        try {
            $request->validate([
                'bvn' => 'required|numeric',
                'number' => 'required|numeric'
            ]);

            $user = User::where('mobile', $request->number)->first();

            if ($user) {
                $bvnNumber = $this->verifyBvn($request->bvn, $user->id);
                if (!$bvnNumber) {
                    return $this->sendError('BVN verification failed', 404);
                }

                if ($bvnNumber == $user->mobile) {
                    $user->is_online = 1;
                    $user->status = 1;
                    $user->is_phone_verified = 1;
                    $user->save();
                    return $this->sendResponse('BVN verified successfully', 1);
                } else {
                    $otp = rand(1000, 9999);
                    $user->otp = $otp;
                    $user->save();

                    $phone_Number = +234. substr($bvnNumber, -10);
                    $message = "Your Vensemart bvn authentication code is " . $otp . ". Please do not share this code with anyone. This code expires in 5 mins.";
                    $this->sendSMSMessage(intVal($phone_Number), $message);
                    return $this->sendResponse('Verify your number first', intVal($phone_Number));
                }
            } else {
                return $this->sendError('User not found', 404);
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }


    protected function verifyBvn($bvn, $user_id)
    {
        $User = User::find($user_id);
        if (!$User) {
            throw new \Exception('User not found');
        }
        // BVN Checks
        $bvn_exits = UserVerifiedInfo::where('user_id', $user_id)->first();

        if ($bvn_exits) {
            throw new \Exception('Verification in Progress');
        }

        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'AppId' => getenv("DOJAH_APP_KEY"),
            'Authorization' => getenv("DOJAH_API_KEY")
        ])->get('https://api.dojah.io/api/v1/kyc/bvn/full?bvn=' . $bvn);
        $response = $request->json();

        // check if bvn is valid
        if (array_key_exists('error', $response)) {
            throw new \Exception($response['error']);
        }

        // check if bvn is matches
        if ($response['entity']['bvn'] == $bvn) {
            $User->bvn = $bvn;
            $User->bvn_phone_number = $response['entity']['phone_number1'];
            $User->save();

            UserVerifiedInfo::create([
                'user_id' => $user_id,
                'data' => json_encode($response['entity']),
            ]);
            return $response['entity']['phone_number1'];
        }

        throw new \Exception('BVN not found');
    }

    public function verifybvnOTP(Request $request)
    {
        try {
            $request->validate([
                'number' => 'required|numeric',
                'otp' => 'required|numeric'
            ]);

            $user = User::where('mobile', $request->number)->first();

            if ($user) {
                if ($user->otp == $request->otp) {
                    $user->is_online = 1;
                    $user->status = 1;
                    $user->is_phone_verified = 1;
                    $user->save();
                    return $this->sendResponse('BVN verified successfully', 1);
                } else {
                    return $this->sendError('Invalid OTP', 404);
                }
            } else {
                return $this->sendError('User not found', 404);
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function delete_account(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric'
        ]);

        $user = User::find($request->user_id);

        if ($user) {
            $this->deleteUserAccount($user->id);
            return $this->sendResponse('Account deleted successfully');
        } else {
            return $this->sendError('User not found', 404);
        }
    }
}