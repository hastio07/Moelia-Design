<!DOCTYPE html>
<html lang="id">

<head>
    <title>CONFIRMATION EMAIL TEMPLATE</title>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
    <meta content="width=device-width" name="viewport" />
    <link href="https://fonts.googleapis.com/css?family=Lato|Lato:i,b,bi" hs-webfonts="true" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style media="all" type="text/css">
        @media only screen and (max-width: 576px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<body style="font-family: Lato, sans-serif; margin: 0; padding: 0; box-sizing: border-box; color: #74787e; height: 100%; width: 100%; hyphens: auto; line-height: 1 0.4; -moz-hyphens: auto; -ms-word-break: break-all; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word; background-color: #f2f4f6;">
    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="width: 100%; margin: 0; padding: 0; background-color: #f2f4f6">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <!-- Header Section -->
                    <tr>
                        <td style="padding: 25px 0; text-align: center">
                            <a href="#" rel="nofollow noopener noreferrer" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 16px; font-weight: bold; color: #2f3133; text-decoration: none; text-shadow: 0 1px 0 white;" target="_blank">
                                <img alt="moeliadesign" src="https://raw.githubusercontent.com/hastio07/Moelia-Design/master/public/img/logoMulia.jpg" style="max-width: 100%; border: none;  width: 110px; border-radius: 100%;" /></a>
                        </td>
                    </tr>
                    <!-- Content Text Section -->
                    <tr>
                        <td style="width: 100%; margin: 0; padding: 0; border-top: 1px solid #edeff2; border-bottom: 1px solid #edeff2; background-color: #fff;" width="100%">
                            <table align="center" cellpadding="0" cellspacing="0" style="width: auto; max-width: 570px; margin: 0 auto; padding: 0;" width="570">
                                <tr>
                                    <td style="padding: 35px">
                                        <h1 style="margin-top: 0; color: #2f3133; font-size: 19px; font-weight: bold; text-align: left;">
                                            Selamat datang di Moelia Design!
                                        </h1>
                                        <p style="text-align: left; margin-top: 0; color: #74787e; font-size: 16px; line-height: 1.5em;">
                                            Silakan tekan tombol di bawah ini untuk reset password akun MoeliaDesign Anda:
                                        </p>

                                        <table align="center" cellpadding="0" cellspacing="0" style="width: 100%; margin: 30px auto; padding: 0; text-align: center;" width="100%">
                                            <tr>
                                                <td align="center" style="font-family: Avenir, Helvetica, sans-serif">
                                                    <a class="button" href="{{ $actionUrl }}" rel="nofollow noopener noreferrer" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; display: inline-block; width: 200px; min-height: 20px; padding: 10px; background-color: #dc3535; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px; text-align: center; text-decoration: none;" target="_blank">
                                                        Atur Ulang Kata Sandi
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                        <p style="text-align: left; margin-top: 0; color: #74787e; font-size: 16px; line-height: 1.5em;">
                                            Link reset password ini akan kedaluwarsa dalam 60 menit
                                        </p>
                                        <p style="text-align: left; margin-top: 0; color: #74787e; font-size: 16px; line-height: 1.5em;">
                                            Jika Anda tidak meminta pengaturan ulang password, tidak perlu melakukan tindakan lebih lanjut.
                                        </p>
                                        <p style="text-align: left; margin-top: 0; color: #74787e; font-size: 16px; line-height: 1.5em;">
                                            Terima kasih telah menggunakan MoeliaDesign.
                                        </p>

                                        <p style="text-align: left; margin-top: 0; color: #74787e; font-size: 16px; line-height: 1.5em;">
                                            Salam,<br />MD
                                        </p>

                                        <table style="margin-top: 25px; padding-top: 25px; border-top: 1px solid #edeff2;">
                                            <tr>
                                                <td style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
                                                    <p style="text-align: left;margin-top: 0;color: #74787e;font-size: 12px;  line-height: 1.5em;">
                                                        Jika Anda mengalami kesulitan untuk menekan tombol &quot;<b>Atur Ulang Kata Sandi</b>&quot;, silahkan salin dan tempel tautan di bawah ini ke peramban Anda:
                                                    </p>
                                                    <p style="text-align: left;margin-top: 0;color: #74787e;font-size: 12px;line-height: 1.5em;">
                                                        <a href="{{ $actionUrl }}" rel="nofollow noopener noreferrer" style="color: #ff291b" target="_blank">
                                                            {{ $actionUrl }}
                                                        </a>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Footer Section -->
                    <tr>
                        <td>
                            <table align="center" cellpadding="0" cellspacing="0" style="width: auto;max-width: 570px;margin: 0 auto;padding: 0;text-align: center;" width="570">
                                <!-- Footer Copyright Section -->
                                <tr>
                                    <td style="font-family: Arial, 'Helvetica Neue', Helvetica,sans-serif;color: #aeaeae; padding: 35px 35px 0 35px;text-align: center;">
                                        <p style="text-align: left;margin-top: 0;color: #74787e;font-size: 12px;line-height: 1.5em;">
                                            ©2023
                                            <a href="#" rel="nofollow noopener noreferrer" style="color: #ff291b" target="_blank">MoeliaDesign</a>.
                                            <span style="color: #99acc2"> Made with &hearts;</span>.
                                        </p>
                                    </td>
                                </tr>
                                <!-- Footer Social Media Section -->
                                <tr>
                                    <td style="padding: 0 35px 35px 35px">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <a href="{{ $sosmeds->l_facebook }}" style="text-decoration: none" target="_blank">
                                                        <i class="bi bi-facebook" style="color:blue;font-size:18px;"></i>
                                                    </a>
                                                </td>
                                                <td style="width: 6px" width="6">&nbsp;</td>
                                                <td>
                                                    <a href="{{ $sosmeds->l_twitter }}" style="text-decoration: none" target="_blank">
                                                        <i class="bi bi-twitter" style="color:lightblue;font-size:18px;"></i>
                                                    </a>
                                                </td>
                                                <td style="width: 6px" width="6">&nbsp;</td>
                                                <td>
                                                    <a href="{{ $sosmeds->l_youtube }}" style="text-decoration: none" target="_blank">
                                                        <i class="bi bi-youtube" style="color:red;font-size:18px;"></i>
                                                    </a>
                                                </td>
                                                <td style="width: 6px" width="6">&nbsp;</td>
                                                <td>
                                                    <a href="{{ $sosmeds->l_tiktok }}" style="text-decoration: none" target="_blank">
                                                        <i class="bi bi-tiktok" style="color:black;font-size:18px;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
