<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\TransactionModel;

class TransactionController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $transactionModel = new TransactionModel();
        $data = $transactionModel->findAll();

        if (!empty($data)) {
            return $this->respond(['status' => 'success', 'message' => 'Data retrieved successfully', 'data' => $data]);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'No data found', 'data' => []]);
        }
    }

    public function create()
    {
        $data = [
            'tanggal_transaksi' => $this->request->getVar('tanggal_transaksi'),
            'jumlah_transaksi' => $this->request->getVar('jumlah_transaksi'),
            'struk' => $this->request->getVar('struk')
        ];

        $transactionModel = new Transactionodel();
        $transactionModel->insert($data);

        return $this->respondCreated([
            'status' => 201,
            'messages' => 'Data berhasil ditambahkan',
            'data' => $data,
        ]);
    }

    public function update($id = null)
    {
        $goalsModel = new GoalsModel();
        $user = $goalsModel->find($id);

        if ($user) {
            $data = [
                'tanggal_transaksi' => $this->request->getVar('tanggal_transaksi'),
                'jumlah_transaksi' => $this->request->getVar('jumlah_transaksi'),
                'struk' => $this->request->getVar('struk')
            ];

            $proses = $goalsModel->update($id, $data);

            if ($proses) {
                return $this->respond(['status' => 200, 'messages' => 'Data berhasil diubah', 'data' => $data]);
            } else {
                return $this->respond(['status' => 500, 'messages' => 'Gagal diubah']);
            }
        }

        return $this->failNotFound('Data tidak ditemukan');
    }

    public function delete($id = null)
    {
        $transactionModel = new TransactionModel();
        $user = $transactionModel->find($id);

        if ($user) {
            $proses = $transactionModel->delete($id);

            if ($proses) {
                return $this->respond(['status' => 200, 'messages' => 'Data berhasil dihapus']);
            } else {
                return $this->respond(['status' => 500, 'messages' => 'Gagal menghapus data']);
            }
        } else {
            return $this->failNotFound('Data tidak ditemukan');
        }
    }
}
