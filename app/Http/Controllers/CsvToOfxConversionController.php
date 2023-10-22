<?php

namespace App\Http\Controllers;

use App\Http\Requests\csvToOfxConversionRequest;
use App\Repositories\CsvToOfxConversionRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CsvToOfxConversionController extends Controller
{
    protected $userRepository;
    protected $csvToOfxConversionRepository;

    public function __construct(
        UserRepository $userRepository,
        CsvToOfxConversionRepository $csvToOfxConversionRepository
    ) {
        $this->userRepository               = $userRepository;
        $this->csvToOfxConversionRepository = $csvToOfxConversionRepository;
    }

    public function index() {
        try {
            $processList = $this->csvToOfxConversionRepository->getAll();
            return view('processList.processList', compact('processList'));
        
        } catch(\Exception $error) {
            Log::error('CsvToOfxConversionController - (index) : ' . $error->getMessage());
        }
    }

    public function search(csvToOfxConversionRequest $request) {
        try {

            $data        = $request->validated(); 
            $processList = $this->csvToOfxConversionRepository->getBySearch($data);
            return view('processList.processList', ['processList' => $processList, 'search' => $data['search']]);

        } catch(\Exception $error) {
            Log::error('CsvToOfxConversionController - (search) : ' . $error->getMessage());
        }
    }
    
    public function create() {
        try {
           
            $users = $this->userRepository->getUsersForDropDown();
            return view('processList.createProcess', compact('users'));
        
        } catch(\Exception $error) {
            Log::error('CsvToOfxConversionController - (create) : ' . $error->getMessage());
        }
    }

    public function store(csvToOfxConversionRequest $request) {
        try {
            
            $data  = $request->validated();
            $this->csvToOfxConversionRepository->store($data);
            $users = $this->userRepository->getUsersForDropDown();
            return redirect()->route('process-list.create')->with([
                'success' => 'Process created successfully',
                'users'   => $users
            ]);
        
        } catch(\Exception $error) {
            Log::error('CsvToOfxConversionController - (store) : ' . $error->getMessage());
        }
    }

    public function destroy($id) {
        try {
            
            $result = $this->csvToOfxConversionRepository->destroy($id);
            return redirect()->route('process-list')->with($result['type'], $result['message']);
        
        } catch(\Exception $error) {
            Log::error('CsvToOfxConversionController - (destroy) : ' . $error->getMessage());
        }
    }


}
