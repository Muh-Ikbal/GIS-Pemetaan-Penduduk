
const iconSideNav =  document.getElementById('iconNavbarSidenav')

iconSideNav.addEventListener('click',function(){
    console.log('Icon clicked');
    document.getElementById('sidenav-main').classList.toggle('bg-white')
    // get body element
    document.body.classList.toggle('g-sidenav-pinned')
})


// navlink active control base on url param
// get all nav links
document.addEventListener('DOMContentLoaded', () => {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
  
    for (const link of navLinks) {
      const linkPath = new URL(link.href).pathname;
      link.classList.toggle('active', linkPath === currentPath);
    }
  });
  

// chart data penduduk
let chartInstance = null;
async function renderChart() {
    const ctx = document.getElementById('chartPenduduk')
    try {
        const response = await fetch('/admin/chart/penduduk');
        const data = await response.json();

        const { labels, datasets } = data;
        if (chartInstance) {
            chartInstance.destroy();
        }
        chartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Penduduk per Kecamatan per Tahun'
                    }
                },
                 scales: {
                    y: {
                        beginAtZero: true
                    }
                }
                
            }
        });
    } catch (error) {
        console.error('Gagal memuat data chart:', error);
    }
}

// Jalankan setelah DOM siap
document.addEventListener('DOMContentLoaded', renderChart);
