import React, { useState } from "react";
import "./DodajOglas.css";
import Dugme from "../dugme/Dugme";
import axios from "axios";
import { useNavigate } from "react-router-dom";

function DodajOglas() {
  const [pozicija, setPozicija] = useState("");
  const [opis, setOpis] = useState("");
  const [grad, setGrad] = useState("");
  const [logo, setLogo] = useState("");
  const navigate = useNavigate();

  async function handleSubmit(e) {
    e.preventDefault();

    try {
      const token = localStorage.getItem("token");
      await axios.post(
        "http://localhost:8000/api/oglasi",
        { pozicija, opis, grad, logo },
        { headers: { Authorization: `Bearer ${token}` } }
      );

      alert("Oglas je uspešno dodat!");
      navigate("/oglasi");
    } catch (err) {
      console.error("Greška pri dodavanju oglasa:", err);
      alert("Došlo je do greške pri dodavanju oglasa.");
    }
  }

  return (
    <div className="dodaj-oglas">
      <h1>Dodaj novi oglas</h1>
      <form className="oglas-forma" onSubmit={handleSubmit}>
        <label>
          Naziv pozicije:
          <input
            type="text"
            value={pozicija}
            onChange={(e) => setPozicija(e.target.value)}
            required
          />
        </label>

        <label>
          Opis oglasa:
          <textarea
            value={opis}
            onChange={(e) => setOpis(e.target.value)}
            required
          />
        </label>

        <label>
          Grad:
          <input
            type="text"
            value={grad}
            onChange={(e) => setGrad(e.target.value)}
            required
          />
        </label>

        <label>
          Logo (URL):
          <input
            type="text"
            value={logo}
            onChange={(e) => setLogo(e.target.value)}
          />
        </label>

        <div className="dugme">
          <Dugme tekst="Dodaj oglas" />
        </div>
      </form>
    </div>
  );
}

export default DodajOglas;
