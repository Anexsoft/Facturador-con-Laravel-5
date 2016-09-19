<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request,
    App\Repositories\ClientRepository,
    App\Http\Requests;

class InvoiceController extends Controller
{
    private $_clientRepo;
    private $_productRepo;

    public function __CONSTRUCT(
        ClientRepository $clientRepo,
        ProductRepository $productRepo
    )
    {
        $this->_clientRepo = $clientRepo;
        $this->_productRepo = $productRepo;
    }

    public function index()
    {
        return view('invoice.index');
    }

    public function add()
    {
        return view('invoice.add');
    }

    public function findClient(Request $req)
    {
        return $this->_clientRepo
                    ->findByName($req->input('q'));
    }

    public function findProduct(Request $req)
    {
        return $this->_productRepo
                    ->findByName($req->input('q'));
    }
}
