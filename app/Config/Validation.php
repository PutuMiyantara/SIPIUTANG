<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules User
    // --------------------------------------------------------------------

	public $login = [
		'username' => 'required',
		'password' => 'required|min_length[8]',
	];
	public $login_errors = [
		'username' => [
			'required' => 'Username Masih Kosong'
		],
		'password' => [
			'required' => 'Password Masih Kosong', 'min_length' => 'Password Minimal 8 Karakter'
		]
	];

    public $usertext = [
		'username' => 'required',
		'password' => 'required|min_length[8]',
		'repass' => 'required|matches[password]',
		'role' => 'required',
		'status' => 'required',
		'nama' => 'required',
	];
	public $usertext_errors = [
		'username' => [
			'required' => 'Username Masih Kosong'
		],
		'password' => [
			'required' => 'Password Masih Kosong', 'min_length' => 'Password Minimal 8 Karakter'
		],
		'repass' => [
			'required' => 'Verifikasi Password Masih Kosong', 
            'matches' => 'Password dan Repeat Password Berbeda'
		],
		'role' => [
			'required' => 'Role Masih Kosong'
		],
		'status' => [
			'required' => 'Status Masih Kosong'
		],
		'nama' => [
			'required' => 'Nama Masih Kosong'
		]
	];

	public $userfoto = [
		'file' => 'uploaded[file]|max_size[file,1024]|mime_in[file,image/jpg,image/jpeg,image/png]'
	];
	public $userfoto_errors = [
		'file' => [
			'uploaded' => 'Foto Belum Dipilih',
			'max_size' => 'Max Size [1Mb]',
			'mime_in' => 'Format Foto Didukung[jpg/jpeg]'
		]
	];

    public $userEdit = [
		'username' => 'required',
		'role' => 'required',
		'status' => 'required',
		'nama' => 'required',
	];
	public $userEdit_errors = [
		'username' => [
			'required' => 'Email Masih Kosong'
		],
		'role' => [
			'required' => 'Role Masih Kosong'
		],
		'status' => [
			'required' => 'Status Masih Kosong'
		],
		'nama' => [
			'required' => 'Nama Masih Kosong'
		]
	];

	public $customertext = [
		'nama_cstmr' => 'required',
		'alamat_cstmr' => 'required',
		'id_bank' => 'required',
		'rekening' => 'required',
		'ktp' => 'required',
		'telepon' => 'required',
		'email' => 'required',
		'atas_nama' => 'required',
		'nama_usaha' => 'required',
	];
	public $customertext_errors = [
		'nama_cstmr' => [
			'required' => 'Nama Masih Kosong'
		],
		'alamat_cstmr' => [
			'required' => 'Alamat Masih Kosong'
		],
		'id_bank' => [
			'required' => 'Nama Bank Masih Kosong'
		],
		'rekening' => [
			'required' => 'No Rek Masih Kosong'
		],
		'ktp' => [
			'required' => 'No KTP Masih Kosong'
		],
		'telepon' => [
			'required' => 'No Telepon Masih Kosong'
		],
		'email' => [
			'required' => 'Email Masih Kosong'
		],
		'atas_nama' => [
			'required' => 'Atas Nama Masih Kosong'
		],
		'nama_usaha' => [
			'required' => 'Nama Usaha Masih Kosong'
		]
	];

	public $invoicetext = [
		// 'no_invoice' => 'required',
		'tgl_invoice' => 'required',
		'termin' => 'required',
		'jth_tmpo' => 'required',
		'nilai_invoice' => 'required|numeric',
		'sisa_hutang' => 'required',
		'id_customer' => 'required',
		'ket_invoice' => 'required',
	];
	public $invoicetext_errors = [
		// 'no_invoice' => [
		// 	'required' => 'No Invoice Masih Kosong',
		// ],
		'tgl_invoice' => [
			'required' => 'Tanggal Invoice Masih Kosong'
		],
		'termin' => [
			'required' => 'Termin Masih Kosong'
		],
		'jth_tmpo' => [
			'required' => 'Tanggal Invoice Masih Kosong'
		],
		'nilai_invoice' => [
			'required' => 'No KTP Masih Kosong',
			'numberic' => 'Masukan Angka'
		],
		'sisa_hutang' => [
			'required' => 'Sisa Hutang Masih Kosong'
		],
		'id_customer' => [
			'required' => 'Nama Customer Masih Kosong'
		],
		'ket_invoice' => [
			'required' => 'Keterangan Invoice Masih Kosong'
		]
	];

	public $invoicetextupdate = [
		'no_invoice' => 'required',
		'tgl_invoice' => 'required',
		'termin' => 'required',
		'jth_tmpo' => 'required',
		'id_customer' => 'required',
		'ket_invoice' => 'required',
	];
	public $invoicetextupdate_errors = [
		'no_invoice' => [
			'required' => 'No Invoice Masih Kosong',
		],
		'tgl_invoice' => [
			'required' => 'Tanggal Invoice Masih Kosong'
		],
		'termin' => [
			'required' => 'Termin Masih Kosong'
		],
		'jth_tmpo' => [
			'required' => 'Tanggal Invoice Masih Kosong'
		],
		'id_customer' => [
			'required' => 'Nama Customer Masih Kosong'
		],
		'ket_invoice' => [
			'required' => 'Keterangan Invoice Masih Kosong'
		]
	];

	public $paymenttext = [
		'no_payment' => 'required',
		'nominal_payment' => 'required',
		'tgl_pembayaran' => 'required',
		'id_rekening_penerima' => 'required',
	];
	public $paymenttext_errors = [
		'no_payment' => [
			'required' => 'Nomor Payment Masih Kosong',
		],
		'nominal_payment' => [
			'required' => 'Nominal Masih Kosong',
		],
		'tgl_pembayaran' => [
			'required' => 'Tanggal Pembayaran Masih Kosong'
		],
		'id_rekening_peneima' => [
			'required' => 'Rekening Penerima Masih Kosong'
		]
	];

	public $file_bukti_tf = [
		'file_bukti_tf' => 'uploaded[file]|max_size[file,1024]|mime_in[file,image/jpg,image/jpeg,image/png]'
	];
	public $file_bukti_tf_errors = [
		'file_bukti_tf' => [
			'uploaded' => 'Foto Belum Dipilih',
			'max_size' => 'Max Size [1Mb]',
			'mime_in' => 'Format Foto Didukung[jpg/jpeg]'
		]
	];

	public $returtext = [
		'no_retur' => 'required',
		'tgl_retur' => 'required',
		'nilai_retur' => 'required',
	];
	public $returtext_errors = [
		'no_retur' => [
			'required' => 'Nomor Retur Masih Kosong',
		],
		'tgl_retur' => [
			'required' => 'Tanggal Retur Masih Kosong'
		],
		'nilai_retur' => [
			'required' => 'Nilai Retur Ekspedisi Masih Kosong'
		]
	];

	public $returtextupdate = [
		'no_retur' => 'required',
		'tgl_retur' => 'required',
	];
	public $returtextupdate_errors = [
		'no_retur' => [
			'required' => 'Nomor Retur Masih Kosong',
		],
		'tgl_retur' => [
			'required' => 'Tanggal Retur Masih Kosong'
		]
	];

	public $paymenttextupdate = [
		'id_rekening_penerima' => 'required',
	];
	public $paymenttextupdate_errors = [
		'id_rekening_penerima' => [
			'required' => 'Nama Rekening Penerima Masih Kosong',
		]
	];

	public $banktext = [
		'nama_bank' => 'required',
		'alias' => 'required',
	];
	public $banktext_errors = [
		'nama_bank' => [
			'required' => 'Nama Bank Masih Kosong'
		],
		'alias' => [
			'required' => 'Alias Masih Kosong'
		]
	];

	public $rekeningpenerimatext = [
		'nama_rekening' => 'required',
		'nomor_rekening' => 'required',
		'keterangan' => 'required',
		'id_bank_penerima' => 'required',
	];
	public $rekeningpenerimatext_errors = [
		'nama_rekening' => [
			'required' => 'Nama Rekening Penerima Masih Kosong'
		],
		'nomor_rekening' => [
			'required' => 'Nomor Rekening Masih Kosong'
		],
		'keterangan' => [
			'required' => 'Keterangan Masih Kosong'
		],
		'id_bank_penerima' => [
			'required' => 'Nama Bank Masih Kosong'
		]
	];
}
