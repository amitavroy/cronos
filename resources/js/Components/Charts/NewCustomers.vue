<script setup>

const signupsChartColors = {
  backgroundBarColors: ['#E5E7EB', '#E5E7EB', '#E5E7EB', '#E5E7EB', '#E5E7EB', '#E5E7EB', '#E5E7EB']
}

const options = {
  labels: ['01 Feb', '02 Feb', '03 Feb', '04 Feb', '05 Feb', '06 Feb', '07 Feb'],
  chart: {
    type: 'bar',
    height: '140px',
    foreColor: '#4B5563',
    fontFamily: 'Inter, sans-serif',
    toolbar: {
      show: false
    }
  },
  theme: {
    monochrome: {
      enabled: true,
      color: '#1A56DB'
    }
  },
  plotOptions: {
    bar: {
      columnWidth: '25%',
      borderRadius: 3,
      colors: {
        backgroundBarColors: signupsChartColors.backgroundBarColors,
        backgroundBarRadius: 3
      },
    },
    dataLabels: {
      hideOverflowingLabels: false
    }
  },
  xaxis: {
    floating: false,
    labels: {
      show: false
    },
    axisBorder: {
      show: false
    },
    axisTicks: {
      show: false
    },
  },
  tooltip: {
    shared: true,
    intersect: false,
    style: {
      fontSize: '14px',
      fontFamily: 'Inter, sans-serif'
    }
  },
  states: {
    hover: {
      filter: {
        type: 'darken',
        value: 0.8
      }
    }
  },
  fill: {
    opacity: 1
  },
  yaxis: {
    show: false
  },
  grid: {
    show: false
  },
  dataLabels: {
    enabled: false
  },
  legend: {
    show: false
  }
};
const series = [
  {
    name: 'Users',
    data: [1334, 2435, 1753, 1328, 1155, 1632, 1336]
  }
]
</script>

<template>
  <div
    class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="w-full">
      <h3 class="text-base font-normal text-gray-500">New customers</h3>
      <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">2,340</span>
      <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
        <span class="flex items-center mr-1.5 text-sm text-green-500 dark:text-green-400">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true">
            <path clip-rule="evenodd" fill-rule="evenodd"
              d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
            </path>
          </svg>
          12.5%
        </span>
        Since last month
      </p>
    </div>
    <div class="w-full">
      <apexchart type="bar" :options="options" :series="series"></apexchart>
    </div>
  </div>
</template>
