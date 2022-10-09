<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl overflow-hidden mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap bg-white rounded-xl shadow-md p-2 mb-5">
                        <div class="w-full font-black mb-2">Chamados Dia</div>

                        <div class="w-1/2 border-r border-black-200 p-2">Aberto</div>
                        <div class="w-1/2 p-2" id="opened-ticket">{{ $numberOpenedTicket }}</div>

                        <div class="w-1/2 border-r border-black-200 p-2">Em Andamento</div>
                        <div class="w-1/2 p-2" id="in_progress-ticket">{{ $numberInProgressTicket }}</div>

                        <div class="w-1/2 border-r border-black-200 p-2">Aguardando Visita Técnica</div>
                        <div class="w-1/2 p-2" id="in_progress-ticket">{{ $numberWaitingEmp }}</div>

                        <div class="w-1/2 border-r border-black-200 p-2">Fechado</div>
                        <div class="w-1/2 p-2" id="closed-ticket">{{ $numberClosedTicked }}</div>
                    </div>

                    <div class="flex">
                        <div id="columnchart_values" class="w-full"></div>
                    </div>

                    {{-- <div id="barchart_values" style="mt-5"></div> --}}
                </div>
            </div>
        </div>


    </div>

    <x-slot name="scripts">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <script>
            Echo.channel('ticket')
                .listen("TicketChanged", (e) => {
                    console.log(e.numberOpenedTicket);
                    const openedTicket = document.getElementById('opened-ticket');
                    const inProgressTicket = document.getElementById('in_progress-ticket');
                    const closedTicket = document.getElementById('closed-ticket');

                    openedTicket.innerText = e.numberOpenedTicket;
                    inProgressTicket.innerText = e.numberInProgressTicket;
                    closedTicket.innerText = e.numberClosedTicked;
                });
        </script>

        <script>
            window.addEventListener('resize', function(event) {
                console.log(event);
                quantityTicketMonth();
            }, true);

            google.charts.load("current", {packages:['corechart']});
            google.charts.setOnLoadCallback(quantityTicketMonth);

            function quantityTicketMonth() {
                var data = google.visualization.arrayToDataTable([
                    ["Mês", "Quantidade", { role: "style" } ],
                    ["Jan", {{ quantityTicket('01') }}, "color: #e5e4e2"],
                    ["Fev", {{ quantityTicket('02') }}, "color: #e5e4e2"],
                    ["Mar", {{ quantityTicket('03') }}, "color: #e5e4e2"],
                    ["Abr", {{ quantityTicket('04') }}, "color: #e5e4e2"],
                    ["Mai", {{ quantityTicket('05') }}, "color: #e5e4e2"],
                    ["Jun", {{ quantityTicket('06') }}, "color: #e5e4e2"],
                    ["Jul", {{ quantityTicket('07') }}, "color: #e5e4e2"],
                    ["Ago", {{ quantityTicket('08') }}, "color: #e5e4e2"],
                    ["Set", {{ quantityTicket('09') }}, "color: #e5e4e2"],
                    ["Out", {{ quantityTicket('10') }}, "color: #e5e4e2"],
                    ["Nov", {{ quantityTicket('11') }}, "color: #e5e4e2"],
                    ["Dez", {{ quantityTicket('12') }}, "color: #e5e4e2"]
                ]);

                var view = new google.visualization.DataView(data);
                view.setColumns([
                    0,
                    1,
                    { calc: "stringify", sourceColumn: 1, type: "string", role: "annotation" },
                    2
                ]);

                var options = {
                    title: "Quantidade de Chamados",
                    width: "100%",
                    height: 400,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                chart.draw(view, options);
            }
        </script>
    </x-slot>
</x-app-layout>
