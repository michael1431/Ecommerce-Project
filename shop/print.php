<?php 
 include 'mpdf/mpdf.php';
?>
     
<?php
$body = ob_get_clean();
$mpdf = new mPDF('+aCJK', 'A4', '', '', 0, 0, 0, 0, 0, 0);
$mpdf->WriteHTML($body);

$mpdf->Output('SaveToPDF.pdf', 'D');

/*
$mpdf = new mPDF("A4");
$mpdf->setAutoFont();
$html = "Hello World";
$mpdf->writeHTML($html);
$mpdf->Output("test.pdf","D");*/

?>