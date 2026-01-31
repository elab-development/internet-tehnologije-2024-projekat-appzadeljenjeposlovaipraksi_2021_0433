import React, { useEffect, useState } from "react";
import axios from "axios";
import "./MojProfil.css";
import profilna from "../../assets/profile2.jpg";

function MojProfil() {
  const [korisnik, setKorisnik] = useState(null);
  const [prijave, setPrijave] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  useEffect(() => {
    const token = localStorage.getItem("token");

    async function fetchProfil() {
      try {
        const res = await axios.get(
          "http://localhost:8000/api/myprofile",
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        setKorisnik(res.data.data);
      } catch (err) {
        setError("Greška pri učitavanju profila");
      }
    }

    async function fetchPrijave() {
      try {
        const res = await axios.get(
          "http://localhost:8000/api/myPrijave",
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        setPrijave(res.data);
      } catch (err) {
        setError("Greška pri učitavanju prijava");
      }
    }

    Promise.all([fetchProfil(), fetchPrijave()]).finally(() =>
      setLoading(false)
    );
  }, []);

  if (loading) {
    return <p className="loading">Učitavanje profila...</p>;
  }

  if (error) {
    return <p className="error">{error}</p>;
  }

  return (
    <div className="profil-stranica">
      {korisnik && (
        <div className="zaglavlje">
          <img src={profilna} alt="Profil" />
          <div className="info">
            <h2>{korisnik.name}</h2>
            <p>{korisnik.email}</p>
          </div>
        </div>
      )}

      <div className="prijave">
        <h3>Moje prijave na oglase</h3>

        {prijave.length === 0 ? (
          <p>Niste se prijavili ni na jedan oglas.</p>
        ) : (
          <div className="lista-prijava">
            {prijave.map((prijava) => (
              <div className="kartica" key={prijava.id}>
                <h4>{prijava.oglas?.pozicija}</h4>
                <p>{prijava.oglas?.kompanija?.naziv}</p>
                <p>Status: {prijava.status}</p>
              </div>
            ))}
          </div>
        )}
      </div>
    </div>
  );
}

export default MojProfil;
