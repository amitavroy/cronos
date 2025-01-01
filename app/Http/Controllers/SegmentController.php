<?php

namespace App\Http\Controllers;

use App\Domain\Segment\Models\Segment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class SegmentController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Segment::class);

        $segments = Segment::query()
            ->orderBy('name')
            ->paginate(10);

        return inertia('Segment/Index', [
            'segments' => $segments,
        ]);
    }

    public function create() {}

    public function store(Request $request) {}

    public function show(Segment $segment)
    {
        return $segment;
    }

    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
