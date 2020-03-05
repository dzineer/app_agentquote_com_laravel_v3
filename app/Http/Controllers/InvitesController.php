<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InvitesController extends Controller
{
    const TOKEN_STRENGTH = 16;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $random_password = str_random(self::TOKEN_STRENGTH);

        $random_hash_1 = substr(md5(uniqid(rand(), true)), self::TOKEN_STRENGTH, self::TOKEN_STRENGTH); // 16 characters long
        $random_hash_2 = substr(md5(uniqid(rand(), true)), self::TOKEN_STRENGTH, self::TOKEN_STRENGTH); // 16 characters long
        $random_hash_3 = substr(md5(uniqid(rand(), true)), self::TOKEN_STRENGTH, self::TOKEN_STRENGTH); // 16 characters long
        $random_hash_4 = substr(md5(uniqid(rand(), true)), self::TOKEN_STRENGTH, self::TOKEN_STRENGTH); // 16 characters long

        $random_hash = $random_hash_1 . $random_hash_2 . $random_hash_3 . $random_hash_4;

        echo $random_hash;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
