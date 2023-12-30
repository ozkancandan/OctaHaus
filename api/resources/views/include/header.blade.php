<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Transfer</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
        ul{
            list-style: none;
            padding:0;
            margin:0;
        }
        ul.centered-menu{
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            justify-content: center;
            list-style: none;
            gap: 10px;
            margin-bottom: 0;
            padding-bottom: 0;

        }
        ul li a {
            color: #3f3f3f;
            font-size: 10px;
            font-weight: 400;
        }
        .header {
            padding: 20px;
        }

        a, a:hover {
            text-decoration: none; /* Link altı çizgilerini kaldır */
            position: relative; /* Bağlantıya göre konumlandırma yapmak için */
            color: #3f3f3f;
        }

        a.active:after {
            content: ""; /* Pseudo-element içeriği */
            position: absolute; /* Mutlak konumlandırma */
            width: 70%; /* Yarım altı çizgi için genişlik ayarı */
            height: 1px; /* Altı çizginin kalınlığı */
            background-color: #3f3f3f; /* Altı çizginin rengi */
            bottom: -4px; /* Alt kenara göre konumlandırma */
            left: 0%; /* Orta hizaya getirme */
            transition: width 0.3s ease; /* Animasyonlu genişlik geçişi */

        }
        ul.search-inputs {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 10px;
        }
        ul.search-inputs li:first-child {
            flex-grow: 2;
        }
        .search-box {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 2px solid;
            box-shadow: 5px 5px 0px #ccc;
            margin-bottom: 20px;
        }
        .btn-black {
            background: black;
            border-radius: 0;
            color: white;
            font-size: 10px;
            padding: 5px 20px;
        }
        .btn-outline-black {
            border: 2px solid #000;
            border-radius: 0;
            font-size: 10px;
            padding: 5px 20px;
        }
        .form-control {
            height: 28px;
            font-size: 8px;
            border: 1px solid #000;
            border-radius: 0;
        }
        select.form-control {
            padding-left: 5px;
        }
        ul.holiday-detail {
            position: relative;
            display: flex;
            justify-content: space-between;
        }
        ul.holiday-detail li {
            display: flex;
            flex-direction: column;
        }
        ul.holiday-detail li p, ul.holiday-detail li b {
            margin-bottom: 0;
            font-size: 10px;
        }
        ul.holiday-detail li:last-child{
            display: flex;
        }
        ul.holiday-detail li label, ul.holiday-detail li .form-group{
            margin-bottom: 0;
        }
        .form-group {
            display: block;
            margin-bottom: 15px;
        }

        ul.holiday-detail li .form-group{
            display: flex;
            margin: auto;
        }

        .form-group input {
            padding: 0;
            height: initial;
            width: initial;
            margin-bottom: 0;
            display: none;
            cursor: pointer;
        }

        .form-group label {
            position: relative;
            cursor: pointer;
            position: relative;
            margin: auto;
        }

        .form-group label:before {
            content:'';
            -webkit-appearance: none;
            background-color: transparent;
            border: 2px solid #000000;
            box-shadow: 0;
            padding: 10px;
            display: inline-block;
            position: relative;
            vertical-align: middle;
            cursor: pointer;
            margin-right: 5px;
        }

        .form-group input:checked + label:after {
            content: '';
            display: block;
            position: absolute;
            top: 8px;
            left: 10px;
            width: 5px;
            height: 9px;
            border: solid #000000;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
    </style>
</head>
<body class="antialiased">
