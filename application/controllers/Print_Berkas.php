<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require("assets/excel/vendor/autoload.php");
require("assets/html2pdf/autoload.php");

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Spipu\Html2Pdf\Html2Pdf;

class Print_Berkas extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('model_home');//load model
        $this->load->model('model_print');//load model
		$this->load->model('model_detail');//load model
		$this->load->model('model_form');//load model
    }
    public function cetaklaporanpdf($tanggal,$bulan,$tahun,$status_jo,$asal){
        $data["jo"] = $this->model_print->getjobyperiode($tanggal,$bulan,$tahun,$status_jo);
        $data["tanggal"] = $tanggal."-".$bulan."-".$tahun;
		$data["paketan"] = $this->model_print->getpaketan();
		$data["kosongan"] = $this->model_print->getkosongan();
		ob_start();
		if($asal=="uang_jalan"){
			$this->load->view("print/report_uang_jalan_pdf",$data);
			$pdf_name = 'UJ_'.$data["tanggal"].'.pdf';
		}else{
			$this->load->view("print/report_pdf",$data);
			$pdf_name = 'JO_'.$data["tanggal"].'.pdf';
		}
	    $html = ob_get_clean();
		$pdf = new Html2Pdf('L','A4','fr');   
		$pdf->WriteHTML($html);   
		$pdf->Output($pdf_name, 'D');
    }

	public function cetaklaporanexcel($tanggal,$bulan,$tahun,$status_jo,$asal){
		$jo = $this->model_print->getjobyperiode($tanggal,$bulan,$tahun,$status_jo);
		$tanggal = $tanggal."-".$bulan."-".$tahun;
		$paketan= $this->model_print->getpaketan();
		$kosongan = $this->model_print->getkosongan();

		//generate rute
		$isi_rute = [];
		$isi_customer = [];
		foreach($jo as $value){
			$rute = "";
			$customer = "";
			$n=0; 
			for($i=0;$i<count($paketan);$i++){
					if($paketan[$i]["paketan_id"] == $value["paketan_id"]){
						$data_paketan = json_decode($paketan[$i]["paketan_data_rute"],true);
						$n++;
						for($j=0;$j<count($data_paketan);$j++){
							if($data_paketan[$j]["customer"]!="-"){
							 $customer .= $data_paketan[$j]["customer"]." - ";
							}
						}
						$customer .= "(Paketan)";
						for($j=0;$j<count($data_paketan);$j++){
							$rute .= $data_paketan[$j]["dari"]."-".$data_paketan[$j]["ke"]." (".$data_paketan[$j]["muatan"].");";
						}
					}
			}
			for($i=0;$i<count($kosongan);$i++){
					if($kosongan[$i]["kosongan_id"] == $value["kosongan_id"]){
						$n++;
						$customer .= $value["customer_name"]." (Reguler)";
						$rute .= $kosongan[$i]["kosongan_dari"]."-".$kosongan[$i]["kosongan_ke"]." ("."kosongan);";
						$rute .= $value["asal"]."-".$value["tujuan"]."-".$value["muatan"].")";
					}
			}
			if($n==0){
				$customer .= $value["customer_name"]." (Reguler)";
				$rute .= $value["asal"]."-".$value["tujuan"]." (".$value["muatan"].")";
			}
			$isi_rute[]=$rute;
			$isi_customer[]=$customer;
		}

		if($asal=="uang_jalan"){
			$name_file = 'UJ_'.$tanggal;
		}else{
			$name_file = 'JO_'.$tanggal;
		}

		$excel = new Spreadsheet();

		// 	//set properti
		$excel->getProperties()->setCreator('PT.Sumber Karya Berkah')
		->setLastModifiedBy('PT.Sumber Karya Berkah');

			//set tampilan judul file
			$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA JOB ORDER (".$tanggal.")");
			$excel->getActiveSheet()->mergeCells('A1:H1');
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);

			//header tabel
			$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO JO");
			$excel->setActiveSheetIndex(0)->setCellValue('B3', "CUSTOMER");
			$excel->setActiveSheetIndex(0)->setCellValue('C3', "RUTE");
			$excel->setActiveSheetIndex(0)->setCellValue('D3', "TGL MUAT");
			$excel->setActiveSheetIndex(0)->setCellValue('E3', "TGL BONGKAR");
			$excel->setActiveSheetIndex(0)->setCellValue('F3', "UANG JALAN");
			$excel->setActiveSheetIndex(0)->setCellValue('G3', "NO POL");
			$excel->setActiveSheetIndex(0)->setCellValue('H3', "SUPIR");
			$excel->setActiveSheetIndex(0)->setCellValue('I3', "TONASE");
			$excel->setActiveSheetIndex(0)->setCellValue('J3', "NO INV");

			//isi tabel
			$numrow = 4;
			for($i=0;$i<count($jo);$i++){
				$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, strval($jo[$i]["Jo_id"]));
				$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $isi_customer[$i]);
				$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $isi_rute[$i]);
				$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $jo[$i]["tanggal_surat"]);
				$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $jo[$i]["tanggal_bongkar"]);
				$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, "Rp".number_format($jo[$i]["uang_jalan"],2,",","."));
				$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $jo[$i]["mobil_no"]);
				$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $jo[$i]["supir_name"]);
				$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $jo[$i]["tonase"]);
				$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $jo[$i]["invoice_id"]);
			
				$numrow++; // Tambah BARIS
			}

			// Set width kolom
			$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10); // Set width kolom A
			$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20); // Set width kolom B
			$excel->getActiveSheet()->getColumnDimension('C')->setWidth(35); // Set width kolom C
			$excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); // Set width kolom D
			$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
			$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15); // Set width kolom E
			$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom E
			$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom E
			$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15); // Set width kolom E
			$excel->getActiveSheet()->getColumnDimension('J')->setWidth(15); // Set width kolom E			
			// tinggi otomatis
			$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

			// Set judul file excel nya
			$excel->getActiveSheet(0)->setTitle("Laporan Data Job Order");
			$excel->setActiveSheetIndex(0);

			// Proses file excel
			$header = 'Content-Disposition: attachment; filename='.$name_file.'.xlsx';
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header($header);
			header('Cache-Control: max-age=0');

			$write = IOFactory::createWriter($excel, 'Xlsx');
			$write->save('php://output');
	}

	// fungsi cetak invoice,gaji,memo
		public function invoice($invoice_id,$asal){
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
			$data["invoice"] = $this->model_detail->getinvoicebyid(str_replace("%20"," ",$invoice_id));
            $paketan_id = [];
            $kosongan_id = [];
            for($i=0;$i<count($data["invoice"]);$i++){
                $data_paketan = $this->model_form->getpaketanbyid($data["invoice"][$i]["paketan_id"]);
                $paketan_id[] = $data_paketan;
                $data_kosongan = $this->model_print->getkosonganbyid($data["invoice"][$i]["kosongan_id"]);
                $kosongan_id[] = $data_kosongan;
            }
            $data["paketan"] = $paketan_id;
            $data["kosongan"] = $kosongan_id;
			$data["customer"] = $this->model_home->getcustomerbyid($data["invoice"][0]["customer_id"]);
			$data["invoice_kode"] = $data["invoice"][0]["invoice_kode"];
			$data["asal"] = $asal;
			$this->load->view("print/invoice_print",$data);
		}
		public function uang_jalan($jo_id){
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
			$data["data"] = $this->model_home->getjobyid($jo_id);
			if($data["data"]["paketan_id"]==0){
				$data["tipe_jo"] = "reguler";
				$data["kosongan"] = $this->model_detail->getkosonganbyid($data["data"]["kosongan_id"],0);
			}else{
				$data["paketan"] = $this->model_form->getpaketanbyid($data["data"]["paketan_id"]);
				$data["tipe_jo"] = "paketan";
			}
			$data["jo_id"] = $data["data"]["Jo_id"];
			$data["asal"] = "detail";
            $data["supir"] = $this->model_home->getsupirbyid($data["data"]["supir_id"]);
            $data["mobil"] = $this->model_home->getmobilbyid($data["data"]["mobil_no"]);
			$this->load->view("print/jo_print",$data);
		}
	// end fungsi cetak invoice,gaji,memo

}
