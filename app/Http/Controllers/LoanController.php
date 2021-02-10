<?php

namespace App\Http\Controllers;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
    	$loans = Loan::all()->toArray();
        return array_reverse($loans);
    }

    public function store(Request $request) {
    	$newloan = new Loan;
    	$newloan->name = $request['name'];
		$newloan->bank = $request['bank'];
		$newloan->amount = $request['amount'];
		$newloan->save();
		return $newloan;    	
    }

    public function edit($id) {
    	$loan = Loan::find($id);
    	if ($loan) {
    		return $loan;
    	}
    	return "Loan request not found.";
    }

    public function update(Request $request, $id) {
    	$loan = Loan::find($id);
    	if ($loan) {
		   	$loan->name = $request['name'];
	    	$loan->bank = $request['bank'];
	    	$loan->amount = $request['amount'];
	    	$loan->save();
	    	return "Loan updated successfully.";
    	}
    	return "Loan item not found.";
    }

    public function destroy($id) {
    	$loan = Loan::find($id);
    	if ($loan) {
    		$loan->delete();
    		return "Loan deleted successfully.";
    	}
    	return "Long request not found.";
    }
}
