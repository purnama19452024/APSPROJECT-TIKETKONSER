<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewView;
use Mpdf\Mpdf;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class InvoiceController extends Controller
{
    public function index(Request $request): ViewView
    {
        $query = Invoice::latest();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $invoices = $query->paginate(15);

        return view('admin.invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice): ViewView
    {
        return view('admin.invoices.show', compact('invoice'));
    }

    public function create(): ViewView
    {
        return view('admin.invoices.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'type' => 'required|in:incoming,outgoing',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'invoice_date' => 'required|date',
        ]);

        $prefix = $data['type'] === 'incoming' ? 'INV-IN' : 'INV-OUT';
        $timestamp = now()->format('ymdHis');
        $data['invoice_number'] = $prefix.'-'.$timestamp;

        Invoice::create($data);

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice created successfully.');
    }

    public function uploadSignature(Request $request, Invoice $invoice): RedirectResponse
    {
        $request->validate([
            'signature' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($invoice->signature) {
            Storage::disk('public')->delete($invoice->signature);
        }

        $path = $request->file('signature')->store('signatures', 'public');

        $invoice->update(['signature' => $path]);

        return back()->with('success', 'Signature uploaded successfully.');
    }

    public function exportPdf(Invoice $invoice)
    {
        $html = View::make('admin.invoices.export', compact('invoice'))->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_top' => 20,
            'margin_bottom' => 20,
            'margin_left' => 20,
            'margin_right' => 20,
        ]);

        $mpdf->SetTitle('Invoice - '.$invoice->invoice_number);
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('invoice-'.$invoice->invoice_number.'.pdf', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="invoice-'.$invoice->invoice_number.'.pdf"');
    }

    public function exportWord(Invoice $invoice)
    {
        $phpWord = new PhpWord;
        $section = $phpWord->addSection([
            'margin' => ['top' => 720, 'bottom' => 720, 'left' => 720, 'right' => 720],
        ]);

        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(11);

        $section->addText(
            'APS PROJECT',
            ['name' => 'Arial', 'size' => 24, 'bold' => true, 'color' => '1D4ED8'],
            ['alignment' => 'center']
        );
        $section->addTextBreak(1);

        $typeLabel = $invoice->type === 'incoming' ? 'INVOICE (UANG MASUK)' : 'INVOICE (UANG KELUAR)';
        $typeColor = $invoice->type === 'incoming' ? '059669' : 'DC2626';

        $section->addText(
            $typeLabel,
            ['name' => 'Arial', 'size' => 16, 'bold' => true, 'color' => $typeColor],
            ['alignment' => 'center']
        );

        $section->addTextBreak(1);

        $table = $section->addTable(['borderSize' => 1, 'borderColor' => 'E5E7EB', 'cellMargin' => 80]);
        $table->addRow();
        $table->addCell(4000)->addText('Invoice Number', ['bold' => true]);
        $table->addCell(6000)->addText($invoice->invoice_number);

        $table->addRow();
        $table->addCell(4000)->addText('Date', ['bold' => true]);
        $table->addCell(6000)->addText($invoice->invoice_date ? $invoice->invoice_date->format('d F Y') : '-');

        $table->addRow();
        $table->addCell(4000)->addText('Type', ['bold' => true]);
        $table->addCell(6000)->addText(ucfirst($invoice->type));

        $table->addRow();
        $table->addCell(4000)->addText('Amount', ['bold' => true]);
        $table->addCell(6000)->addText('Rp '.number_format($invoice->amount, 0, ',', '.'));

        $table->addRow();
        $table->addCell(4000)->addText('Created', ['bold' => true]);
        $table->addCell(6000)->addText($invoice->created_at?->format('d F Y H:i') ?? '-');

        if ($invoice->description) {
            $table->addRow();
            $table->addCell(4000)->addText('Description', ['bold' => true]);
            $table->addCell(6000)->addText($invoice->description);
        }

        $section->addTextBreak(2);

        $section->addText('Signature:', ['bold' => true, 'size' => 12]);

        if ($invoice->signature && Storage::disk('public')->exists($invoice->signature)) {
            $sigPath = Storage::disk('public')->path($invoice->signature);
            try {
                $section->addImage($sigPath, ['width' => 120, 'height' => 60]);
            } catch (\Exception $e) {
                $section->addText('(Signature file error)', ['color' => 'DC2626', 'italic' => true]);
            }
        } else {
            $section->addText('(No signature)', ['color' => '9CA3AF', 'italic' => true]);
        }

        $section->addTextBreak(1);
        $section->addText(
            'APS PROJECT - Official Invoice',
            ['size' => 9, 'color' => '9CA3AF'],
            ['alignment' => 'center']
        );

        $safeName = preg_replace('/[^A-Za-z0-9\-_]/', '', $invoice->invoice_number);
        $fileName = 'invoice-'.$safeName.'.docx';
        $tempPath = storage_path('app/temp/'.$fileName);

        if (! is_dir(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempPath);

        return response()->download($tempPath, $fileName)->deleteFileAfterSend(true);
    }
}
