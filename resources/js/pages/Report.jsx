import React, { useState, useEffect } from "react";
import { getDetailKecamatan } from "../api/api-maps";
import { useParams } from "react-router-dom";
import L from "leaflet";
import "leaflet/dist/leaflet.css";
import axios from "axios";

const Report = () => {
    const [kecamatan, setKecamatan] = useState(null);
    const [penduduk, setPenduduk] = useState([]);
    const params = useParams();
    const id = params.id;

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await getDetailKecamatan(id);
                setKecamatan(response.kecamatan);
                setPenduduk(response.penduduk);
            } catch (err) {
                console.error("Error fetching data:", err);
            }
        };
        fetchData();
    }, [id]);

    useEffect(() => {
        if (!kecamatan) return;

        const map = L.map("map").setView(
            [parseFloat(kecamatan.latitude), parseFloat(kecamatan.longitude)],
            14
        );

        map.createPane("labels");
        map.getPane("labels").style.zIndex = 650;

        L.tileLayer(
            "https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png",
            {}
        ).addTo(map);

        L.tileLayer(
            "https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}.png",
            { pane: "labels" }
        ).addTo(map);

        let isCancelled = false;

        async function renderLayers() {
            if (isCancelled) return;
            const geojsonPath = kecamatan.geojson;
            try {
                const response = await axios.get(
                    `storage/geojson/${geojsonPath}`
                );
                const geojsonLayer = L.geoJSON(response.data, {
                    style: {
                        fillColor: "#8b5cf6",
                        fillOpacity: 0.7,
                        weight: 2,
                        color: "#a855f7",
                    },
                }).addTo(map);
                map.fitBounds(geojsonLayer.getBounds());
            } catch (error) {
                console.error("Error loading geojson:", error);
            }
        }

        renderLayers();

        return () => {
            isCancelled = true;
            map.remove();
        };
    }, [kecamatan]);

    return (
        <div className="min-h-screen bg-white py-8 px-4 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
            <div className="text-center mb-8 pt-20">
                <h1 className="text-2xl md:text-4xl font-bold text-purple-700 mb-4">
                    Laporan Kepadatan Penduduk Kecamatan {kecamatan?.nama_kecamatan || "Kecamatan"}
                </h1>

            </div>

            <div className="max-w-6xl mx-auto rounded-lg overflow-hidden p-4">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div className="bg-green-50 p-2 rounded-lg shadow-inner">
                        <div id="map" className="h-96 w-full z-0 rounded-lg"></div>
                    </div>
                    <div className="bg-purple-50 p-4 rounded-lg shadow-inner">
                        <h2 className="text-xl font-semibold mb-2 text-purple-800">
                            Detail Kecamatan
                        </h2>
                        <p className="text-gray-700 text-sm">
                            {kecamatan?.description || "Tidak ada deskripsi."}
                        </p>
                    </div>
                </div>

                <div className="mt-6">
                    <h3 className="text-lg font-semibold text-purple-700 mb-2">
                        Data Penduduk
                    </h3>
                    {penduduk.length > 0 ? (
                        <div className="overflow-x-auto ">
                            <table className="w-full text-sm text-left text-gray-600 border overflow-x-auto">
                                <thead className="bg-purple-200 text-purple-900">
                                    <tr>
                                        <th className="px-3 py-2">Tahun</th>
                                        <th className="px-3 py-2">
                                            Jumlah Penduduk
                                        </th>
                                        <th className="px-3 py-2">Laki-laki</th>
                                        <th className="px-3 py-2">Perempuan</th>
                                        <th className="px-3 py-2">
                                            Kepadatan (jiwa/km²)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {penduduk.map((row) => (
                                        <tr
                                            key={row.id}
                                            className="even:bg-purple-100"
                                        >
                                            <td className="px-3 py-2">
                                                {row.tahun}
                                            </td>
                                            <td className="px-3 py-2">
                                                {row.jumlah_penduduk}
                                            </td>
                                            <td className="px-3 py-2">
                                                {row.jumlah_laki_laki}
                                            </td>
                                            <td className="px-3 py-2">
                                                {row.jumlah_perempuan}
                                            </td>
                                            <td className="px-3 py-2">
                                                {row.kepadatan_penduduk}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    ) : (
                        <p className="text-gray-500 italic">
                            Belum ada data penduduk tersedia.
                        </p>
                    )}
                </div>


            </div>
        </div>
    );
};

export default Report;
