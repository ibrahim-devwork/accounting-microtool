<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Jobs\ConvertOfxToCsvJob;
use App\Models\CsvToOfxConversion;

class CsvToOfxConversionRepository {

    protected $csvToOfxConversion;

    public function __construct(CsvToOfxConversion $csvToOfxConversion)
    {
        $this->csvToOfxConversion = $csvToOfxConversion;
    }

    public function getAll() {
        $query = $this->csvToOfxConversion;
        if(auth()->user()->role === 'User') {
            $query = $query
                ->where('user_id', auth()->user()->id)
                ->with('user');
        }
        $query = $query
                ->select()
                ->orderBy('updated_at', 'desc')
                ->paginate(Helper::COUNT_PER_PAGE);

        return $query;
    }

    public function getBySearch($data) {
        $query = $this->csvToOfxConversion
                ->where('name', 'like', '%' . $data['search'] . '%');
        if(auth()->user()->role === 'User') {
            $query = $query
                ->where('user_id', auth()->user()->id)
                ->with('user');
        }
        $query = $query
                ->select()
                ->orderBy('updated_at', 'desc')
                ->paginate(Helper::COUNT_PER_PAGE);

        return $query;
    }

    public function getById($id) {
        // return $this->user->where('role', 'User')->find($id);
    }

    public function store($data) {

        $csvToOfxConversion                 = new $this->csvToOfxConversion;
        $csvToOfxConversion->name           = $data['name'];
        $csvToOfxConversion->ofx_file_name  = Helper::saveFile($data['ofx_file']);
        if(auth()->user()->role == 'Admin') {
            $csvToOfxConversion->user_id    = $data['user_id'];
        } else {
            $csvToOfxConversion->user_id    = auth()->user()->id;
        }
        $csvToOfxConversion->save();

        ConvertOfxToCsvJob::dispatch($csvToOfxConversion->id);

        return $csvToOfxConversion;
    }

    public function destroy($id) {

        $user  =  $this->csvToOfxConversion->find($id);
        if($user && $user->status != 1) {
            $user->delete();
            return ['type' => 'success', 'message' => 'Process deleted successfully'];
        }

        if($user && $user->status == 1) {
            return ['type' => 'warning', 'message' => "This process cannot be deleted because it is in progress"];
        }

        return ['type' => 'error', 'message' => "This process not found !"];

    }

}