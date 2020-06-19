<?php

namespace App\Http\Controllers;

use App\Invitation;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invitations = Invitation::mine()->get();


        return View('invitation.index', compact('invitations'));
    }
}
