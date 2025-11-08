import React from 'react';
import './MojProfil.css';
import logo1 from '../../assets/lidl.png'; // primer slike

function MojProfil() {
  const korisnik = {
    ime: 'Natalija Petrović',
    email: 'natalija@example.com',
    slika: logo1,
  };

  const prijavljeniOglasi = [
    { id: 'o1', nazivPozicije: 'Menadžer prodaje', kompanija: 'Lidl', rok: '12.12.2025' },
    { id: 'o2', nazivPozicije: 'Frontend praktikant', kompanija: 'Nordeus', rok: '01.01.2026' },
    { id: 'o3', nazivPozicije: 'UI/UX dizajner', kompanija: 'Vega IT', rok: '20.11.2025' },
  ];

  return (
    <div className="profil-stranica">
      <div className="zaglavlje">
        <img src={korisnik.slika} alt="Profil" />
        <div className="info">
          <h2>{korisnik.ime}</h2>
          <p>{korisnik.email}</p>
        </div>
      </div>

      <div className="prijave">
        <h3>Prijavljeni oglasi</h3>
        <div className="lista-prijava">
          {prijavljeniOglasi.map((oglas) => (
            <div className="kartica" key={oglas.id}>
              <h4>{oglas.nazivPozicije}</h4>
              <p>{oglas.kompanija}</p>
              <p>Rok: {oglas.rok}</p>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}

export default MojProfil;
