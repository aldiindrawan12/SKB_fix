<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require("assets/dom_pdf/autoload.inc.php");
require("assets/excel/vendor/autoload.php");


use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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
		$paketan_id = [];
		$kosongan_id = [];
		for($i=0;$i<count($data["jo"]);$i++){
			$data_paketan = $this->model_form->getpaketanbyid($data["jo"][$i]["paketan_id"]);
			$paketan_id[] = $data_paketan;
			$data_kosongan = $this->model_detail->getkosonganbyid($data["jo"][$i]["kosongan_id"]);
			$kosongan_id[] = $data_kosongan;
		}
		$data["paketan"] = $paketan_id;
		$data["kosongan"] = $kosongan_id;
        // $this->load->view("print/report_pdf",$data);
        $dompdf = new Dompdf();
		if($asal=="uangjalan"){
			$html = $this->load->view("print/report_uang_jalan_pdf",$data,true);
		}else{
			$html = $this->load->view("print/report_pdf",$data,true);
		}
        $dompdf->loadHtml($html);

        // Setting ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'landscape');

        // Rendering dari HTML Ke PDF
        $dompdf->render();

        // Melakukan output file Pdf
        $name_file = "JobOrder_".$data["tanggal"].".pdf";
        $dompdf->stream($name_file);
    }
public function cetaklaporanexcel($tanggal,$bulan,$tahun,$status_jo,$asal){
    // echo $tahun."-".$bulan."-".$tanggal;
    $jo = $this->model_print->getjobyperiode($tanggal,$bulan,$tahun,$status_jo);
    $data["tanggal"] = $tanggal."-".$bulan."-".$tahun;

	$excel = new Spreadsheet();

	// 	//set properti
	$excel->getProperties()->setCreator('PT.Sumber Karya Berkah')
	->setLastModifiedBy('PT.Sumber Karya Berkah');

		// //set style kolom
		// $kolom = array(
		// 	'font' => array('bold' => true),
		// 	'alignment' => array(
		// 		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		// 	),
		// 	'borders' => array(
		// 		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), //garis tipis
		// 		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  //garis tipis
		// 		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), //garis tipis
		// 		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) //garis tipis
		// 	)
		// );

		// //set style baris
		// $baris = array(
		// 	'alignment' => array(
		// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		// 	),
		// 	'borders' => array(
		// 		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), //garis tipis
		// 		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  //garis tipis
		// 		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), //garis tipis
		// 		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) //garis tipis
		// 	)
		// );

        //set tampilan judul file
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA JOB ORDER (".$data["tanggal"].")");
		$excel->getActiveSheet()->mergeCells('A1:H1');
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		// $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		//header tabel
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO JO");
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "CUSTOMER");
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "MUATAN");
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "ASAL");
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "TUJUAN");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "TGL MUAT");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "TGL BONGKAR");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "UANG JALAN");

		//apply style
		// $excel->getActiveSheet()->getStyle('A3')->applyFromArray($kolom);
		// $excel->getActiveSheet()->getStyle('B3')->applyFromArray($kolom);
		// $excel->getActiveSheet()->getStyle('C3')->applyFromArray($kolom);
		// $excel->getActiveSheet()->getStyle('D3')->applyFromArray($kolom);
		// $excel->getActiveSheet()->getStyle('E3')->applyFromArray($kolom);
        // $excel->getActiveSheet()->getStyle('F3')->applyFromArray($kolom);
        // $excel->getActiveSheet()->getStyle('G3')->applyFromArray($kolom);
        // $excel->getActiveSheet()->getStyle('H3')->applyFromArray($kolom);

        //isi tabel
		$numrow = 4;
		foreach($jo as $value){
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $value["Jo_id"]);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $value["customer_name"]);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $value["muatan"]);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $value["asal"]);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $value["tujuan"]);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $value["tanggal_surat"]);
            $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $value["tanggal_bongkar"]);
            $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $value["uang_jalan"]);
			
			//Apply style
			// $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($baris);
			// $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($baris);
			// $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($baris);
			// $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($baris);
			// $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($baris);
            // $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($baris);
            // $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($baris);
            // $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($baris);
			
			$numrow++; // Tambah BARIS
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom E
		
		// tinggi otomatis
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// kertas LANDSCAPE
		// $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Job Order");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
        $name_file = "JobOrder_".$data["tanggal"].".pdf";
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
                $data_kosongan = $this->model_detail->getkosonganbyid($data["invoice"][$i]["kosongan_id"]);
                $kosongan_id[] = $data_kosongan;
            }
            $data["paketan"] = $paketan_id;
            $data["kosongan"] = $kosongan_id;
			$data["customer"] = $this->model_home->getcustomerbyid($data["invoice"][0]["customer_id"]);
			$data["invoice_kode"] = $data["invoice"][0]["invoice_kode"];
			$data["asal"] = $asal;
			$this->load->view("print/invoice_print",$data);
		}
		public function data_gaji($supir_id,$upah,$bonus){
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
			$data["jo"] = $this->model_detail->getjobbysupir($supir_id);
			$data["supir"] = $this->model_home->getsupirbyid($supir_id);
			//update upah
			$data_jo_id = [];
			for($i=0;$i<count($data["jo"]);$i++){
				$data_jo_id[] = $data["jo"][$i]["Jo_id"];
			}
			$data["data_jo_id"] = $data_jo_id;
			$data["upah"] = $upah;
			$data["bonus_tf"]=$bonus;
			$this->load->view("print/penggajian_print",$data);
		}
		public function memo_tunai($supir_id,$gaji){
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
			$data["gaji"] = $gaji;
			$data["supir"] = $this->model_home->getsupirbyid($supir_id);
			$this->load->view("print/memo_tunai_print",$data);
		}
		public function memo_tf($supir_id,$gaji){
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
			$data["data"]=[
				"Bank"=>$this->input->post("Bank"),
				"Norek"=>$this->input->post("Norek"),
				"AN"=>$this->input->post("AN"),
				"Keterangan"=>$this->input->post("Keterangan")
			];
			$data["bonus"] = str_replace(".","",$this->input->post("bonus_tf"));
			$data["gaji"] = $gaji;
			$data["supir"] = $this->model_home->getsupirbyid($supir_id);
			$this->load->view("print/memo_tf_print",$data);
		}
		public function uang_jalan($jo_id){
            if(!$_SESSION["user"]){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
			$data["data"] = $this->model_home->getjobyid($jo_id);
			$data["jo_id"] = $data["data"]["Jo_id"];
			$data["asal"] = "detail";
            $data["supir"] = $this->model_home->getsupirbyid($data["data"]["supir_id"]);
            $data["mobil"] = $this->model_home->getmobilbyid($data["data"]["mobil_no"]);
			$this->load->view("print/jo_print",$data);
		}
	// end fungsi cetak invoice,gaji,memo

}
