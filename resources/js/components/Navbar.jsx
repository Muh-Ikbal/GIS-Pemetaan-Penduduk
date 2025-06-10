import React, { useState, useEffect } from "react";
import { Link, useLocation } from "react-router-dom";
import { Menu, X, Leaf, Users } from "lucide-react";

export default function Navbar() {
    const [isOpen, setIsOpen] = useState(false);
    const [isScrolled, setIsScrolled] = useState(false);
    const location = useLocation();

    const toggleMenu = () => setIsOpen(!isOpen);

    // Handle scroll effect
    useEffect(() => {
        const handleScroll = () => {
            setIsScrolled(window.scrollY > 20);
        };

        window.addEventListener("scroll", handleScroll);
        return () => window.removeEventListener("scroll", handleScroll);
    }, []);

    // Close mobile menu when route changes
    useEffect(() => {
        setIsOpen(false);
    }, [location]);

    // Check if current path is active
    const isActive = (path) => location.pathname === path;

    const navLinks = [
        { path: "/", label: "Home" },
        { path: "/map", label: "Maps" },
        { path: "/kecamatan", label: "Kecamatan" },
    ];

    return (
        <nav
            className={`fixed w-full z-50 transition-all duration-300 ${
                isScrolled
                    ? "bg-white/95 backdrop-blur-md shadow-lg border-b border-gray-200"
                    : "bg-white shadow-md"
            }`}
        >
            <div className="container mx-auto px-4 sm:px-6 lg:px-8">
                <div className="flex justify-between items-center h-16">
                    {/* Logo */}
                    <Link
                        to="/"
                        className="flex items-center space-x-2 text-xl font-bold text-gray-900 hover:text-purple-600 transition-colors"
                    >
                        <div className="w-8 h-8 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <Users className="w-6 h-6 text-white" />
                        </div>
                        <span>PopulationGIS</span>
                    </Link>

                    {/* Desktop Navigation */}
                    <div className="hidden md:flex items-center space-x-8">
                        {navLinks.map((link) => (
                            <Link
                                key={link.path}
                                to={link.path}
                                className={`relative font-medium transition-colors duration-200 ${
                                    isActive(link.path)
                                        ? "text-purple-600"
                                        : "text-gray-700 hover:text-purple-600"
                                }`}
                            >
                                {link.label}
                                {isActive(link.path) && (
                                    <span className="absolute -bottom-1 left-0 w-full h-0.5 bg-purple-600 rounded-full"></span>
                                )}
                            </Link>
                        ))}
                    </div>

                    {/* Mobile Menu Button */}
                    <div className="md:hidden">
                        <button
                            onClick={toggleMenu}
                            className="p-2 rounded-md text-gray-700 hover:text-purple-600 hover:bg-gray-100 transition-colors"
                            aria-label="Toggle menu"
                        >
                            {isOpen ? (
                                <X className="w-6 h-6" />
                            ) : (
                                <Menu className="w-6 h-6" />
                            )}
                        </button>
                    </div>
                </div>

                {/* Mobile Navigation Dropdown */}
                <div
                    className={`md:hidden z-50 transition-all duration-300 ease-in-out ${
                        isOpen
                            ? "max-h-64 opacity-100"
                            : "max-h-0 opacity-0 overflow-hidden"
                    }`}
                >
                    <div className="py-4 space-y-1 border-t border-gray-200">
                        {navLinks.map((link) => (
                            <Link
                                key={link.path}
                                to={link.path}
                                className={`block px-4 py-3 rounded-lg font-medium transition-colors ${
                                    isActive(link.path)
                                        ? "text-purple-600 bg-purple-50"
                                        : "text-gray-700 hover:text-purple-600 hover:bg-gray-50"
                                }`}
                                onClick={toggleMenu}
                            >
                                {link.label}
                            </Link>
                        ))}
                    </div>
                </div>
            </div>
        </nav>
    );
}
