<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Avantech</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
            html, body, div, span, applet, object, iframe,
            h1, h2, h3, h4, h5, h6, p, blockquote, pre,
            a, abbr, acronym, address, big, cite, code,
            del, dfn, em, img, ins, kbd, q, s, samp,
            small, strike, b, sub, sup, tt, var,
            b, u, i, center,
            dl, dt, dd, ol, ul, li,
            fieldset, form, label, legend,
            table, caption, tbody, tfoot, thead, tr, th, td,
            article, aside, canvas, details, embed,
            figure, figcaption, footer, header, hgroup,
            menu, nav, output, ruby, section, summary,
            time, mark, audio, video {
                margin: 0;
                padding: 0;
                border: 0;
                font-size: 100%;
                font: inherit;
                vertical-align: baseline;
            }
            /* HTML5 display-role reset for older browsers */
            article, aside, details, figcaption, figure,
            footer, header, hgroup, menu, nav, section {
                display: block;
            }
            body {
                line-height: 1;
            }
            ol, ul {
                list-style: none;
            }
            blockquote, q {
                quotes: none;
            }
            blockquote:before, blockquote:after,
            q:before, q:after {
                content: '';
                content: none;
            }
            table {
                border-collapse: collapse;
                border-spacing: 0;
            }
        </style>

        <style>
            .header {
                border: 1px solid grey;
                border-radius: 10px;
                margin: 20px 5px 5px 5px;
                height: 11%;
                width: 100%;
            }

            .logo {
                border-right: 1px solid grey;
                height: 11%;
                width: 80%;
            }

            #img-logo {
                position: absolute;
                top: 0;
            }

            main {
                border: 1px solid grey;
                border-radius: 10px;
                height: 60%;
                margin: 10px 5px 0px 5px;
                width: 100%;
            }

            table {
                width: 100%;
            }

            table tr td {
                border-right: 1px solid black;
                border-bottom: 1px solid black;
                padding: 2px;
            }

            .last-column {
                border-right: 0;
            }
        </style>
    </head>

    <body>
        <div class="header">
            <div class="logo">
                <img src="images/logo-header.png" id="img-logo">

                <div
                    style="left: 190; position: absolute; top: 20;"
                >
                    <p>SAKAI INFORMÁTICA LTDA.</p>
                    <p>AV. RIO DE JANEIRO, 1.500 - LOJA 2 - CENTRO</p>
                    <p>CEP 86010-150 - LONDRINA PR</p>
                    <p>TELEFONE: 43 3324-9200</p>
                    <p>E-MAIL: comercial@avantech.com.br</p>
                </div>
            </div>

            <div class="service-order">
                <p
                    style="position: absolute; right: 20; top: 20;"
                >
                    Ordem de Serviço
                </p>

                <hr width="19.5%" style="position: absolute; right: 5; top: 20;">

                <p
                    style="position: absolute; right: 50; text-align: center; top: 50;"
                >
                    Nº {{ $ticket->id }}
                </p>

                <p
                    style="position: absolute; right: 12; text-align: center; top: 78;"
                >
                    Emissão: {{ $ticket->updated_at->format('d-m-y') }}
                </p>
            </div>
        </div>

        <main>
            <table>
                @php
                    $client = client($ticket->client_id);
                @endphp

                {{-- Cliente --}}
                <tr>
                    <td colspan="1">Cliente</td>
                    <td colspan="3" class="last-column">{{ $client->name }}</td>
                </tr>

                {{-- Endereço --}}
                <tr>
                    <td colspan="1">Endereço</td>
                    <td colspan="3" class="last-column">{{ $client->address }}</td>
                </tr>

                {{-- Cidade e Telefone --}}
                <tr>
                    <td>Cidade</td>
                    <td>{{ $client->city }}</td>
                    <td>Telefone</td>
                    <td class="last-column">{{ $client->phone }}</td>
                </tr>

                {{-- CNPJ/CPF e INSC. EST. --}}
                <tr>
                    <td>CNPJ/CPF</td>
                    <td>{{ $client->cnpj }}</td>
                    <td>INSC. EST.</td>
                    <td class="last-column">{{ $client->insc }}</td>
                </tr>
            </table>

            <p
                style="font-size: 14px; margin-bottom: 20px; padding: 10px; text-align: center;"
            >
                SENDO PRESTADORA DE SERVIÇOS DE HARDWARE A CONTRATADA NÃO SE RESPONSABILIZA PELOS DADOS EXISTENTES NA MÁQUINA, POIS É DE RESPONSABILIDADE DO CLIENTE EFETUAR A CÓPIA DE SEGURANÇA
            </p>

            <hr
                width="20%"
                style="margin: auto;"
            >

            <p
                style="margin-top: 2px; margin-bottom: 20px; text-align: center;"
            >
                Cliente
            </p>

            <table
                style="width: 100%"
            >
                <tr>
                    <th></th>
                    <th></th>
                </tr>

                {{-- Defeito reclamado --}}
                <tr>
                    <td style="border-top: 1px solid black;">Defeito Reclamado</td>
                    <td class="last-column" style="border-top: 1px solid black;">
                        {{ $ticket->claimed_defect }}
                    </td>
                </tr>

                {{-- Defeito constatado --}}
                <tr>
                    <td>Defeito Constatado</td>
                    <td class="last-column">
                        {{ $ticket->found_defect }}
                    </td>
                </tr>

                {{-- Serviços executados --}}
                <tr>
                    <td>Serviços Executados</td>
                    <td class="last-column">
                        {{ $ticket->service_performed }}
                    </td>
                </tr>

                {{-- Peças trocadas --}}
                <tr>
                    <td>Peças Trocadas</td>
                    <td class="last-column">
                        {{ $ticket->swap_parts }}
                    </td>
                </tr>
            </table>

            <table
                style="margin-bottom: 50px; margin-top: 50px; width: 100%;"
            >
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>

                <tr>
                    <td colspan="2" style="border-top: 1px solid black;">Início do Trabalho</td>
                    <td colspan="2" style="border-top: 1px solid black;" class="last-column">{{ $ticket->created_at->format('d-m-y H:i:s') }}</td>
                </tr>

                <tr>
                    <td colspan="2">Término do Trabalho</td>
                    <td colspan="2" class="last-column">{{ $ticket->updated_at->format('d-m-y H:i:s') }}</td>
                </tr>
            </table>

            <hr
                width="20%"
                style="margin: auto;"
            >

            <p
                style="margin-top: 2px; margin-bottom: 20px; text-align: center;"
            >
                Técnico Responsável
            </p>
        </main>
    </body>
</html>
