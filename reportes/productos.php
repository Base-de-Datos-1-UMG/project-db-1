<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    include_once("./fpdf184/fpdf.php");
    include_once("./../includes/session.php");

    $url = "https://www.datos.gov.co/resource/gt2j-8ykr.json";
    $res = json_decode(file_get_contents($url));

    //Consultamos la tabla que queremos mostrar en la vista
    $sql = "SELECT M.*, PA.*, UM.*, ML.*, L.*
            FROM MEDICAMENTO M 
            JOIN PRINCIPIO_ACTIVO PA 
                ON (PA.IDPRINCIPIO_ACTIVO = M.PRINCIPIO_ACTIVO_IDPRINCIPIO_ACTIVO) 
            JOIN UNIDAD_MEDIDA UM 
                ON (UM.IDUNIDAD_MEDIDA = M.UNIDAD_MEDIDA_IDUNIDAD_MEDIDA)
            JOIN MEDICAMENTO_X_LABORATORIO ML 
                ON (ML.MEDICAMENTO_IDMEDICAMENTO = M.IDMEDICAMENTO)
            JOIN LABORATORIO L 
                ON (L.IDLABORATORIO = ML.LABORATORIO_IDLABORATORIO)
            ORDER BY M.IDMEDICAMENTO";

    //usamos db_select para traer multiples filas
    $result = db_select($sql, $conn);

    $registros = 20;

    class PDF extends FPDF{
        function Header(){
            //header
            $this->SetY(0);
            $this->SetFont("Arial","B",30);
            $this->SetFillColor(14,22,61);
            $this->SetTextColor(255, 255, 255);
            $this->Cell(0,30,"  Reporte de Medicamento", 0, 1, 'L', true);
        }

        function Footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->SetTextColor(0,0,0);
            $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
        }

        function ChapterTitle(){
            $this->SetY(31);
            $this->SetFont("Arial","B", 16);
            $this->SetFillColor(255, 255, 255);
            $this->SetTextColor(14, 22, 61);
            $this->Cell(0,10,utf8_decode("Informacion de Medicamentos"), 0, 1, 'L', true);
        }

        function ChapterBody($M,$F, $promedioEdad, $comunitaria, $relacionado, $recuperados, $registros){
            //body
            $this->SetTextColor(0, 0, 0);
            $this->SetFont("Arial", "", 11);
            $this->SetFillColor(255,255,255);
            $this->Cell(0,6,"Total de Hombres: ". $M, 0, 1, 'L', true);
            $this->Cell(0,6,"Total de Mujeres: ". $F, 0, 1, 'L', true);
            $this->Cell(0,6,"Promedio de edad: ". $promedioEdad/$registros, 0, 1, 'L', true);
            $this->Cell(0,6,"Contagio comunitario: ". $comunitaria, 0, 1, 'L', true);
            $this->Cell(0,6,"Contagio Relacionado: ". $relacionado, 0, 1, 'L', true);
            $this->Cell(0,6,"Total de Recuperados: ". $recuperados, 0, 1, 'L', true);
            $this->Ln();
            $this->Cell(0,6,"Datos Recuperados de:", 0, 1, 'L', true);
            $this->SetTextColor(33,121,254);
            $this->Cell(0,6,"https://www.datos.gov.co/resource/gt2j-8ykr.json", 0, 1, 'L', true);

        }

        function FancyTable($result,$registros){
        // Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(14,22,61);
        $this->SetDrawColor(238,156,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B', 10);
        $w = array(24,58,15,15,30,18,29);
        // Cabecera
        $this->Cell(20, 10, "ID", 0, 0, "C", 1);
        $this->Cell(48, 10, "Medicamento", 0, 0, "L", 1);
        $this->Cell(15, 10, "Precio", 0, 0, "C", 1);
        $this->Cell(25, 10, "P. Activo", 0, 0, "C", 1);
        $this->Cell(30, 10, "Unidad Medida", 0, 0, "C", 1);
        $this->Cell(18, 10, "Stock", 0, 0, "C", 1);
        $this->Cell(34, 10, "Fecha Vencimiento", 0, 0, "C", 1);
        $this->Ln();
        
        // Restauración de colores y fuentes
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('Arial', '', 9);
        // Datos
        $fill = false;
        $i = 0;
        $M = 0;
        $F = 0;
        $promedioEdad = 0;
        $comunitaria = 0;
        $relacionado = 0;
        $recuperados = 0;
        foreach($result as $row){
            
            $this->Cell(20,6, $row['IDMEDICAMENTO'],0,0,'C',$fill);
            $this->Cell(48,6, $row['NOMBRE_MEDICAMENTO'],0,0,'L',$fill);
            $this->Cell(15,6, $row['PRECIO_MEDICAMENTO'],0,0,'C',$fill);
            $this->Cell(25,6, utf8_decode($row['PRINCIPIO_ACTIVO']),0,0,'C',$fill);
            $this->Cell(30,6, $row['UNIDAD_MEDIDA'],0,0,'C',$fill);
            $this->Cell(18,6, $row['EXISTENCIA_MEDICAMENTO'],0,0,'C',$fill);
            $this->Cell(34,6, $row['FECHA_VENCIMIENTO'],0,0,'C',$fill);
            $this->Ln();
            $fill = !$fill;

            $i++;
            if($i == $registros){
                break;
            }
        }
        // Línea de cierre
        $this->Cell(array_sum($w) + 1,6,'','T');

        $this->Ln();

        //$this->ChapterBody($M,$F, $promedioEdad, $comunitaria, $relacionado, $recuperados, $registros);

    }

        function PrintChapter($result,$registros){
            $this->AddPage();
            $this->ChapterTitle();
            $this->FancyTable($result,$registros);
        }
    }

    //Objeto FPDF
    $pdf = new PDF();
    $pdf->PrintChapter($result,$registros);
    $pdf->Output('Reporte medicamentos.pdf', 'D');

?>