<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\PlanCreateRequest;
use App\Http\Requests\PlanUpdateRequest;
use App\Repositories\PlanRepository;
use App\Http\Controllers\Controller;
use App\Services\PlanService;

/**
 * Class PlansController.
 *
 * @package namespace App\Http\Controllers\Api;
 */
class PlansController extends Controller
{
    /**
     * @var PlanRepository
     */
    protected $repository;

        /**
     * @var PlanService
     */
    protected $service;

    /**
     * PlansController constructor.
     *
     * @param PlanRepository $repository
     * @param PlanValidator $validator
     */
    public function __construct(PlanRepository $repository, PlanService $servce)
    {
        $this->repository = $repository;
        $this->service  = $servce;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $result = $this->repository->all();

        return response()->json([
            'data' => $result,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PlanCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PlanCreateRequest $request)
    {
       $request = $this->service->store($request->all());

       if($request['success']){
           $result = $request['data'];
       }

       $result = null;

       return response()->json([
        'data' => $request,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->repository->find($id);
        return response()->json([
            'data' => $result,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = $this->repository->find($id);
        return view('plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PlanUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PlanUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $plan = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Plan updated.',
                'data'    => $plan->toArray(),
            ];

            return response()->json($response);
        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        return response()->json([
            'message' => 'Plan deleted.',
            'deleted' => $deleted,
        ]);
    }
}
