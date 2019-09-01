<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="{{asset('css/invoice.css')}}" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body style="padding: 50px; font-family: DejaVu Sans; font-size: 10px; box-sizing: border-box;">
    <header style="font-size: 20px">
        <div style="display: flex;
    align-items: baseline;
    border-bottom: 3px solid black;">
            <h1>INEX</h1>
            <h4>Inessa Dimitrova</h4>
        </div>
        <div>
            -
        </div>
        <div style="margin-bottom: 30px;">
            Rue Van Maerlant, 1040 Brussels, Belgium, VAT BE 0662620856
        </div>
        <div style="display: flex;
    align-content: flex-end;">
            <div style="flex-grow: 1;
    margin: 0;">
                Beloil Polska Sp z o.o. <br>
                ul. Dzielna 58, <br>
                01-029 Warszawa <br>
            </div>
            <div style="margin: 0;
    display: flex;
    flex-grow: 1;
    flex-direction: column;
    justify-content: flex-end;">
                <p>Брюссель, {{$date}}</p>
            </div>
        </div>
    </header>
    <div style="font-size: 20px">
        <div style="font-size: 22px;
    font-weight: bold;">
            Разнарядка № {{$number}}
        </div>
        <div class="main-text">
            на отгрузку нефтепродуктов на экспорт по контракту INEX/LPG/01/2019/07
            Наименование нефтепродукта Изобутан марки А- просьба загрузить продукт с
            минимальным до 20 ррм содержанием 1.3 бутадиена и чистотой не менее 99 % <br>
            Количество (тонн) 20 тонн <br>
            Условия поставки: FCA Речица <br>
        </div>
        <div style="display: grid;
    grid-template-columns: repeat(2, 50%);
    grid-template-rows: repeat(3, auto);
    padding: 1px;
    margin-left: 0;
    margin-right: 0;">
            <div style="margin: 0;
    padding: 1vh;
    border-top: 1px solid black;">
                Грузополучатель
            </div>
            <div style="margin: 0;
    padding: 1vh;
    border-top: 1px solid black;">
                INEX, Rue Van Maerlant 11/03, 1040 Brussels, <br>
                Belgium <br>
                ИНЕКС, Рю Ван Маерлант 11/03, Брюссель, <br>
                Бельгия
            </div>
            <div style="margin: 0;
    padding: 1vh;
    border-top: 1px solid black;
    grid-row: 2 / span 1;
    grid-column: 1 / span 2;
    display: grid;
    grid-template-columns: repeat(2, 50%);
    grid-template-rows: repeat(3, auto);">
                <div class="table-item-cistern_item">
                    Тягач, цистерна
                </div>
                <div class="table-item-cistern_item">
                    {{$truckNumber}}
                </div>
                <div class="table-item-cistern_item">
                    Водитель
                </div>
                <div class="table-item-cistern_item">
                    {{$driver}}
                </div>
                <div class="table-item-cistern_item">
                    Паспорт
                </div>
                <div class="table-item-cistern_item">
                    {{$driverPassport}}
                </div>
            </div>
            <div style="margin: 0;
    padding: 1vh;
    border-top: 1px solid black;">
                Вес не более
            </div>
            <div style="margin: 0;
    padding: 1vh;
    border-top: 1px solid black;">
                20 т
            </div>
            <div style="margin: 0;
    padding: 1vh;
    border-top: 1px solid black;">
                Срок поставки авто под загрузку
            </div>
            <div style="margin: 0;
    padding: 1vh;
    border-top: 1px solid black;">
                23-24/08/2019
            </div>
            <div style="margin: 0;
    padding: 1vh;
    border-top: 1px solid black;">
                Место разгрузки
            </div>
            <div style="margin: 0;
    padding: 1vh;
    border-top: 1px solid black;">
                Valcea, 247271, Ionesti, Bucsani-La Balastiera
            </div>
            <div style="margin: 0;
    padding: 1vh;
    border-top: 1px solid black;">
                Погран-переходы
            </div>
            <div style="margin: 0;
    padding: 1vh;
    border-top: 1px solid black;">
                Новая Рудня/Выступовичи; Порубное/Сирет
            </div>
            <div style="margin: 0;
    padding: 1vh;
    border-top: 1px solid black;">
                Перевозчик
            </div>
            <div style="margin: 0;
    padding: 1vh;
    border-top: 1px solid black;">
                БКМ Трансгаз РМВ СРЛ <br>
                (BKM NTRANSGAZ RMW S.R.L)
            </div>
            <div style="margin: 0;
    padding: 1vh;
    border-top: 1px solid black;
border-bottom: 1px solid black;">
                Стоимость транспортировки
            </div>
            <div style="margin: 0;
    padding: 1vh;
    border-top: 1px solid black;
border-bottom: 1px solid black;">
                От Речицы до погран-перехода BY/UA 15 евро/т
            </div>
        </div>
        <div style="margin: 0;
    display: flex;">
            <div style="flex-grow: 1;">
                С уважением, <br>
                И. Димитрова
            </div>
            <div style="flex-grow: 1;">
                <img style="max-height: 70px;" src='/images/signature.png'>
            </div>
        </div>
    </div>
</body>
