<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Bidding;
use App\Models\Tag;
use Illuminate\Http\Request;

class BiddingController extends BaseController
{

    protected $bidding = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Bidding $bidding)
    {
        $this->middleware('auth:api');
        $this->bidding = $bidding;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $biddings = $this->bidding->latest()->with('product', 'user')->paginate(10);

        return $this->sendResponse($biddings, 'Bidding list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bidding = $this->bidding->create([
            'bid' => $request->get('bid'),
            'user_id' => $request->get('user_id'),
            'product_id' => $request->get('product_id'),
        ]);

        return $this->sendResponse($bidding, 'Bidding Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bidding = $this->bidding->with(['product', 'user'])->findOrFail($id);

        return $this->sendResponse($bidding, 'Bidding Details');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bidding  $bidding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bidding = $this->bidding->findOrFail($id);

        $bidding->update($request->all());

        return $this->sendResponse($bidding, 'Bidding Information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $bidding = $this->bidding->findOrFail($id);

        $bidding->delete();

        return $this->sendResponse($bidding, 'Bidding has been Deleted');
    }
}
