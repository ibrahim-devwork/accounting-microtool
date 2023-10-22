<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Models\CsvToOfxConversion;

class HomeRepository {

    protected $csvToOfxConversion;

    public function __construct(CsvToOfxConversion $csvToOfxConversion)
    {
        $this->csvToOfxConversion = $csvToOfxConversion;
    }

    public function getAll() {
        $query = $this->csvToOfxConversion
                ->where('status', '2');
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
                ->where('name', 'like', '%' . $data['search'] . '%')
                ->where('status', '2');
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

}