<?php
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

/**********************************************************************************
* Convert HTML/PDML entities into special characters                              *
*                                                                                 *
* Parameters:                                                                     *
*  given_html  = pdml data (with entities)                                        *
*  quote_style = Quotation Style                                                  *
*                ENT_COMPAT  :Convert double-quotes and leave single-quotes alone.*
*                ENT_QUOTES  :Convert both double and single quotes.              *
*                ENT_NOQUOTES:Leave both double and single quotes unconverted.    *
* Result:                                                                         *
*  return = pdml data (with entities converted into special characters            *
*                                                                                 *
**********************************************************************************/
function pdml_entity_decode( $given_html, $quote_style = ENT_QUOTES )
{
    $trans_table = array_flip(array_merge(
    get_html_translation_table( HTML_SPECIALCHARS, $quote_style ),
    get_html_translation_table( HTML_ENTITIES, $quote_style) ));
    $trans_table['&#39;'] = "'";
    $trans_table['&euro;'] = chr(128);
    $trans_table['&bull;'] = chr(149);
    return ( strtr( $given_html, $trans_table ) );
}
