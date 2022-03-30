<?php

namespace App\Http\Controllers;
use App\Models\po_receive;
use App\Models\POCreation;
use App\Models\PRCreation;
use Codedge\Fpdf\Fpdf\Fpdf;
use Codedge\Fpdf\Fpdf\PDF_Code128;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new PDF_Code128('P','mm',array(101.6,101.6));
    }
    public function barcode($po_number){
        $po=POCreation::find($po_number);

        echo "LC Buyer :".$lc_buyer=$po->lc_buyer;
        echo "<br>";
        echo "Name Of Material :".$name_of_material=$po->name_of_mats;
        echo "<br>";
        echo "Seller :".$supplier_or_seller=$po->supplier;
        echo "<br>";
        echo "Invoice Number :".$invoice_number=$po->invoice;
        echo "<br>";
        echo "LC Number :".$lc_number=$po->lc_number;
        echo "<br>";

        $pr_number=$po->pr_number;

        $pr=PRCreation::find($pr_number);
        echo "Type of Raw Material :".$type_of_raw_material=$pr->name_of_raw_matrial;
        echo "<br>";
        echo "Total Number of Bales :".$total_number_of_bales=$po->bales;
        echo "<br>";
        echo "Total Kgs :".$total_kgs=$po->total_kgs;
        echo "<br>";
        echo "Quality :".$quality=$pr->quality;
        echo "<br>";

        $po_receive=po_receive::all()->where('po_number',$po_number);
        echo "TC Number :".$tc_number=$po_receive[0]->tc_number;
        echo "<br>";


        echo "Gmo :".$gmo_test_report=$po_receive[0]->gmo;


    }

    public function index($po_number)
    {
        $po=POCreation::find($po_number);

        $lc_buyer=$po->lc_buyer;
        $name_of_material=$po->name_of_mats;
        $supplier_or_seller=$po->supplier;
        $invoice_number=$po->invoice;
        $lc_number=$po->lc_number;

        $pr_number=$po->pr_number;
        $pr=PRCreation::find($pr_number);
        $type_of_raw_material=$pr->name_of_raw_matrial;
        $total_number_of_bales=$po->bales;
        $total_kgs=$po->total_kgs;
        $quality=$pr->quality;
         $po_receive=po_receive::all()->where('po_number',$po_number);
        $tc_number=$po_receive[0]->tc_number;

        $gmo_test_report=$po_receive[0]->gmo;

        $barcode_code = 'http://127.0.0.1:8000/barcode/'.$po_number;

        $this->fpdf->setTopMargin(3);

        $this->fpdf->AliasNbPages();
        $this->fpdf->AddPage();
        $this->fpdf->SetAutoPageBreak(true,2);
        // $pdf->SetFont('Arial','B',25);
        $this->fpdf->SetFont('Arial','B',12);
        $this->fpdf->Cell(83,5,'Spinning Mills Limited',0,0,'C');
        $this->fpdf->SetFont('Arial','B',6);
        $this->fpdf->Ln();
        $this->fpdf->Image('img/spining_pdf.png',5,3,10);

        //$this->fpdf->Image('img/spining_pdf.png',10,3,80,6);


        $this->fpdf->Ln(0);
        $this->fpdf->SetFont('Arial','B',10);
        //$this->fpdf->Cell(85,5,'SPINNING MILLS',0,0,'C');
        $this->fpdf->SetFont('Arial','B',6);
        $this->fpdf->Ln(3);

//  ..................... for barcode ..........................
        $this->fpdf->Code128(26,10,$barcode_code,50,5);
        $this->fpdf->Ln(0);
        $this->fpdf->setLeftMargin(5);
        $this->fpdf->SetFont('Arial','',10);
        $this->fpdf->Cell(71,12,"".$barcode_code,"0","0","R");
//  .....................end for barcode ..........................




        $this->fpdf->Ln(10);
        $this->fpdf->setTextColor(0,0,0);

        $this->fpdf->Ln(3);
        $this->fpdf->setLeftMargin(5);
        $this->fpdf->SetFont('Arial','B',9);
        $this->fpdf->Cell(95,-2,$lc_buyer, "0", "1","C");
        $this->fpdf->setLeftMargin(4);
        $this->fpdf->Ln(0);
        $this->fpdf->Cell(95,5,"LC Buyer : ", "0", "1","L");
        $this->fpdf->setLeftMargin(21);
        $this->fpdf->SetFont('Arial','',9);
        $this->fpdf->Cell(95,-5,"....................................................................................", "0", "0","L");
        $this->fpdf->setLeftMargin(4);

        $this->fpdf->Ln(3);
        $this->fpdf->setLeftMargin(5);
        $this->fpdf->SetFont('Arial','B',9);
        $this->fpdf->Cell(95,-2,$name_of_material, "0", "1","C");
        $this->fpdf->setLeftMargin(4);
        $this->fpdf->Ln(0);
        $this->fpdf->Cell(95,5,"Name of Material : ", "0", "1","L");
        $this->fpdf->setLeftMargin(32);
        $this->fpdf->SetFont('Arial','',9);
        $this->fpdf->Cell(95,-5,".......................................................................", "0", "0","L");
        $this->fpdf->setLeftMargin(4);


        $this->fpdf->Ln(3);
        $this->fpdf->setLeftMargin(5);
        $this->fpdf->SetFont('Arial','B',9);
        $this->fpdf->Cell(95,-2,$supplier_or_seller, "0", "1","C");
        $this->fpdf->setLeftMargin(4);
        $this->fpdf->Ln(0);
        $this->fpdf->Cell(95,5,"Supplier / Seller : ", "0", "1","L");
        $this->fpdf->setLeftMargin(30);
        $this->fpdf->SetFont('Arial','',9);
        $this->fpdf->Cell(95,-5,".........................................................................", "0", "0","L");
        $this->fpdf->setLeftMargin(4);


        $this->fpdf->Ln(3);
        $this->fpdf->setLeftMargin(5);
        $this->fpdf->SetFont('Arial','B',9);
        $this->fpdf->Cell(95,-2,$invoice_number, "0", "1","C");
        $this->fpdf->setLeftMargin(4);
        $this->fpdf->Ln(0);
        $this->fpdf->Cell(95,5,"Invoice Number : ", "0", "1","L");
        $this->fpdf->setLeftMargin(29);
        $this->fpdf->SetFont('Arial','',9);
        $this->fpdf->Cell(95,-5,"..........................................................................", "0", "0","L");
        $this->fpdf->setLeftMargin(4);



        $this->fpdf->Ln(3);
        $this->fpdf->setLeftMargin(5);
        $this->fpdf->SetFont('Arial','B',9);
        $this->fpdf->Cell(95,-2,$lc_number, "0", "1","C");
        $this->fpdf->setLeftMargin(4);
        $this->fpdf->Ln(0);
        $this->fpdf->Cell(95,5,"LC Number : ", "0", "1","L");
        $this->fpdf->setLeftMargin(24);
        $this->fpdf->SetFont('Arial','',9);
        $this->fpdf->Cell(95,-5,"................................................................................", "0", "0","L");
        $this->fpdf->setLeftMargin(4);


        $this->fpdf->Ln(3);
        $this->fpdf->setLeftMargin(5);
        $this->fpdf->SetFont('Arial','B',9);
        $this->fpdf->Cell(95,-2,$type_of_raw_material, "0", "1","C");
        $this->fpdf->setLeftMargin(4);
        $this->fpdf->Ln(0);
        $this->fpdf->Cell(95,5,"Type of Raw Material : ", "0", "1","L");
        $this->fpdf->setLeftMargin(38);
        $this->fpdf->SetFont('Arial','',9);
        $this->fpdf->Cell(95,-5,"................................................................", "0", "0","L");
        $this->fpdf->setLeftMargin(4);


        $this->fpdf->Ln(3);
        $this->fpdf->setLeftMargin(5);
        $this->fpdf->SetFont('Arial','B',9);
        $this->fpdf->Cell(95,-2,$total_number_of_bales, "0", "1","C");
        $this->fpdf->setLeftMargin(4);
        $this->fpdf->Ln(0);
        $this->fpdf->Cell(95,5,"Total Number of Bales : ", "0", "1","L");
        $this->fpdf->setLeftMargin(40);
        $this->fpdf->SetFont('Arial','',9);
        $this->fpdf->Cell(95,-5,"..............................................................", "0", "0","L");
        $this->fpdf->setLeftMargin(4);


        $this->fpdf->Ln(3);
        $this->fpdf->setLeftMargin(5);
        $this->fpdf->SetFont('Arial','B',9);
        $this->fpdf->Cell(95,-2,$total_kgs, "0", "1","C");
        $this->fpdf->setLeftMargin(4);
        $this->fpdf->Ln(0);
        $this->fpdf->Cell(95,5,"Total KGS : ", "0", "1","L");
        $this->fpdf->setLeftMargin(22);
        $this->fpdf->SetFont('Arial','',9);
        $this->fpdf->Cell(95,-5,"..................................................................................", "0", "0","L");
        $this->fpdf->setLeftMargin(4);


        $this->fpdf->Ln(3);
        $this->fpdf->setLeftMargin(5);
        $this->fpdf->SetFont('Arial','B',9);
        $this->fpdf->Cell(95,-2,$quality, "0", "1","C");
        $this->fpdf->setLeftMargin(4);
        $this->fpdf->Ln(0);
        $this->fpdf->Cell(95,5,"Quality : ", "0", "1","L");
        $this->fpdf->setLeftMargin(18);
        $this->fpdf->SetFont('Arial','',9);
        $this->fpdf->Cell(95,-5,"......................................................................................", "0", "0","L");
        $this->fpdf->setLeftMargin(4);


        $this->fpdf->Ln(3);
        $this->fpdf->setLeftMargin(5);
        $this->fpdf->SetFont('Arial','B',9);
        $this->fpdf->Cell(95,-2,$tc_number, "0", "1","C");
        $this->fpdf->setLeftMargin(4);
        $this->fpdf->Ln(0);
        $this->fpdf->Cell(95,5,"TC number : ", "0", "1","L");
        $this->fpdf->setLeftMargin(23);
        $this->fpdf->SetFont('Arial','',9);
        $this->fpdf->Cell(95,-5,"................................................................................", "0", "0","L");
        $this->fpdf->setLeftMargin(4);


        $this->fpdf->Ln(3);
        $this->fpdf->setLeftMargin(5);
        $this->fpdf->SetFont('Arial','B',9);
        $this->fpdf->Cell(95,-2,$gmo_test_report, "0", "1","C");
        $this->fpdf->setLeftMargin(4);
        $this->fpdf->Ln(0);
        $this->fpdf->Cell(95,5,"GMO Test Report : ", "0", "1","L");
        $this->fpdf->setLeftMargin(33);
        $this->fpdf->SetFont('Arial','',9);
        $this->fpdf->Cell(95,-5,".....................................................................", "0", "0","L");
        $this->fpdf->setLeftMargin(4);



        ob_end_clean();

        $this->fpdf->Output('I', $barcode_code.".pdf");

        // $this->fpdf->Output();

        //exit;
    }
}
