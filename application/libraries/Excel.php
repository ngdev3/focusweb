<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Excel {

    private $excel;

    public function __construct() {
        require_once APPPATH . 'third_party/PHPExcel.php';
        $this->excel = new PHPExcel();
    }

    public function load($path) {
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $this->excel = $objReader->load($path);
    }

    public function save($path) {
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save($path);
    }

    public function stream($filename, $data = null) { 
        if ($data != null) {
            $col = 'A';
            foreach ($data[0] as $key => $val) {
                $objRichText = new PHPExcel_RichText();
                $objPayable = $objRichText->createTextRun(str_replace("_", " ", $key));
                $this->excel->getActiveSheet()->getCell($col . '1')->setValue($objRichText);
                $col++;
            }
            $rowNumber = 2;
            foreach ($data as $row) {
                $col = 'A';
                foreach ($row as $cell) {
                    $this->excel->getActiveSheet()->setCellValue($col . $rowNumber, $cell);
                    $col++;
                }
                $rowNumber++;
            }
        }
	ob_end_clean();
        header('Content-type: application/ms-excel');
        header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
        header("Cache-control: private"); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	//ob_end_clean();
        $objWriter->save("assets/export/$filename");
        header("location: " . base_url() . "assets/export/$filename");
        unlink(base_url() . "assets/export/$filename");
    }
    
    public function emailStream($filename, $data = null) {
        if ($data != null) {
            $col = 'A';
            foreach ($data[0] as $key => $val) {
                $objRichText = new PHPExcel_RichText();
                $objPayable = $objRichText->createTextRun(str_replace("_", " ", $key));
                $this->excel->getActiveSheet()->getCell($col . '1')->setValue($objRichText);
                $col++;
            }
            $rowNumber = 2;
            foreach ($data as $row) {
                $col = 'A';
                foreach ($row as $cell) {
                    $this->excel->getActiveSheet()->setCellValue($col . $rowNumber, $cell);
                    $col++;
                }
                $rowNumber++;
            }
        }
	ob_end_clean();
        
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
	ob_end_clean();
        $objWriter->save("assets/export/$filename");
        $my_file = $filename;
        $my_path = base_url() . "assets/export/";
        $my_name = "Admin";
        $my_mail = fromEmail();
        $my_replyto = fromEmail();
        $my_subject = $filename;
        $my_message = $filename; 
        mail_attachment($my_file, $my_path, CSV_EMAIL.",".USER_EMAIL, $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
        unlink("assets/export/$filename");
    }

    public function __call($name, $arguments) {
        if (method_exists($this->excel, $name)) {
            return call_user_func_array(array($this->excel, $name), $arguments);
        }
        return null;
    }
}
