<?php
/**include '/../../dao/connection.php';  Bonjour 
 Pour me joindre, vous pouvez faire le 775404351, 704078610 ou par mail jopmomo@gmail.com
include '/../../dao/select.php';
//include '/../../all_function.php';
 // require_once(dirname(__FILE__).'/../../all_function.php');

 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    // for display the post information
    if (isset($_POST['test'])) {
        echo '<pre>';
        echo htmlentities(print_r($_POST, true));
        echo '</pre>';
        exit;
    }

    // get the HTML
    ob_start();
    include(dirname(__FILE__).'/../../affemp.php');
    $content = ob_get_clean();

    // convert to PDF
    require_once(dirname(__FILE__).'/../../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('forms.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
