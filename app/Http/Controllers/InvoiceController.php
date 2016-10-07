<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request,
    App\Repositories\ClientRepository,
    App\Repositories\InvoiceRepository,
    App\Http\Requests,
    PDF;

class InvoiceController extends Controller
{
    private $_clientRepo;
    private $_productRepo;
    private $_invoiceRepo;

    public function __CONSTRUCT(
        ClientRepository $clientRepo,
        ProductRepository $productRepo,
        InvoiceRepository $invoiceRepo
    )
    {
        $this->_clientRepo = $clientRepo;
        $this->_productRepo = $productRepo;
        $this->_invoiceRepo = $invoiceRepo;
    }

    public function index()
    {
        return view(
            'invoice.index', [
                'model' => $this->_invoiceRepo->getAll()
            ]
        );
    }

    public function detail($id)
    {
        return view('invoice.detail', [
            'model' => $this->_invoiceRepo->get($id)
        ]);
    }

    public function pdf($id)
    {
        $model = $this->_invoiceRepo->get($id);
        $invoice_name = sprintf('comprobante-%s.pdf', str_pad ($model->id, 7, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('invoice.pdf', [
            'model' => $model
        ]);

        return $pdf->download($invoice_name);
    }

    public function add()
    {
        return view('invoice.add');
    }

    public function save(Request $req)
    {
        $data = (object)[
            'iva' => $req->input('iva'),
            'subTotal' => $req->input('subTotal'),
            'total' => $req->input('total'),
            'client_id' => $req->input('client_id'),
            'detail' => []
        ];

        foreach($req->input('detail') as $d){
            $data->detail[] = (object)[
                'product_id' => $d['id'],
                'quantity'   => $d['quantity'],
                'unitPrice'  => $d['price'],
                'total'      => $d['total']
            ];
        }

        return $this->_invoiceRepo->save($data);
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
