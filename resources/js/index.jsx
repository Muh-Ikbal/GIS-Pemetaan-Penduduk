import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Navbar from "./components/Navbar";
import Footer from "./components/Footer";
import Home from "./pages/Home";
import Maps from "./pages/Maps";
import Report from "./pages/Report";
import ReportHome from "./pages/ReportHome";
import "../css/app.css";

function App() {
    return (
        <BrowserRouter>
            <Navbar />
            <Routes>
                <Route path="/" element={<Home />} />
                <Route path="/map" element={<Maps />} />
                <Route path="/kecamatan/:id" element={<Report />} />
                <Route path="/kecamatan" element={<ReportHome />} />
            </Routes>
            <Footer />
        </BrowserRouter>
    );
}
const root = ReactDOM.createRoot(document.getElementById("app"));
root.render(<App />);
