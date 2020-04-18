<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CarComponentLevelRepositoryInterface;
use App\Contracts\Repositories\CarComponentRepositoryInterface;
use App\Contracts\Repositories\UserCarComponentRepositoryInterface;
use App\Models\Entities\CarComponentEntity;
use App\Models\Entities\CarComponentGroupEntity;

/**
 * Class GridController
 * @package App\Http\Controllers
 */
class GridController extends Controller
{
    /**
     * @var CarComponentRepositoryInterface
     */
    protected $_carComponentRepository;

    /**
     * @var CarComponentLevelRepositoryInterface
     */
    protected $_carComponentLevelRepository;

    /**
     * @var UserCarComponentRepositoryInterface
     */
    protected $_userCarComponentRepository;

    /**
     * GridController constructor.
     * @param CarComponentRepositoryInterface $carComponentRepository
     * @param CarComponentLevelRepositoryInterface $carComponentLevelRepository
     * @param UserCarComponentRepositoryInterface $userCarComponentRepository
     */
    public function __construct(CarComponentRepositoryInterface $carComponentRepository,
                                CarComponentLevelRepositoryInterface $carComponentLevelRepository,
                                UserCarComponentRepositoryInterface $userCarComponentRepository)
    {
        $this->_carComponentRepository = $carComponentRepository;
        $this->_carComponentLevelRepository = $carComponentLevelRepository;
        $this->_userCarComponentRepository = $userCarComponentRepository;
    }

    /*
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function carComponents()
    {
        return view('car_components/car_component_grid_vue');
    }
}
