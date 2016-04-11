<?php

use pdml\PDML;

require '../vendor/autoload.php';

$PDML_AutoStart = isset($PDML_AutoStart)?$PDML_AutoStart:1;         // Start PDF output automatically
$PDML_FileName = isset($PDML_FileName)?$PDML_FileName:"doc.pdf";    // Default filename for PDF
$PDML_Orientation = isset($PDML_Orientation)?$PDML_Orientation:"P"; // Orientation: P=Portrait / L=Landscape
$PDML_Format = isset($PDML_Format)?$PDML_Format:"A4";               // Format: A3 / A4 / A5 / legal / letter

/*******************************************************************************
* PDML to PDF conversion                                                       *
*                                                                              *
* Parameters:                                                                  *
*  buffer = pdml data                                                          *
* Result:                                                                      *
*  return = raw pdf data                                                       *
*                                                                              *
*******************************************************************************/
function pdml2pdf($buffer)
{
    global $PDML_Orientation;
    global $PDML_Format;

    $pdml = new PDML($PDML_Orientation,'pt',$PDML_Format);
    $pdml->compress=0;
    $pdml->ParsePDML($buffer);
    $s = $pdml->Output("","S");
    return ($s);
}

/*******************************************************************************
* Create and display PDF to STDOUT                                             *
*                                                                              *
* Parameters:                                                                  *
*  buffer = pdml data                                                          *
* Result:                                                                      *
*  return = raw pdf data                                                       *
*                                                                              *
*******************************************************************************/
function ob_pdml($buffer)
{
    global $PDML_FileName;

    $s = pdml2pdf($buffer);

    Header('Content-Type: application/pdf');
    Header('Content-Length: '.strlen($s));
    Header('Content-disposition: inline; filename='.$PDML_FileName);

    header( "Expires: Mon, 20 Dec 1998 01:00:00 GMT" );
    header( "Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
    header( "Cache-Control: no-cache, must-revalidate" );
    header( "Pragma: no-cache" );

    return $s;
}

// Start PDF ouput automatically is PDML_AutoStart is set
if ($PDML_AutoStart) {
    ob_start("ob_pdml");
}
