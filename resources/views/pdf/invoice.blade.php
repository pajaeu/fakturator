@php
    use App\Enums\PaymentMethod;
    use App\Enums\UserTier;
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Invoice')  }} {{ $invoice->number }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="box-content h-screen text-sm leading-tight text-gray-800">
<div @class(['p-[20px] h-[calc(100%-40px)]', 'h-[calc(100%-60px)]' => $invoice->user->tier === UserTier::FREE])>
    @if($invoice->supplier_vat_id)
        <div class="h-[30px] text-right font-bold uppercase">{{ __('Invoice - tax document number') }} {{ $invoice->number }}</div>
    @else
        <div class="h-[30px] text-right font-bold uppercase">{{ __('Invoice number') }} {{ $invoice->number }}</div>
    @endif
    <div class="h-full border border-gray-200 border-collapse">
        <div class="mb-10">
            <table class="w-full border-collapse">
                <tr>
                    <td class="w-1/2 p-3 border-r border-b border-gray-200 align-top">
                        <div class="text-xs text-gray-400 uppercase mb-4">Dodavatel</div>
                        <div class="text-base">{{ $invoice->supplier_company }}</div>
                        <div>{{ $invoice->supplier_address }}</div>
                        <div>{{ $invoice->supplier_zip }} {{ $invoice->supplier_city }}</div>
                        <div class="mb-4">{{ $invoice->supplier_country->label() }}</div>
                        <table class="w-full">
                            <tr>
                                <td class="w-1/2">
                                    {{ __('Company ID') }}:
                                </td>
                                <td class="w-1/2 text-right">
                                    {{ $invoice->supplier_company_id }}
                                </td>
                            </tr>
                            <tr>
                                @if($invoice->supplier_vat_id)
                                    <td class="w-1/2">
                                        {{ __('VAT ID') }}:
                                    </td>
                                    <td class="w-1/2 text-right">
                                        {{ $invoice->supplier_vat_id }}
                                    </td>
                                @else
                                    <td class="w-1/2 italic text-xs text-gray-500">{{ __('Non-payer of VAT') }}</td>
                                    <td class="w-1/2 text-right"></td>
                                @endif
                            </tr>
                        </table>
                    </td>
                    <td class="w-1/2 p-3 border-b border-gray-200 align-top">
                        <div class="text-xs text-gray-400 uppercase mb-4">Odběratel</div>
                        <div class="text-base">{{ $invoice->customer_company }}</div>
                        <div>{{ $invoice->customer_address }}</div>
                        <div>{{ $invoice->customer_zip }} {{ $invoice->customer_city }}</div>
                        <div class="mb-4">{{ $invoice->customer_country->label() }}</div>
                        <table class="w-full">
                            <tr>
                                <td class="w-1/2">
                                    {{ __('Company ID') }}:
                                </td>
                                <td class="w-1/2 text-right">
                                    {{ $invoice->customer_company_id }}
                                </td>
                            </tr>
                            @if($invoice->customer_vat_id)
                                <tr>
                                    <td class="w-1/2">
                                        {{ __('VAT ID') }}:
                                    </td>
                                    <td class="w-1/2 text-right">
                                        {{ $invoice->customer_vat_id }}
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="w-1/2 p-3 border-r border-b border-gray-200 align-top">
                        <table class="w-full">
                            @if($invoice->payment_method === PaymentMethod::BANK_TRANSFER)
                                <tr>
                                    <td class="w-1/2">
                                        {{ __('Bank account') }}:
                                    </td>
                                    <td class="w-1/2 text-right">
                                        {{ $invoice->bankAccount?->number }}
                                        /
                                        {{ $invoice->bankAccount?->bank_code }}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td class="w-1/2">
                                    {{ __('Variable symbol') }}:
                                </td>
                                <td class="w-1/2 text-right">
                                    {{ $invoice->variable_symbol }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-1/2">
                                    {{ __('Payment method') }}:
                                </td>
                                <td class="w-1/2 text-right">
                                    {{ $invoice->payment_method->label() }}
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="w-1/2 p-3 border-b border-gray-200 align-top">
                        <table class="w-full">
                            <tr>
                                <td class="w-1/2">
                                    {{ __('Date of issue') }}:
                                </td>
                                <td class="w-1/2 text-right">
                                    {{ $invoice->issued_at->format('d. m. Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-1/2">
                                    {{ __('Due date') }}:
                                </td>
                                <td class="w-1/2 text-right">
                                    {{ $invoice->due_at->format('d. m. Y') }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <table class="w-full border-collapse border-t border-gray-200">
            <tr>
                <th class="py-1.5 px-3 text-xs text-left border-b border-gray-200">{{ __('Description') }}</th>
                <th class="py-1.5 px-3 text-xs text-left border-b border-gray-200">{{ __('Quantity') }}</th>
                <th class="py-1.5 px-3 text-xs text-right border-b border-gray-200">{{ __('Price per unit') }}</th>
                <th class="py-1.5 px-3 text-xs text-right border-b border-gray-200">{{ __('Total') }}</th>
            </tr>
            @foreach($invoice->items as $item)
                <tr>
                    <td class="py-1.5 px-3 text-sm text-left border-b border-gray-200">{{ $item['description'] }}</td>
                    <td class="py-1.5 px-3 text-sm text-left border-b border-gray-200">{{ $item['quantity'] }} {{ $item['unit'] }}</td>
                    <td class="py-1.5 px-3 text-sm text-right border-b border-gray-200">{{ price((float) $item['unit_price'], $invoice->currency)->format() }}</td>
                    <td class="py-1.5 px-3 text-sm text-right border-b border-gray-200">{{ price((float) $item['total'], $invoice->currency)->format() }}</td>
                </tr>
            @endforeach
        </table>

        <table class="w-full text-base font-bold border-collapse">
            <tr>
                <td class="w-1/2 py-2 px-3 uppercase">{{ __('Total to be paid') }}</td>
                <td class="w-1/2 py-2 px-3 text-right">{{ price($invoice->total_with_vat, $invoice->currency)->format() }}</td>
            </tr>
        </table>

        @if($invoice->payment_method === PaymentMethod::BANK_TRANSFER)
            <div class="mt-6 px-3">
                {!! invoice_qr_payment($invoice)->render() !!}
            </div>
        @endif
    </div>

    @if($invoice->user->tier === UserTier::FREE)
        <div class="py-4 text-center text-xs text-gray-400">{{ __('Generated in the Fakturátor app') }}</div>
    @endif
</div>
</body>
</html>