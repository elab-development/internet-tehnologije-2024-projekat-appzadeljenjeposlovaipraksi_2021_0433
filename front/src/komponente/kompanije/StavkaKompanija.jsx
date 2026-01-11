import React, { useEffect, useState } from 'react'
import './StavkaKompanije.css'
import { useNavigate } from 'react-router-dom';
import { IoLocationOutline } from "react-icons/io5";
import axios from "axios";

function StavkaKompanija() {
  const [nizKomp, setNizKomp] = useState([]);
  const navigate = useNavigate();

  async function getNizKomp() {
    try {
      const res = await axios.get("http://localhost:8000/api/kompanije"); 
      
      console.log("Kompanije:", res.data);
      if (Array.isArray(res.data)) {
        setNizKomp(res.data.kompanije);
      } else if (Array.isArray(res.data.data)) {
        setNizKomp(res.data.data);
      } else {
        setNizKomp([]);
      }
    } catch (err) {
      console.error("Greška pri dohvaćanju kompanija:", err);
      setNizKomp([]);
    }
  }

  useEffect(() => {
    getNizKomp();
  }, []);

  const otvoriKomp = (komp) => {
    navigate(`/detaljiKompanija/${komp.id}`);
  };

  function getStanje(nazivKomp) {
    return 3; 
  }

  return (
    <>
      {Array.isArray(nizKomp) && nizKomp.map((komp) => {
        let nazivKomp = komp.naziv;
        let lokacija = komp.grad;
        let stanje = getStanje(komp.naziv);
        let id = komp.id;
        let logo = komp.logo;

        return (
          <div className='KStavka' key={id} onClick={() => otvoriKomp(komp)}>
            <img src={logo} alt="" />
            <div className="overlay">
              <h3>Prikaži detalje o kompaniji</h3>
            </div>
            <div className="komp-detalji">
              <div className="naziv">
                <h1>{nazivKomp}</h1>
              </div>
              <label>
                <div className="lokacija">
                  <IoLocationOutline />
                  <h2>{lokacija}</h2>
                </div>
              </label>
            </div>
            <div className="stanje">
              <h3>Trenutno aktivno oglasa: {stanje}</h3>
            </div>
          </div>
        )
      })}
    </>
  )
}

export default StavkaKompanija;
