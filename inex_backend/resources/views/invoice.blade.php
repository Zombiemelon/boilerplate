<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="{{asset('css/invoice.css')}}" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body style="padding: 20px; font-family: DejaVu Sans; font-size: 16px; box-sizing: border-box;">
    <header style="font-size: 16px">
        <table style="border-bottom: 3px solid black;">
            <tbody>
                <tr>
                    <td>
                        <h1>INEX</h1>
                    </td>
                    <td valign="bottom">
                        <h4>Inessa Dimitrova</h4>
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
            -
        </div>
        <div style="margin-bottom: 30px;">
            Rue Van Maerlant, 1040 Brussels, Belgium, VAT BE 0662620856
        </div>
        <table>
            <tbody>
                <tr>
                    <td>
                        Beloil Polska Sp z o.o. <br>
                        ul. Dzielna 58, <br>
                        01-029 Warszawa <br>
                    </td>
                    <td valign="bottom">
                        <p>Брюссель, {{$date}}</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </header>
    <div>
        <div style="margin: 20px 0 20px 0; font-size: 22px; font-weight: bold;">
            Разнарядка № {{$number}}
        </div>
        <div class="main-text" style="margin-bottom: 20px">
            на отгрузку нефтепродуктов на экспорт по контракту INEX/LPG/01/2019/07
            Наименование нефтепродукта Изобутан марки А- просьба загрузить продукт с
            минимальным до 20 ррм содержанием 1.3 бутадиена и чистотой не менее 99 % <br>
            Количество (тонн) 20 тонн <br>
            Условия поставки: FCA Речица <br>
        </div>
        <table CELLSPACING=0>
            <tr>
                <td width="50%" style="border: 1px solid black">
                    Грузополучатель
                </td>
                <td width="50%" style="border: 1px solid black">
                    INEX, Rue Van Maerlant 11/03, 1040 Brussels, <br>
                    Belgium <br>
                    ИНЕКС, Рю Ван Маерлант 11/03, Брюссель, <br>
                    Бельгия
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 0">
                    <table CELLSPACING=0 width="100%">
                        <tr>
                            <td width="50%" style="padding-top:30px; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black">
                                Тягач, цистерна
                            </td>
                            <td width="50%" style="border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black">
                                {{$truckNumber}}
                            </td>
                        </tr>
                        <tr style="padding: 10px">
                            <td width="50%" style="padding-top:30px; border-left: 1px solid black; border-right: 1px solid black">
                                Водитель
                            </td>
                            <td width="50%" style="border-left: 1px solid black; border-left: 1px solid black; border-right: 1px solid black">
                                {{$driver}}
                            </td>
                        </tr>
                        <tr style="padding: 10px">
                            <td width="50%" style="padding-top:30px; border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">
                                Паспорт
                            </td>
                            <td width="50%" style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">
                                {{$driverPassport}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td valign="bottom" width="50%" style="padding-top:30px; border-left: 1px solid black; border-right: 1px solid black">
                    Вес не более
                </td>
                <td valign="bottom" width="50%" style="border-left: 1px solid black; border-right: 1px solid black">
                    20 т
                </td>
            </tr>
            <tr>
                <td valign="bottom" width="50%" style="padding-top:30px; border: 1px solid black">
                    Срок поставки авто под загрузку
                </td>
                <td valign="bottom" width="50%" style="border: 1px solid black">
                    {{$dateForLoading}}
                </td>
            </tr>
            <tr>
                <td valign="bottom" width="50%" style="padding-top:30px; border: 1px solid black">
                    Место разгрузки
                </td>
                <td valign="bottom" width="50%" style="border: 1px solid black">
                    Valcea, 247271, Ionesti, Bucsani-La Balastiera
                </td>
            </tr>
            <tr>
                <td valign="bottom" width="50%" style="padding-top:30px; border: 1px solid black">
                    Погран-переходы
                </td>
                <td valign="bottom" width="50%" style="border: 1px solid black">
                    Новая Рудня/Выступовичи; Порубное/Сирет
                </td>
            </tr>
            <tr>
                <td valign="bottom" width="50%" style="padding-top:30px; border: 1px solid black">
                    Перевозчик
                </td>
                <td valign="bottom" width="50%" style="border: 1px solid black">
                    БКМ Трансгаз РМВ СРЛ (BKM NTRANSGAZ RMW S.R.L)
                </td>
            </tr>
            <tr>
                <td valign="bottom" width="50%" style="padding-top:30px; border: 1px solid black">
                    Стоимость транспортировки
                </td>
                <td valign="bottom" width="50%" style="border: 1px solid black">
                    От Речицы до погран-перехода BY/UA 15 евро/т
                </td>
            </tr>
            <tr>
                <td valign="bottom" width="50%" style="padding-top:30px">
                    С уважением, <br>
                    И. Димитрова
                </td>
                <td valign="bottom" width="50%">
                    <img width="120px" height="70px" src="https://lh3.googleusercontent.com/--2xwQGwogePSNPuiz3rHW1SyBPVZSXQjYXCoVN2AEQJVgkUuXS9Jjy2xuYjJ8F25xLJyDRFk9zPcVf7Pp9ypQDjPuY9m1vHvprwSmDYqwcuqammRGWmF4UXx-HplYiDeG1PVVnay9fV-IyVrUbSznWE3hmVyaObL9k9iYFnJtErxNxdr_bfIJq6KOZBt013tsr7mlwG8ndUTVVzfGoE-nDd-zI8Yp_oKV4GqLJ8fWc4jyaOfpjFBe4C2QLxwV1h9LhknRbzOYAUPTZohdSDbbPK87NXN3BTc3Y-aCUvx6o-9FE2Sb1Ayfv2NlE6e1OP2Tc5OWUjZNogaAfIeBt4wsX0W1KBg0Q0Ovdw8Bq1YCGAuuKQ88_wU7Y8YwFA_Gk0PDrHdVENV-TqQUtPjtubjBAlAfkUMqdKiLgruz0B-_2GdiDzx6B6loRxSmZhxZbJukHRuwhBkAzzCCVW_DclF0FHllt9WzVsqO627uBYDg9bAJyLgfSvyoXvZCxIyPs0p-nFEzNwlumRDuYUT3gL4z5K90-_FVw_fVKks374R4HK872r1xdu4Qi6ZRLEZ9-cgP5dG07DuibfZtufor6SRxV1_CCLuOLH4bqpYa2PdnPv585Sg53onhk7AUGCh8RNeKPunB3PVXh64NSKFLrm3g8jdtxhB9JbEEoGkroVCoJLaVs8WYzB1Ig=w440-h232-no">
                </td>
            </tr>
        </table>
        </div>
    </div>
</body>
