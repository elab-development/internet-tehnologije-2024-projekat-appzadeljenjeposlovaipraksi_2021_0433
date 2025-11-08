import React, { useEffect, useState } from 'react'
import { MdWorkOutline } from "react-icons/md";
import { IoLocationOutline } from "react-icons/io5";
import './Stavka.css'
import logo1 from '../../assets/lidl.png'
import { useNavigate } from 'react-router-dom';
import firebase from '../../firebase';
import { collection, getDocs } from 'firebase/firestore';
import { db } from '../../firebase';

function Stavka({stranica}) {


  const [nizOglasa, setNizOglasa]=useState([]);
  const[Loading, setLoading]=useState(false);

  const ref=collection(db,"oglasi");


  const navigate=useNavigate()
   

async function getNizOglasa() {
  setLoading(true);

  const snapshot = await getDocs(ref);
  const items = [];

  snapshot.docs.forEach(function(doc) {
    const podatak = doc.data();
    podatak.id = doc.id;
    items.push(podatak);
  });

  setNizOglasa(items);
  setLoading(false);
}



    useEffect(()=>{
      getNizOglasa();
    }, [])
   


let trenutni; 

const otvoriOglas = ()=>{
      navigate(`/detaljiOglas/${trenutni.id}`);
    }
return (
  <>
    {nizOglasa.map((oglas) => {
      /*const {id, kompanija, grad, pozicija, rok, tip } = oglas;*/
      const id=oglas.id;
      const kompanija =oglas.kompanija;
      const grad = oglas.grad;
      const pozicija = oglas.pozicija;
      const rok =oglas.rok;
      const tip= oglas.tip;
      const logo =oglas.logo

      trenutni=oglas;

      return (
        <div key={id} className='OStavka' onClick={() => navigate(`/detaljiOglas/${id}`)}>
          <img src={logo} alt={kompanija} />
          <div className="overlay">
            <h3>Prikaži oglas</h3>
          </div>
          <div className='opis'>
            <h3>{pozicija}</h3>
            <h3>Rok za prijavu: {rok}</h3>
          </div>
          <div className="Okomp-info">
            <label>
              <div className="naziv">
                <MdWorkOutline />
                <h3>{kompanija}</h3>
              </div>
            </label>
            <label>
              <div className="lokacija">
                <IoLocationOutline />
                <h3>{grad}</h3>
              </div>
            </label>
            <label>
              <div className="vrsta">
                <h3>{tip}</h3>
              </div>
            </label>
          </div>
        </div>
      );
    })}
  </>
);



}
    


export default Stavka