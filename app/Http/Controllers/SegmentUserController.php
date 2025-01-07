<?php

namespace App\Http\Controllers;

use App\Domain\Segment\Models\Segment;
use Illuminate\Http\Request;

class SegmentUserController extends Controller
{
    public function index(Segment $segment)
    {
        $users = $segment->customers()->paginate(10);

        return inertia('SegmentUser/Index', [
            'segment' => $segment,
            'users' => $users,
        ]);
    }

    public function create() {}

    public function store(Request $request) {}

    public function show($id) {}

    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
