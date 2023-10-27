<!DOCTYPE html>
<html>
    <head>
        <title>{{$email_data['subject']}}</title>
        <meta charset="utf-8">
        <style type="text/css">
            body{margin: 0px; padding: 0px;}
            table, table tr{vertical-align: top;border-spacing: 0;}
            table tr{margin: 0px;padding: 0px;border-spacing: 0;}
            table tr td, table tr th{margin: 0px;}
            th, td{padding: 0px; vertical-align: middle;}
            img{margin: 0px;padding: 0px;}
        </style>
    </head>
    <body style="background: #f3f3f3;">
        <table border='0' cellpadding='0' cellspacing='0' style='width:650px; background-color:#ffffff; margin:0px; padding:0px;'>{{ $email_data['email_header'] }}
            <tbody>
                <tr style='width:650px; margin:0px; padding:0px;'>
                    <td style='width:610px; margin:0px; padding:0px 20px; '>
                    <table border='0' cellpadding='0' cellspacing='0' style='width:610px; margin:0px; padding:0px;'><!-- hello user -->
                        <tbody>
                            <tr style='width:610px; margin:0px; padding:0px;'>
                                <td style='width:610px; margin:0px; padding:0px;'>
                                <table style='width:610px; margin:0px; padding:0px; '>
                                    <tbody>
                                        <tr style='width:610px; margin:0px; padding:0px;'>
                                            <td style='width:610px; margin:0px; padding:0px 0px 12px 0px;'>
                                            <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 14px; color: #444444; margin:0px; padding:0px;'>Hello {{ $email_data['to_name'] }},</p>
                                            </td>
                                        </tr>
                                        <tr style='width:610px; margin:0px; padding:0px;'>
                                            <td style='width:610px; margin:0px; padding:0px 0px 8px 0px;'>
                                            <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px; padding:0px;'>A Thank you for your Registration as a {{ $email_data['type'] }}.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </td>
                            </tr>
                            <!-- user details -->
                            <tr style='width:610px; margin:0px; padding:0px;'>
                                <td align='left' style='width:610px; margin:0px; padding: 0px; background: #ffffff;'>
                                <table border='0' cellpadding='0' cellspacing='0' style='width:610px; background-color:#ffffff; margin:0px; padding:0px;'>
                                    <tbody>
                                        <tr style='width:610px; margin:0px; padding:0px;'>
                                            <td style='width:610px; margin:0px; padding:0px 0px 8px 0px;'>
                                            <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px; padding:0px;'>Respective details are as follows:</p>
                                            </td>
                                        </tr>
                                        <tr style='width:610px; margin:0px; padding:0px;'>
                                            <td align='left' colspan='2' style='width:610px; margin:0px; padding: 0px; height: 1px; background: #eeeeee;'>&nbsp;</td>
                                        </tr>
                                        <tr style='width:610px; margin:0px; padding:0px;'>
                                            <td align='left' style='width:188px; margin:0px; padding: 10px; background: #ffffff; border-right: 1px solid #eeeeee; border-left: 1px solid #eeeeee;'>
                                            <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px;'>Name:</p>
                                            </td>
                                            <td align='right' style='width:378px; margin:0px; padding: 10px; background: #ffffff; border-right: 1px solid #eeeeee;'>
                                            <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin: 0px; text-align: left;'><a href='javascript:void(0);' style='text-decoration:none;  color: #333; '>{{ {{ $email_data['to_name'] }} }}</a></p>
                                            </td>
                                        </tr>
                                        <tr style='width:610px; margin:0px; padding:0px;'>
                                            <td align='left' colspan='2' style='width:610px; margin:0px; padding: 0px; height: 1px; background: #eeeeee;'>&nbsp;</td>
                                        </tr>
                                        <tr style='width:610px; margin:0px; padding:0px;'>
                                            <td align='left' style='width:188px; margin:0px; padding: 10px; background: #ffffff; border-right: 1px solid #eeeeee; border-left: 1px solid #eeeeee;'>
                                            <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px;'>Email:</p>
                                            </td>
                                            <td align='right' style='width:378px; margin:0px; padding: 10px; background: #ffffff; border-right: 1px solid #eeeeee;'>
                                            <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin: 0px; text-align: left;'><a href='javascript:void(0);' style='text-decoration:none;  color: #333; '>{{ {{ $email_data['to_email'] }} }}</a></p>
                                            </td>
                                        </tr>
                                        <tr style='width:610px; margin:0px; padding:0px;'>
                                            <td align='left' colspan='2' style='width:610px; margin:0px; padding: 0px; height: 1px; background: #eeeeee;'>&nbsp;</td>
                                        </tr>
                                        <tr style='width:610px; margin:0px; padding:0px;'>
                                            <td align='left' style='width:188px; margin:0px; padding: 10px; background: #ffffff; border-right: 1px solid #eeeeee; border-left: 1px solid #eeeeee;'>
                                            <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px;'>Phone Number:</p>
                                            </td>
                                            <td align='right' style='width:378px; margin:0px; padding: 10px; background: #ffffff; border-right: 1px solid #eeeeee;'>
                                            <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin: 0px; text-align: left;'>{{ $email_data['mobile'] }}</p>
                                            </td>
                                        </tr>
                                        <tr style='width:610px; margin:0px; padding:0px;'>
                                            <td align='left' colspan='2' style='width:610px; margin:0px; padding: 0px; height: 1px; background: #eeeeee;'>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
                <tr>
                    <td style='background: #f94144;padding: 25px 20px;text-align: center;color: #fff;font-size: 14px;'>© CLEANING EXPERT ". date("Y")." ALL RIGHTS RESERVED</td>
                </tr>
            </tbody>
        </table>
	</body>
</html>