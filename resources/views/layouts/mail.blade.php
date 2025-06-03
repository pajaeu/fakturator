<!doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fakturátor</title>
</head>
<body style="color: #1E2939; background-color: #ffffff; margin: 0; padding: 0;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
    <tbody>
    <tr>
        <td>
            <table align="center" border="0" cellpadding="0" cellspacing="0" style="color: #1E2939; font-size: 16px; width: 500px; margin: 0 auto;" width="500">
                <tr>
                    <td style="padding: 35px 30px 20px; text-align: center">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Fakturátor logo" style="height: 32px">
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="padding: 30px; color: #1E2939; text-align: center; background-color: #ffffff;">{{ $slot }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px 30px 40px; color: #D1D5DC; font-size: 12px; text-align: center">
                        <p style="color: #64748b;">
                            Codetiv, Těšínská 1652/79, 746 01 Opava<br/>
                            e-mail: info@codetiv.cz<br/>
                            tel.: +420 737 792 267<br/>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>