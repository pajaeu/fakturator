<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('Invoice number') }} {{ $invoice->number }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1f2937;
            margin: 0;
        }
        .page-wrapper {
            position: relative;
            min-height: 1000px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            padding: 8px 0;
        }
        .border {
            border: 1px solid #e5e7eb;
        }
        .border-b {
            border-bottom: 1px solid #e5e7eb;
        }
        .border-r {
            border-right: 1px solid #e5e7eb;
        }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        .text-xs { font-size: 10px; }
        .text-sm { font-size: 12px; }
        .text-base { font-size: 14px; }
        .text-gray { color: #6b7280; }
        .uppercase { text-transform: uppercase; }
        .italic { font-style: italic; }
        .table { width: 100%; border-collapse: collapse; }
        .p-3 { padding: 12px; }
        .py-2 { padding-top: 8px; padding-bottom: 8px; }
        .px-3 { padding-left: 12px; padding-right: 12px; }
        .mb-4 { margin-bottom: 16px; }
        .mb-10 { margin-bottom: 40px; }
        .mt-6 { margin-top: 24px; }
    </style>
</head>
<body>
<div class="page-wrapper">
    <div style="height: 30px;" class="text-right text-bold uppercase">
        @if($invoice->supplier_vat_id)
            {{ __('Invoice - tax document number') }} {{ $invoice->number }}
        @else
            {{ __('Invoice number') }} {{ $invoice->number }}
        @endif
    </div>

    <div class="border mb-10">
        <table class="table">
            <tr>
                <td class="p-3 border-r border-b" style="vertical-align: top; width: 50%;">
                    <div class="text-xs text-gray uppercase mb-4">{{ __('Supplier') }}</div>
                    <div class="text-base">{{ $invoice->supplier_company }}</div>
                    <div>{{ $invoice->supplier_address }}</div>
                    <div>{{ $invoice->supplier_zip }} {{ $invoice->supplier_city }}</div>
                    <div class="mb-4">{{ $invoice->supplier_country->label() }}</div>
                    <table class="table">
                        <tr>
                            <td style="width: 50%;">{{ __('Company ID') }}:</td>
                            <td class="text-right">{{ $invoice->supplier_company_id }}</td>
                        </tr>
                        <tr>
                            @if($invoice->supplier_vat_id)
                                <td>{{ __('VAT ID') }}:</td>
                                <td class="text-right">{{ $invoice->supplier_vat_id }}</td>
                            @else
                                <td class="italic text-xs text-gray">{{ __('Non-payer of VAT') }}</td>
                                <td></td>
                            @endif
                        </tr>
                    </table>
                </td>
                <td class="p-3 border-b" style="vertical-align: top; width: 50%;">
                    <div class="text-xs text-gray uppercase mb-4">{{ __('Customer') }}</div>
                    <div class="text-base">{{ $invoice->customer_company }}</div>
                    <div>{{ $invoice->customer_address }}</div>
                    <div>{{ $invoice->customer_zip }} {{ $invoice->customer_city }}</div>
                    <div class="mb-4">{{ $invoice->customer_country->label() }}</div>
                    <table class="table">
                        <tr>
                            <td style="width: 50%;">{{ __('Company ID') }}:</td>
                            <td class="text-right">{{ $invoice->customer_company_id }}</td>
                        </tr>
                        @if($invoice->customer_vat_id)
                            <tr>
                                <td>{{ __('VAT ID') }}:</td>
                                <td class="text-right">{{ $invoice->customer_vat_id }}</td>
                            </tr>
                        @endif
                    </table>
                </td>
            </tr>

            <tr>
                <td class="p-3 border-r" style="vertical-align: top;">
                    <table class="table">
                        @if($invoice->payment_method === \App\Enums\PaymentMethod::BANK_TRANSFER)
                            <tr>
                                <td style="width: 50%;">{{ __('Bank account') }}:</td>
                                <td class="text-right">
                                    {{ $invoice->bankAccount?->number }}/{{ $invoice->bankAccount?->bank_code }}
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td>{{ __('Variable symbol') }}:</td>
                            <td class="text-right">{{ $invoice->variable_symbol }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Payment method') }}:</td>
                            <td class="text-right">{{ $invoice->payment_method->label() }}</td>
                        </tr>
                    </table>
                </td>
                <td class="p-3" style="vertical-align: top;">
                    <table class="table">
                        <tr>
                            <td style="width: 50%;">{{ __('Date of issue') }}:</td>
                            <td class="text-right">{{ $invoice->issued_at->format('d. m. Y') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Due date') }}:</td>
                            <td class="text-right">{{ $invoice->due_at->format('d. m. Y') }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <table class="table border-t border-b">
        <tr>
            <th class="py-2 px-3 text-xs text-left border-b">{{ __('Description') }}</th>
            <th class="py-2 px-3 text-xs text-left border-b">{{ __('Quantity') }}</th>
            <th class="py-2 px-3 text-xs text-right border-b">{{ __('Price per unit') }}</th>
            <th class="py-2 px-3 text-xs text-right border-b">{{ __('Total') }}</th>
        </tr>
        @foreach($invoice->items as $item)
            <tr>
                <td class="py-2 px-3 text-sm text-left border-b">{{ $item['description'] }}</td>
                <td class="py-2 px-3 text-sm text-left border-b">{{ $item['quantity'] }} {{ $item['unit'] }}</td>
                <td class="py-2 px-3 text-sm text-right border-b">{{ price((float) $item['unit_price'], $invoice->currency)->format() }}</td>
                <td class="py-2 px-3 text-sm text-right border-b">{{ price((float) $item['total'], $invoice->currency)->format() }}</td>
            </tr>
        @endforeach
    </table>

    <table class="table text-base text-bold">
        <tr>
            <td class="py-2 px-3 uppercase" style="width: 50%;">{{ __('Total to be paid') }}</td>
            <td class="py-2 px-3 text-right" style="width: 50%;">{{ price($invoice->total_with_vat, $invoice->currency)->format() }}</td>
        </tr>
    </table>

    @if($invoice->payment_method === \App\Enums\PaymentMethod::BANK_TRANSFER)
        <div class="mt-6 px-3">
            {!! invoice_qr_payment($invoice)->render() !!}
        </div>
    @endif

    @if($invoice->user->tier === \App\Enums\UserTier::FREE)
        <div class="footer">
            {{ __('Generated in the Fakturátor app') }}
        </div>
    @endif
</div>
</body>
</html>
