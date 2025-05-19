<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Finder</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            display: flex;
            height: 100vh;
        }
        
        .sidebar {
            width: 260px;
            background-color: #fff;
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .sidebar-header {
            padding: 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .sidebar-header i {
            color: #00a676;
            font-size: 20px;
            margin-right: 10px;
        }
        
        .sidebar-header h1 {
            font-size: 18px;
            color: #333;
            font-weight: bold;
        }
        
        .sidebar-section {
            padding: 15px 20px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .sidebar-section h2 {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .categories-list {
            list-style: none;
        }
        
        .categories-list li {
            padding: 8px 0;
            cursor: pointer;
            color: #333;
            font-size: 14px;
        }
        
        .categories-list li:hover, .categories-list li.active {
            color: #00a676;
        }
        
        .categories-list li.active {
            font-weight: bold;
        }
        
        .about-section {
            padding: 15px 20px;
            margin-top: auto;
        }
        
        .about-section h2 {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .about-section p {
            font-size: 13px;
            color: #333;
            line-height: 1.5;
            margin-bottom: 10px;
        }
        
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        
        .search-bar {
            padding: 15px 20px;
            background-color: #fff;
            border-bottom: 1px solid #e0e0e0;
            z-index: 10;
        }
        
        .search-container {
            position: relative;
        }
        
        .search-container input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            font-size: 14px;
            outline: none;
        }
        
        .search-container i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }
        
        .map-container {
            flex: 1;
            position: relative;
        }
        
        #map {
            width: 100%;
            height: 100%;
            background-color: #f5f5f5;
        }
        
        .zoom-controls {
            position: absolute;
            right: 15px;
            top: 15px;
            z-index: 1000;
        }
        
        .zoom-controls button {
            width: 32px;
            height: 32px;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .zoom-controls button:first-child {
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            border-bottom: none;
        }
        
        .zoom-controls button:last-child {
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        
        .zoom-controls button:hover {
            background-color: #f5f5f5;
        }
        
        .location-label {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #fff;
            padding: 8px 15px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            font-size: 13px;
            color: #333;
            z-index: 1000;
        }
        
        .marker-icon {
            color: #00a676;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-store"></i>
            <h1>UMKM Finder</h1>
        </div>
        
        <div class="sidebar-section">
            <h2>Business Categories</h2>
            <ul class="categories-list">
                <li class="active">All Categories</li>
                <li>Restaurant</li>
                <li>Cafe</li>
                <li>Retail</li>
                <li>Craft</li>
                <li>Service</li>
                <li>Food Stall</li>
            </ul>
        </div>
        
        <div class="about-section">
            <h2>About</h2>
            <p>UMKM Finder helps you discover small businesses in Kendari City.</p>
            <p>Browse the map to find local businesses, filter by category, or search by name.</p>
        </div>
    </div>
    
    <div class="main-content">
        <div class="search-bar">
            <div class="search-container">
                <input type="text" placeholder="Search businesses...">
                <i class="fas fa-search"></i>
            </div>
        </div>
        
        <div class="map-container">
            <div id="map"></div>
            
            <div class="zoom-controls">
                <button id="zoom-in">+</button>
                <button id="zoom-out">−</button>
            </div>
            
            <div class="location-label">
                Kendari, Southeast Sulawesi
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
    <script>
        // Initialize map
        const map = L.map('map', {
            zoomControl: false
        }).setView([-3.9985, 122.5127], 14); // Koordinat Kendari dan zoom level
        
        // Add tile layer (peta dasar)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Custom marker icon
        const greenIcon = L.divIcon({
            className: 'custom-marker',
            html: '<i class="fas fa-map-marker-alt marker-icon"></i>',
            iconSize: [24, 24],
            iconAnchor: [12, 22]
        });
        
        // Contoh data UMKM (dalam aplikasi nyata akan diambil dari database)
        const umkmData = [
            { lat: -3.9975, lng: 122.5107, name: "Warung Pak Budi", category: "Food Stall" },
            { lat: -4.0015, lng: 122.5157, name: "Toko Batik Sulawesi", category: "Craft" },
            { lat: -3.9935, lng: 122.5147, name: "Cafe Kendari", category: "Cafe" },
            { lat: -4.0035, lng: 122.5097, name: "Salon Cantik", category: "Service" },
            { lat: -3.9965, lng: 122.5177, name: "Restoran Raja Laut", category: "Restaurant" },
            { lat: -3.9995, lng: 122.5217, name: "Toko Oleh-oleh", category: "Retail" },
            { lat: -4.0025, lng: 122.5137, name: "Bengkel Motor", category: "Service" }
        ];
        
        // Add markers to map
        umkmData.forEach(umkm => {
            const marker = L.marker([umkm.lat, umkm.lng], {icon: greenIcon}).addTo(map);
            marker.bindPopup(`<b>${umkm.name}</b><br>${umkm.category}`);
        });
        
        // Zoom control buttons
        document.getElementById('zoom-in').addEventListener('click', () => {
            map.zoomIn();
        });
        
        document.getElementById('zoom-out').addEventListener('click', () => {
            map.zoomOut();
        });
        
        // Category filter functionality
        const categoryItems = document.querySelectorAll('.categories-list li');
        categoryItems.forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all items
                categoryItems.forEach(cat => cat.classList.remove('active'));
                
                // Add active class to clicked item
                this.classList.add('active');
                
                // Implement filter logic here
                const selectedCategory = this.textContent;
                console.log("Selected category:", selectedCategory);
                
            });
        });
        
        const searchInput = document.querySelector('.search-container input');
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                const searchTerm = this.value.trim().toLowerCase();
                console.log("Searching for:", searchTerm);
            }
        });
    </script>
</body>
</html>