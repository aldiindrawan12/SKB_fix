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
	
    function change_tanggal($data){
        $data_tanggal = explode('-', $data);
        $tanggal = $data_tanggal[2].'-'.$data_tanggal[1].'-'.$data_tanggal[0];
        return $tanggal;
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
		$pdf = new Html2Pdf('P','A4','fr');   
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

			//isi tabel
			$numrow = 4;
			for($i=0;$i<count($jo);$i++){
				$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, strval($jo[$i]["Jo_id"]));
				$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $isi_customer[$i]);
				$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $isi_rute[$i]);
				$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $this->change_tanggal($jo[$i]["tanggal_surat"]));
				$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $this->change_tanggal($jo[$i]["tanggal_bongkar"]));
				$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, "Rp".number_format($jo[$i]["uang_jalan"],2,",","."));
			
				$numrow++; // Tambah BARIS
			}

			// Set width kolom
			$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10); // Set width kolom A
			$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20); // Set width kolom B
			$excel->getActiveSheet()->getColumnDimension('C')->setWidth(35); // Set width kolom C
			$excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); // Set width kolom D
			$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
			$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15); // Set width kolom E
			
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

	public function bon_excel(){
		$content = $this->input->post("file_content");
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Data_Kasbon.xls");
		echo $content;
	}
	public function jo_excel(){
		$content = $this->input->post("file_content");
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Detail_JO.xls");
		echo $content;
	}
	public function jo_excel_data(){
		$content = $this->input->post("file_content");
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Data_JO.xls");
		echo $content;
	}
	public function invoice_excel(){
		$content = $this->input->post("file_content");
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Data_Invoice.xls");
		echo $content;
	}
	public function gaji_excel(){
		$content = $this->input->post("file_content");
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Data_Slip_Gaji.xls");
		echo $content;
	}
	public function detail_gaji_excel(){
		$content = $this->input->post("file_content");
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Detail_Slip_Gaji.xls");
		echo $content;
	}
	public function mutasi_excel(){
		$content = $this->input->post("file_content");
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Data_Mutasi.xls");
		echo $content;
	}
	public function detail_invoice_excel(){
		$content = $this->input->post("file_content");
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Detail_Invoice.xls");
		echo $content;
	}
	// fungsi cetak invoice,gaji,memo
		public function invoice($invoice_id,$asal){
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
			$data["invoice"] = $this->model_detail->getinvoicebyid(str_replace("%20"," ",$invoice_id));
			$data["customer"] = $this->model_home->getcustomerbyid($data["invoice"][0]["customer_id"]);
			$data["invoice_kode"] = $data["invoice"][0]["invoice_kode"];
			$data["asal"] = $asal;
			$this->load->view("print/invoice_print",$data);
		}
		public function uang_jalan($jo_id,$asal){
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
			$data["data"] = $this->model_home->getjobyid($jo_id);
			$data["customer"] = $this->model_home->getcustomerbyid($data["data"]["customer_id"]);
			$data["tipe_jo"] = "reguler";
			$data["jo_id"] = $data["data"]["Jo_id"];
			$data["asal"] = $asal;
            $data["supir"] = $this->model_home->getsupirbyid($data["data"]["supir_id"]);
            $data["mobil"] = $this->model_home->getmobilbyid($data["data"]["mobil_no"]);
			$this->load->view("print/jo_print",$data);
		}
		public function print_bon($bon_id){
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
			$data["data"] = $this->model_detail->getbonbyid($bon_id);
            $data["supir"] = $this->model_home->getsupirbyid($data["data"]["supir_id"]);
			$data["asal"]="detail";
            $data["data_jo"] = array("Jo_id"=>"0");
			$this->load->view("print/bon_print",$data);
		}
	// end fungsi cetak invoice,gaji,memo

}
