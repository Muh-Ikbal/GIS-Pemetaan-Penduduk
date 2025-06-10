import React from "react";
import {
    Users,
    
} from "lucide-react";

const Footer = () => {
    return (
        //  {/* Footer */}
        <footer className="bg-gray-900 text-white py-16">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div className="grid md:grid-cols-4 gap-8">
                    <div className="col-span-2">
                        <div className="flex items-center mb-6">
                            <div className="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                                <Users className="w-6 h-6 text-white" />
                            </div>
                            <span className="ml-3 text-2xl font-bold">
                                PopulationGIS
                            </span>
                        </div>
                        <p className="text-gray-400 mb-6 max-w-md">
                            Website pemetaan kepadatan penduduk di Kota Kendari. Menyediakan informasi lengkap mengenai jumlah penduduk, luas wilayah, dan kepadatan penduduk per kecamatan.
                        </p>
                    </div>

                    <div>
                        <h3 className="font-semibold mb-4">Menu</h3>
                        <ul className="space-y-2 text-gray-400">
                            <li>
                                <a
                                    href="/map"
                                    className="hover:text-white transition-colors"
                                >
                                    Maps
                                </a>
                            </li>
                            {/* <li>
                                <a
                                    href="#"
                                    className="hover:text-white transition-colors"
                                >
                                    Analytics
                                </a>
                            </li> */}
                            <li>
                                <a
                                    href="/kecamatan"
                                    className="hover:text-white transition-colors"
                                >
                                    Laporan Kecamatan
                                </a>
                            </li>
                            {/* <li>
                                <a
                                    href="#"
                                    className="hover:text-white transition-colors"
                                >
                                    API
                                </a>
                            </li> */}
                        </ul>
                    </div>

                    <div>
                        <h3 className="font-semibold mb-4">Support</h3>
                        <ul className="space-y-2 text-gray-400">
                            <li>
                                <a
                                    href="#"
                                    className="hover:text-white transition-colors"
                                >
                                    Documentation
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    className="hover:text-white transition-colors"
                                >
                                    Help Center
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    className="hover:text-white transition-colors"
                                >
                                    Contact
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    className="hover:text-white transition-colors"
                                >
                                    Community
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div className="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                    <p>
                        &copy; {new Date().getFullYear()} PopulationGIS. All
                        rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    );
};

export default Footer;
