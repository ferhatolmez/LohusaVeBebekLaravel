<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BebekFormRequest;
use App\Http\Resources\BebekFormResource;
use App\Models\BebekForm;
use App\Repositories\BebekFormRepository;
use App\Services\BebekFormService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BebekApiController extends Controller
{
    public function __construct(
        private readonly BebekFormRepository $repository,
        private readonly BebekFormService $service,
    ) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', BebekForm::class);

        return BebekFormResource::collection(
            $this->repository->apiPaginate($request->only(['q', 'cinsiyet', 'termin_durumu', 'izlem_min', 'muayene_from', 'muayene_to']))
        );
    }

    public function store(BebekFormRequest $request): JsonResponse
    {
        $this->authorize('create', BebekForm::class);

        $form = $this->service->store($request->validated(), $request->user()->id);

        return BebekFormResource::make($form)->response()->setStatusCode(201);
    }

    public function show(BebekForm $bebek): BebekFormResource
    {
        $this->authorize('view', $bebek);

        return BebekFormResource::make($bebek);
    }

    public function update(BebekFormRequest $request, BebekForm $bebek): BebekFormResource
    {
        $this->authorize('update', $bebek);

        return BebekFormResource::make($this->service->update($bebek, $request->validated(), $request->user()->id));
    }

    public function destroy(BebekForm $bebek): JsonResponse
    {
        $this->authorize('delete', $bebek);
        $this->service->destroy($bebek);

        return response()->json([], 204);
    }
}
