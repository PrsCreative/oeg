<html>
<head>
    <title>Password has been reset</title>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
    <style type="text/css">
        *{
            font-size:12px;
            font-family:Arial, sans-serif;
            color: #000;
        }
    </style>
</head>
<body style="background:#eceae8">
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" style="background:#ffffff;padding-bottom:50px;">
    <tr>
        <td colspan="2">
            <table width="40%" cellpadding="0" cellspacing="0" border="0">
                <tr style="background:#ffffff;">
                    <td align="left" style="padding:20px;">
                        <img class="logo" style="width: 120px;" src="{{ asset('images/logo.gif') }}">
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td colspan="2" style="padding:20px 30px 0 30px;" valign="top">
            <p>Please click on the following link to reset password with OEG</p>
            <a href="{{$link_login}}" target="_blank">Reset Password</a>
        </td>
    </tr>

</table>

</body>
</html>
