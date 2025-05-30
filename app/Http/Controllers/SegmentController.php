<?php

namespace App\Http\Controllers;

use App\Domain\Segment\Models\Segment;
use App\Domain\Segment\Services\SegmentRuleService;
use App\Http\Requests\SegmentRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class SegmentController extends Controller
{
    use AuthorizesRequests;

    public function index(): Response|ResponseFactory
    {
        $this->authorize('viewAny', Segment::class);

        $segments = Segment::query()
            ->orderByDesc('id')
            ->paginate(10);

        return inertia('Segment/Index', [
            'segments' => $segments,
        ]);
    }

    public function create(): Response|ResponseFactory
    {
        $this->authorize('create', Segment::class);

        return inertia('Segment/Create');
    }

    public function store(SegmentRequest $request): RedirectResponse
    {
        $this->authorize('create', Segment::class);

        Segment::create(array_merge(
            $request->validated(),
            ['rules' => []] // keeping the rules empty for now
        ));

        return redirect()->route('segment.index');
    }

    public function show(
        Segment $segment,
        SegmentRuleService $segmentRuleService
    ): Response|ResponseFactory {
        $rules = $segmentRuleService->getRuleNames();

        return inertia('Segment/Show', [
            'segment' => $segment,
            'rules' => $rules,
        ]);
    }

    public function update(Request $request, Segment $segment): RedirectResponse
    {
        $postData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'rules' => 'sometimes|array',
            'is_active' => 'required|boolean',
        ]);

        Segment::where('id', $segment->id)
            ->update($postData);

        return redirect()->route('segment.show', ['segment' => $segment->id]);
    }

    public function destroy(Segment $segment): void {}
}
