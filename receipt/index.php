<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fund Transfer Receipt</title>
    
    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="http://i.imgur.com/Gl0mDXz.jpg" style="width:100%; max-width:300px;">
                            </td>
                            
                            <td>
                                Transaction Id #: <?php echo $_GET['transactionId']; ?><br>
                                Created: <?php echo $_GET['transactionDate']; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                            </td>
                            
                            <td>
                                <?php echo $_GET['corporateId']; ?><br>
                                <?php echo $_GET['source']; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td colspan="2">
                    Fund Transfer Receipt
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Reference Number
                </td>
                
                <td>
                    <?php echo $_GET['referenceId']; ?>
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Transfer to Account
                </td>
                
                <td>
                    <?php echo $_GET['destination']; ?>
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Beneficiary Name
                </td>
                
                <td>
                    <?php
                        $name = strcmp($_GET['destination'], '8220000053') ? 'A' : 'B';
                        echo 'finhacks13 '.$name;
                    ?>
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Amount
                </td>
                
                <td>
                    <?php echo $_GET['amount']; ?>
                </td>
            </tr>
            
            <tr class="item last">
                <td>
                    Status
                </td>
                
                <td>
                    <?php echo $_GET['status']; ?>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
