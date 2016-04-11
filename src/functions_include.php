<?php

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
