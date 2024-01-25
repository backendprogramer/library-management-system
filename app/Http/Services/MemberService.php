<?php

namespace App\Http\Services;

use App\Http\Resources\MemberResource;
use App\Http\Resources\PaginationCollection;
use App\Models\Member;
use Illuminate\Support\Facades\Log;

class MemberService
{
    /**
     * Display a listing of the Members.
     */
    public function showAll()
    {
        try {
            $members = Member::paginate(10);

            return $this->returnResponse($members);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception, 'showAll');
        }
    }

    /**
     * Store a newly created Member in storage.
     */
    public function addMember($request)
    {
        try {
            $member = Member::create($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Member added successfully',
                'book' => new MemberResource($member),
            ]);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception, 'add');
        }
    }

    /**
     * Update the specified Member in storage.
     */
    public function editMember($member, $request)
    {
        try {
            $member->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Member updated successfully',
                'member' => new MemberResource($member),
            ]);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception, 'edit');
        }
    }

    /**
     * Remove the specified Member from storage.
     */
    public function deleteMember($member)
    {
        try {
            Member::whereId($member->id)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Member deleted successfully',
            ]);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception, 'delete');
        }
    }

    /**
     * Member search by name and email
     */
    public function searchMember($request)
    {
        try {
            $member = Member::query();

            $fields = ['name', 'email'];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    $member = Member::where($field, 'like', '%'.$request->get($field).'%');
                }
            }

            $members = $member->paginate(10);

            return $this->returnResponse($members);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception, 'search');
        }
    }

    /**
     * Response for error catch section
     */
    private function errorResponse($exception, $nameMethode)
    {
        // Save Erorr In Laravel Log File
        Log::error('error in '.$nameMethode.'Member method in MemberService: '.$exception->getMessage()." \n".$exception);

        // Return Responce Error
        return response()->json([
            'status' => 'error',
            'message' => 'Member '.$nameMethode.' Unsuccessfully!',
        ], 500);
    }

    /**
     * Response for showAll and seachMember methods
     */
    private function returnResponse($members)
    {
        return response()->json([
            'status' => 'success',
            'data' => MemberResource::collection($members),
            'links' => new PaginationCollection($members),
        ]);
    }
}
