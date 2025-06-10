import React, { useState, useEffect } from "react";
import { getKecamatan } from "../api/api-maps";
const ReportHome = () => {
    const [kecamatan, setKecamatan] = useState([]);
    useEffect(() => {
        const fetchKecamatan = async () => {
            const response = await getKecamatan();
            setKecamatan(response);
            console.log(response)
        };
        fetchKecamatan();
    },[]);
    return (
        <div className="min-h-screen bg-white py-8 px-4 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
            <div className="text-center mb-8 pt-20">
                <h1 className="text-2xl md:text-4xl font-bold text-purple-700 mb-4">
                    Daftar Kecamatan
                </h1>
                <p className="text-gray-600 text-lg">
                    Daftar Kecamatan di Kota Kendari
                </p>
            </div>
            <div className="max-w-6xl mx-auto">
                <div className="overflow-x-auto">
                    <table className="w-full text-sm text-left text-gray-600 border overflow-x-auto">
                        <thead className="bg-purple-200 text-purple-900 text-sm md:text-md">
                            <tr>
                                <th className="px-3 py-2">Nama Kecamatan</th>
                                <th className="px-3 py-2">Luas Kecamatan</th>
                                <th className="px-3 py-2">Kode Pos</th>
                                <th className="px-3 py-2">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            {kecamatan.map((item) => (
                                <tr
                                    key={item.id}
                                    className="border-b even:bg-purple-100 hover:bg-purple-50"
                                >
                                    <td className="px-3 py-2">{item.nama_kecamatan}</td>
                                    <td className="px-3 py-2">
                                        {item.luas} km²
                                    </td>
                                    <td className="px-3 py-2">
                                        {item.kode_pos}
                                    </td>
                                    <td className="px-3 py-2">
                                        <a
                                            href={`/kecamatan/${item.id}`}
                                            className="text-purple-600 hover:underline"
                                        >
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    );
};

export default ReportHome;
