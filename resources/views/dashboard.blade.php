<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">      
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-5">
                        <h5 class="text-center mb-3"></h5>
                    </div>
                    <canvas id="productChart" style="width:100%;"></canvas>
                </div>
            </div>
        </div>
    </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    const xValues = {!! ($products->pluck('name')) !!};

    new Chart("productChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [
                {
                    label: "Quantity",
                    data: {!! ($products->pluck('quantity')) !!},
                    borderColor: "red",
                    fill: false
                },
            ]
        },
        options: {
            legend: {display: true},
            title: {
                display: true,
                text: "Product Stock Overview",
                fontSize: 20
            }
        }
        
    });
</script>



</x-app-layout>
