<?php

namespace frontend\controllers;


use Yii;
use kartik\mpdf\Pdf;
use backend\models\Invoice;
use backend\controllers\EventController as BaseEventController;

class InvoiceController extends BaseEventController
{
    public function actionIndex()
    {
        $model = Invoice::findOne(1);
        $client = $model->getClient();
        $invoice_items = $model->getInvoiceItems();
        $contract = $model->getContract();

        return $this->render('index', [
            'model' => $model,
            'client' => $client,
            'invoice_items' => $invoice_items,
            'contract' => $contract,
        ]);
    }

    public function actionPdf()
    {
        $model = Invoice::findOne(1);
        $client = $model->getClient();
        $invoice_items = $model->getInvoiceItems();
        $contract = $model->getContract();

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_invoice', [
            'model' => $model,
            'client' => $client,
            'invoice_items' => $invoice_items,
            'contract' => $contract,
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_LETTER,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Rwanda Guide'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>['Invoice' . $model->id],
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

}
