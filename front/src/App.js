import "./App.css";
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import { useEffect, useState } from "react";

// Komponente
import Navbar from "./komponente/navBar/Navbar";
import Pozadina from "./komponente/PozadinaPocetna/Pozadina";
import Naslov from "./komponente/naslov/Naslov";
import PStavka from "./komponente/pocetnaStavka/PStavka";
import Oglasi from "./komponente/oglasi/Oglasi";
import DetaljiOglas from "./komponente/oglasi/DetaljiOglas";
import Kompanije from "./komponente/kompanije/Kompanije";
import DetaljiKompanije from "./komponente/kompanije/DetaljiKompanije";
import MojProfil from "./komponente/mojProfil/MojProfil";
import Kontakt from "./komponente/kontakt/Kontakt";
import Login from "./komponente/login/Login";
import Register from "./komponente/registracija/Registracija";
import AdminPage from "./adminPage/AdminPage";
import DodajOglas from "./komponente/dodajOglas/DodajOglas";
import MojiOglasi from "./komponente/mojiOglasi/MojiOglasi";

function App() {
  const [token, setToken] = useState(null);
  const [role, setRole] = useState(null);

  useEffect(() => {
    const t = localStorage.getItem("token");
    const r = localStorage.getItem("role");
    setToken(t);
    setRole(r);
  }, []);

  return (
    <BrowserRouter>
      <Navbar />

      <Routes>

        {/* GOST */}
        <Route
          path="/"
          element={
            <>
              <Pozadina />
              <Naslov podnaslov="utisci" naslov="Naših studenata" />
              <PStavka />
            </>
          }
        />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/kontakt" element={<Kontakt />} />
        <Route path="/kompanije" element={<Kompanije />} />
        <Route path="/detaljiKompanija/:id" element={<DetaljiKompanije />} />

        {/* USER */}
        {token && role === "user" && (
          <>
            <Route path="/oglasi" element={<Oglasi />} />
            <Route path="/detaljiOglas/:id" element={<DetaljiOglas />} />
            <Route path="/mojProfil" element={<MojProfil />} />
          </>
        )}

        {/* KOMPANIJA */}
        {token && role === "kompanija" && (
          <>
            <Route path="/dodajOglas" element={<DodajOglas />} />
            <Route path="/mojiOglasi" element={<MojiOglasi />} />
          </>
        )}

        {/* ADMIN */}
        {token && role === "admin" && (
          <Route path="/adminPage" element={<AdminPage />} />
        )}

        {/* FALLBACK */}
        <Route path="*" element={<Navigate to="/" />} />

      </Routes>
    </BrowserRouter>
  );
}

export default App;


