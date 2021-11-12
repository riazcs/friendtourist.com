<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice: {{ $booking->invoice_no }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

        * {
            padding: 0;
            margin: 0;
        }

        * {
            color-adjust: exact !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
            font-weight: 500;
            font-size: 16px;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: 16px;
            font-weight: 600;

        }

        p {
            font-size: 14px;
            font-weight: 500;
            color: #2b2b2b;
        }

        #pageborder {
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            border: 2px solid rgb(240, 240, 240);
        }

        .container {
            padding: 0 20px;
        }

        body:before {
            content: "www.friendtourist.com";
            background: ;
            position: fixed;
            z-index: -2;
            left: 0;
            bottom: 0;
            right: 0;
            top: 0;
            font-size: 50px;
            display: grid;
            justify-content: center;
            align-content: center;
            opacity: 0.1;
            transform: rotate(-45deg);
        }
    </style>
</head>

<body>
<div id=pageborder>
</div>
<div class="container">
    <header>
        <div style="display: flex; justify-content: space-between; column-gap: 10px; border-bottom: 1px solid #e6e6e6;padding: 10px 0;">

            <div>
                <img src="{{ asset('images/logo-text.png') }}" height="40" alt="logo">
            </div>
            <div>
                <p>Friend Tourist Receipt <br> Confirmation Code ABCD1234</p>
            </div>
            <div style="text-align: right;">
                <h2>{{ config('app.name') }}</h2>
                <p>{{ config('app.address') }}</p>
            </div>
        </div>
    </header>

    <section style="padding: 20px 0">
        <div style="display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
                <h2>Confirmed {{ $booking->nights }} nights in {{ $booking->hotel->name }}</h2>
                <p>{{ $booking->hotel->address_line }}, {{ $booking->hotel->area }} , {{ $booking->hotel->district->name }}</p>
                <p>{{ \Carbon\Carbon::parse($booking->created_at)->format('l d,M Y') }} </p>
            </div>
            <div>
                <h2 style="text-transform: capitalize;">{{ $booking->user->name }}</h2>
                <p>Phone: {{ $booking->user->phone }}</p>
            </div>
        </div>
    </section>

    <section style="margin-bottom: 20px;">
        <div style="display: flex; justify-content: space-between; gap: 20px;">
            <div style="border: 1px solid #e6e6e6; padding: 20px; width: 100%; border-radius: 5px;">
                <div
                    style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e6e6e6; padding-bottom: 20px;">
                    <div>
                        <h2 style="font-size: 14px;">Check In</h2>
                        <h2>{{ $booking->check_in_date }}</h2>
                    </div>
                    <div style="align-self: center;">
                        <span><svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px;" fill="none"
                                   viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <h2 style="font-size: 14px;">Check Out</h2>
                        <h2>{{ $booking->check_out_date }}</h2>
                    </div>
                </div>

                <div style="margin-top: 20px;">
                    <!-- Room Details start -->
                    @foreach($booking->booked_rooms as $booked_room)
                    <div style="padding-bottom: 10px;">
                        <h2 style="padding-bottom: 5px;">{{ $booked_room->room_name }}</h2>
                        <p>{{ $booked_room->room_qty }} Room(s), {{ $booked_room->room->beds()->count() }} Bed(s), {{ $booked_room->room->adult_occupancy }} Guest(s)</p>
                    </div>
                    @endforeach
                </div>
                <div
                    style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e6e6e6; padding: 10px 0 0;">
                    <div>
                        <h2 style="font-size: 14px;">Total Room(s): {{ $booking->total_room }}</h2>
                    </div>
                    <div>
                        <h2 style="font-size: 14px;">Adult: {{ $booking->adult }}</h2>
                    </div>
                    <div>
                        <h2 style="font-size: 14px;">Child: {{ $booking->child }}</h2>
                    </div>
                </div>
            </div>
            <div style="width: 100%;">
                <div style="border: 1px solid #e6e6e6;padding: 10px; margin-bottom: 15px;border-radius: 5px;">
                    <h2 style="padding-bottom: 10px;">Charges</h2>
                    <div style="display: flex; justify-content: space-between;padding-bottom: 10px;">
                        <p>Sub Total:</p>
                        <p>{{ $booking->sub_total }} BDT</p>
                    </div>
                    <div style="display: flex; justify-content: space-between;padding-bottom: 10px;">
                        <p>Tax & Service Fee:</p>
                        <p>{{ $booking->total_charge }} BDT</p>
                    </div>
                    @if($booking->coupon_discount && $booking->coupon_discount> 0 )
                    <div style="display: flex; justify-content: space-between;padding-bottom: 10px;">
                        <p>Coupon:</p>
                        <p>-{{ $booking->coupon_discount }} BDT</p>
                    </div>
                    @endif
                    <div style="display: flex; justify-content: space-between;padding-bottom: 10px;">
                        <p>Convenience Fee:</p>
                        <p>{{ $booking->convenience_fee }} BDT</p>
                    </div>
                    <div style="display: flex; justify-content: space-between;padding-bottom: 10px;">
                        <h2>Total:</h2>
                        <h2>{{ $booking->total_amount }} BDT</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div
            style="display: flex; justify-content: space-between;  justify-items:center; border-top: 1px solid #e6e6e6; border-bottom: 1px solid #e6e6e6; padding: 20px 0;">
            <div>
                <h2 style="padding-bottom: 10px;">Need Help</h2>
                <p>Call help center for any questions. <span>{{ config('app.phone') }}</span></p>
            </div>
            <div>
                <h2>Friend Tourist</h2>
                <p>{{ config('app.address') }}</p>
            </div>
        </div>
    </section>
</div>
<script>
    window.addEventListener('load', (event) => {
        console.log('page is fully loaded');
        window.print();
    });
    window.addEventListener("afterprint", function(event) {
        console.log('print cancel');
        window.close();
    });
</script>
</body>

</html>
