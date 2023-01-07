@extends('layouts/dashboard_ts')
@section('head')

    @php
        $tag = new App\Models\Gtag;
        $tag = $tag->where('id','>',0)->first();
        echo !empty($tag)?''.$tag->text.'':'';
    @endphp


    <style>
        body{
            background-color:#f5f5f5;
        }
        .card{
            margin-left: 15%;
            margin-right: 15%;
        }
        .card-body{
            padding: 28px;

        }
        hr.line{
            color: #0000004f;
            margin-top: -25px;
            margin-left: 30px;
            margin-right: 30px;
        }
        /* .row1{
            margin: 30px;
            padding: 20px;
            border: none;
            -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
        } */
        .row1 {
            border-style: solid 2px;
            border-color: #d1d1d1;
            padding-left: 36px;
            padding-top: 12px;
        }
        .active1{
            width: 65px;
            padding: 7px;
            font-size: medium;
            background-color: #aaf0d1 !important;
            color: darkgreen !important;
        }
        .number{
            color: #0000004f;
            margin-top: -2px;
            width: 18%;
        }
    </style>
@endsection
@section('content')

    <!--   Big container   -->
    <div id="app">
        <section class="billing-banner bg-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1>Payment Method</h1>
                    </div>

                    <div class="billing-tabs col-12">
                        <ul class="nav nav-tabs" id="myTab">

                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#UsageandBilling">Usage & Billing</a>
                            </li>
                        </ul>
                        <div class="tab-content col-12 pt-3" id="myTabContent">
                            <div class="tab-pane fade active show usage-billing-wrapper" id="UsageandBilling">

                                <billing-details :info="{{json_encode($all_data)}}"></billing-details>

                                <div class="billing-bg invoice-wrapper mt-5">
                                    <h2>Invoices</h2>
                                    <p>View your payment history</p>
                                    @foreach (auth()->user()->invoices() as $invoice)
                                        <div class="invoice-detail">
                                            <div class="invoice-card">
                                                <div class="invocie-left">
                                                    <img src="/ts/images/invoice-credit-card.svg" alt="">
                                                </div>
                                                <div class="invoice-right">
                                                    <p class="price">{{ $invoice->total() }} on {{ $invoice->date()->toFormattedDateString() }}</p>
                                                    <p class="invocie-status">Subscription update</p>
                                                </div>
                                            </div>

                                            <div class="invocie-link">
                                                <a href="{{ route('user-invoice', $invoice->id) }}"><img src="public/ts/images/download-card.svg" alt=""></a>
                                                {{--<a href=""><img src="public/ts/images/external-link.svg" alt=""></a>--}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="billing-bg cancle-account mt-5 mb-5">
                                    <h2>Cancel account</h2>
                                    <p>We are working on adding self cancellation and it should be ready by early next week. In the mean time if you would like to close your account and delete all content + remaining Credits please send us an email at <a href="mailto:basil@typeskip.ai">basil@typeskip.ai</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal" id="modal-content" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered pricing-popup billing-popup" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form role="dialog" id="request-template-form" action="#" aria-modal="true" aria-labelledby="modal-headline" class="p-6 overflow-hidden transition-all transform bg-white rounded-lg shadow-xl pointer-events-auto sm:max-w-xl sm:w-full sm:p-6">
                            <div class="w-full text-center">
                                <!-- <div class="mdl-close">
                                   <a href="#" data-dismiss="modal"> <img src="public/ts/imagesround-close.svg"></a>
                                </div> -->

                                <div class="payment-wrapper">
                                    <div class="payment-method col-12">
                                        <div class="payment-details-wrapper">
                                            <div class="payment-details">
                                                <div class="payment-options">
                                                    <span>Credit or Debit Card</span>
                                                </div>
                                                <div class="payment-mode">
                                                    <ul>
                                                        <li><a href="#"><img src="public/ts/images/pricing/visa.svg" alt=""></a></li>
                                                        <li><a href="#"><img src="public/ts/images/pricing/mastercard.svg" alt=""></a></li>
                                                        <li><a href="#"><img src="public/ts/images/pricing/discover.svg" alt=""></a></li>
                                                        <li><a href="#"><img src="public/ts/images/pricing/american-express.svg" alt=""></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="payment-info">
                                                <h3>Credit Card Info</h3>
                                                <p>Set your preferred method of payment</p>
                                            </div>
                                            <div class="payment-card">
                                                <span><img src="public/ts/images/pricing/Icon-credit-card.svg" alt=""> Card Number</span>
                                                <span class="date">MM/YY CVC</span>
                                            </div>
                                            <div class="payment-cta">
                                                <a href="#" class="btn cancle-btn">Cancle</a>
                                                <a href="#" class="btn primary-btn ts-btn r-square-btn">Submit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  <!--  big container -->
    </div>
@endsection
