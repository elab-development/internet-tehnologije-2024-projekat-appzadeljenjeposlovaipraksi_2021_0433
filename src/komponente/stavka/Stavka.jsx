import React, { useEffect, useState } from 'react'
import { MdWorkOutline } from "react-icons/md";
import { IoLocationOutline } from "react-icons/io5";
import './Stavka.css'
import logo1 from '../../assets/lidl.png'
import { useNavigate } from 'react-router-dom';
import { collection, getDocs } from 'firebase/firestore';
import { db } from '../../firebase';

function Stavka({stranica, trenutnaStr, velicinaStr, filterGrad, filterTip, onUkupnoStr}) {


  const [nizOglasa, setNizOglasa]=useState([]);
  

  const ref=collection(db,"oglasi");


  const navigate=useNavigate()
  const otvoriOglas=(oglas) =>{
    navigate(`/detaljiOglas/${oglas.id}`)
  }
   

async function getNizOglasa() {
  

  const snapshot = await getDocs(ref);
  const items = [];

  snapshot.docs.forEach(function(doc) {
    const podatak = doc.data();
    podatak.id = doc.id;
    items.push(podatak);
  });

  setNizOglasa(items);
  
}



    useEffect(()=>{
      getNizOglasa();
    }, [])
   


const filtriraniOglasi = nizOglasa.filter(oglas => {
  return (
    (filterGrad === "" || oglas.grad === filterGrad) &&
    (filterTip === "" || oglas.tip === filterTip)
  );
});

const ukupnoStr= Math.ceil(filtriraniOglasi.length/velicinaStr)

useEffect(() => {
 if(onUkupnoStr){
  onUkupnoStr(ukupnoStr)
 }
}, [filtriraniOglasi, velicinaStr]);



const startIndex = (trenutnaStr - 1) * velicinaStr;
const endIndex = startIndex + velicinaStr;
const prikazaniOglasi = filtriraniOglasi.slice(startIndex, endIndex);


return (
  <>
    {prikazaniOglasi.map((oglas) => {
    
      const id=oglas.id;
      const kompanija =oglas.kompanija;
      const grad = oglas.grad;
      const pozicija = oglas.pozicija;
      const rok =oglas.rok;
      const tip= oglas.tip;
      const logo =oglas.logo



      return (
        <div key={id} className='OStavka' onClick={() => otvoriOglas(oglas)}>
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