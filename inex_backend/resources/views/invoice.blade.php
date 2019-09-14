<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="{{asset('css/invoice.css')}}" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body style="padding: 0; font-family: DejaVu Sans; font-size: 14px; box-sizing: border-box;">
        <table cellspacing="0">
            <tbody>
                <tr>
                    <td style="border-bottom: 3px solid black;">
                        <span style="font-size: 20px">INEX</span>
                        <span>Inessa Dimitrova</span>
                    </td>
                </tr>
            <tr>
                <td colspan="2" >
                    Rue Van Maerlant, 1040 Brussels, Belgium, VAT BE 0662620856
                </td>
            </tr>
            </tbody>
        </table>
        <table style="margin-top: 20px">
            <tbody>
                <tr>
                    <td>
                        Beloil Polska Sp z o.o. <br>
                        ul. Dzielna 58, <br>
                        01-029 Warszawa <br>
                    </td>
                </tr>
            </tbody>
        </table>
        <table CELLSPACING=0>
            <tr>
                <td colspan="2" style="margin: 20px 0 20px 0; font-size: 22px; font-weight: bold;">
                    Разнарядка № {{$number}} от {{date('d-m-Y')}}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Количество: 20 тонн <br>
                    Условия поставки: FCA Речица <br>
                </td>
            </tr>
            <tr>
                <td width="50%" style="border: 1px solid black">
                    Контракт
                </td>
                <td width="50%" style="border: 1px solid black">
                    INEX/LPG/01/2019/07
                </td>
            </tr>
            <tr>
                <td width="50%" style="border: 1px solid black">
                    Нефтепродукт
                </td>
                <td width="50%" style="border: 1px solid black">
                    Изобутан марки А с минимальным до 20 ррм содержанием 1.3 бутадиена и чистотой не менее 99 %
                </td>
            </tr>
            <tr>
                <td width="50%" style="border: 1px solid black">
                    Грузополучатель
                </td>
                <td width="50%" style="border: 1px solid black">
                    INEX, Rue Van Maerlant 11/03, 1040 Brussels, <br>
                    Belgium <br>
                    ИНЕКС, Рю Ван Маерлант 11/03, 1040 Брюссель, <br>
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
                            <td width="50%" style="padding-top:30px; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black">
                                Водитель
                            </td>
                            <td width="50%" style="border-left: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black">
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
                    БКМ Трансгаз РМВ СРЛ (BKM TRANSGAZ RMW S.R.L)
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
                    <img width="120px" height="70px" src="https://inexbelgium.s3.eu-central-1.amazonaws.com/signature.png">
                </td>
            </tr>
        </table>
    </div>
</body>
