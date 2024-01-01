<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class AnalyticsController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $analyticsModel = new \App\Models\AnalyticsModel();
        $data = $analyticsModel->findAll();

        if (!empty($data)) {
            $response = [
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'No data found',
                'data' => []
            ];
        }

        return $this->respond($response);
    }

    public function create()
{
    $data = [
        'saldo_awal' => $this->request->getVar('saldo_awal'),
        'pemasukan' => $this->request->getVar('pemasukan'),
        'pengeluaran' => $this->request->getVar('pengeluaran'),
        'selisih' => $this->request->getVar('selisih'),
    ];

    $analyticsModel = new \App\Models\analyticsModel();
    $analyticsModel->save($data);

    $response = [
        'status' => 200,
        'messages' => 'Data berhasil ditambahkan',
        'data' => $data,
    ];

        return $this->respond($response);
    }

    // function untuk mengedit data
    public function update($id = null)
    {
        $analyticsModel = new \App\Models\analyticsModel();
        $user = $analyticsModel->find($id);
        if ($user) {
            $data = [
                'saldo_awal' => $this->request->getVar('saldo_awal'),
                'pemasukan' => $this->request->getVar('pemasukan'),
                'pengeluaran' => $this->request->getVar('pengeluaran'),
                'selisih' => $this->request->getVar('selisih')
            ];
            $proses = $analyticsModel->update($id, $data);
            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Data berhasil diubah',
                    'data' => $data,
                ];
            } else {
                $response = [
                    'status' => 500,
                    'messages' => 'Gagal diubah',
                ];
            }
            return $this->respond($response);
        }
        return $this->failNotFound('Data tidak ditemukan');
    }    

    // function untuk menghapus data
    public function delete($id = null)
    {
        $analyticsModel = new \App\Models\analyticsModel();
        $user = $analyticsModel->find($id);
        if ($user) {
            $proses = $analyticsModel->delete($id);
            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Data berhasil dihapus',
                ];
            } else {
                $response = [
                    'status' => 200,
                    'messages' => 'Gagal menghapus data',
                ];
            }
            return $this->respond($response);
        } else {
            return $this->failNotFound('Data tidak ditemukan');
        }
    }
}