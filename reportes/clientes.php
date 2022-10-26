<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    include_once("./fpdf184/fpdf.php");
    include_once("./../includes/session.php");

    $url = "https://www.datos.gov.co/resource/gt2j-8ykr.json";
    $res = json_decode(file_get_contents($url));

    //Consultamos la tabla que queremos mostrar en la vista
    $sql = "SELECT
                C.*,
                P.*,
                ES.*
            FROM CLIENTE C
            JOIN PERSONA P 
                ON (P.IDPERSONA = C.PERSONA_IDPERSONA)
            JOIN ESTADO ES 
                ON (ES.IDESTADO = C.ESTADO_IDESTADO)
            WHERE
                C.ESTADO_IDESTADO = 0
            ORDER BY C.IDCLIENTE ASC";

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
            $this->Cell(0,30,"  Reporte de Clientes", 0, 1, 'L', true);
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
            $this->Cell(0,10,utf8_decode("Informacion de clientes activos"), 0, 1, 'L', true);
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
        $this->Cell(48, 10, "Nombre", 0, 0, "L", 1);
        $this->Cell(30, 10, "DPI", 0, 0, "L", 1);
        $this->Cell(24, 10, "NIT", 0, 0, "L", 1);
        $this->Cell(26, 10, "Genero", 0, 0, "L", 1);
        $this->Cell(18, 10, "Carnet", 0, 0, "R", 1);
        $this->Cell(25, 10, "Estado", 0, 0, "R", 1);
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
            
            $this->Cell(20,6, $row['IDCLIENTE'],0,0,'C',$fill);
            $this->Cell(48,6, $row['NOMBRE1'].' '.$row['NOMBRE2'].' '.$row['APELLIDO1'].' '.$row['APELLIDO2'],0,0,'L',$fill);
            $this->Cell(30,6, $row['DPI'],0,0,'L',$fill);
            $this->Cell(24,6, $row['NIT'],0,0,'L',$fill);
            $this->Cell(26,6, ($row['GENERO'] == 1 ? 'Masculino' : 'Femenino'),0,0,'L',$fill);
            $this->Cell(18,6, $row['CARNET'],0,0,'R',$fill);
            $this->Cell(25,6, $row['DES_ESTADO'],0,0,'R',$fill);
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
    $pdf->Output('Reporte clientes.pdf', 'D');

?>