<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web GIS Kepadatan Penduduk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
        }

        /* Navigation Styles */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 2000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .nav-brand {
            font-size: 1.5em;
            font-weight: 700;
            color: #2c3e50;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-menu {
            display: flex;
            gap: 30px;
            list-style: none;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            text-decoration: none;
            color: #2c3e50;
            font-weight: 600;
            font-size: 1.1em;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link:hover, .nav-link.active {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
        }

        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 5px;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: #2c3e50;
            margin: 3px 0;
            transition: 0.3s;
        }

        /* Page Content Styles */
        .page-content {
            min-height: calc(100vh - 80px);
        }

        .page {
            display: none;
        }

        .page.active {
            display: block;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 2.2em;
            font-weight: 700;
        }

        .header p {
            color: #7f8c8d;
            font-size: 1.1em;
        }

        .controls {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            flex-wrap: wrap;
        }

        .control-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .control-group label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 1.1em;
        }

        .year-selector {
            padding: 12px 20px;
            border: 2px solid #3498db;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            outline: none;
        }

        .year-selector:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
        }

        .year-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .year-btn {
            padding: 10px 20px;
            border: 2px solid #e74c3c;
            border-radius: 20px;
            background: transparent;
            color: #e74c3c;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .year-btn:hover, .year-btn.active {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            color: white;
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }

        .map-container {
            position: relative;
            height: 70vh;
            margin: 0;
            border-radius: 0;
            overflow: hidden;
            box-shadow: inset 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        #map {
            height: 100%;
            width: 100%;
        }

        .info-panel {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            min-width: 250px;
            border: 2px solid rgba(52, 152, 219, 0.2);
        }

        .info-panel h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 1.3em;
            border-bottom: 2px solid #3498db;
            padding-bottom: 8px;
        }

        .info-item {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info-label {
            font-weight: 600;
            color: #34495e;
        }

        .info-value {
            color: #2980b9;
            font-weight: 700;
        }

        .legend {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            border: 2px solid rgba(231, 76, 60, 0.2);
        }

        .legend h4 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 1.1em;
            text-align: center;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .legend-color {
            width: 20px;
            height: 15px;
            margin-right: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        .legend-label {
            font-size: 0.9em;
            color: #2c3e50;
            font-weight: 500;
        }

        .stats-footer {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 20px;
            text-align: center;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 2em;
            font-weight: 700;
            color: #e74c3c;
            display: block;
        }

        .stat-label {
            color: #7f8c8d;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9em;
        }

        /* Detail Page Styles */
        .detail-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .detail-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        .district-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .district-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .district-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border-color: #3498db;
        }

        .district-name {
            font-size: 1.4em;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
        }

        .district-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-box {
            text-align: center;
            padding: 15px;
            border-radius: 15px;
            border: 2px solid #ecf0f1;
        }

        .stat-box.density {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border-color: #2980b9;
        }

        .stat-box.population {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border-color: #c0392b;
        }

        .stat-box.area {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            border-color: #27ae60;
        }

        .stat-number {
            font-size: 1.8em;
            font-weight: 700;
            display: block;
            margin-bottom: 5px;
        }

        .stat-text {
            font-size: 0.9em;
            opacity: 0.9;
        }

        .density-indicator {
            width: 100%;
            height: 8px;
            background: #ecf0f1;
            border-radius: 4px;
            margin-top: 15px;
            overflow: hidden;
        }

        .density-bar {
            height: 100%;
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .year-filter {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-menu {
                position: fixed;
                top: 70px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 70px);
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                flex-direction: column;
                justify-content: flex-start;
                align-items: center;
                gap: 20px;
                padding-top: 50px;
                transition: left 0.3s ease;
            }

            .nav-menu.active {
                left: 0;
            }

            .hamburger {
                display: flex;
            }

            .hamburger.active span:nth-child(1) {
                transform: rotate(-45deg) translate(-5px, 6px);
            }

            .hamburger.active span:nth-child(2) {
                opacity: 0;
            }

            .hamburger.active span:nth-child(3) {
                transform: rotate(45deg) translate(-5px, -6px);
            }

            .controls {
                flex-direction: column;
                gap: 15px;
            }
            
            .year-buttons {
                justify-content: center;
            }
            
            .info-panel, .legend {
                position: relative;
                margin: 20px;
                top: auto;
                right: auto;
                bottom: auto;
            }
            
            .map-container {
                height: 50vh;
            }

            .district-grid {
                grid-template-columns: 1fr;
            }

            .district-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="nav-brand">
                🗺️ Population GIS
            </a>
            <ul class="nav-menu" id="navMenu">
                <li class="nav-item">
                    <a href="#" class="nav-link active" data-page="home">
                        🏠 Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-page="detail">
                        📊 Detail
                    </a>
                </li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="page-content">
        <!-- Home Page -->
        <div id="homePage" class="page active">
            <div class="header">
                <h1>🗺️ Web GIS Kepadatan Penduduk</h1>
                <p>Visualisasi Kepadatan Penduduk per Kecamatan Berdasarkan Tahun</p>
            </div>

            <div class="controls">
                <div class="control-group">
                    <label for="yearSelect">📅 Pilih Tahun:</label>
                    <select id="yearSelect" class="year-selector">
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
                <div class="year-buttons">
                    <button class="year-btn active" data-year="2020">2020</button>
                    <button class="year-btn" data-year="2021">2021</button>
                    <button class="year-btn" data-year="2022">2022</button>
                    <button class="year-btn" data-year="2023">2023</button>
                    <button class="year-btn" data-year="2024">2024</button>
                </div>
            </div>

            <div class="map-container">
                <div id="map"></div>
                
                <div class="info-panel">
                    <h3>📊 Informasi Kecamatan</h3>
                    <div class="info-item">
                        <span class="info-label">Nama:</span>
                        <span class="info-value" id="districtName">Pilih kecamatan</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Kepadatan:</span>
                        <span class="info-value" id="densityValue">- jiwa/km²</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Total Penduduk:</span>
                        <span class="info-value" id="populationValue">- jiwa</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Luas Wilayah:</span>
                        <span class="info-value" id="areaValue">- km²</span>
                    </div>
                </div>

                <div class="legend">
                    <h4>🎨 Legenda Kepadatan</h4>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #2ecc71;"></div>
                        <span class="legend-label">Rendah (< 500)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #f1c40f;"></div>
                        <span class="legend-label">Sedang (500-1500)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #e67e22;"></div>
                        <span class="legend-label">Tinggi (1500-3000)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #e74c3c;"></div>
                        <span class="legend-label">Sangat Tinggi (> 3000)</span>
                    </div>
                </div>
            </div>

            <div class="stats-footer">
                <div class="stat-item">
                    <span class="stat-value" id="totalDistricts">12</span>
                    <span class="stat-label">Total Kecamatan</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value" id="avgDensity">1,247</span>
                    <span class="stat-label">Rata-rata Kepadatan</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value" id="maxDensity">4,521</span>
                    <span class="stat-label">Kepadatan Tertinggi</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value" id="currentYear">2020</span>
                    <span class="stat-label">Tahun Aktif</span>
                </div>
            </div>
        </div>

        <!-- Detail Page -->
        <div id="detailPage" class="page">
            <div class="detail-container">
                <div class="detail-header">
                    <h1>📊 Detail Kepadatan Penduduk per Kecamatan</h1>
                    <p>Data lengkap kepadatan penduduk, populasi, dan luas wilayah setiap kecamatan</p>
                </div>

                <div class="year-filter">
                    <label for="detailYearSelect" style="font-weight: 600; color: #2c3e50; margin-right: 15px;">📅 Filter Tahun:</label>
                    <select id="detailYearSelect" class="year-selector">
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>

                <div class="district-grid" id="districtGrid">
                    <!-- District cards will be generated here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    <script>
        // Data kepadatan penduduk per kecamatan
        const populationData = {
            2020: {
                'Kecamatan A': { density: 1250, population: 45000, area: 36.0, coords: [-7.2575, 112.7521] },
                'Kecamatan B': { density: 2800, population: 78000, area: 27.9, coords: [-7.2675, 112.7421] },
                'Kecamatan C': { density: 850, population: 32000, area: 37.6, coords: [-7.2475, 112.7621] },
                'Kecamatan D': { density: 3500, population: 92000, area: 26.3, coords: [-7.2775, 112.7321] },
                'Kecamatan E': { density: 450, population: 28000, area: 62.2, coords: [-7.2375, 112.7721] },
                'Kecamatan F': { density: 1800, population: 54000, area: 30.0, coords: [-7.2875, 112.7221] },
                'Kecamatan G': { density: 4200, population: 115000, area: 27.4, coords: [-7.2975, 112.7121] },
                'Kecamatan H': { density: 720, population: 36000, area: 50.0, coords: [-7.2175, 112.7821] },
                'Kecamatan I': { density: 2100, population: 68000, area: 32.4, coords: [-7.3075, 112.7021] },
                'Kecamatan J': { density: 980, population: 42000, area: 42.9, coords: [-7.2075, 112.7921] },
                'Kecamatan K': { density: 3200, population: 85000, area: 26.6, coords: [-7.3175, 112.6921] },
                'Kecamatan L': { density: 620, population: 31000, area: 50.0, coords: [-7.1975, 112.8021] }
            },
            2024: {
                'Kecamatan A': { density: 1400, population: 50400, area: 36.0, coords: [-7.2575, 112.7521] },
                'Kecamatan B': { density: 3100, population: 86490, area: 27.9, coords: [-7.2675, 112.7421] },
                'Kecamatan C': { density: 960, population: 36096, area: 37.6, coords: [-7.2475, 112.7621] },
                'Kecamatan D': { density: 3950, population: 103985, area: 26.3, coords: [-7.2775, 112.7321] },
                'Kecamatan E': { density: 540, population: 33588, area: 62.2, coords: [-7.2375, 112.7721] },
                'Kecamatan F': { density: 1980, population: 59400, area: 30.0, coords: [-7.2875, 112.7221] },
                'Kecamatan G': { density: 4650, population: 127410, area: 27.4, coords: [-7.2975, 112.7121] },
                'Kecamatan H': { density: 830, population: 41500, area: 50.0, coords: [-7.2175, 112.7821] },
                'Kecamatan I': { density: 2330, population: 75492, area: 32.4, coords: [-7.3075, 112.7021] },
                'Kecamatan J': { density: 1110, population: 47619, area: 42.9, coords: [-7.2075, 112.7921] },
                'Kecamatan K': { density: 3570, population: 95062, area: 26.6, coords: [-7.3175, 112.6921] },
                'Kecamatan L': { density: 730, population: 36500, area: 50.0, coords: [-7.1975, 112.8021] }
            }
        };

        let map;
        let currentYear = '2020';
        let markers = [];

        // Navigation functionality
        function initNavigation() {
            const navLinks = document.querySelectorAll('.nav-link');
            const pages = document.querySelectorAll('.page');
            const hamburger = document.getElementById('hamburger');
            const navMenu = document.getElementById('navMenu');

            // Navigation click handler
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetPage = this.getAttribute('data-page');
                    
                    // Update active nav link
                    navLinks.forEach(nl => nl.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Show target page
                    pages.forEach(page => page.classList.remove('active'));
                    document.getElementById(targetPage + 'Page').classList.add('active');
                    
                    // Close mobile menu
                    navMenu.classList.remove('active');
                    hamburger.classList.remove('active');
                    
                    // Initialize page-specific functionality
                    if (targetPage === 'home' && !map) {
                        setTimeout(initMap, 100);
                    } else if (targetPage === 'detail') {
                        updateDetailPage();
                    }
                });
            });

            // Hamburger menu toggle
            hamburger.addEventListener('click', function() {
                navMenu.classList.toggle('active');
                hamburger.classList.toggle('active');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!navMenu.contains(e.target) && !hamburger.contains(e.target)) {
                    navMenu.classList.remove('active');
                    hamburger.classList.remove('active');
                }
            });
        }

        // Initialize map
        function initMap() {
            if (map) return; // Prevent multiple initializations
            
            map = L.map('map').setView([-7.2575, 112.7521], 11);
            
            // Add tile layer with attractive style
            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                subdomains: 'abcd',
                maxZoom: 19
            }).addTo(map);
            
            updateMapData();
        }

        // Get density color
        function getDensityColor(density) {
            if (density < 500) return '#2ecc71';
            if (density < 1500) return '#f1c40f';
            if (density < 3000) return '#e67e22';
            return '#e74c3c';
        }

        // Get density category
        function getDensityCategory(density) {
            if (density < 500) return 'Rendah';
            if (density < 1500) return 'Sedang';
            if (density < 3000) return 'Tinggi';
            return 'Sangat Tinggi';
        }

        // Update map data based on year
        function updateMapData() {
            if (!map) return;
            
            // Remove existing markers
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];

            const yearData = populationData[currentYear];
            let totalDensity = 0;
            let maxDensity = 0;
            let districtCount = 0;

            Object.entries(yearData).forEach(([district, data]) => {
                const color = getDensityColor(data.density);
                
                // Create circle marker with size based on density
                const radius = Math.max(5, Math.min(25, data.density / 200));
                
                const marker = L.circleMarker(data.coords, {
                    radius: radius,
                    fillColor: color,
                    color: '#ffffff',
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.8
                }).addTo(map);

                // Add popup
                marker.bindPopup(`
                    <div style="font-family: Arial, sans-serif; min-width: 200px;">
                        <h3 style="color: #2c3e50; margin-bottom: 10px; border-bottom: 2px solid ${color}; padding-bottom: 5px;">
                            📍 ${district}
                        </h3>
                        <div style="margin-bottom: 8px;">
                            <strong>🏘️ Kepadatan:</strong> ${data.density.toLocaleString()} jiwa/km²
                        </div>
                        <div style="margin-bottom: 8px;">
                            <strong>👥 Populasi:</strong> ${data.population.toLocaleString()} jiwa
                        </div>
                        <div style="margin-bottom: 8px;">
                            <strong>📐 Luas:</strong> ${data.area} km²
                        </div>
                        <div style="margin-top: 10px; padding: 8px; background: ${color}; color: white; border-radius: 5px; text-align: center;">
                            <strong>Tahun ${currentYear}</strong>
                        </div>
                    </div>
                `);

                // Event hover for info panel
                marker.on('mouseover', function() {
                    updateInfoPanel(district, data);
                });

                markers.push(marker);
                
                totalDensity += data.density;
                maxDensity = Math.max(maxDensity, data.density);
                districtCount++;
            });

            // Update statistics
            updateStats(districtCount, Math.round(totalDensity / districtCount), maxDensity);
        }

        // Update info panel
        function updateInfoPanel(district, data) {
            document.getElementById('districtName').textContent = district;
            document.getElementById('densityValue').textContent = `${data.density.toLocaleString()} jiwa/km²`;
            document.getElementById('populationValue').textContent = `${data.population.toLocaleString()} jiwa`;
            document.getElementById('areaValue').textContent = `${data.area} km²`;
        }

        // Update statistics footer
        function updateStats(totalDistricts, avgDensity, maxDensity) {
            document.getElementById('totalDistricts').textContent = totalDistricts;
            document.getElementById('avgDensity').textContent = avgDensity.toLocaleString();
            document.getElementById('maxDensity').textContent = maxDensity.toLocaleString();
            document.getElementById('currentYear').textContent = currentYear;
        }

        // Update detail page
        function updateDetailPage() {
            const yearData = populationData[currentYear];
            const districtGrid = document.getElementById('districtGrid');
            
            // Clear existing cards
            districtGrid.innerHTML = '';
            
            // Sort districts by density (descending)
            const sortedDistricts = Object.entries(yearData).sort((a, b) => b[1].density - a[1].density);
            
            sortedDistricts.forEach(([district, data]) => {
                const densityColor = getDensityColor(data.density);
                const densityCategory = getDensityCategory(data.density);
                const densityPercentage = Math.min(100, (data.density / 5000) * 100); // Max scale 5000
                
                const card = document.createElement('div');
                card.className = 'district-card';
                card.innerHTML = `
                    <div class="district-name">${district}</div>
                    <div class="district-stats">
                        <div class="stat-box density">
                            <span class="stat-number">${data.density.toLocaleString()}</span>
                            <span class="stat-text">jiwa/km²</span>
                        </div>
                        <div class="stat-box population">
                            <span class="stat-number">${data.population.toLocaleString()}</span>
                            <span class="stat-text">jiwa</span>
                        </div>
                    </div>
                    <div class="stat-box area" style="grid-column: 1 / -1; margin-bottom: 15px;">
                        <span class="stat-number">${data.area}</span>
                        <span class="stat-text">km²</span>
                    </div>
                    <div style="text-align: center; margin-bottom: 10px;">
                        <strong style="color: ${densityColor};">Kategori: ${densityCategory}</strong>
                    </div>
                    <div class="density-indicator">
                        <div class="density-bar" style="width: ${densityPercentage}%; background: ${densityColor};"></div>
                    </div>
                `;
                
                districtGrid.appendChild(card);
            });
        }

        // Event listeners for year controls
        function initYearControls() {
            document.getElementById('yearSelect').addEventListener('change', function() {
                currentYear = this.value;
                updateMapData();
                updateActiveButton();
                updateDetailPage();
            });

            document.getElementById('detailYearSelect').addEventListener('change', function() {
                currentYear = this.value;
                document.getElementById('yearSelect').value = currentYear;
                updateMapData();
                updateActiveButton();
                updateDetailPage();
            });

            document.querySelectorAll('.year-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    currentYear = this.dataset.year;
                    document.getElementById('yearSelect').value = currentYear;
                    document.getElementById('detailYearSelect').value = currentYear;
                    updateMapData();
                    updateActiveButton();
                    updateDetailPage();
                });
            });
        }

        function updateActiveButton() {
            document.querySelectorAll('.year-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.year === currentYear);
            });
        }

        // Initialize application
        document.addEventListener('DOMContentLoaded', function() {
            initNavigation();
            initYearControls();
            initMap();
            updateDetailPage();
        });
    </script>
</body>
</html>
            