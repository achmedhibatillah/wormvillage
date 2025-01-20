// Inisialisasi Grafik Mingguan (default bar)
let chartMingguan = new Chart(document.getElementById('grafikSetoran').getContext('2d'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Total Setoran (kg)',
            data: dataSetoran,
            backgroundColor: '#59b865', // Warna tema konsisten
            borderColor: '#006137', // Warna border konsisten
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value;
                    }
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.raw + ' kg';
                    }
                }
            }
        }
    }
});

// Inisialisasi 30 Hari (default bar)
let chartBulanan = new Chart(document.getElementById('grafikSetoranBulanan').getContext('2d'), {
    type: 'bar',
    data: {
        labels: labelsBulanan,
        datasets: [{
            label: 'Total Setoran (kg)',
            data: dataSetoranBulanan,
            backgroundColor: '#59b865', // Warna tema konsisten
            borderColor: '#006137', // Warna border konsisten
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value;
                    }
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.raw + ' kg';
                    }
                }
            }
        }
    }
});

// Inisialisasi Bulanan (default bar)
let chartBulananFix = new Chart(document.getElementById('grafikSetoranBulananFix').getContext('2d'), {
    type: 'bar',
    data: {
        labels: labelsBulananFix,
        datasets: [{
            label: 'Total Setoran (kg)',
            data: dataSetoranBulananFix,
            backgroundColor: '#59b865', // Warna tema konsisten
            borderColor: '#006137', // Warna border konsisten
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value;
                    }
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.raw + ' kg';
                    }
                }
            }
        }
    }
});

// Inisialisasi Keseluruhan (default bar)
let chartAll = new Chart(document.getElementById('grafikSetoranAll').getContext('2d'), {
    type: 'line',
    data: {
        labels: labelsAll,
        datasets: [{
            label: 'Total Setoran (kg)',
            data: dataSetoranAll,
            backgroundColor: 'rgba(89, 184, 101, 0.2)', // Transparan untuk area di bawah grafik
            borderColor: '#006137', // Warna garis grafik
            borderWidth: 2,
            pointRadius: 0 // Menghilangkan titik lingkaran kecil
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value;
                    }
                }
            }
        },
        plugins: {
            tooltip: {
                enabled: false,
            }
        }
    }
});


// Fungsi untuk Mengubah Tipe Grafik
function updateChartType(jenis) {
    if (jenis === 'mingguan') {
        const newType = document.getElementById('chartTypeMingguan').value;
        chartMingguan.destroy(); // Hancurkan grafik lama
        chartMingguan = new Chart(document.getElementById('grafikSetoran').getContext('2d'), {
            type: newType,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Setoran (kg)',
                    data: dataSetoran,
                    backgroundColor: '#59b865', // Warna tema konsisten
                    borderColor: '#006137', // Warna border konsisten
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value;
                            }
                        }
                    }
                }
            }
        });
    } else if (jenis === 'bulanan') {
        const newType = document.getElementById('chartTypeBulanan').value;
        chartBulanan.destroy(); // Hancurkan grafik lama
        chartBulanan = new Chart(document.getElementById('grafikSetoranBulanan').getContext('2d'), {
            type: newType,
            data: {
                labels: labelsBulanan,
                datasets: [{
                    label: 'Total Setoran (kg)',
                    data: dataSetoranBulanan,
                    backgroundColor: '#59b865', // Warna tema konsisten
                    borderColor: '#006137', // Warna border konsisten
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value;
                            }
                        }
                    }
                }
            }
        });
    } else if (jenis === 'bulananFix') {
        const newType = document.getElementById('chartTypeBulananFix').value;
        chartBulananFix.destroy(); // Hancurkan grafik lama
        chartBulananFix = new Chart(document.getElementById('grafikSetoranBulananFix').getContext('2d'), {
            type: newType,
            data: {
                labels: labelsBulananFix,
                datasets: [{
                    label: 'Total Setoran (kg)',
                    data: dataSetoranBulananFix,
                    backgroundColor: '#59b865', // Warna tema konsisten
                    borderColor: '#006137', // Warna border konsisten
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value;
                            }
                        }
                    }
                }
            }
        });
    }
}