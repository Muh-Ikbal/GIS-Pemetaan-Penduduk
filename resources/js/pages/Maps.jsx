import React, { use, useEffect, useState } from "react";
import L from "leaflet";
import "leaflet/dist/leaflet.css";
import { getMaps, getKecamatan } from "../api/api-maps";
import axios from "axios";
// import { API_URL } from '../api/api-maps';

const Maps = () => {
    const [mapsData, setMapsData] = useState([]);
    const [kecamatanData, setKecamatanData] = useState([]);
    const [selectedYear, setSelectedYear] = useState();
    // function generate color
    function getRandomColor() {
        return "#" + Math.floor(Math.random() * 16777215).toString(16);
    }
    useEffect(() => {
        async function fetchData() {
            try {
                const [kecamatan, maps] = await Promise.all([
                    getKecamatan(),
                    getMaps(),
                ]);
                setKecamatanData(kecamatan);
                setMapsData(maps);
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        }
        fetchData();
    }, []);

    useEffect(() => {
        if (mapsData.length > 0) {
            // Set the initial selected year to the most recent year in the data
            const years = [...new Set(mapsData.map((item) => item.tahun))];
            setSelectedYear(Math.max(...years));
        }
    }, [mapsData, kecamatanData]);
    useEffect(() => {
        // Inisialisasi peta

        const map = L.map("map").setView(
            [-3.992242014553726, 122.53258165448392],
            13
        );
        map.createPane("labels");
        map.getPane("labels").style.zIndex = 650;

        // Tambahkan tile layer (OpenStreetMap)
        L.tileLayer(
            "https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png",
            {}
        ).addTo(map);
        L.tileLayer(
            "https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}.png",
            {
                pane: "labels",
            }
        ).addTo(map);
        L.control
            .scale({
                position: "bottomleft",
                metric: true,
                imperial: false,
                maxWidth: 200,
            })
            .addTo(map);
        let isCancelled = false;
        async function renderLayers() {
            for (const kecamatan of kecamatanData) {
                const colorLine = getRandomColor();
                if (isCancelled) return;
                const response = await axios.get(
                    `storage/geojson/${kecamatan.geojson}`
                );

                const data = response.data;
                console.log(data);
                if (isCancelled) return;

                L.geoJSON(data, {
                    onEachFeature: (feature, layer) => {
                        if (isCancelled) return;

                        const id = kecamatan.id;
                        const dataPenduduk = mapsData.find(
                            (item) =>
                                item.kecamatan.id === id &&
                                item.tahun === selectedYear
                        );
                        if (dataPenduduk) {
                            let color;
                            const kepadatan = dataPenduduk.kepadatan_penduduk;
                            if (kepadatan < 500) {
                                color = "#4ade80 "; // Purple light
                            } else if (kepadatan < 1500) {
                                color = "#eab308"; // Purple medium
                            } else if (kepadatan < 3000) {
                                color = "#f97316 "; // Purple dark
                            } else {
                                color = "#dc2626 "; // Purple very dark
                            }
                            layer.setStyle({
                                fillColor: color,
                                fillOpacity: 0.7,
                                weight: 2,
                                color: colorLine,
                            });
                            layer.bindPopup(
                                `<div class="text-black">
                                            <h3 class="font-bold text-lg mb-2">${
                                                kecamatan.nama_kecamatan
                                            }</h3>
                                            <div class="space-y-1">
                                                <p><span class="font-semibold">Luas:</span> ${
                                                    kecamatan.luas
                                                        ? kecamatan.luas
                                                        : 0
                                                } km²</p>
                                                <p><span class="font-semibold">Kepadatan:</span> ${
                                                    dataPenduduk.kepadatan_penduduk
                                                } jiwa/km²</p>
                                                <p><span class="font-semibold">Total Penduduk:</span> ${
                                                    dataPenduduk.jumlah_penduduk
                                                } jiwa</p>
                                                <p><span class="font-semibold">Tahun:</span> ${
                                                    dataPenduduk.tahun
                                                }</p>
                                                <a class="text-purple-500 active:text-purple-500" href="kecamatan/${
                                                    kecamatan.id
                                                }">detail</a>
                                            </div>
                                        </div>`
                            );
                        } else {
                            layer.setStyle({
                                fillColor: "#e5e7eb",
                                fillOpacity: 0.5,
                                weight: 2,
                                color: "#9ca3af",
                            });
                            layer.bindPopup(
                                `<div class="popup-gray text-black ">
                                            <h3 class="font-bold text-lg mb-2">${kecamatan.nama_kecamatan}</h3>
                                            <p>Data tahun ${selectedYear} tidak tersedia.</p>
                                            <a class="" style="color:##f3f4f6 !important" href="kecamatan/${kecamatan.id}">detail</a>
                                        </div>`
                            );
                        }
                        layer.on("mouseover", () => {
                            document.getElementById("districtName").innerText =
                                kecamatan.nama_kecamatan;
                            if (dataPenduduk) {
                                document.getElementById(
                                    "densityValue"
                                ).innerText =
                                    dataPenduduk.kepadatan_penduduk +
                                    " jiwa/km²";
                                document.getElementById(
                                    "populationValue"
                                ).innerText =
                                    dataPenduduk.jumlah_penduduk + " jiwa";
                            } else {
                                document.getElementById(
                                    "densityValue"
                                ).innerText = "- jiwa/km²";
                                document.getElementById(
                                    "populationValue"
                                ).innerText = "- jiwa";
                            }
                        });
                    },
                }).addTo(map);
            }
        }

        if (kecamatanData.length > 0 && mapsData.length > 0) {
            renderLayers();
        }
        return () => {
            isCancelled = true;
            map.remove();
        };
    }, [kecamatanData]);
    console.log(mapsData);
    return (
        <div className="min-h-screen bg-white py-8 px-3 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
            {/* Header with gradient */}
            <div className="text-center mb-8 pt-20">
                <div className="inline-block">
                    <h1 className="text-2xl md:text-4xl font-bold bg-gradient-to-r from-purple-600 via-purple-500 to-purple-700 bg-clip-text text-transparent mb-4">
                        Pemetaan Kepadatan Penduduk
                    </h1>
                    <div className="h-1 w-full bg-gradient-to-r from-purple-400 via-purple-500 to-purple-600 rounded-full"></div>
                </div>
                <p className="text-gray-600 mt-4 text-lg">
                    Visualisasi data kepadatan penduduk berdasarkan kecamatan
                </p>
            </div>

            {/* Year selector with purple gradient */}
            <div className="flex justify-center mb-8">
                <div className="relative">
                    <select
                        onChange={(e) =>
                            setSelectedYear(parseInt(e.target.value))
                        }
                        className="appearance-none bg-gradient-to-r from-purple-500 to-purple-600 text-black px-8 py-3 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-purple-300 cursor-pointer"
                        value={selectedYear}
                    >
                        {Array.isArray(mapsData) && mapsData.length > 0 ? (
                            [
                                ...new Set(mapsData.map((item) => item.tahun)),
                            ].map((tahun) => (
                                <option
                                    className="text-black"
                                    key={tahun}
                                    value={tahun}
                                >
                                    📅 Tahun {tahun}
                                </option>
                            ))
                        ) : (
                            <option disabled className="text-gray-500">
                                Tidak ada data tahun
                            </option>
                        )}

                        {/* <option value={2025}>📅 Tahun 2025</option>
                        <option value={2024}>📅 Tahun 2024</option>
                        <option value={2023}>📅 Tahun 2023</option>
                        <option value={2022}>📅 Tahun 2022</option>
                        <option value={2021}>📅 Tahun 2021</option> */}
                    </select>
                    <div className="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                        <svg
                            className="w-5 h-5 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth="2"
                                d="M19 9l-7 7-7-7"
                            ></path>
                        </svg>
                    </div>
                </div>
            </div>

            {/* Main content */}
            <div className="max-w-7xl mx-auto">
                <div className="bg-white rounded-2xl shadow-2xl overflow-hidden border border-purple-100">
                    <div className="flex flex-col lg:flex-row min-h-[80vh]">
                        {/* Info Panel */}
                        <div className="w-full lg:w-80 bg-gradient-to-br from-purple-50 to-purple-100 border-b lg:border-b-0 lg:border-r border-purple-200 order-2 lg:order-1">
                            {/* District Info */}
                            <div className="p-4 sm:p-6 border-b border-purple-200">
                                <div className="flex items-center mb-4">
                                    <div className="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mr-3">
                                        <span className="text-white font-bold text-sm sm:text-lg">
                                            📊
                                        </span>
                                    </div>
                                    <h3 className="text-lg sm:text-xl font-bold bg-gradient-to-r from-purple-600 to-purple-700 bg-clip-text text-transparent">
                                        Informasi Kecamatan
                                    </h3>
                                </div>

                                <div className="space-y-3 sm:space-y-4">
                                    <div className="bg-white rounded-lg p-3 sm:p-4 shadow-sm border border-purple-200">
                                        <div className="flex justify-between items-center">
                                            <span className="text-purple-700 font-semibold text-sm sm:text-base">
                                                Nama:
                                            </span>
                                            <span
                                                className="text-gray-700 font-medium text-sm sm:text-base"
                                                id="districtName"
                                            >
                                                Pilih kecamatan
                                            </span>
                                        </div>
                                    </div>

                                    <div className="bg-white rounded-lg p-3 sm:p-4 shadow-sm border border-purple-200">
                                        <div className="flex justify-between items-center">
                                            <span className="text-purple-700 font-semibold text-sm sm:text-base">
                                                Kepadatan:
                                            </span>
                                            <span
                                                className="text-gray-700 font-medium text-sm sm:text-base"
                                                id="densityValue"
                                            >
                                                - jiwa/km²
                                            </span>
                                        </div>
                                    </div>

                                    <div className="bg-white rounded-lg p-3 sm:p-4 shadow-sm border border-purple-200">
                                        <div className="flex justify-between items-center">
                                            <span className="text-purple-700 font-semibold text-sm sm:text-base">
                                                Total Penduduk:
                                            </span>
                                            <span
                                                className="text-gray-700 font-medium text-sm sm:text-base"
                                                id="populationValue"
                                            >
                                                - jiwa
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {/* Legend */}
                            <div className="p-6">
                                <div className="flex items-center mb-4">
                                    <div className="w-10 h-10 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mr-3">
                                        <span className="text-white font-bold text-lg">
                                            🎨
                                        </span>
                                    </div>
                                    <h4 className="text-xl font-bold bg-gradient-to-r from-purple-600 to-purple-700 bg-clip-text text-transparent">
                                        Legenda Kepadatan
                                    </h4>
                                </div>

                                <div className="space-y-3">
                                    <div className="flex items-center bg-white rounded-lg p-3 shadow-sm border border-purple-200">
                                        <div className="w-6 h-6 rounded-full bg-gradient-to-r from-green-300 to-green-400 mr-3 shadow-sm"></div>
                                        <span className="text-gray-700 font-medium">
                                            Rendah (&lt; 500)
                                        </span>
                                    </div>

                                    <div className="flex items-center bg-white rounded-lg p-3 shadow-sm border border-purple-200">
                                        <div className="w-6 h-6 rounded-full bg-gradient-to-r from-yellow-400 to-yellow-500 mr-3 shadow-sm"></div>
                                        <span className="text-gray-700 font-medium">
                                            Sedang (500-1500)
                                        </span>
                                    </div>

                                    <div className="flex items-center bg-white rounded-lg p-3 shadow-sm border border-purple-200">
                                        <div className="w-6 h-6 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 mr-3 shadow-sm"></div>
                                        <span className="text-gray-700 font-medium">
                                            Tinggi (1500-3000)
                                        </span>
                                    </div>

                                    <div className="flex items-center bg-white rounded-lg p-3 shadow-sm border border-purple-200">
                                        <div className="w-6 h-6 rounded-full bg-gradient-to-r from-red-600 to-red-700 mr-3 shadow-sm"></div>
                                        <span className="text-gray-700 font-medium">
                                            Sangat Tinggi (&gt; 3000)
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Map Container */}
                        <div className="flex-1 relative order-1 lg:order-2 min-h-[60vh] lg:min-h-[80vh]">
                            <div className="absolute top-4 right-4 z-10">
                                <div className="bg-white rounded-lg shadow-lg px-4 py-2 border border-purple-200">
                                    <span className="text-purple-700 font-semibold text-xs sm:text-sm">
                                        📍 Interactive Population Map
                                    </span>
                                </div>
                            </div>
                            <div
                                id="map"
                                className="z-0 w-full h-full min-h-[60vh] lg:min-h-[80vh] relative"
                                style={{
                                    background:
                                        "linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%)",
                                }}
                            ></div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Footer gradient line */}
            <div className="mt-8 flex justify-center">
                <div className="w-64 h-1 bg-gradient-to-r from-purple-400 via-purple-500 to-purple-600 rounded-full"></div>
            </div>
        </div>
    );
};

export default Maps;
