import "./App.css";
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import { useState, useEffect } from "react";
import { onAuthStateChanged } from "firebase/auth";
import { auth } from "./firebase";

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

function App() {
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const unsubscribe = onAuthStateChanged(auth, (user) => {
      console.log("Firebase user:", user); 
      setIsAuthenticated(!!user);
      setLoading(false);
    });
    return () => unsubscribe();
  }, []);

  if (loading) return <p>Učitavanje...</p>;

  return (
    <BrowserRouter>
      {/* Navbar se prikazuje samo ako je korisnik prijavljen */}
      {isAuthenticated && <Navbar />}

      <Routes>
        {/* Login i Registracija su uvijek dostupni */}
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />

        {/* Ako nije prijavljen → sve ostalo vodi na login */}
        {!isAuthenticated ? (
          <Route path="*" element={<Navigate to="/login" />} />
        ) : (
          <>
            <Route
              path="/"
              element={
                <>
                  <Pozadina />
                  <Naslov podnaslov="utisci" naslov="Nasih studenata" />
                  <PStavka />
                </>
              }
            />
            <Route path="/oglasi" element={<Oglasi />} />
            <Route path="/detaljiOglas/:id" element={<DetaljiOglas />} />
            <Route path="/kompanije" element={<Kompanije />} />
            <Route path="/detaljiKompanija/:id" element={<DetaljiKompanije />} />
            <Route path="/mojProfil" element={<MojProfil />} />
            <Route path="/kontakt" element={<Kontakt />} />

            <Route path="/login" element={<Navigate to="/" />} />
            <Route path="/register" element={<Navigate to="/" />} />
          </>
        )}
      </Routes>
    </BrowserRouter>
  );
}

export default App;

