import React, { useEffect, useState } from 'react'
import './Detalji.css'
import Stavka from '../stavka/Stavka'
import Dugme from '../dugme/Dugme'
import Forma from '../kontakt/Forma';
import { useParams } from 'react-router-dom';
import axios from "axios";

export function useOglas(nizOglasa) {
  const { id } = useParams();
  const [tOglas, setTOglas] = useState(null);

  useEffect(() => {
    const trenutniOglas = nizOglasa.find(oglas => String(oglas.id) === String(id));
    setTOglas(trenutniOglas);
  }, [id, nizOglasa]);

  return tOglas;
}

export function useKompanija(nizKomp) {
  const { id } = useParams();
  const [tKomp, setTKomp] = useState(null);

  useEffect(() => {
    const trenutnaKomp = nizKomp.find(k => String(k.id) === String(id));
    setTKomp(trenutnaKomp);
  }, [id, nizKomp]);

  return tKomp;
}

function Detalji({ str }) {
  const { id } = useParams();
  const [modalOpen, setModalOpen] = useState(false);
  const [nizKomp, setNizKomp] = useState([]);
  const [nizOglasa, setNizOglasa] = useState([]);
  const [oglasiKompanije, setOglasiKompanije] = useState([]);

  // Dohvati sve kompanije
  async function getNizKomp() {
    try {
      const res = await axios.get("http://localhost:8000/api/kompanije");
      setNizKomp(res.data);
    } catch (err) {
      console.error("Greška pri dohvaćanju kompanija:", err);
    }
  }

  // Dohvati sve oglase
  async function getNizOglasa() {
    try {
      const res = await axios.get("http://localhost:8000/api/oglasi");
      setNizOglasa(res.data);
    } catch (err) {
      console.error("Greška pri dohvaćanju oglasa:", err);
    }
  }

  // Dohvati oglase za određenu kompaniju
  async function getOglasiKompanije() {
    try {
      const res = await axios.get(`http://localhost:8000/api/kompanije/${id}/oglasi`);
      setOglasiKompanije(res.data);
    } catch (err) {
      console.error("Greška pri dohvaćanju oglasa kompanije:", err);
    }
  }

  useEffect(() => {
    getNizKomp();
    getNizOglasa();
    if (str !== 'O') {
      getOglasiKompanije();
    }
  }, [id, str]);

  const tOglas = useOglas(nizOglasa);
  const tKomp = useKompanija(nizKomp);

  if (str === 'O' && !tOglas) return <p>Učitavanje oglasa...</p>;
  if (str !== 'O' && !tKomp) return <p>Učitavanje kompanije...</p>;

  return (
    <div className='detalji'>
      {/* Detalji oglasa */}
      {str === 'O' && tOglas && (
        <>
          <div className="zaglavlje">
            <img src={tOglas.logo} alt="" />
            <div className="naziv">
              <h2>{tOglas.kompanija}</h2>
              <h3>{tOglas.grad}</h3>
            </div>
          </div>
          <div className="telo">
            <div className="pozicija">
              <h3>Naziv pozicije</h3>
              <p>{tOglas.pozicija}</p>
            </div>
            <div className="oglas-opis">
              <h3>Opis oglasa</h3>
              <p>{tOglas.opis}</p>
            </div>
            <div className='dugme' onClick={() => setModalOpen(true)}>
              <Dugme tekst='Prijavi se' />
            </div>
          </div>
        </>
      )}

      {/*Detalji kompanije */}
      {str !== 'O' && tKomp && (
        <>
          <div className="zaglavlje">
            <img src={tKomp.logo} alt="" />
            <div className="naziv">
              <h2>{tKomp.naziv}</h2>
              <h3>{tKomp.mesto}</h3>
            </div>
          </div>
          <div className="telo">
            <div className="pozicija">
              <h3>Naziv kompanije</h3>
              <p>{tKomp.naziv}</p>
            </div>
            <div className="oglas-opis">
              <h3>Opis kompanije</h3>
              <p>{tKomp.opis}</p>
            </div>
            <div className='ogl'>
              <h3>Aktivni oglasi</h3>
              {oglasiKompanije.length > 0 ? (
                oglasiKompanije.map((oglas) => (
                  <Stavka key={oglas.id} stranica={'O'} {...oglas} />
                ))
              ) : (
                <p>Ova kompanija trenutno nema oglasa.</p>
              )}
            </div>
          </div>
        </>
      )}

      {/* Modal za prijavu */}
      {modalOpen && (
        <div className="modal-overlay" onClick={() => setModalOpen(false)}>
          <div className="modal-content" onClick={(e) => e.stopPropagation()}>
            <button className='zatvori' onClick={() => setModalOpen(false)}>X</button>
            <Forma />
          </div>
        </div>
      )}
    </div>
  )
}

export default Detalji;
