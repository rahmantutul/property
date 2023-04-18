<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        body{
            width:1100px;
            margin: auto;
        }
        .heading-border{
            height: 22px;
            width: 1100px;
            background: #f76206;
        }
        .message{
            margin: auto;
        }
        h3{
            width:100%; background:#4d4c4c; color: #fff; margin-top:9px; line-height: 1.5;
        }
        table th{
            text-align: right;
            background: #dedddd;
        }
    </style>
</head>
<body>
        <h2>UsMetroReality A &#174; -Arizona Origon and Washington Properties</h2>
        <div class="heading-border"></div>
        <div class="message">
            <h3>Message To Title</h3>
            <table width="100%">
                <tr>
                    <th width="20%"></th>
                    <td width="70%" style="padding:5px 20px;"> 
                        <b>Dear Tammy LeMaire,</b> <br> <br>
                        Here are broker instructions for this transaction. {{config('app.name')}} agent (listed below) is working on this
                        transaction. A voided check is attached to this email to wire-transfer the commission amount into {{config('app.name')}}
                        company account. <br> <br>
                        Please let us know if you have any questions. Following is the detail:
                    </td>
                </tr>
            </table>
            <h3>Property Information</h3>
            <div style="display: flex; flex-direction: row;">
                <table width="50%">
                    <tr>
                        <th width="20%">Transaction</th>
                        <td width="30%" style="padding:5px 20px;">{{$transaction->transaction_id}}</td>
                    </tr>
                </table>
                <table width="50%">
                    <tr>
                        <td width="20%"> </td>
                        <td width="30%" style="padding:5px 20px;"></td>
                    </tr>
                </table>
            </div>
            <div style="display: flex; flex-direction: row;">
                <table width="50%">
                    <tr>
                        <th width="20%">MLS#</th>
                        <td width="30%" style="padding:5px 20px;">{{$transaction->property->mlsId}}</td>
                    </tr>
                </table>
                <table width="50%">
                    <tr>
                        <th width="20%">Transaction Type </th>
                        @if ($transaction->transection_type == 1)
                            <td width="30%" style="padding:5px 20px;"> Sale Transaction</td>
                        @elseif ($transaction->transection_type == 2)
                            <td width="30%" style="padding:5px 20px;"> Listing Transaction</td>
                        @elseif ($transaction->transection_type == 3)
                            <td width="30%" style="padding:5px 20px;"> Others Transaction</td>
                        @endif
                    </tr>
                </table>
            </div>
            <div style="display: flex; flex-direction: row;">
                <table width="50%">
                    <tr>
                        <th width="20%">Listing Price</th>
                        <td width="30%" style="padding:5px 20px;">  ${{ $transaction->listing_price }}</td>
                    </tr>
                </table>
                <table width="50%">
                    <tr>
                        <th width="20%">Sold Price</th>
                        <td width="30%" style="padding:5px 20px;"> ${{ $transaction->sold_price }}</td>
                    </tr>
                </table>
            </div>
            <div style="display: flex; flex-direction: row;">
                <table width="50%">
                    <tr>
                        <th width="20%">Listing Date</th>
                        <td width="30%" style="padding:5px 20px;"> {{ $transaction->listing_date }}</td>
                    </tr>
                </table>
                <table width="50%">
                    <tr>
                        <th width="20%">Sold Date</th>
                        <td width="30%" style="padding:5px 20px;"> {{ $transaction->sold_date }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <h3>Property Address</h3>
        <div style="display: flex; flex-direction: row;">
            <table width="50%">
                <tr>
                    <th width="20%">Address</th>
                    <td width="30%" style="padding:5px 20px;">{{ $transaction->property_address }}</td>
                </tr>
            </table>
            <table width="50%">
                <tr>
                    <td width="20%"></td>
                    <td width="30%" style="padding:5px 20px;"></td>
                </tr>
            </table>
        </div>
        <div style="display: flex; flex-direction: row;">
            <table width="50%">
                <tr>
                    <th width="20%">City, State Zip</th>
                    <td width="30%" style="padding:5px 20px;"> {{ $transaction->city }}, {{ $transaction->state }} OR {{ $transaction->zip }}</td>
                </tr>
            </table>
            <table width="50%">
                <tr>
                    <td width="20%"></td>
                    <td width="30%" style="padding:5px 20px;"></td>
                </tr>
            </table>
        </div>
        <h3>Buyers information</h3>
        <div style="display: flex; flex-direction: row;">
            <table width="50%">
                <tr>
                    <th width="20%">Buyer Name</th>
                    <td width="30%" style="padding:5px 20px;">{{ $transaction->buyer_one_name }}</td>
                </tr>
            </table>
            <table width="50%">
                <tr>
                    <th width="20%">Buyer Name</th>
                    <td width="30%" style="padding:5px 20px;">{{ $transaction->buyer_two_name }}</td>
                </tr>
            </table>
        </div>
        <div style="display: flex; flex-direction: row;">
            <table width="50%">
                <tr>
                    <th width="20%">Buyer Email</th>
                    <td width="30%" style="padding:5px 20px;">{{ $transaction->buyer_agent_email }}</td>
                </tr>
            </table>
            <table width="50%">
                <tr>
                    <th width="20%">Buyer Address</th>
                    <td width="30%" style="padding:5px 20px;">{{ $transaction->buyer_address }}</td>
                </tr>
            </table>
        </div>
        <h3>Seller information</h3>
        <div style="display: flex; flex-direction: row;">
            <table width="50%">
                <tr>
                    <th width="20%">Seller Name</th>
                    <td width="30%" style="padding:5px 20px;">{{ $transaction->seller_one_name }}</td>
                </tr>
            </table>
            <table width="50%">
                <tr>
                    <th width="20%">Seller Full Address</th>
                    <td width="30%" style="padding:5px 20px;">{{ $transaction->seller_address }}</td>
                </tr>
            </table>
        </div>
        <div style="display: flex; flex-direction: row;">
            <table width="50%">
                <tr>
                    <th width="25%">Seller Email address</th>
                    <td width="30%" style="padding:5px 10px;"> {{ $transaction->seller_agent_email }}</td>
                </tr>
            </table>
            <table width="50%">
                <tr>
                    <th width="20%">Seller Phone</th>
                    <td width="30%" style="padding:5px 20px;">{{ $transaction->seller_agent_phone }}</td>
                </tr>
            </table>
        </div>
        <h3>Title Information</h3>
        <div style="display: flex; flex-direction: row;">
            <table width="50%">
                <tr>
                    <th width="20%">Closing Title</th>
                    <td width="30%" style="padding:5px 20px;">{{ $transaction->closing_title }}</td>
                </tr>
            </table>
            <table width="50%">
                <tr>
                    <th width="25%">Escrow Tran #</th>
                    <td width="30%" style="padding:5px 10px;"> {{ $transaction->escrow_transection }}</td>
                </tr>
            </table>
        </div>
        <div style="display: flex; flex-direction: row;">
            <table width="50%">
                <tr>
                    <th width="20%">Title Full Address</th>
                    <td width="30%" style="padding:5px 20px;">{{ $transaction->title_address }}</td>
                </tr>
            </table>
        </div>
        <h3>Msc information</h3>
        <div style="display: flex; flex-direction: row;">
            <table width="50%">
                <tr>
                    <th width="20%">Commission Amount</th>
                    <td width="30%" style="padding:5px 20px;"> ${{ $transaction->commission_amount }}</td>
                </tr>
            </table>
            <table width="50%">
                <tr>
                    <th width="20%">Commission Type</th>
                    <td width="30%" style="padding:5px 20px;">{{ $transaction->commission_type }}</td>
                </tr>
            </table>
        </div>
        <div style="display: flex; flex-direction: row;">
            <table width="50%">
                <tr>
                    <th width="20%">Earnest Money Amount</th>
                    <td width="30%" style="padding:5px 10px;">${{ $transaction->earnest_money }}</td>
                </tr>
            </table>
            <table width="50%">
                <tr>
                    <th width="20%">Seller Phone</th>
                    <td width="30%" style="padding:5px 20px;">{{ $transaction->seller_phone }}</td>
                </tr>
            </table>
        </div>
        <table width="100%" style="margin-top:12px;">
            <tr>
                <th width="20%" style="text-align: center;">Principal Broker</th>
                <td width="70%" style="padding:5px 20px;"> 
                    Kalim Qamar, principal broker <br><br>
                    Us Metro Realty, Inc.<br><br>
                    Phone: 888-313-0001 Fax: 888-313-0001 <br><br>
                    Principal Broker<br><br>
                    Cell: 503-880-9889 Email: kalim@usMetroRealty.com<br><br>
                    Website: www.usMetroRealty.com <br><br>
                </td>
            </tr>
        </table>
        <div class="heading-border" style="padding:10px;text-align: center; "><b>Copyright © 2021, usMetroRealty®-Arizona, Oregon and Washington Properties. All rights reserved.</b></div>
</body>
</html>