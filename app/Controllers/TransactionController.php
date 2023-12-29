<?php

// namespace App\Controllers;

// use CodeIgniter\API\ResponseTrait;
// use App\Models\TransactionModel;

// class TransactionController extends BaseController
// {
//     use ResponseTrait;

//     public function index()
//     {
//         $transactionModel = new TransactionModel();
//         $data = $transactionModel->findAll();

//         if (!empty($data)) {
//             return $this->respond(['status' => 'success', 'message' => 'Data retrieved successfully', 'data' => $data]);
//         } else {
//             return $this->respond(['status' => 'error', 'message' => 'No data found', 'data' => []]);
//         }
//     }

//     public function create()
//     {
//         $data = [
//             'tanggal_transaksi' => $this->request->getVar('tanggal_transaksi'),
//             'jumlah_transaksi' => $this->request->getVar('jumlah_transaksi'),
//             'struk' => $this->request->getVar('struk')
//         ];

//         $transactionModel = new Transactionodel();
//         $transactionModel->insert($data);

//         return $this->respondCreated([
//             'status' => 201,
//             'messages' => 'Data berhasil ditambahkan',
//             'data' => $data,
//         ]);
//     }

//     public function update($id = null)
//     {
//         $goalsModel = new GoalsModel();
//         $user = $goalsModel->find($id);

//         if ($user) {
//             $data = [
//                 'tanggal_transaksi' => $this->request->getVar('tanggal_transaksi'),
//                 'jumlah_transaksi' => $this->request->getVar('jumlah_transaksi'),
//                 'struk' => $this->request->getVar('struk')
//             ];

//             $proses = $goalsModel->update($id, $data);

//             if ($proses) {
//                 return $this->respond(['status' => 200, 'messages' => 'Data berhasil diubah', 'data' => $data]);
//             } else {
//                 return $this->respond(['status' => 500, 'messages' => 'Gagal diubah']);
//             }
//         }

//         return $this->failNotFound('Data tidak ditemukan');
//     }

//     public function delete($id = null)
//     {
//         $transactionModel = new TransactionModel();
//         $user = $transactionModel->find($id);

//         if ($user) {
//             $proses = $transactionModel->delete($id);

//             if ($proses) {
//                 return $this->respond(['status' => 200, 'messages' => 'Data berhasil dihapus']);
//             } else {
//                 return $this->respond(['status' => 500, 'messages' => 'Gagal menghapus data']);
//             }
//         } else {
//             return $this->failNotFound('Data tidak ditemukan');
//         }
//     }
// }


namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class TransactionController extends ResourceController
{

    protected $format = 'json';
    public function index()
    {
        $transactionModel = new \App\Models\TransactionModel();
        $data = $transactionModel->findAll();

        if (!empty($data)) {
            return $this->respond(['status' => 'success', 'message' => 'Data retrieved successfully', 'data' => $data]);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'No data found', 'data' => []]);
        }
    }

    // public function create()
    // {
    //     $data = [
    //         'nama_transaksi' => $this->request->getVar('nama_transaksi'),
    //         'tanggal_transaksi' => $this->request->getVar('tanggal_transaksi'),
    //         'jumlah_transaksi' => $this->request->getVar('jumlah_transaksi'),
    //         'struk' => $this->request->getFile('struk')
    //     ];

    //     $transactionModel = new \App\Models\TransactionModel();
    //     $transactionModel->insert($data);

    //     return $this->respondCreated([
    //         'status' => 201,
    //         'messages' => 'Data berhasil ditambahkan',
    //         'data' => $data,
    //     ]);
    // }
    public function create()
{
    $nama_transaksi = $this->request->getVar('nama_transaksi');
    $tanggal_transaksi = $this->request->getVar('tanggal_transaksi');
    $jumlah_transaksi = $this->request->getVar('jumlah_transaksi');
    $strukFile = $this->request->getFile('struk');

    // Validate and move the uploaded file
    if ($strukFile->isValid() && !$strukFile->hasMoved()) {
        // Generate a unique name for the file
        $newName = $strukFile->getRandomName();
        // Move the file to the uploads directory
        $strukFile->move(ROOTPATH . 'public/uploads/', $newName);

        // Create the full URL for the image
        $strukUrl = base_url('uploads/') . $newName;
    } else {
        // Handle file upload failure
        return $this->respond(['status' => 500, 'messages' => 'Failed to upload file']);
    }

    // Prepare data for insertion
    $data = [
        'nama_transaksi' => $nama_transaksi,
        'tanggal_transaksi' => $tanggal_transaksi,
        'jumlah_transaksi' => $jumlah_transaksi,
        'struk' => $strukUrl // Include the URL in the data
    ];

    // Insert data into the database
    $transactionModel = new \App\Models\TransactionModel();
    $transactionModel->insert($data);

    // Include the image URL in the response data
    $data['struk'] = base_url('uploads/') . $newName;

    // Respond with the created data
    return $this->respondCreated([
        'status' => 201,
        'messages' => 'Data berhasil ditambahkan',
        'data' => $data,
    ]);
}


    public function update($id = null)
    {
        $transactionModel = new \App\Models\TransactionModel();
        $user = $transactionModel->find($id);

        if ($user) {
            $data = [
                'nama_transaksi' => $this->request->getVar('nama_transaksi'),
                'tanggal_transaksi' => $this->request->getVar('tanggal_transaksi'),
                'jumlah_transaksi' => $this->request->getVar('jumlah_transaksi'),
                'struk' => $this->request->getFile($strukUrl)
            ];

            $proses = $transactionModel->update($id, $data);

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
        $transactionModel = new \App\Models\TransactionModel();
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