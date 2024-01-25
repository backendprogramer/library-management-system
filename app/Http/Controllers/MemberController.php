<?php

namespace App\Http\Controllers;

use App\Http\Requests\Member\SearchMemberRequest;
use App\Http\Requests\Member\StoreMemberRequest;
use App\Http\Requests\Member\UpdateMemberRequest;
use App\Http\Services\MemberService;
use App\Models\Member;

class MemberController extends Controller
{

    public function __construct(private $memberService = new MemberService()) {}
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->memberService->showAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        return $this->memberService->addMember($request);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        return $this->memberService->editMember($member, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        return $this->memberService->deleteMember($member);
    }

    /**
     * Search for resource in storage.
     */
    public function search(SearchMemberRequest $request)
    {
        return $this->memberService->searchMember($request);
    }
}