import React, { useState } from "react";
import {
    Users,
    BarChart3,
    Map,
    TrendingUp,
    Globe,
    Database,
    Search,
    Filter,
    MapPin,
    PieChart,
} from "lucide-react";


const Home = () => {
    const [activeTab, setActiveTab] = useState("overview");

    return (
        <div className="min-h-screen bg-white">
            {/* Hero Section */}
            <section className="pt-32 pb-20 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="grid lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <h1 className="text-4xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                                Pemetaan Kepadatan Penduduk di Kendari dengan
                                <span className="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                    {" "}
                                    GIS
                                </span>
                            </h1>
                            <p className="text-xl text-gray-600 mb-8 leading-relaxed">
                                Platform web pemetaan kepadatan penduduk di Kota
                                Kendari berdasarkan kecamatan, dilengkapi dengan
                                sistem informasi geografis (GIS) untuk
                                visualisasi data spasial, analisis demografis,
                                dan perencanaan wilayah secara akurat dan
                                real-time.
                            </p>
                            <div className="flex flex-col sm:flex-row gap-4">
                                <a
                                    href="/map"
                                    className="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 flex items-center justify-center"
                                >
                                    <Map className="w-5 h-5 mr-2" />
                                    Explore Maps
                                </a>
                                <a
                                    href="/kecamatan"
                                    className="border-2 border-blue-600 text-blue-600 px-8 py-4 rounded-xl font-semibold hover:bg-blue-50 transition-all duration-300 flex items-center justify-center"
                                >
                                    <BarChart3 className="w-5 h-5 mr-2" />
                                    Lihat Laporan
                                </a>
                            </div>
                        </div>
                        <div className="relative">
                            <div className="bg-white rounded-3xl shadow-2xl p-6 relative">
                                {/* Interactive Dashboard Preview */}
                                <div className="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl h-80 mb-6 relative overflow-hidden">
                                    {/* Map visualization */}
                                    <div className="absolute inset-4">
                                        {/* <div className="grid grid-cols-6 gap-1 h-full"> */}
                                        {/* <Image src="src" alt="alt" width={} height={} /> */}
                                        <img
                                            src="/images/map-preview.png"
                                            alt="Map Preview"
                                            className="col-span-6 h-full w-full object-cover rounded-lg shadow-md"
                                        />
                                        {/* </div> */}
                                    </div>

                                    {/* Floating stats */}
                                    <div className="absolute top-4 right-4 bg-white rounded-lg shadow-lg p-3">
                                        <div className="text-xs text-gray-500 mb-1">
                                            Total Penduduk
                                        </div>
                                        <div className="text-lg font-bold text-gray-900">
                                            355.6K
                                        </div>
                                    </div>

                                    <div className="absolute bottom-4 left-4 bg-white rounded-lg shadow-lg p-3">
                                        <div className="text-xs text-gray-500 mb-1">
                                            Kepadatan/km²
                                        </div>
                                        <div className="text-lg font-bold text-gray-900">
                                            1,355
                                        </div>
                                    </div>
                                </div>

                                {/* Quick stats */}
                                <div className="grid grid-cols-3 gap-4">
                                    <div className="text-center">
                                        <div className="text-2xl font-bold text-blue-600">
                                            11
                                        </div>
                                        <div className="text-sm text-gray-500">
                                            Kecamatan
                                        </div>
                                    </div>
                                    <div className="text-center">
                                        <div className="text-2xl font-bold text-purple-600">
                                            297 KM²
                                        </div>
                                        <div className="text-sm text-gray-500">
                                            Luas
                                        </div>
                                    </div>
                                    <div className="text-center">
                                        <div className="text-2xl font-bold text-green-600">
                                            24/7
                                        </div>
                                        <div className="text-sm text-gray-500">
                                            Updates
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {/* Floating elements */}
                            <div className="absolute -top-6 -left-6 bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl p-4 shadow-lg">
                                <TrendingUp className="w-8 h-8 text-white" />
                            </div>
                            <div className="absolute -bottom-6 -right-6 bg-gradient-to-br from-green-500 to-blue-500 rounded-2xl p-4 shadow-lg">
                                <Globe className="w-8 h-8 text-white" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Features Overview */}
            <section className="py-20 bg-white">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="text-center mb-16">
                        <h2 className="text-4xl font-bold text-gray-900 mb-4">
                            Fitur{" "}
                            <span className="text-blue-600">Unggulan</span>
                        </h2>
                        <p className="text-xl text-gray-600 max-w-3xl mx-auto">
                            Solusi lengkap untuk pemetaan dan analisis kepadatan
                            penduduk di Kota Kendari, dilengkapi teknologi GIS
                            terdepan untuk mendukung perencanaan wilayah
                            berbasis data spasial.
                        </p>
                    </div>

                    <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div className="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                            <div className="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <Map className="w-8 h-8 text-blue-600" />
                            </div>
                            <h3 className="text-xl font-bold text-gray-900 mb-4">
                                Pemetaan Interaktif
                            </h3>
                            <p className="text-gray-600 leading-relaxed">
                                Visualisasi data populasi dalam bentuk peta
                                interaktif dengan berbagai layer dan filter
                                untuk analisis mendalam.
                            </p>
                        </div>

                        <div className="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                            <div className="w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-200 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <BarChart3 className="w-8 h-8 text-purple-600" />
                            </div>
                            <h3 className="text-xl font-bold text-gray-900 mb-4">
                                Analisis Demografis
                            </h3>
                            <p className="text-gray-600 leading-relaxed">
                                Analisis komprehensif struktur gender, kepadatan penduduk,
                                luas wilayah, dan karakteristik demografis
                                lainnya.
                            </p>
                        </div>

                        <div className="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                            <div className="w-16 h-16 bg-gradient-to-br from-green-100 to-green-200 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <TrendingUp className="w-8 h-8 text-green-600" />
                            </div>
                            <h3 className="text-xl font-bold text-gray-900 mb-4">
                                Proyeksi Populasi
                            </h3>
                            <p className="text-gray-600 leading-relaxed">
                                Prediksi pertumbuhan populasi dengan model
                                statistik advanced untuk perencanaan jangka
                                panjang.
                            </p>
                        </div>


                        <div className="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                            <div className="w-16 h-16 bg-gradient-to-br from-orange-100 to-orange-200 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <Globe className="w-8 h-8 text-orange-600" />
                            </div>
                            <h3 className="text-xl font-bold text-gray-900 mb-4">
                                Spatial Analysis
                            </h3>
                            <p className="text-gray-600 leading-relaxed">
                                Analisis spasial lanjutan untuk mengidentifikasi
                                pola, cluster, dan hubungan geografis.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {/* Interactive Demo Section */}
            {/* <section className="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="grid lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <h2 className="text-4xl font-bold text-gray-900 mb-6">
                                Platform yang{" "}
                                <span className="text-blue-600">Powerful</span>
                            </h2>
                            <p className="text-lg text-gray-600 mb-8">
                                PopulationGIS memberikan kemampuan analisis yang
                                mendalam dengan interface yang user-friendly
                                untuk berbagai kebutuhan penelitian dan
                                perencanaan.
                            </p>

                            <div className="space-y-4">
                                <div className="flex items-start space-x-4">
                                    <div className="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <Search className="w-4 h-4 text-blue-600" />
                                    </div>
                                    <div>
                                        <h4 className="font-semibold text-gray-900">
                                            Advanced Search & Filter
                                        </h4>
                                        <p className="text-gray-600">
                                            Pencarian data dengan filter
                                            kompleks berdasarkan kriteria
                                            geografis dan demografis
                                        </p>
                                    </div>
                                </div>

                                <div className="flex items-start space-x-4">
                                    <div className="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <Filter className="w-4 h-4 text-purple-600" />
                                    </div>
                                    <div>
                                        <h4 className="font-semibold text-gray-900">
                                            Multi-Layer Visualization
                                        </h4>
                                        <p className="text-gray-600">
                                            Visualisasi multi-layer untuk
                                            analisis komprehensif dengan konteks
                                            geografis
                                        </p>
                                    </div>
                                </div>

                                <div className="flex items-start space-x-4">
                                    <div className="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <MapPin className="w-4 h-4 text-green-600" />
                                    </div>
                                    <div>
                                        <h4 className="font-semibold text-gray-900">
                                            Location Intelligence
                                        </h4>
                                        <p className="text-gray-600">
                                            Analisis berbasis lokasi untuk
                                            insight yang actionable dan
                                            strategic planning
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="bg-white rounded-3xl shadow-2xl p-8">
                            <div className="flex space-x-4 mb-6">
                                <button
                                    onClick={() => setActiveTab("overview")}
                                    className={`px-4 py-2 rounded-lg font-medium transition-colors ${
                                        activeTab === "overview"
                                            ? "bg-blue-600 text-white"
                                            : "bg-gray-100 text-gray-600 hover:bg-gray-200"
                                    }`}
                                >
                                    Overview
                                </button>
                                <button
                                    onClick={() => setActiveTab("analysis")}
                                    className={`px-4 py-2 rounded-lg font-medium transition-colors ${
                                        activeTab === "analysis"
                                            ? "bg-blue-600 text-white"
                                            : "bg-gray-100 text-gray-600 hover:bg-gray-200"
                                    }`}
                                >
                                    Analysis
                                </button>
                                <button
                                    onClick={() => setActiveTab("reports")}
                                    className={`px-4 py-2 rounded-lg font-medium transition-colors ${
                                        activeTab === "reports"
                                            ? "bg-blue-600 text-white"
                                            : "bg-gray-100 text-gray-600 hover:bg-gray-200"
                                    }`}
                                >
                                    Reports
                                </button>
                            </div>

                            <div className="h-64 bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl relative overflow-hidden">
                                {activeTab === "overview" && (
                                    <div className="p-6">
                                        <h3 className="text-lg font-semibold mb-4">
                                            Population Overview
                                        </h3>
                                        <div className="grid grid-cols-2 gap-4">
                                            <div className="bg-white rounded-lg p-4">
                                                <div className="text-2xl font-bold text-blue-600">
                                                    2.4M
                                                </div>
                                                <div className="text-sm text-gray-500">
                                                    Total Population
                                                </div>
                                            </div>
                                            <div className="bg-white rounded-lg p-4">
                                                <div className="text-2xl font-bold text-green-600">
                                                    +2.3%
                                                </div>
                                                <div className="text-sm text-gray-500">
                                                    Growth Rate
                                                </div>
                                            </div>
                                            <div className="bg-white rounded-lg p-4">
                                                <div className="text-2xl font-bold text-purple-600">
                                                    1,250
                                                </div>
                                                <div className="text-sm text-gray-500">
                                                    Density/km²
                                                </div>
                                            </div>
                                            <div className="bg-white rounded-lg p-4">
                                                <div className="text-2xl font-bold text-orange-600">
                                                    34.2
                                                </div>
                                                <div className="text-sm text-gray-500">
                                                    Median Age
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                )}

                                {activeTab === "analysis" && (
                                    <div className="p-6">
                                        <h3 className="text-lg font-semibold mb-4">
                                            Demographic Analysis
                                        </h3>
                                        <div className="space-y-3">
                                            <div className="bg-white rounded-lg p-3 flex justify-between items-center">
                                                <span className="text-sm">
                                                    Age 0-17
                                                </span>
                                                <div className="flex items-center">
                                                    <div className="w-16 h-2 bg-blue-200 rounded mr-2">
                                                        <div className="w-8 h-2 bg-blue-600 rounded"></div>
                                                    </div>
                                                    <span className="text-sm font-medium">
                                                        25%
                                                    </span>
                                                </div>
                                            </div>
                                            <div className="bg-white rounded-lg p-3 flex justify-between items-center">
                                                <span className="text-sm">
                                                    Age 18-64
                                                </span>
                                                <div className="flex items-center">
                                                    <div className="w-16 h-2 bg-green-200 rounded mr-2">
                                                        <div className="w-12 h-2 bg-green-600 rounded"></div>
                                                    </div>
                                                    <span className="text-sm font-medium">
                                                        65%
                                                    </span>
                                                </div>
                                            </div>
                                            <div className="bg-white rounded-lg p-3 flex justify-between items-center">
                                                <span className="text-sm">
                                                    Age 65+
                                                </span>
                                                <div className="flex items-center">
                                                    <div className="w-16 h-2 bg-purple-200 rounded mr-2">
                                                        <div className="w-3 h-2 bg-purple-600 rounded"></div>
                                                    </div>
                                                    <span className="text-sm font-medium">
                                                        10%
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                )}

                                {activeTab === "reports" && (
                                    <div className="p-6">
                                        <h3 className="text-lg font-semibold mb-4">
                                            Generated Reports
                                        </h3>
                                        <div className="space-y-3">
                                            <div className="bg-white rounded-lg p-3 flex items-center justify-between">
                                                <div>
                                                    <div className="font-medium text-sm">
                                                        Quarterly Report Q1 2024
                                                    </div>
                                                    <div className="text-xs text-gray-500">
                                                        Population Trends
                                                    </div>
                                                </div>
                                                <button className="text-blue-600 text-xs font-medium">
                                                    Download
                                                </button>
                                            </div>
                                            <div className="bg-white rounded-lg p-3 flex items-center justify-between">
                                                <div>
                                                    <div className="font-medium text-sm">
                                                        Urban Planning Analysis
                                                    </div>
                                                    <div className="text-xs text-gray-500">
                                                        Spatial Distribution
                                                    </div>
                                                </div>
                                                <button className="text-blue-600 text-xs font-medium">
                                                    Download
                                                </button>
                                            </div>
                                            <div className="bg-white rounded-lg p-3 flex items-center justify-between">
                                                <div>
                                                    <div className="font-medium text-sm">
                                                        Migration Patterns
                                                    </div>
                                                    <div className="text-xs text-gray-500">
                                                        5-Year Analysis
                                                    </div>
                                                </div>
                                                <button className="text-blue-600 text-xs font-medium">
                                                    Download
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </section> */}

           
        </div>
    );
};

export default Home;
