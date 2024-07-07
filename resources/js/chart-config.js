/*$(document).ready(function () {
    let testBowieBar = document.getElementById('testBowieChart');
    $.get('/testbowie/chart-data', function (response) {
        let testBowieChart = new Chart(testBowieBar, {
            type: 'bar',
            data: {
                labels: response.TBD_Correcto.original.days,
                datasets: [{
                    label: 'Positivo',
                    data: response.TBD_Correcto.original.data,
                    backgroundColor: [
                        '#6366F1',
                    ],
                    borderColor: [
                        '#6366F1',
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Negativo',
                    data: response.TBD_Falla.original.data,
                    backgroundColor: [
                        '#A5B4FC',
                    ],
                    borderColor: [
                        '#A5B4FC',
                    ],
                    borderWidth: 1
                }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

    let overviewChart = document.getElementById('currentMonthChart');
    $.get('/current-month/chart-data', function (response) {
        let currentMonthChart = new Chart(overviewChart, {
            type: 'doughnut',
            data: {
                labels: ['Sales', 'Purchases', 'Expenses'],
                datasets: [{
                    data: [response.sales, response.purchases, response.expenses],
                    backgroundColor: [
                        '#F59E0B',
                        '#0284C7',
                        '#EF4444',
                    ],
                    hoverBackgroundColor: [
                        '#F59E0B',
                        '#0284C7',
                        '#EF4444',
                    ],
                }]
            },
        });
    });

    let paymentChart = document.getElementById('paymentChart');
    $.get('/payment-flow/chart-data', function (response) {
        let cashflowChart = new Chart(paymentChart, {
            type: 'line',
            data: {
                labels: response.months,
                datasets: [
                    {
                        label: 'Payment Sent',
                        data: response.payment_sent,
                        fill: false,
                        borderColor: '#EA580C',
                        tension: 0
                    },
                    {
                        label: 'Payment Received',
                        data: response.payment_received,
                        fill: false,
                        borderColor: '#2563EB',
                        tension: 0
                    },
                ]
            },
        });
    });
});
*/

$(document).ready(function() {

	// Bar Chart
	
	Morris.Bar({
		element: 'testBowieChart',
		data: [
			{ y: '2006', a: 100, b: 90, c: 10, d: 50},
			{ y: '2007', a: 100, b: 90, c: 10, d: 100},
			{ y: '2008', a: 10, b: 60, c: 10, d: 50},
			{ y: '2009', a: 100, b: 90, c: 100, d: 50},
			{ y: '2010', a: 70, b: 30, c: 10, d: 50},
		
		],
		xkey: 'y',
		ykeys: ['a', 'b','c','d'],
		labels: ['Total Fallos Vapor 1', 'Total Correctos Vapor 1','Total Fallos Vapor 2', 'Total Correctos Vapor 2'],
		lineColors: ['#f43b48','#453a94','#e1bc16','#3ba453'],
		lineWidth: '3px',
		barColors: ['#f43b48','#453a94','#e1bc16','#3ba453'],
		resize: true,
		redraw: true
	});
	
	// Line Chart
	
	Morris.Line({
		element: 'line-charts',
		data: [
			{ y: '2006', a: 100, b: 90, c: 10, d: 50},
			{ y: '2007', a: 100, b: 90, c: 10, d: 100},
			{ y: '2008', a: 10, b: 60, c: 10, d: 50},
			{ y: '2009', a: 100, b: 90, c: 100, d: 50},
			{ y: '2010', a: 70, b: 30, c: 10, d: 50},
		],
		xkey: 'y',
		ykeys: ['a', 'b','c','d'],
		labels: ['Total Fallos Vapor 1', 'Total Correctos Vapor 1','Total Fallos Vapor 2', 'Total Correctos Vapor 2'],
		lineColors: ['#f43b48','#453a94','#e1bc16','#3ba453'],
		lineWidth: '3px',
		barColors: ['#f43b48','#453a94','#e1bc16','#3ba453'],
		lineWidth: '3px',
		resize: true,
		redraw: true
	});
	Morris.Bar({
		element: 'bar-charts2',
		data: [
			{ y: '2006', a: 10, b: 90, c: 10, d: 50},
			{ y: '2007', a: 10, b: 90, c: 10, d: 100},
			{ y: '2008', a: 10, b: 60, c: 10, d: 50},
			{ y: '2009', a: 10, b: 90, c: 10, d: 50},
			{ y: '2010', a: 70, b: 30, c: 10, d: 50},
		
		],
		xkey: 'y',
		ykeys: ['a', 'b','c','d'],
		labels: ['Total Fallos Vapor 1', 'Total Correctos Vapor 1','Total Fallos Vapor 2', 'Total Correctos Vapor 2'],
		lineColors: ['#f43b48','#453a94','#e1bc16','#3ba453'],
		lineWidth: '3px',
		barColors: ['#f43b48','#453a94','#e1bc16','#3ba453'],
		resize: true,
		redraw: true
	});
	
	// Line Chart
	
	Morris.Line({
		element: 'line-charts2',
		data: [
			{ y: '2006', a: 10, b: 90, c: 10, d: 50},
			{ y: '2007', a: 100, b: 90, c: 10, d: 100},
			{ y: '2008', a: 10, b: 60, c: 10, d: 50},
			{ y: '2009', a: 10, b: 90, c: 10, d: 50},
			{ y: '2010', a: 70, b: 30, c: 10, d: 50},
		],
		xkey: 'y',
		ykeys: ['a', 'b','c','d'],
		labels: ['Total Fallos Vapor 1', 'Total Correctos Vapor 1','Total Fallos Vapor 2', 'Total Correctos Vapor 2'],
		lineColors: ['#f43b48','#453a94','#e1bc16','#3ba453'],
		lineWidth: '3px',
		barColors: ['#f43b48','#453a94','#e1bc16','#3ba453'],
		lineWidth: '3px',
		resize: true,
		redraw: true
	});
		
});